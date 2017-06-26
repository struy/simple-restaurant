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

        $('button').click(function () {
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
</script>

