<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">

<div class="card">
    <div class="card-body">
        <h4>Doctors
            <span style="float: right;">
                <button type="button" onclick="AddDoctor()"
                        class="btn btn-primary "
                        data-toggle="modal" data-target="#exampleModal">
              Add
            </button>
           </span></h4>
    </div>
    <div class="table-responsive">
        <table id="doctor" class="table table-striped table-bordered">
            <thead>
            <tr>
                <div class="mt-5" id="Telemedicine"></div>
                <div class="mt-5" id="AddSmsCreditsResponse"></div>

                <th>Sr No</th>
<!--                <th>Profile</th>-->
                <th>Name</th>
<!--                <th>Sponsors</th>-->
                <th>Email</th>
                <th>City</th>
                <th>Telemedicine Credits</th>
                <th>SMS Credits</th>
                <th>Last Visit Date</th>

                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>Sr No</th>
<!--                <th>Profile</th>-->
                <th>Name</th>
<!--                <th>Sponsors</th>-->
                <th>Email</th>
                <th>City</th>
                <th>Telemedicine Credits</th>
                <th>SMS Credits</th>
                <th>Last Visit Date</th>

                <th>Actions</th>
            </tr>
            <div class="mt-5" id="Response"></div>

            </tfoot>
        </table>
    </div>

    <script>
        $(document).ready(function () {
            $('#doctor').DataTable({
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
                    "url": "<?= $path ?>builder/get-doctor",
                    "type": "POST"
                }
            });
        });

    </script>
    <script>
        function AddDoctor() {
            location.href = "<?=$path?>builder/add-doctor";

        }

        function AddTeleMedicineCredits( id, newcredits ){

            if( confirm( "Are You Want To Add " + newcredits + " Telemedicine Credits" ) ){

                response = AjaxResponse( 'builder/add_telemedicine_credits', "id=" + id + "&newcredits=" + newcredits );

                if (response.status == 'success') {
                    $("#TelemedicineResponse").html('<div class="alert alert-success mb-4" style="margin: 10px;" role="alert"> <strong>Add Successfully!</strong>  </div>')
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    $("#TelemedicineResponse").html('<div class="alert alert-danger mb-4" style="margin: 10px;" role="alert"> <strong>Error! Not Added</strong>  </div>')
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }
            }
        }  function AddSmsCredits( id, newcredits ){

            if( confirm( "Are You Want To Add " + newcredits + " SMS Credits" ) ){

                response = AjaxResponse( 'builder/add_sms_credits', "id=" + id + "&newcredits=" + newcredits );

                if (response.status == 'success') {
                    $("#AddSmsCreditsResponse").html('<div class="alert alert-success mb-4" style="margin: 10px;" role="alert"> <strong>Added Successfully!</strong>  </div>')
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    $("#AddSmsCreditsResponse").html('<div class="alert alert-danger mb-4" style="margin: 10px;" role="alert"> <strong>Error! Not Added</strong>  </div>')
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }
            }
        }


        function DeleteDoctor(id) {
            if (confirm("Are you Sure U want to Delete this?")) {
                response = AjaxResponse("builder/delete-doctor", "id=" + id);
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
