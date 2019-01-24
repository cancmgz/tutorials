<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js" type="text/javascript"></script>

<body class="dt-example">

<table id="dataTable" class="table table-striped table-responsive">
    <thead>
    <tr>
        <th>ID</th>
        <th>Role Name</th>
        <th>Role Description</th>
        <th>User Name</th>
        <th>Create Date</th>
    </tr>
    </thead>
</table>

</body>

    <script type="text/javascript" language="javascript" class="init">

        $(document).ready(function () {

            $('#dataTable').dataTable({
              /*
              aProcessing : datatable oluşturulurken zaman alan veriler için,
              işlem göstergesinin aktif olup olmaması.

              aServerSide : Sunucu tarafı işleme, ajax aracılığıyla veri kaynağı
              sağlamak için izin istenmesi.

              columns: kolonlarımızın sıralaması ve gelen datada ki karşılığı.

              buttons: çıktı alma butonları.
              */
                "aProcessing": true,
                "aServerSide": true,
                "ajax": 'includes/permissionController.php',
                "columns": [
                    {"data": "permissionId"},
                    {"data": "name"},
                    {"data": "description"},
                    {"data": "userId"},
                    {"data": "createDate"}
                ],
                dom: 'Bfrtip',
                buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });

    </script>
