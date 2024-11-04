<br>
<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">
<link rel="stylesheet" href="<?= $template ?>vendors/select2/css/select2.min.css" type="text/css">

<div class="card">
    <div class="card-body">
        <h4>Specialities
            <span style="float: right;">            <button type="button" onclick="Addspecialities()"
                                                            class="btn btn-primary "
                                                            data-toggle="modal" data-target="#exampleModal">
              Add
            </button>
           </span>
        </h4>
    </div>
    <div class="table-responsive">
        <table id="record" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Sr. No</th>
                <th>Icon</th>
                <th>Name</th>
                <th>Total Images</th>

                <th >Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>Sr. No</th>
                <th>Icon</th>
                <th>Name</th>
                <th>Total Images</th>

                <th >Actions</th>
            </tr>
            <div class="mt-5" id="Response"></div>

            </tfoot>
        </table>
    </div>

    <?php echo view('builder/modal/add_specialities'); ?>
    <?php echo view('builder/modal/update_specialities'); ?>

    <script>
        $(document).ready(function () {
           $('#record').DataTable({
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
                    "url": "<?= $path ?>builder/fetch_specialities",
                   "type": "POST"
               }
           });
        });

    </script>
    <script>
        function Addspecialities() {
            $('#AddspecialitiesModal').modal('show');

        }
        function Editspecialities(id) {
            var Items = AjaxResponse("builder/get_specialities_record", "id=" + id);

            $('#UpdatespecialitiesModal form#UpdatespecialitiesForm input#UID').val(Items.record.UID);
            $('#UpdatespecialitiesModal form#UpdatespecialitiesForm input#name').val(Items.record.Name);
            $('#UpdatespecialitiesModal form#UpdatespecialitiesForm select#tag').val(Items.record.Tag);
            // Define the image path
            var path = '<?=$path?>';


            // JavaScript code to set image HTML in the modal
            var imageHTML;

            // Assuming Items.record.Image comes from your backend data, check for its value
            if (Items.record.Icon) {
                imageHTML = '<img src="' + path + 'upload/specialities/' + Items.record.Icon + '" style="height:100px;">';
            } else {
                imageHTML = '<img src="' + path + 'upload/specialities/no-image.png" style="height:100px;">';
            }

            // Set the image HTML in the modal
            $('#UpdatespecialitiesModal form#UpdatespecialitiesForm #ImageHTML').html(imageHTML);

            $('#UpdatespecialitiesModal').modal('show');

        }
        function Deletespecialities(id) {
            if (confirm("Are you Sure You want to Delete this Permanently ?")) {
                response = AjaxResponse("builder/delete_specialities", "id=" + id);
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
    <script src="<?= $template ?>vendors/select2/js/select2.min.js"></script>
    <script src="<?= $template ?>vendors/dataTable/datatables.min.js"></script>
    <script src="<?= $template ?>assets/js/examples/datatable.js"></script>
    <script src="<?= $template ?>vendors/prism/prism.js"></script>
