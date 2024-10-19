<br>
<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">
<link rel="stylesheet" href="<?= $template ?>vendors/select2/css/select2.min.css" type="text/css">

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
<div class="card">
    <div class="card-body">
        <h4>Support Videos
            <span style="float: right;">            <button type="button" onclick="AddSupportVideo()"
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
                <th>Category</th>
                <th>Title</th>
                <th>Video Link</th>
                <th >Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>Sr. No</th>
                <th>Category</th>
                <th>Title</th>
                <th>Video Link</th>
                <th >Actions</th>
            </tr>
            <div class="mt-5" id="Response"></div>

            </tfoot>
        </table>
    </div>
    <?php echo view('health_care/modal/add_support_video'); ?>
    <?php echo view('health_care/modal/update_support_video'); ?>

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
                    "url": "<?= $path ?>diet/support-videos-data",
                    "type": "POST"
                }
            });
        });

    </script>
    <script>
        function AddSupportVideo() {
            $('#AddSupportVideoModal').modal('show');

        }

        function UpdateSupportVideo(id) {
            var Items = AjaxResponse("diet/get-record-support-video", "id=" + id);

            $('#UpdateSupportVideoModal form#UpdateSupportVideoForm input#UID').val(Items.record.UID);
            $('#UpdateSupportVideoModal form#UpdateSupportVideoForm input#Category').val(Items.record.Category);
            $('#UpdateSupportVideoModal form#UpdateSupportVideoForm input#Title').val(Items.record.Title);
            $('#UpdateSupportVideoModal form#UpdateSupportVideoForm input#EmbedCode').val(Items.record.EmbedCode);
            $('#UpdateSupportVideoModal form#UpdateSupportVideoForm input#OrderID').val(Items.record.OrderID);
            $('#UpdateSupportVideoModal').modal('show');
        }

        function DeleteSupportVideo(id) {
            if (confirm("Are you Sure You want to Delete this Permanently ?")) {
                response = AjaxResponse("diet/support-video-delete", "id=" + id);
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
