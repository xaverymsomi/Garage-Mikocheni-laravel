$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var checkedCount = 0;
    var checkboxes = $('input[name="chk"]');
    var totalRows = $('table tbody tr').length;
    var selectAll = $('input[name="selectAll"]'); 


    $('#select-all-btn').click(function () {
        var checkboxes = $('input[name="chk"]');
        checkboxes.prop('checked', !checkboxes.prop('checked'));
    });

    checkboxes.change(function () {
        // Update checkedCount every time a checkbox changes
        checkedCount = checkboxes.filter(':checked').length;
        if (checkedCount === totalRows) {
            selectAll.prop('checked', true); // Set the "Select All" checkbox to true
        } else {
            selectAll.prop('checked', false); // Set the "Select All" checkbox to false if not all checkboxes are checked
        }
    });

    $('#delete-selected-btn').click(function () {
        var selectedIds = [];
        var deleteUrl = $(this).data('url');
        // console.log("inside function");
        $('input[name="chk"]:checked').each(function () {
            selectedIds.push($(this).closest('tr').data('user-id'));
        });

        if (selectedIds.length === 0) {
            swal({
                title: "Please select atleast one record",
                icon: 'warning',
                button: "OK",
                dangerMode: true,
            });
            return;
        }
        else {
            var msg1 = "Are You Sure?";
            var msg2 = "You will not be able to recover this data afterwards!";
            var msg3 = "Cancel";
            var msg4 = "Yes, delete!";

            swal({
                title: msg1,
                text: msg2,
                icon: 'warning',
                cancelButtonColor: '#C1C1C1',
                buttons: [msg3, msg4],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: deleteUrl,
                        method: 'POST',
                        data: {
                            _token: csrfToken,
                            ids: selectedIds
                        },
                        success: function (response) {
                            selectedIds.forEach(function (id) {
                                $('tr[data-user-id="' + id + '"]').remove();
                            });
                            location.reload();
                        },
                        error: function () {
                            alert('An error occurred while deleting selected rows.');
                        }
                    });
                }
            });
        }
    });
});
