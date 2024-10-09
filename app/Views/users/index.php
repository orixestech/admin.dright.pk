<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">

<div class="card">
    <div class="card-body">
        <h6 class="card-title mb-0">DataTable Fixed Height</h6>
    </div>
    <div class="table-responsive">
        <table id="users" class="table table-striped table-bordered">
            <thead>
         <tr>
             <th>SR no</th>
             <th>Email</th>
             <th>Email</th>
             <th>Type</th>
         </tr>
            </thead>
<tbody>

</tbody>
            <tfoot>
            <tr>
                <th>SR no</th>
                <th>Email</th>
                <th>Email</th>
                <th>Type</th>
            </tr>
            </tfoot>
        </table>
    </div>

    <script>
        $(document).ready(function (){
            $('#users').DataTable({
                "scrollY": "800px",
                "scrollCollapse": true,
                "searching": false,
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "lengthMenu": [[100, 500, 1000, -1], [100, 500, 1000, 'All']],
                "pageLength": 100,
                "autoWidth": true,
                "ajax": {
                    "url": "<?= $path ?>users/users-data",
                    "type": "POST"
                }
            });});

    </script>
<script src="<?= $template ?>vendors/dataTable/datatables.min.js"></script>
<script src="<?= $template ?>assets/js/examples/datatable.js"></script>
<script src="<?= $template ?>vendors/prism/prism.js"></script>

