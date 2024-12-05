<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">

<?php

$session = session();
$SessionFilters = $session->get('ExtendedFilters');
$Category='';
if (isset($SessionFilters['Profile']) && $SessionFilters['Profile'] != '') {
    $Profile = $SessionFilters['Profile'];
}if (isset($SessionFilters['Type']) && $SessionFilters['Type'] != '') {
    $Type = $SessionFilters['Type'];
}
?>
<div class="card">
    <div class="card-body">
        <h4>Clinta Extended
          </h4>
        <hr>
        <form method="post" name="AllExtendedFilterForm" id="AllExtendedFilterForm"
              onsubmit="SearchFilterFormSubmit('AllExtendedFilterForm');">
            <div class="form-group">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="validationCustom02">Profile</label>
                        <select class="form-control" id="Profile" name="Profile">
                            <option value="">Please Select</option>

                            <?php  foreach ($extended_profiles as $record) { ?>
                                <option value="<?= $record['UID'] ?>"
                                ><?= ucwords($record['FullName']); ?></option>
                            <?php } ?>
                        </select> </div>
                   
                    <div class="form-group col-md-12" style="float: right">
                                 <span style="float: right;">
                                    <button class="btn btn-outline-primary" onclick="ClearAllFilter('ExtendedFilters');"
                                            type="button">Clear</button>

                                <button class="btn btn-outline-success"
                                        onclick="SearchFilterFormSubmit('AllExtendedFilterForm');"
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
                <th>Profile</th>
                <th>Module</th>
                <th>Subject</th>
                <th>CreatedBy</th>
                <th>Creat DateTime</th>
                <th>Last Updated</th>
                <th>DeadLine</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>Sr No</th>
                <th>Profile</th>
                <th>Module</th>
                <th>Subject</th>
                <th>CreatedBy</th>
                <th>Creat DateTime</th>
                <th>Last Updated</th>
                <th>DeadLine</th>
                <th>Status</th>
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
                    "url": "<?= $path ?>support-ticket/fetch-data",
                    "type": "POST"
                }
            });});

    </script>
<script>
    function SearchFilterFormSubmit(parent) {

        var data = $("form#" + parent).serialize();
        var rslt = AjaxResponse('support-ticket/search_filter', data);
        if (rslt.status == 'success') {
            $("#AllExtendedFilterForm form #FilterResponse").html(rslt.message);
            location.reload();
        }
    }

    function ClearAllFilter(Session) {
        var rslt = AjaxResponse('home/clear_session', 'SessionName=' + Session);
        if (rslt.status == 'success') {
            $("#AllExtendedFilterForm form #FilterResponse").html(rslt.message);
            location.reload();
        }
    }
</script>
    <script src="<?= $template ?>vendors/dataTable/datatables.min.js"></script>
    <script src="<?= $template ?>assets/js/examples/datatable.js"></script>
    <script src="<?= $template ?>vendors/prism/prism.js"></script>
