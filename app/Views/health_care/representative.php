<br>
<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">
<link rel="stylesheet" href="<?= $template ?>vendors/select2/css/select2.min.css" type="text/css">
<?php

$session = session();
$SessionFilters = $session->get('RCCFilters');
$Name='';
$City='';
$Status='';
if (isset($SessionFilters['Name']) && $SessionFilters['Name'] != '') {
    $Name = $SessionFilters['Name'];
}if (isset($SessionFilters['City']) && $SessionFilters['City'] != '') {
    $City = $SessionFilters['City'];
}if (isset($SessionFilters['Status']) && $SessionFilters['Status'] != '') {
    $Status = $SessionFilters['Status'];
}
?>
<div class="card">
    <div class="card-body">
        <h4>Representatives
            <span style="float: right;">            <button type="button" onclick="AddRepresentatives()"
                                                            class="btn btn-primary "
                                                            data-toggle="modal" data-target="#exampleModal">
              Add
            </button>
           </span>
        </h4>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <h5>Search Filters</h5>
                <hr>
                <form method="post" name="AllRCCFilterForm" id="AllRCCFilterForm"
                      onsubmit="SearchFilterFormSubmit('AllRCCFilterForm');">
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
                                            <?php foreach ($cities as $record) { ?>
                                                <option value="<?= $record['UID'] ?>" <?= (isset($City) && $City == $record['UID']) ? 'selected' : '' ?>
                                                ><?= ucwords($record['FullName']); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                                <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="col-sm-4">Status:</label>
                                    <div class="col-sm-12">
                                        <select id="Status" name="Status" class="form-control"
                                                data-validation-engine="validate[required]">
                                            <option value="">Please Select</option>
                                            <option value="active">Active</option>
                                            <option value="block">Block</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12" style="float: right">
                                 <span style="float: right;">
                                    <button class="btn btn-outline-primary" onclick="ClearAllFilter('RCCFilters');"
                                            type="button">Clear</button>

                                <button class="btn btn-outline-success"
                                        onclick="SearchFilterFormSubmit('AllRCCFilterForm');"
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
        <table id="record" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Sr. No</th>
                <th>RCC ID</th>
                <th>Full Name</th>
                <th>City</th>
                <th>Contact No</th>
                <th>Branch</th>
                <th>Category</th>
                <th>Status</th>
                <th>Total Receipts</th>
                <th >Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>Sr. No</th>
                <th>RCC ID</th>
                <th>Full Name</th>
                <th>City</th>
                <th>Contact No</th>
                <th>Branch</th>
                <th>Category</th>
                <th>Status</th>
                <th>Total Receipts</th>
                <th >Actions</th>
            </tr>
            <div class="mt-5" id="Response"></div>

            </tfoot>
        </table>
    </div>

    <?php echo view('health_care/modal/add_recipt'); ?>

    <script>
        $(document).ready(function () {
            $('#record').DataTable({
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
                    "url": "<?= $path ?>representative/representatives-data",
                    "type": "POST"
                }
            });
        });

    </script>
    <script>
        function AddRepresentatives() {
            location.href = "<?=$path?>representative/add";


        }
        function Updaterepresentatives(id) {
            location.href = "<?=$path?>representative/update/" + id;


        }
        function AlotReceiptNo(item) {
            $('#AddRCCReceiptsModal form#AddRCCReceiptsForm input#RCCUID').val(item);
            AjaxRequest("representative/get", "id="+item, "AddRCCReceiptsModal div#serials");

            $('#AddRCCReceiptsModal').modal('show');
        }




        function Deleterepresentatives(id) {
            if (confirm("Are you Sure You want to Delete this Permanently ?")) {
                response = AjaxResponse("representative/delete", "id=" + id);
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
            var rslt = AjaxResponse('representatives/rcc_search_filter', data);
            if (rslt.status == 'success') {
                $("#AllRCCFilterForm form #FilterResponse").html(rslt.message);
                // location.reload();
            }
        }

        function ClearAllFilter(Session) {
            var rslt = AjaxResponse('home/clear_session', 'SessionName=' + Session);
            if (rslt.status == 'success') {
                $("#AllRCCFilterForm form #FilterResponse").html(rslt.message);
                location.reload();
            }
        }
    </script>
    <script src="<?= $template ?>vendors/select2/js/select2.min.js"></script>
    <script src="<?= $template ?>vendors/dataTable/datatables.min.js"></script>
    <script src="<?= $template ?>assets/js/examples/datatable.js"></script>
    <script src="<?= $template ?>vendors/prism/prism.js"></script>
