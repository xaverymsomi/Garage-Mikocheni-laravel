<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use DB;
use App\Mail\ServiceMail;
use App\User;
use App\JobcardDetail;
use Carbon\Carbon;
use App\EmailLog;
use App\MailNotification;

class ServiceReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:serviceReminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command. 
     *
     * @return int
     */

    public function handle()
    {
        $reminderDate = Carbon::now()->addDays(7)->toDateString();

        $jobcardDetails = JobcardDetail::whereDate('next_date', $reminderDate)->get();

        if ($jobcardDetails->count() > 0) {
            foreach ($jobcardDetails as $jobcardDetail) {
                $userId = $jobcardDetail->customer_id;
                $user = User::find($userId);

                if ($user) {
                    // Check if the reminder email has already been sent for this job card detail
                    if ($jobcardDetail->reminder_sent == 0) {

                        // Create the email message

                        $systemName = DB::table('tbl_settings')->first();
                        $systemname = $systemName->system_name;
                        $emailformat = DB::table('tbl_mail_notifications')->where('notification_for', '=', 'reminder_mail')->first();
                        $mail_subjects = $emailformat->subject;
                        $mail_format = $emailformat->notification_text;
                        $mail_send_from = $emailformat->send_from;
                        $firstname = $user->name;
                        $search1 = array('{ system_name }');
                        $replace1 = array($systemname);
                        $mail_sub = str_replace($search1, $replace1, $mail_subjects);
                        $search = array('{ system_name }', '{ user_name }', '{ date }');
                        $replace = array($systemname, $firstname, $reminderDate);

                        $email_content = str_replace($search, $replace, $mail_format);

                        $data = array(
                            'email' => $user->email,
                            'mail_sub1' => $mail_sub,
                            'email_content1' => $email_content, 
                            'emailsend' => $mail_send_from,
                        );

                        $data1 = Mail::send('customer.customermail', $data, function ($message) use ($data) {
                            $message->from($data['emailsend'], 'noreply');
                            $message->to($data['email'])->subject($data['mail_sub1']);
                        });

                        // Update the reminder_sent status
                        $jobcardDetail->reminder_sent = 1;
                        $jobcardDetail->save();

                        // Store email log entry 
                        $emailLog = new EmailLog();
                        $emailLog->recipient_email = $data['email'];
                        $emailLog->subject = $data['mail_sub1'];
                        $emailLog->content = $data['email_content1'];
                        $emailLog->save();
                    }
                }
            }
        }

        return 0;
    }
}
