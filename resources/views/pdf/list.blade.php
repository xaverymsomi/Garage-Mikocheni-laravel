<div class="x_panel">
  <table id="datatable-buttons"
    class="table table-striped jambo_table"
    style="margin-top:20px;">
    <thead>
      <tr>
        <th>#</th>
        <th>{{ trans('message.Invoice Number') }}</th>
        <th>{{ trans('message.Customer Name') }}</th>
        <th>{{ trans('message.Invoice For') }}</th>
        <th>{{ trans('message.Payment Type') }}</th>
        <th>{{ trans('message.Total Amount') }} ({{ getCurrencySymbols() }})</th>

        <th>{{ trans('message.Date') }}</th>
        <th>{{ trans('message.Action') }}</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; ?>
      @foreach ($invoices as $invoices)
        <tr class="texr-left">
          <td>{{ $i }}</td>
          <td>{{ $invoices->invoice_number }}</td>
          <td>{{ getCustomerName($invoices->customer_id) }}</td>
          <td>
            @if (getVehicleName($invoices->job_card) == null)
              {{ $invoices->job_card }}
              @else{{ getVehicleName($invoices->job_card) }}
            @endif
          </td>
          <td>{{ $invoices->payment_type }}</td>
          <td>{{ number_format($invoices->total_amount, 2) }}</td>

          <td>{{ date(getDateFormat(), strtotime($invoices->date)) }}</td>
          <td>
            <?php $userid = Auth::User()->id; ?>
            @if (getActiveCustomer($userid) == 'yes')
              <button type="button"
                data-toggle="modal"
                data-target="#myModal-job"
                type_id="{{ $invoices->type }}"
                serviceid="{{ $invoices->sales_service_id }}"
                auto_id="{{ $invoices->id }}"
                url="{!! url('/jobcard/modalview') !!}"
                sale_url="{!! url('/sales/list/modal') !!}"
                class="btn btn-round btn-info save">{{ trans('message.View Invoice') }}</button>

              <a href="{!! url('/invoice/list/edit/' . $invoices->id) !!}"><button type="button"
                  class="btn btn-round btn-success">{{ trans('message.Edit') }}</button></a>

              <a url="{!! url('/invoice/list/delete/' . $invoices->id) !!}"
                class="sa-warning"><button type="button"
                  class="btn btn-round btn-danger">{{ trans('message.Delete') }}</button></a>
            @else
              <button type="button"
                data-toggle="modal"
                data-target="#myModal-job"
                type_id="{{ $invoices->type }}"
                serviceid="{{ $invoices->sales_service_id }}"
                auto_id="{{ $invoices->id }}"
                url="{!! url('/jobcard/modalview') !!}"
                sale_url="{!! url('/sales/list/modal') !!}"
                class="btn btn-round btn-info save">{{ trans('message.View Invoice') }} </button>
            @endif
          </td>

        </tr>
        <?php $i++; ?>
      @endforeach
    </tbody>
  </table>
</div>
