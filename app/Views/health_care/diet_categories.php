<br>
<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">
<link rel="stylesheet" href="<?= $template ?>vendors/select2/css/select2.min.css" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>

<div class="card">
    <div class="card-body">
        <h4>Diet Categories
            <span style="float: right;">            <button type="button" onclick="AddDietCategory()"
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
                <th>Sub Category</th>
                <th>Units</th>
                <th>Estimated Average Requirements (EAR)</th>
                <th>Recommended Dietary Allowances (RDA)</th>
                <th>Tolerable upper intake levels (UL)</th>
                <th >Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>Sr. No</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Units</th>
                <th>Estimated Average Requirements (EAR)</th>
                <th>Recommended Dietary Allowances (RDA)</th>
                <th>Tolerable upper intake levels (UL)</th>
                <th >Actions</th>
            </tr>
            <div class="mt-5" id="Response"></div>

            </tfoot>
        </table>
    </div>
    <?php echo view('health_care/modal/add_category'); ?>
    <?php echo view('health_care/modal/update_category'); ?>

    <script>

        // $(document).ready(function() {
        //     $('#Description').summernote();
        // });
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
                    "url": "<?= $path ?>diet/diet-categories-data",
                    "type": "POST"
                }
            });
        });

    </script>
    <script>
        function AddDietCategory() {
            $('#AddDietCategoryModal').modal('show');

        }

        function UpdateDietCategory(id) {
            var Items = AjaxResponse("diet/get-record-category", "id=" + id);

            $('#UpdateDietCategoryModal form#UpdateDietCategoryForm input#UID').val(Items.record.UID);
            $('#UpdateDietCategoryModal form#UpdateDietCategoryForm input#Category').val(Items.record.Category);
            $('#UpdateDietCategoryModal form#UpdateDietCategoryForm input#SubCategory').val(Items.record.SubCategory);
            $('#UpdateDietCategoryModal form#UpdateDietCategoryForm input#Unit').val(Items.record.Unit);
            $('#UpdateDietCategoryModal form#UpdateDietCategoryForm input#EAR').val(Items.record.EAR);
            $('#UpdateDietCategoryModal form#UpdateDietCategoryForm input#RDA').val(Items.record.RDA);
            $('#UpdateDietCategoryModal form#UpdateDietCategoryForm input#UL').val(Items.record.UL);
            $('#UpdateDietCategoryModal form#UpdateDietCategoryForm input#OrderID').val(Items.record.OrderID);
            $('#UpdateDietCategoryModal form#UpdateDietCategoryForm textarea#Description').val(Items.record.Description);
            $('#UpdateDietCategoryModal').modal('show');
        }

        function DeleteDietCategory(id) {
            if (confirm("Are you Sure U want to Delete this?")) {
                response = AjaxResponse("diet/delete-category", "id=" + id);
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
