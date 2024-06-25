<div class="modal-header">

    <h4 id="myLargeModalLabel" class="modal-title text-center">{{ getNameSystem() }}</h4>


    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
    <!-- <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
        <h1 class="text-center">{{ trans('message.Payment History') }}</h1>
    </div> -->
    <h4 id="myLargeModalLabel" class="modal-title text-center">{{ trans('message.Payment History for Invoice Number') }} -
        {{ $tbl_invoices->invoice_number }}
    </h4>
    <br>


    <div class="table-responsive">
        <?php $total = 0;
        $i = 1; ?>
        @if (!empty($tbl_payment_records))
        <table id="datatable" class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 5%;">#</th>
                    <th>{{ trans('message.Payment Number') }}</th>
                    <th>{{ trans('message.Payment Type') }}</th>
                    <th>{{ trans('message.Payment Date') }}</th>
                    <th style="width: 20%;">{{ trans('message.Amount') }} ({{ getCurrencySymbols() }})</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tbl_payment_records as $tbl_payment_recordss)
                <!-- @if ($tbl_payment_recordss->amount != 0) -->

                <tr class="texr-left">
                    <td>{{ $i }}</td>
                    <td>{{ $tbl_payment_recordss->payment_number }}</td>
                    <td>{{ GetPaymentMethod($tbl_payment_recordss->payment_type) }}</td>
                    <td>{{ date(getDateFormat(), strtotime($tbl_payment_recordss->payment_date)) }}</td>
                    <td>{{ number_format($tbl_payment_recordss->amount, 2) }} <?php $total += $tbl_payment_recordss->amount; ?></td>

                    <?php $i++; ?>
                </tr>
                <!-- @else -->
                <!-- <tr>
                    <td class="cname text-center" colspan="5">{{ trans('message.No records are available for unpaid invoice.') }}</td>
                </tr> -->

            </tbody>
            <!-- @endif -->
            @endforeach

        </table>
        @endif
    </div>

    <br />
    <div class="">
        <table class="table paymentmodal table-bordered">
            <tr>
                <td align="right" style="width: 80%;">{{ trans('message.Total Paid') }} ({{ getCurrencySymbols() }}) :</td>
                <td class="fw-bold"> {{ number_format($total, 2) }}</td>
            </tr>
            <tr>
                <td align="right">{{ trans('message.Due Amount') }} ({{ getCurrencySymbols() }}) :</td>
                <?php
                $grand_total = $tbl_invoices->grand_total;
                $paid_amount = $tbl_invoices->paid_amount;
                $AmountDue = $grand_total - $paid_amount;
                ?>
                <td class="fw-bold">{{ number_format($AmountDue, 2) }} </td>
            </tr>
        </table>
    </div>
    <div class="modal-footer p-0">
        <button type="button" class="btn btn-outline-secondary btn-sm mx-0" data-bs-dismiss="modal">{{ trans('message.Close') }}</button>
    </div>
</div>