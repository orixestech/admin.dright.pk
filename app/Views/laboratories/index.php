<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">

<div class="card">
    <div class="card-body">
        <h4>Diseases
            <span style="float: right;">
                <button type="button" onclick="AddDisease()"
                        class="btn btn-primary "
                        data-toggle="modal" data-target="#exampleModal">
              Add
            </button>
           </span></h4>
    </div>
    <div class="table-responsive">
        <table id="frutis" class="table table-striped table-bordered">
            <thead>            <tr>
                <th>Sr No</th>
                <th>Name</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>Sr No</th>
                <th>Name</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
            </tfoot>
        </table>
    </div>
    <?php echo view('diseases/modal/add'); ?>
    <?php echo view('diseases/modal/update'); ?>
    <script>
        $(document).ready(function (){
            $('#frutis').DataTable({
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
                    "url": "<?= $path ?>diseases/diseases-data",
                    "type": "POST"
                }
            });});

    </script>
    <script>
        function AddDisease() {
            $('#AddDiseaseModal').modal('show');

        }

        function UpdateDisease(id) {
            var Items = AjaxResponse("diseases/get-record", "id=" + id);

            $('#UpdateDiseaseModal form#UpdateDiseaseForm input#UID').val(Items.record.UID);
            $('#UpdateDiseaseModal form#UpdateDiseaseForm input#DiseaseName').val(Items.record.DiseaseName);
            $('#UpdateDiseaseModal form#UpdateDiseaseForm select#BodySystem').val(Items.record.BodySystem);
            $('#UpdateDiseaseModal').modal('show');
        }

        function DeleteDisease(id) {
            if (confirm("Are you Sure U want to Delete this?")) {
                response = AjaxResponse("diseases/delete", "id=" + id);
                if (response.status == 'success') {
                    $("#Response").html('<div class="alert alert-success mb-4" style="margin: 10px;" role="alert"> <strong>Deleted Successfully!</strong>  </div>')
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    $("#Response").html('<div class="alert alert-danger mb-4" style="margin: 10px;" role="alert"> <strong>Error! Not Deleted</strong>  </div>')
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }

            }
        }
    </script>

    <script src="<?= $template ?>vendors/dataTable/datatables.min.js"></script>
    <script src="<?= $template ?>assets/js/examples/datatable.js"></script>
    <script src="<?= $template ?>vendors/prism/prism.js"></script>
