<?php

namespace App\Http\Controllers;

use League\Csv\Reader;
use League\Csv\Writer;
use Illuminate\Http\Request;
use League\Csv\CharsetConverter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;


class ImportdataController extends Controller
{
    public function user()
    {
        return view('importdata.user');
    }

    public function vehicle()
    {
        return view('importdata.vehicle');
    }

    public function export()
    {
        return view('importdata.export');
    }

    public function importUser(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt,xlsx|max:2048',
        ]);

        $file = $request->file('csv_file');
        $csv = Reader::createFromPath($file->getPathname());

        $csv->setHeaderOffset(0);
        $header = $csv->getHeader();

        $tableName = "user";

        if (!Schema::hasTable($tableName)) {
            return redirect()->back()->with('message', 'Selected table does not exist');
        }

        // // Check the file format
        // $expectedFormat = ['id', 'name', 'lastname', 'display_name', 'company_name', 'gender', 'birth_date', 'email', 'contact_person', 'password', 'mobile_no', 'landline_no', 'address', 'image', 'join_date', 'designation', 'left_date', 'account_no', 'ifs_code', 'branch_name', 'tin_no', 'pan_no', 'gst_no', 'country_id', 'state_id', 'city_id', 'role', 'role_id', 'language', 'timezone', 'custom_field', 'soft_delete', 'branch_id', 'remember_token', 'created_at', 'updated_at'];
        // $headerDiff = array_diff($expectedFormat, $header);
        // if (!empty($headerDiff)) {
        //     // dd("Selected file is empty. Please upload a valid file with data.");
        //     return redirect()->back()->with('message', 'Invalid file format Please select valid file.');
        // }

        // foreach ($csv as $record) {
        //     $data = [];

        //     foreach ($header as $columnName) {
        //         $data[$columnName] = $record[$columnName];
        //     }

        //     DB::table($tableName)->insert($data);
        // }

        $selectedColumns = ['name', 'gender', 'email', 'password', 'mobile_no', 'address', 'join_date', 'designation', 'country_id', 'role', 'role_id'];

        foreach ($csv as $record) {
            $data = [];

            foreach ($header as $columnName) {
                if (in_array($columnName, $selectedColumns)) {
                    if ($columnName === 'gender') {
                        $data[$columnName] = (strtolower($record[$columnName]) === 'female') ? 1 : 0;
                    } elseif ($columnName === 'password') {
                        $data[$columnName] = Hash::make($record[$columnName]);
                    } elseif ($columnName === 'join_date') {
                        if (empty($record[$columnName])) {
                            $data[$columnName] = null;
                        } else {
                            $date = date('Y-m-d', strtotime(str_replace('/', '-', $record[$columnName])));
                            $data[$columnName] = $date;
                        }
                    } elseif ($columnName === 'designation' && empty($record[$columnName])) {
                        $data[$columnName] = null;
                    } else {
                        $data[$columnName] = $record[$columnName];
                    }
                } else {
                    $data[$columnName] = null;
                }
            }
            $data['branch_id'] = 1;
            $data['image'] = 'avtar.png';
            $data['language'] = 'en';
            $data['timezone'] = 'UTC';
            DB::table($tableName)->insert($data);
        }
        return redirect()->back()->with('message', 'Data Imported Successfully');
    }

    public function exportData(Request $request)
    {
        // Establish a database connection
        $conn = DB::connection()->getPdo();
        $table = $request->query('table');
        // dd($table);

        $query = "SELECT * FROM $table";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // dd($results);
        if (!empty($results)) {
            // Create a CSV writer
            $csv = Writer::createFromPath($table . '.csv', 'w+');
            $csv->setOutputBOM(Writer::BOM_UTF8);

            // Insert the header row
            $csv->insertOne(array_keys($results[0]));

            // Insert the data rows
            $csv->insertAll($results);
            $conn = null;
        } else {
            return redirect()->back()->with('message', 'Data Not avaliable');
        }

        // Download the CSV file
        return response()->download($table . '.csv')->deleteFileAfterSend(true);
    }
}
