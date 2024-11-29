<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">
<?php

$session = session();
$SessionFilters = $session->get('InvestigationFilters');
$Category='';
if (isset($SessionFilters['Category']) && $SessionFilters['Category'] != '') {
    $Category = $SessionFilters['Category'];
}if (isset($SessionFilters['Type']) && $SessionFilters['Type'] != '') {
    $Type = $SessionFilters['Type'];
}
?>
<div class="card">
    <div class="card-body">
        <h4><?php if($UID=='1'){
            echo 'Lab Reports';
            }
            else{
                echo 'Radiology';
            }
            ?>
            <span style="float: right;">
                <button type="button" onclick="AddInvestigation(<?=$UID?>)"
                        class="btn btn-primary "
                        data-toggle="modal" data-target="#exampleModal">
              Add
            </button>
           </span></h4>
        <hr>
        <form method="post" name="AllInvestigationFilterForm" id="AllInvestigationFilterForm"
              onsubmit="SearchFilterFormSubmit('AllInvestigationFilterForm');">
            <div class="form-group">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="validationCustom02">Category</label>
                        <select class="form-control" id="Category" name="Category">
                            <option value="">Please Select</option>

                            <?php  foreach ($category as $record) { ?>
                                <option value="<?= $record['UID'] ?>"
                                ><?= ucwords($record['Name']); ?></option>
                            <?php } ?>
                        </select> </div>
                    <div class="form-group col-md-3">
                        <label for="validationCustom02">Type</label>
                        <select class="form-control" id="Type" name="Type">
                            <option value="">Please Select</option>

                            <?php  foreach ($type as $record) { ?>
                                <option value="<?= $record['UID'] ?>"
                                ><?= ucwords($record['Name']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12" style="float: right">
                                 <span style="float: right;">
                                    <button class="btn btn-outline-primary" onclick="ClearAllFilter('InvestigationFilters');"
                                            type="button">Clear</button>

                                <button class="btn btn-outline-success"
                                        onclick="SearchFilterFormSubmit('AllInvestigationFilterForm');"
                                        type="button">Search!</button>
                                 </span>
                    </div>
                    <div class="mt-4" id="FilterResponse"></div>

                </div>
            </div>

        </form>
    </div>
    <div class="table-responsive">
        <table id="frutis" class="table table-striped table-bordered">
            <thead>            <tr>
                <th>Sr No</th>
                <th>Name</th>
                <th>Type </th>
                <th>Category</th>

                                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>Sr No</th>
                <th>Name</th>
                <th>Key</th>
                <th>Description</th>

                                <th>Actions</th>
            </tr>
            </tfoot>
        </table>
    </div>
    <?php echo view('investigation/modal/add_lab'); ?>
    <?php echo view('investigation/modal/update_lab'); ?>
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
                    "url": "<?= $path ?>investigation/fetch_investigation",
                    "type": "POST",
                    data: {
                        UID: '<?=$UID?>' // Wrap UID in quotes for string data
                    }
                }
            });});

    </script>
    <script>
        function AddInvestigation(id) {
            $('#AddInvestigationModal form#AddInvestigationForm input#Parent').val(id);
            $('#AddInvestigationModal').modal('show');

        }
        function ViewParameter(id) {
            location.href = "<?=$path?>investigation/view_parameter/" + id;
        }

        function UpdateInvestigation(id) {
            var Items = AjaxResponse("investigation/get_record", "id=" + id);

            $('#UpdateInvestigationModal form#UpdateInvestigationForm input#UID').val(Items.record.UID);
            $('#UpdateInvestigationModal form#UpdateInvestigationForm input#Parent').val(Items.record.Parent);
            $('#UpdateInvestigationModal form#UpdateInvestigationForm input#Name').val(Items.record.Name);
            $('#UpdateInvestigationModal form#UpdateInvestigationForm select#Category').val(Items.record.Category);
            $('#UpdateInvestigationModal form#UpdateInvestigationForm select#Type').val(Items.record.Type);
            $('#UpdateInvestigationModal').modal('show');
        }

        function DeleteInvestigation(id) {
            if (confirm("Are you Sure U want to Delete this?")) {
                response = AjaxResponse("investigation/delete_investigation", "id=" + id);
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
