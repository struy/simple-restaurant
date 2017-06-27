<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="http://cdn.rawgit.com/hilios/jQuery.countdown/2.0.4/dist/jquery.countdown.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.13/moment-timezone.min.js"></script>


<script>
    $(document).ready(function () {
        $('#table').DataTable({

//            ajax: '/cuisine/json',
//            dataSrc: 'staff',
//            columns: [
//                { data: 'id' },
//                { data: 'dishe.name' },
//            ],


            rowCallback: function (nRow) {
                /* This is your code */
                $(nRow).find('[data-countdown]').each(function () {
                    var $this = $(this),
                        finalDate = $(this).data('countdown');

                    $this.countdown(finalDate, function (event) {
                        $this.html(event.strftime('%H:%M:%S'));
                    });
                }).on('finish.countdown', function (event) {
                    $(this).addClass("label label-sm label-danger");
                    $(this).html('This order has expired!');
                });
            }
        })

        $('button.confirmed').click(function () {
            var id = $(this).data('info');
            alert(id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $.ajax({
                type: 'POST',
                url: '/orders/confirmed',
                data: {
                    'id': id,
                },
                success: function (data) {
                    $('.item' + id).remove();
                }
            });
        });


    });

    setInterval(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/cuisine/json',
            success: function (data) {
                console.log('cuisine');
                $.each(data, function (i, item) {
                    $('.item' + item.id).replaceWith("<tr class='item" + item.id + "'>" +
                        "<td>" + item.id + "</td>" +
                        "<td>" + item.dishe.name + "</td>" +
                        "<td>" + item.quantity + "</td>" +
                        "<td>" + item.number_table + "</td>" +
                        "<td>" + item.user.name + "</td>" +
                        "<td> <div data-countdown='" + item.time +
                        "'>" + item.created_at + "</div>" +
                        "</td><td> <div class='confirmed_order'>" +
                        "<button type='button' class='confirmed btn btn-success'" +
                        "data-info='" + item.id + "'>" +
                        "Success</button> </div> </td> </tr>");
                });
            }
        });
    }, 3000);


</script>

