 <table class="table table-bordered  adddatatable main_data_points f-14" id="main_data_points" align="center">
   <thead>
     <tr>
       <th class="fw-bold">{{ trans('message.Category') }}</th>
       <th class="fw-bold" style="width:10%;">{{ trans('message.Observation Point') }}</th>
       <th class="fw-bold" style="width:10%;">{{ trans('message.Service Charge') }}</th>
       <th class="fw-bold" style="width:10%;">{{ trans('message.Select Product') }}</th>
       <th class="fw-bold" style="width:9%;">{{ trans('message.Price') }}
         (<?php echo getCurrencySymbols(); ?>)
       </th>
       <th class="fw-bold" style="width:10%;">{{ trans('message.Qty') }}</th>
       <th class="fw-bold" style="width:10%;">{{ trans('message.Total') }}
         (<?php echo getCurrencySymbols(); ?>)</th>
       <th class="fw-bold" style="width:10%;">{{ trans('message.Chargeable') }}</th>
       <th class="fw-bold">{{ trans('message.Comments') }}</th>
       <th class="fw-bold">{{ trans('message.Action') }}</th>
     </tr>
   </thead>

   <tbody id="tbd">
     <?php $i = 1; ?>
     <?php foreach ($data as $datas) { ?>
       <tr class="obs_point_data" id="<?php echo 'row_id_delete_' . $i; ?>">
         <td>
           <input type="text" name="product2[category][]" class="form-control" value="<?php echo $datas->checkout_subpoints; ?>" readonly="true">
           <input type="hidden" name="pro_id_delete" class="del_pro_<?php echo $i; ?>" id="del_pro_<?php echo $i; ?>" value="<?php echo $datas->id; ?>">
         </td>

         <td>
           <input type="text" name="product2[sub_points][]" class="form-control" value="<?php echo $datas->checkout_point; ?>" readonly="true">
         </td>

         <td>

           <input type="number" name="product2[service_charge][]" value="<?php echo $datas->service_charge; ?>" class="form-control charge charge_{{ $i }}" row_id="{{ $i }}" maxlength="8">
         </td> 

         <td>
           <select name="product2[product_id][]" class="form-control product_ids product1s_{{ $i }} form-select" url="{{ url('/jobcard/getprice') }}" row_did="{{ $i }}" id="product1s_{{ $i }}" qtyappend="">
             <option value="">{{ trans('message.Select Product') }}</option>
             <?php foreach ($product as $products) {
                if ($products->id == $datas->product_id) {
                  $is_select = "selected";
                } else {
                  $is_select = "";
                }
              ?>
               <option value="<?php echo $products->id; ?>" <?php echo $is_select; ?>><?php echo $products->name; ?></option>
             <?php } ?>
           </select>
         </td>

         <td>
           <input type="text" name="product2[price][]" value="<?php if (!empty($data)) {
                                                                echo $datas->price;
                                                              } ?>" value="<?php echo $products->price; ?>" class="form-control prices rate product1_<?php echo $i; ?> product1_<?php echo $i; ?> price_<?php echo $i; ?>" id="product1_<?php echo $i; ?> " row_id="{{ $i }}" maxlength="8" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
         </td>

         <td>
           <input type="number" min="0" oninput="this.value = Math.abs(this.value)" name="product2[qty][]" class="pe-0 form-control qtyt qnt_<?php echo $i; ?> <?php echo 'qty_' . $i; ?>" row_id1="<?php echo $i; ?>" value="<?php if (!empty($data)) {
                                                                                                                                                                                                                            echo $datas->quantity;
                                                                                                                                                                                                                          } ?>" url="<?php echo url('/jobcard/gettotalprice'); ?>" id="<?php echo 'qty_' . $i; ?>" style="width:100%;float:left;">
         </td>

         <td>
           <input type="text" name="product2[total][]" value="<?php if (!empty($data)) {
                                                                echo $datas->total_price;
                                                              } ?>" value="0" class="form-control total1 total1_<?php echo $i; ?>" id="total1_<?php echo $i; ?>" readonly="true" />
         </td>

         <td>
           <input type="radio" name="yesno_[]<?php echo $i; ?>" class="yes_no m-0" value="1" <?php if ($datas->chargeable == 1) {
                                                                                                echo 'checked';
                                                                                              } ?> style=" height:13px; width:20px;">{{ trans('message.Yes') }}

           <input type="radio" name="yesno_[]<?php echo $i; ?>" class="yes_no" value="0" <?php if ($datas->chargeable == 0) {
                                                                                            echo 'checked';
                                                                                          } ?> style="height:13px; width:20px; margin-right:0px;">{{ trans('message.No') }}
         </td>
         <td>
           <textarea name="product2[comment][]" class="form-control" maxlength="250">{{ $datas->category_comments }}</textarea>
         </td>
         <td class="text-center">
           <i class="fa fa-trash fa-2x delete" style="cursor: pointer;" data_id_trash="<?php echo $i; ?>" delete_data_url=" <?php echo url('/jobcard/delete_on_reprocess'); ?>" service_id="<?php echo $s_id; ?>"></i>
           <input type="hidden" name="obs_id[]" class="form-control" value="<?php echo $datas->id; ?>">
         </td>
       </tr>
       <?php $i++; ?>
     <?php } ?>
   </tbody>
 </table>

 <script>
   $(document).ready(function() {
     $('#main_data_points').DataTable({
       //responsive: true,
       scrollX: true,
       paging: false,
       lengthChange: false,
       searching: false,
       ordering: false,
       info: false,
       autoWidth: true,
       sDom: 'lfrtip',
       "language": {

         "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/<?php echo getLanguageChange();
         ?>.json"
       },
       aoColumnDefs: [{
         bSortable: false,
         aTargets: [-1]
       }]
     });


     $('body').on('keyup', '.qtyt', function() {

       var row_id = $(this).attr('row_id1');
       var productid = $('.product1s_' + row_id).find(":selected").val();
       var qty = $(this).val();
       var price = $('.product1_' + row_id).val();
       var url = $(this).attr('url');

       var msg1 = "{{ trans('message.No Product Available') }}";
       var msg2 = "{{ trans('message.OK') }}";

       $.ajax({
         type: 'GET',
         url: url,
         data: {
           qty: qty,
           price: price,
           productid: productid
         },
         success: function(response) {
           var newd = $.trim(response);
           if (newd == '1') {
            swal({  
                    title: msg1,
                    icon: 'warning',
                    cancelButtonColor: '#C1C1C1',
                    buttons: {
                      cancel: msg3,
                    },
                    dangerMode: true,
                });
             jQuery('.qty_' + row_id).val('');
           } else {
             jQuery('.total1_' + row_id).val('');
             jQuery('.total1_' + row_id).val(response);
             jQuery('#product1s_' + row_id).attr('qtyappend', qty);
           }
         },
         beforeSend: function() {

         },
         error: function(e) {
           console.log(e);
         }
       });
     });


     $('body').on('change', '.product_ids', function() {

       var row_id = $(this).attr('row_did');
       var product_id = $(this).val();
       var qt = $(this).attr('qtyappend');
       if (qt == '') {
         qt = $('.qnt_' + row_id).val();
       }
       var url = $(this).attr('url');

       $.ajax({
         type: 'GET',
         url: url,
         data: {
           product_id: product_id
         },
         success: function(response) {
           if (qt != '') {
             var ttl = qt * response[0];
             jQuery('.total1_' + row_id).val(ttl);
           }
           jQuery('.product1_' + row_id).val(response[0]);
           $('.unit_' + row_id).html(response[1].substr(0, 3));
         },
         error: function(e) {
           console.log(e);
         }
       });
     });
   });
 </script>