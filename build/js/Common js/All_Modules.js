/*Free service*/
// Dash board Module
$(".openmodel").click(function () {

    $('.modal-body').html("");
    var open_id = $(this).attr("open_id");

    var url = $(this).attr('url');
    $.ajax({
        type: 'GET',
        url: url,
        data: {
            open_id: open_id
        },
        success: function (data) {
            $('.modal-body').html(data.html);
        },

        beforeSend: function () {
            $(".modal-body").html(
                "<center><h2 class=text-muted><b>Loading...</b></h2></center>");
        },

        error: function (e) {
            alert("An error occurred: " + e.responseText);
            // console.log(e);
        }
    });
});


/*Paid service*/
$(".completedservice").click(function () {

    $('.modal-body').html("");

    var c_service = $(this).attr("c_service");

    var url = $(this).attr('url');

    $.ajax({
        type: 'GET',
        url: url,
        data: {
            open_id: c_service
        },

        success: function (data) {
            $('.modal-body').html(data.html);
        },

        beforeSend: function () {
            $(".modal-body").html(
                "<center><h2 class=text-muted><b>Loading...</b></h2></center>");
        },

        error: function (e) {
            alert("An error occurred: " + e.responseText);
            // console.log(e);
        }
    });
});



/*Repeat Job service*/
$(".service-up").click(function () {

    $('.modal-body').html("");

    var u_service = $(this).attr("u_service");

    var url = $(this).attr('url');

    $.ajax({
        type: 'GET',
        url: url,
        data: {
            open_id: u_service
        },

        success: function (data) {
            $('.modal-body').html(data.html);
        },

        beforeSend: function () {
            $(".modal-body").html(
                "<center><h2 class=text-muted><b>Loading...</b></h2></center>");
        },

        error: function (e) {
            alert("An error occurred: " + e.responseText);
            // console.log(e);
        }
    });
});



/*Free customer model service*/
$(".customeropenmodel").click(function () {

    $('.modal-body').html("");

    var open_customer_id = $(this).attr("open_customer_id");
    var url = $(this).attr('url');

    $.ajax({
        type: 'GET',
        url: url,
        data: {
            servicesid: open_customer_id
        },

        success: function (data) {
            $('.modal-body').html(data.html);
        },

        beforeSend: function () {
            $(".modal-body").html(
                "<center><h2 class=text-muted><b>Loading...</b></h2></center>");
        },

        error: function (e) {
            alert("An error occurred: " + e.responseText);
            // console.log(e);
        }
    });
});
$(".toogle_item").click(function () {

    if (document.getElementById("app-layout").classList.contains('nav-sm')) {

        document.getElementById("app-layout").classList.add('nav-md');

        document.getElementById("app-layout").classList.remove('nav-sm');
    } else {
        document.getElementById("app-layout").classList.add('nav-sm');

        document.getElementById("app-layout").classList.remove('nav-md');
    }
});




/*if check wizard is displaying or hide*/
var hideVal = $('.mainRowDiv').attr('isHide');

if (hideVal == 1) {
    //Nothing to do
} else {
    $('.mainBoxClass').removeClass('calculationBoxes');
}

// Supplier Module
$(document).ready(function () {
    $('.select_country').change(function () {
        countryid = $(this).val();
        var url = $(this).attr('countryurl');
        $.ajax({
            type: 'GET',
            url: url,
            data: {
                countryid: countryid
            },
            success: function (response) {
                $('.state_of_country').html(response);
            }
        });
    });


    $('body').on('change', '.state_of_country', function () {
        stateid = $(this).val();

        var url = $(this).attr('stateurl');
        $.ajax({
            type: 'GET',
            url: url,
            data: {
                stateid: stateid
            },
            success: function (response) {
                $('.city_of_state').html(response);
            }
        });
    });


    // Basic
    $('.dropify').dropify();

    // Translated
    $('.dropify-fr').dropify({
        messages: {
            default: 'Glissez-déposez un fichier ici ou cliquez',
            replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
            remove: 'Supprimer',
            error: 'Désolé, le fichier trop volumineux'
        }
    });

    // Used events
    var drEvent = $('#input-file-events').dropify();

    drEvent.on('dropify.beforeClear', function (event, element) {
        return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
    });

    drEvent.on('dropify.afterClear', function (event, element) {
        alert('File deleted');
    });

    drEvent.on('dropify.errors', function (event, element) {
        console.log('Has Errors');
    });

    var drDestroy = $('#input-file-to-destroy').dropify();
    drDestroy = drDestroy.data('dropify')
    $('#toggleDropify').on('click', function (e) {
        e.preventDefault();

        if (drDestroy.isDropified()) {
            drDestroy.destroy();
        } else {
            drDestroy.init();
        }
    });



    /*For image preview at selected image*/
    function readUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imagePreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image").change(function () {
        readUrl(this);
        $("#imagePreview").css("display", "block");
    });

    $('body').on('change', '.chooseImage', function () {
        var imageName = $(this).val();
        var imageExtension = /(\.jpg|\.jpeg|\.png)$/i;

        if (imageExtension.test(imageName)) {
            $('.imageHideShow').css({
                "display": ""
            });
        } else {
            $('.imageHideShow').css({
                "display": "none"
            });
        }
    });


    /*If any white space for companyname, firstname, lastname and addresstext are then make empty value of these all field*/
    $('body').on('keyup', '.companyname', function () {

        var companyName = $(this).val();

        if (!companyName.replace(/\s/g, '').length) {
            $(this).val("");
        }
    });

    $('body').on('keyup', '#firstname', function () {

        var firstName = $(this).val();

        if (!firstName.replace(/\s/g, '').length) {
            $(this).val("");
        }
    });

    $('body').on('keyup', '#lastname', function () {

        var lastName = $(this).val();

        if (!lastName.replace(/\s/g, '').length) {
            $(this).val("");
        }
    });

    $('body').on('keyup', '.addressTextarea', function () {

        var addressValue = $(this).val();

        if (!addressValue.replace(/\s/g, '').length) {
            $(this).val("");
        }
    });
});
// Supplier Module End

