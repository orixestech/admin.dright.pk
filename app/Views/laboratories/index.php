<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">
<?php

$session = session();
$SessionFilters = $session->get('LaboratoriesFilters');
$Name='';
$City='';
if (isset($SessionFilters['Name']) && $SessionFilters['Name'] != '') {
    $Name = $SessionFilters['Name'];
}if (isset($SessionFilters['City']) && $SessionFilters['City'] != '') {
    $City = $SessionFilters['City'];
}
?>
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
        <hr>
        <div class="row">
            <div class="col-md-12">
                <h5>Search Filters</h5>
                <hr>
                <form method="post" name="AllLaboratoriesFilterForm" id="AllLaboratoriesFilterForm"
                      onsubmit="SearchFilterFormSubmit('AllLaboratoriesFilterForm');">
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label class="form-control-label no-padding-right">Name:</label>
                                <input type="text" id="Name" name="Name" placeholder="Name"
                                       class="form-control "  value="<?=$Name;?>" data-validation-engine="validate[required]"
                                       data-errormessage="MAC Address is required"/>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="col-sm-4">City:</label>
                                    <div class="col-sm-12">
                                        <select id="City" name="City" class="form-control"
                                                data-validation-engine="validate[required]">
                                            <option value="">Please Select</option>
                                            <?php foreach ($city as $record) { ?>
                                                <option value="<?= $record['UID'] ?>" <?= (isset($City) && $City == $record['UID']) ? 'selected' : '' ?>
                                                ><?= ucwords($record['Name']); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12" style="float: right">
                                 <span style="float: right;">
                                    <button class="btn btn-outline-primary" onclick="ClearAllFilter('LaboratoriesFilters');"
                                            type="button">Clear</button>

                                <button class="btn btn-outline-success"
                                        onclick="SearchFilterFormSubmit('AllLaboratoriesFilterForm');"
                                        type="button">Search!</button>
                                 </span>
                            </div>
                            <div class="mt-4" id="FilterResponse"></div>

                        </div>
                    </div>

                </form>
            </div>
        </div>
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
                "searching": true,
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
        function SearchFilterFormSubmit(parent) {

            var data = $("form#" + parent).serialize();
            var rslt = AjaxResponse('laboratories/labortories_search_filter', data);
            if (rslt.status == 'success') {
                $("#AllLaboratoriesFilterForm form #FilterResponse").html(rslt.message);
                location.reload();
            }
        }

        function ClearAllFilter(Session) {
            var rslt = AjaxResponse('home/clear_session', 'SessionName=' + Session);
            if (rslt.status == 'success') {
                $("#AllLaboratoriesFilterForm form #FilterResponse").html(rslt.message);
                location.reload();
            }
        }
    </script>

    <script src="<?= $template ?>vendors/dataTable/datatables.min.js"></script>
    <script src="<?= $template ?>assets/js/examples/datatable.js"></script>
    <script src="<?= $template ?>vendors/prism/prism.js"></script>
