<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">

<div class="card">
    <div class="card-body">
        <h4>Discounts Center Doctor
            <span style="float: right;">
                <button type="button" onclick="AddDiscountDoctor(<?=$UID?>)"
                        class="btn btn-primary "
                        data-toggle="modal" data-target="#exampleModal">
              Add
            </button>
           </span></h4>
    </div>
    <div class="table-responsive">
        <table id="frutis" class="table table-striped table-bordered">
            <thead>    	<tr>
                <th width="80">Sr. No</th>
                <th>Profile</th>
                <th>Name</th>
                <th>Qualification</th>
                <th>Speciality</th>
                <th width="180">Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th width="80">Sr. No</th>
                <th>Profile</th>
                <th>Name</th>
                <th>Qualification</th>
                <th>Speciality</th>
                <th width="180">Actions</th>
            </tr>
            <div class="mt-4" id="Response"></div>

            </tfoot>
        </table>
    </div>

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
                    "url": "<?= $path ?>discount/fetch_discount_doctor",
                    "type": "POST",
                    data: {
                        UID: '<?=$UID?>' // Wrap UID in quotes for string data
                    }
                }
            });});

    </script>
    <script>
        function AddDiscountDoctor(id) {
            location.href = "<?=$path?>discount/discount_center_doctor_form/add-doctor/" + id;


        }


        function UpdateDiscountDoctor(id) {
            location.href = "<?=$path?>discount/discount_center_doctor_form/update-doctor/" + id;

        }

        function DeleteDiscountDoctor(id) {
            if (confirm("Are you Sure U want to Delete this?")) {
                response = AjaxResponse("discount/delete_discount_center_offers", "id=" + id);
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
