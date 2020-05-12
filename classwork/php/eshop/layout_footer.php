    </div> <!-- end of container -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.js" type="text/javascript"></script>

    <script>
        $(document).on('click', '.delete-item', function () {


            var id = $(this).attr('data-item-id');
            bootbox.confirm({
                message: "Do You really want to delete this item?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback: function (result) {
                   if (result == true) {
                       $.post('delete_item.php', {
                            delete_this_item: id
                       }, function(data) {
                           location.reload();
                       }).fail(function () {
                           alert("Error: unable to delete");
                       });
                   }
                }
            });
        });
    </script>
</body>
</html>
