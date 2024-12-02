<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">

<div class="card">
    <div class="card-body">
        <h4>Branches
            <span style="float: right;">            <button type="button" onclick="AddBranches()"
                                                            class="btn btn-primary "
                                                            data-toggle="modal" data-target="#exampleModal">
              Add
            </button>
           </span>
        </h4>
    </div>
    <div class="table-responsive">
        <table id="frutis" class="table table-striped table-bordered">
            <thead>            <tr>
                <th>Sr No</th>
                <th>Profile</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>ShortProfile</th>
                <th>ShortBusinessDesc</th>
                <th>Status</th>

                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>

        </table>
    </div>
<!--    --><?php //echo view('clinta_members/modal/premium-modal'); ?>
<!--    --><?php //echo view('clinta_members/modal/clinta-member-modal'); ?>


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
                    "url": "<?= $path ?>home/fetch_frenchises",
                    "type": "POST"
                }
            });});

    </script>
    <script>
        function AddBranches() {
            location.href = "<?=$path?>frenchises/add/";
        }
        function UpdateBranches(id) {
            location.href = "<?=$path?>frenchises/update/" + id;
        }
        function DeleteBranches(id) {
            if (confirm("Are you Sure U want to Delete this?")) {
                response = AjaxResponse("frenchises/delete", "id=" + id);
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