// Purchase Module Start
$('body').on('change', '.select_producttype', function() {
    var row_id = $(this).attr('row_did');
    var m_id = $(this).val();
    var url = $(this).attr('m_url');

    $.ajax({
      type: 'GET',
      url: url,
      data: {
        m_id: m_id
      },
      success: function(response) {
        $('.select_productname_' + row_id).html(response);
      }
    });
  });
  var msg100 = "{{ trans('message.An error occurred :') }}";

      $("#add_new_product").click(function() {
        var url = $(this).attr('url');

        var row_len = jQuery(".row_number").length;
        if (row_len > 0) {
          var num = jQuery(".row_number:last").val();
          var row_id = parseInt(num) + 1;
        } else {
          var row_id = 0;
        }

        $.ajax({
          type: 'GET',
          url: url,
          data: {
            row_id: row_id
          },

          beforeSend: function() {
            $("#add_new_product").prop('disabled', false);
          },
          success: function(response) {
            $("#tab_taxes_detail > tbody").append(response.html);
            $('.adddatatable').add($(response.html));
            $("#add_new_product").prop('disabled', false);
            return false;
          },
          error: function(e) {
            alert(msg100 + " " + e.responseText);
            console.log(e);
          }
        });
      });
      $('body').on('click', '.product_delete', function() {
        var row_id = $(this).attr('data-id');
        $('table#tab_taxes_detail tr#row_id_' + row_id).fadeOut();
        $('table#tab_taxes_detail tr.child').fadeOut();

        $('table#tab_taxes_detail tr#row_id_' + row_id).html('<option value="">Select product</option>');
        $('table#tab_taxes_detail tr#row_id_' + row_id).html(
          '<input type="text" name="" class="form-control qty" value="" id="tax_1" readonly="true">');
        $('table#tab_taxes_detail tr#row_id_' + row_id).html(
          '<input type="text" name="" class="form-control price" value="" id="tax_1" readonly="true">');
        $('table#tab_taxes_detail tr#row_id_' + row_id).html(
          '<input type="text" name="" class="form-control total_price" value="" id="tax_1" readonly="true">');
        $('table#tab_taxes_detail tr#row_id_' + row_id).html('<span class="product_delete" data-id="0"></span>');
        return false;
      });
      $('body').on('change', '.productid', '.qty', function() {
        var row_id = $(this).attr('row_did');
        var p_id = $(this).val();
        var qty = $('.qty_' + row_id).val();
        var price = $('.price_' + row_id).val();
        var url = $(this).attr('url');

        $.ajax({
          type: 'GET',
          url: url,
          data: {
            p_id: p_id
          },
          success: function(response) {
            var json_obj = jQuery.parseJSON(response);
            var price = json_obj['price'];
            var total_price = price * qty;
            $('.price_' + row_id).val(price);
            $('.total_price_' + row_id).val(total_price);
            var product_no = json_obj['product_no'];
            $('.qty_' + row_id).html(product_no);
          },
          error: function(e) {
            alert(msg100 + " " + e.responseText);
            console.log(e);
          }
        });
      });

      $('#supplier_select').change(function() {
        var supplier_id = $(this).val();
        var url = $(this).attr('url');

        $.ajax({
          type: 'GET',
          url: url,
          data: {
            supplier_id: supplier_id
          },
          success: function(response) {
            var res_supplier = jQuery.parseJSON(response);

            $('#mobile').attr('value', res_supplier.mobile_no);
            $('#email').attr('value', res_supplier.email);
            $('#address').text(res_supplier.address);
          },
          beforeSend: function() {
            $('#mobile').attr('value', 'Loading..');
            $('#email').attr('value', 'Loading..');
            $('#address').attr('value', 'Loading..');
          },
          error: function(e) {
            alert(msg100 + " " + e.responseText);
            console.log(e);
          }
        });
      });
      $('body').on('change', '.purchaseDate', function() {
        var pDateValue = $(this).val();

        if (pDateValue != null) {
          $('#pur_date-error').css({
            "display": "none"
          });
        }

        if (pDateValue != null) {
          $(this).parent().parent().removeClass('has-error');
        }
      });

// Purchase Module End
