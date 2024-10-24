<br>
<?php
$document='diet-plan'

?>
<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">
<link rel="stylesheet" href="<?= $template ?>vendors/select2/css/select2.min.css" type="text/css">


<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>

<div class="card">
    <div class="card-body">
        <h4>Excersise
            <span style="float: right;">
                <button type="button" onclick="AddDocument('exercise')"
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
                <th>Sr No</th>
                <th>Title</th>
                <th>Status</th>

                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>Sr No</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            <div class="mt-5" id="Response"></div>

            </tfoot>
        </table>
    </div>
    <?php echo view('document/modal/add'); ?>
    <?php echo view('document/modal/update'); ?>

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
                    "url": "<?= $path ?>document/document-data",
                    "type": "POST",
                    data: {
                        Document: 'exercise' // Wrap UID in quotes for string data
                    }
                }
            });
        });

    </script>
    <script>
        function AddDocument(document) {
            $('#AddDocumentModal form#AddDocumentForm input#DocumentID').val(document);

            $('#AddDocumentModal').modal('show');

        }

        function UpdateDocument(id,document) {
            $('#UpdateDocumentModal form#UpdateDocumentForm input#DocumentID').val(document);

            var Items = AjaxResponse("document/get-record", "id=" + id);
            // console.log(Items);
            $('#UpdateDocumentModal textarea#Description').summernote('destroy');

            $('#UpdateDocumentModal form#UpdateDocumentForm input#UID').val(Items.record.UID);
            $('#UpdateDocumentModal form#UpdateDocumentForm input#Heading').val(Items.record.Heading);
            $('#UpdateDocumentModal form#UpdateDocumentForm select#Status').val(Items.record.Status);
            $('#UpdateDocumentModal form#UpdateDocumentForm textarea#Description').val(Items.record.Description);
            $('#UpdateDocumentModal').modal('show');
            setTimeout(function() {
                $('#UpdateDocumentModal textarea#Description').summernote();
            }, 10);
        }

        function DeleteDocument(id) {
            if (confirm("Are you Sure U want to Delete this?")) {
                response = AjaxResponse("document/delete", "id=" + id);
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
