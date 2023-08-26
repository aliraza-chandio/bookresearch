$(document).ready(function () {

    $('#masters').DataTable({
        "columnDefs": [{
            "orderable": false,
            "targets": 9
        }]
    });
    $('#masters_native').DataTable({
        "columnDefs": [{
            "orderable": false,
            "targets": 6
        }]
    });
    // $('#products').DataTable({
    //     "columnDefs": [{
    //         "orderable": false,
    //         "targets": 10
    //     }]
    // });
    $('#products_native').DataTable({
        "columnDefs": [{
            "orderable": false,
            "targets": 6
        }]
    });
    // $('#users').DataTable({
    //     "columnDefs": [{
    //         "orderable": false,
    //         "targets": 5
    //     }]
    // });
});




$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#products tfoot th').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
    });

    // DataTable
    var table = $('#example').DataTable({
        initComplete: function () {
            // Apply the search
            this.api()
                .columns()
                .every(function () {
                    var that = this;

                    $('input', this.footer()).on('keyup change clear', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
        },
    });
});
