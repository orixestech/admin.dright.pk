<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">

<div class="card">
    <div class="card-body">
        <h4>Discount Center
            <span style="float: right;">
                <button type="button" onclick="AddInvestigation()"
                        class="btn btn-primary "
                        data-toggle="modal" data-target="#exampleModal">
              Add
            </button>
           </span></h4>

    </div>
    <div class="table-responsive">
        <table id="frutis" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Sr. No</th>
                <th>Department</th>
                <th>Image</th>
                <th>Title</th>
                <th>Address</th>
                <th>Services</th>
                <th>Basic Discount</th>
                <th>Premium Discount</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>Sr. No</th>
                <th>Department</th>
                <th>Image</th>
                <th>Title</th>
                <th>Address</th>
                <th>Services</th>
                <th>Basic Discount</th>
                <th>Premium Discount</th>
                <th>Actions</th>
            </tr>
            <div class="mt-4" id="Response"></div>

            </tfoot>
        </table>
    </div>
<!--    --><?php //echo view('investigation/modal/add_lab'); ?>
<!--    --><?php //echo view('investigation/modal/update_lab'); ?>
    <script>
        $(document).ready(function (){
            $('#frutis').DataTable({
                "scrollY": "800px",
                "scrollCollapse": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "lengthMenu": [[100, 500, 1000, -1], [100, 500, 1000, 'All']],
                "pageLength": 100,
                "autoWidth": true,
                "ajax": {
                    "url": "<?= $path ?>discount/fetch_discount",
                    "type": "POST",

                }
            });});

    </script>
    <script>
        function AddInvestigation(id) {
            location.href = "<?=$path?>discount/view_parameter/" + id;


        }
        function ViewParameter(id) {
            location.href = "<?=$path?>investigation/view_parameter/" + id;
        }

        function EditDiscountCenter(id) {
            location.href = "<?=$path?>investigation/view_parameter/" + id;

        }

        function DeleteDiscountCenter(id) {
            if (confirm("Are you Sure U want to Delete this?")) {
                response = AjaxResponse("discount/delete_discount_center", "id=" + id);
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
        function SearchFilterFormSubmit(parent) {

            var data = $("form#" + parent).serialize();
            var rslt = AjaxResponse('investigation/investiagation_search_filter', data);
            if (rslt.status == 'success') {
                $("#AllInvestigationFilterForm form #FilterResponse").html(rslt.message);
                location.reload();
            }
        }

        function ClearAllFilter(Session) {
            var rslt = AjaxResponse('home/clear_session', 'SessionName=' + Session);
            if (rslt.status == 'success') {
                $("#AllInvestigationFilterForm form #FilterResponse").html(rslt.message);
                location.reload();
            }
        }
    </script>

    <script src="<?= $template ?>vendors/dataTable/datatables.min.js"></script>
    <script src="<?= $template ?>assets/js/examples/datatable.js"></script>
    <script src="<?= $template ?>vendors/prism/prism.js"></script>
