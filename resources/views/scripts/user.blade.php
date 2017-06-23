<?php ?>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


<script>
    $(document).ready(function () {
        $('#table').DataTable();
    });
</script>

<script>

    $(document).on('click', '.edit-modal', function () {
        $('#footer_action_button').text(" Update");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').removeClass('delete');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        var stuff = $(this).data('info').split(',');
        fillmodalData(stuff)
        $('#myModal').modal('show');
    });
    $(document).on('click', '.delete-modal', function () {
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').removeClass('edit');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete');
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        var stuff = $(this).data('info').split(',');
        $('.did').text(stuff[0]);
        $('.dname').html(stuff[1] + " " + stuff[2]);
        $('#myModal').modal('show');
    });

    function fillmodalData(details) {
        $('#id').val(details[0]);
        $('#name').val(details[1]);
        $('#email').val(details[2]);
    }

    $('.modal-footer').on('click', '.edit', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            type: 'PUT',
            url: '/users/' + $("#id").val(),
            data: {
                'name': $('#name').val(),
                'email': $('#email').val()

            },
            success: function (data) {
                if (data.errors) {
                    $('#myModal').modal('show');
                    if (data.errors.name) {
                        $('.name_error').removeClass('hidden');
                        $('.name_error').text("Name can't be empty !");
                    }
                    if (data.errors.email) {
                        $('.email_error').removeClass('hidden');
                        $('.email_error').text("Email must be a valid one !");
                    }

                }
                else {

                    $('.error').addClass('hidden');
                    $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" +
                        data.id + "</td><td>" + data.name +
                        "</td><td>" + data.email + "</td>" + "<td>" + data.created_at + "</td>"+
                        "<td><button class='edit-modal btn btn-info' data-info='" + data.id + ","
                        + data.name + "," + data.email +
                        "'><span class='glyphicon glyphicon-edit'></span> Edit</button> " +
                        "<button class='delete-modal btn btn-danger' data-info='" + data.id +
                        "," + data.first_name + "," + data.last_name + "," + data.email +  "," + data.created_at +
                        "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

                }
            }
        });
    });
    $('.modal-footer').on('click', '.delete', function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'DELETE',
            url: '/users/'+$('.did').text(),
            data: {
                 'id': $('.did').text()
            },
            success: function (data) {
                $('.item' + $('.did').text()).remove();
            }
        });
    });
</script>