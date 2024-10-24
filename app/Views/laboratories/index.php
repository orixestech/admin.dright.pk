<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">

<div class="card">
    <div class="card-body">
        <h4>Laboratories
            <span style="float: right;">
                <button type="button" onclick="Addlaboratories()"
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
                <th>Logo</th>
                <th>Full Name</th>
                <th>City</th>
                <th>Contact No</th>
                <th>Email</th>
                <th>Inquiry</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>Sr No</th>
                <th>Logo</th>
                <th>Full Name</th>
                <th>City</th>
                <th>Contact No</th>
                <th>Email</th>
                <th>Inquiry</th>
                <th>Actions</th>
            </tr>
            </tfoot>
        </table>
    </div>
    <?php echo view('laboratories/modal/add'); ?>
    <?php echo view('laboratories/modal/update'); ?>
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
                    "url": "<?= $path ?>laboratories/laboratories-data",
                    "type": "POST"
                }
            });});

    </script>
    <script>
        function Addlaboratories() {
            $('#AddlaboratoriesModal').modal('show');

        }

        function Updatelaboratories(id) {
            var Items = AjaxResponse("laboratories/get-record", "id=" + id);

            $('#UpdatelaboratoriesModal form#UpdatelaboratoriesForm input#UID').val(Items.record.UID);
            $('#UpdatelaboratoriesModal form#UpdatelaboratoriesForm input#Password').val(Items.record.Password);
            $('#UpdatelaboratoriesModal form#UpdatelaboratoriesForm input#Email').val(Items.record.Email);
            $('#UpdatelaboratoriesModal form#UpdatelaboratoriesForm input#FullName').val(Items.record.FullName);
            $('#UpdatelaboratoriesModal form#UpdatelaboratoriesForm input#ContactNo').val(Items.record.ContactNo);
            $('#UpdatelaboratoriesModal form#UpdatelaboratoriesForm input#Address').val(Items.record.Address);
            $('#UpdatelaboratoriesModal form#UpdatelaboratoriesForm select#City').val(Items.record.City);

            // Define the image path
            var path = '<?=$path?>'; // assuming `path` is available from the backend
            var imageHTML;

            // Check if an image exists, otherwise show a default image
            if (Items.record.Logo) {
                imageHTML = '<img src="' + path + 'upload/laboratory/' + Items.record.Logo + '" style="height:100px;">';
            } else {
                imageHTML = '<img src="' + path + 'upload/laboratory/images.png" style="height:100px;">';
            }

            // Set the image HTML in the modal
            $('#UpdatelaboratoriesModal form#UpdatelaboratoriesForm #ImageHTML').html(imageHTML);


            $('#UpdatelaboratoriesModal').modal('show');
        }

        function Deletelaboratories(id) {
            if (confirm("Are you Sure U want to Delete this?")) {
                response = AjaxResponse("laboratories/delete", "id=" + id);
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
