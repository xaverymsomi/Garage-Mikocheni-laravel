<div id="stockprint">
  <div class="col-xl-12 col-md-12 col-sm-12 mb-3">
    <label class="fw-bold">{{ trans('message.Manufacturer Name') }} : </label>
    <label class=""> <?php echo getProductName($product->product_type_id); ?> </label>
  </div>
  <div class="col-xl-12 col-md-12 col-sm-12">
    <label class="fw-bold">{{ trans('message.Product Name') }} : </label>
    <label class=""> <?php echo $product->name; ?> </label>
  </div>
  <form id="manageStockForm" action="{!! url('/stoke/list/addstock') !!}" method="POST">
    @csrf
    <div class="modal-body ps-0">
      <!-- Input fields for updating product quantity -->
      <div class="row">
        <div class="col-md-3 data_popup">
          <label class="fw-bold pt-2">{{ trans('message.Quantity') }} :</label>
        </div>
        <div class="col-md-8 data_popup">
          <input type="hidden" name="product_id" id="product_id" value="{{ $p_id }}">
          <input type="number" name="quantity" id="quantity" class="form-control model_input" value="{{ $quantity }}">
        </div>
        <div class="col-md-4 data_popup pt-3">
          <button type="button" class="btn btn-success model_submit addcolor ms-0" colorurl="{!! url('/color_name_add') !!}">{{ trans('message.Submit') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  var originalQuantity = <?php echo $quantity; ?>;

  $('body').on('input', '#quantity', function() {
    var newQuantity = parseInt($(this).val(), 10);

    // Check if the new quantity is less than the original quantity
    if (newQuantity < originalQuantity) {
      swal({
        title: 'Quantity cannot be less than the original quantity.',
        icon: 'warning',
        button: "OK",
        dangerMode: true,
      });

      // Reset the input value to the original quantity
      $(this).val(originalQuantity);
    } else {
      // Update the originalQuantity when the quantity is greater
      originalQuantity = newQuantity;
    }
  });

  $('body').on('click', '.model_submit', function() {
    $('#manageStockForm').find('input[name="quantity"]').val(originalQuantity);
    $('#manageStockForm').submit();
  });
</script>