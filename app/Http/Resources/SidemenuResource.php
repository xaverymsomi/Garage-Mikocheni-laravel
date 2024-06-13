<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SidemenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $regex = json_decode($this->permissions);

        $sidemenu = [
            'dashboard' => $regex->dashboard_view ?? false,
            'suppliers' => $regex->supplier_view ?? false,
            'product' => $regex->product_view ?? false,
            'purchase' => $regex->purchase_view ?? false,
            'stock' => $regex->stock_view ?? false,

            'customers' => $regex->customer_view ?? false,
            'employees' => $regex->employee_view ?? false,
            'support_staffs' => $regex->supportstaff_view ?? false,
            'accountants' => $regex->accountant_view ?? false,
            'branch_admin' => $regex->branchAdmin_view ?? false,

            'list_vehicle' => $regex->vehicle_view ?? false,
            'list_vehicle_type' => $regex->vehicletype_view ?? false,
            'list_vehicle_brand' => $regex->vehiclebrand_view ?? false,
            'colors' => $regex->colors_view ?? false,

            'services' => $regex->service_view ?? false,
            'quotation' => $regex->quotation_view ?? false,
            'invoices' => $regex->invoice_view ?? false,

            'job_card' => $regex->jobcard_view ?? false,
            'gate_pass' => $regex->gatepass_view ?? false,

            'list_tax_rates' => $regex->taxrate_view ?? false,
            'list_payment_method' => $regex->paymentmethod_view ?? false,
            'income' => $regex->income_view ?? false,
            'expenses' => $regex->expense_view ?? false,

            'companyvehicle_sells' => $regex->companyvehicle_view ?? false,
            'companyvehicle' => $regex->companyvehicle ?? false,
            'labor_hours' => $regex->labor_hours ?? false,
            'part_sells' => $regex->salespart_view ?? false,
            'compliances' => $regex->rto_view ?? false,
            'reports' => $regex->report_view ?? false,
            'email_templates' => $regex->emailtemplate_view ?? false,
            'custom_fields' => $regex->customfield_view ?? false,
            'observation_library' => $regex->observationlibrary_view ?? false,
            'branch' => $regex->branch_view ?? false,
            'settings' => $regex->generalsetting_view ?? false,
        ];

        if ($this->name === 'admin' || $this->name === 'branch_admin') {
            foreach ($sidemenu as $key => $value) {
                $sidemenu[$key] = true;
            }
        }

        return [
            'id' => $this->id,
            'role_name' => $this->role_name,
            'permissions' => $sidemenu,
        ];
    }
}
