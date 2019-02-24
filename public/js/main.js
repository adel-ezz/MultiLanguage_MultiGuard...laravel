var callbackfoInline=function () {
    $.fn.editable.defaults.mode = 'inline';
    $('.editable').editable({
        ajaxOptions: {
            type: 'put',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        },
        type: 'text',
        title: __['Put Valid Data'],
        validate: function (value) {
        if (value === null || value === '') {
            return __['required'];
        }
    },
    success: function (data) {
        console.log(data);
    },
    error: function (data) {
        console.log(data);
    }

    });
};
$(document).on('click', '.add-entry', function (e) {
    e.preventDefault();
    var target = $(this);
    var form = $(target).parent().parent();
    var url = $(form).attr('action');
    // console.log(form.serializeArray());
    $.ajax({
        method: "post",
        url: url,
        data: form.serializeArray(),
        success: function (result) {

            if(result == 3)
            {
                swal('success', {
                    icon: "success",
                    buttons: false,
                    timer: 2000
                });
                $('#example1').DataTable().ajax.reload(callbackfoInline);
                $('#AddModal').modal('toggle');
                $(':input.form-control').val('');
            }
            else
            {
                swal(__['error try again'],{
                    icon: "error",
                    buttons: false,
                    timer: 2000,
                });
                // $(':input.form-control').val('');

            }

        }

    });
});
$(document).on('click', '.delete-entry', function (e) {
    e.preventDefault();
    var target = $(this);
    swal({
        title: __['Are You sure you want to delete this item ?'],
        text: __['if we delete it we cant retrieve it again '],
        icon: "warning",
        buttons: {
            confirm: {
                text: __['Delete'],
                value: true,
                visible: true,
                closeModal: false
            },
            cancel: {
                text: __['cancel'],
                value: null,
                visible: true,
                closeModal: true
            }
        },
        dangerMode: true,
    }).then(function (willDelete) {
        if (willDelete) {
            var form = $(target).parent();
            var url = $(form).attr('action');
            $('.swal-modal .swal-button').first().addClass('swal-button--loading')[0].disabled = true;
            $.ajaxSetup({
                dataType: "json",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            $.post(url, $.param({json: true, _method: "DELETE"}), function (result) {
                // alert(result);
                if (result.state == true) {
                    // Remove
                    swal('success', {
                        icon: "success",
                        buttons: false,
                        timer: 2000
                    });
                    $('#example1').DataTable().ajax.reload(callbackfoInline);
                    // $('#gallery_table').ajax.reload();
                    // form.parent().parent().parent().parent('.productFav').fadeOut();
                    // form.parents('tr').fadeOut();
                }
                else {
                    swal('Error!!', {
                        icon: "error",
                        buttons: false,
                        timer: 2000
                    });
                }
            }).always(function () {

                //$('.swal-modal .swal-button').first().removeClass('swal-button--loading')[0].disabled=false;
            });
        }

    });


});
$(document).on('click', '.update-entry', function (e) {
    e.preventDefault();
    var target = $(this);
    var form = $(target).parent().parent();
    var url = $(form).attr('action');
    $.ajax({
        method: "PUT",
        url: url,
        data: form.serializeArray(),
        success: function (e) {
            console.log(e);
            if(e == 3)
            {
                swal('success', {
                    icon: "success",
                    buttons: false,
                    timer: 2000
                });

                $(':input.form-control').val('');
                $('.editpass').modal('hide');
            }else
            {
                swal(__['error try again'],{
                    icon: "error",
                    buttons: false,
                    timer: 2000,
                });
            }

        }

    });
});


// $(document).ready(function () {
//     $.fn.editable.defaults.mode = 'inline';
//     $('.editable').editable({
//         ajaxOptions: {
//             type: 'put',
//             dataType: 'json',
//             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
//         },
//         success: function (data, config) {
//         },
//         error: function (errors) {
//
//         }
//     });
// });


