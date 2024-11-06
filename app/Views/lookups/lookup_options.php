<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">
<?php

$session = session();
$SessionFilters = $session->get('LookupFilters');
$Name='';
if (isset($SessionFilters['Name']) && $SessionFilters['Name'] != '') {
    $Name = $SessionFilters['Name'];
}
?>
<div class="card">
    <div class="card-body">
        <h4>Lookup Options
            <span style="float: right;">
                <button type="button" onclick="AddLookupOption(<?=$UID?>)"
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
                <form method="post" name="AllLookupFilterForm" id="AllLookupFilterForm"
                      onsubmit="SearchFilterFormSubmit('AllLookupFilterForm');">
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label class="form-control-label no-padding-right">Name:</label>
                                <input type="text" id="Name" name="Name" placeholder="Name"
                                       class="form-control "  value="<?=$Name;?>" data-validation-engine="validate[required]"
                                       data-errormessage="MAC Address is required"/>
                            </div>
                            <div class="form-group col-md-12" style="float: right">
                                 <span style="float: right;">
                                    <button class="btn btn-outline-primary" onclick="ClearAllFilter('LookupFilters');"
                                            type="button">Clear</button>

                                <button class="btn btn-outline-success"
                                        onclick="SearchFilterFormSubmit('AllLookupFilterForm');"
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
            <thead>
            <tr>
                <th>Sr No</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>Sr No</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            </tfoot>
        </table>
    </div>
    <?php echo view('lookups/modal/add_lookup_option'); ?>
    <?php echo view('lookups/modal/update_lookup_option'); ?>
    <script>
        $(document).ready(function () {
            $('#frutis').DataTable({
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
                    "url": "<?= $path ?>lookups/lookup-option-data",
                    "type": "POST",
                    data: {
                        UID: '<?=$UID?>' // Wrap UID in quotes for string data
                    }
                }
            });
        });

    </script>
    <script>
        function AddLookupOption(id) {
            $('#AddLookupOptionModal form#AddLookupOptionForm input#LookupUID').val(id);
            $('#AddLookupOptionModal').modal('show');

        }

        function UpdateLookupOption(id,lookupid) {
            var Items = AjaxResponse("lookups/get-lookup-option-record", "id=" + id);

            $('#UpdateLookupOptionModal form#UpdateLookupOptionForm input#UID').val(Items.record.UID);
            $('#UpdateLookupOptionModal form#UpdateLookupOptionForm input#LookupUID').val(lookupid);
            $('#UpdateLookupOptionModal form#UpdateLookupOptionForm input#Name').val(Items.record.Name);
            $('#UpdateLookupOptionModal').modal('show');
        }

        function DeleteLookupOption(id) {
            if (confirm("Are you Sure U want to Delete this?")) {
                response = AjaxResponse("lookups/delete-option", "id=" + id);
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
            var rslt = AjaxResponse('lookup_search_filter', data);
            if (rslt.status == 'success') {
                $("#AllLookupFilterForm form #FilterResponse").html(rslt.message);
                // location.reload();
            }
        }

        function ClearAllFilter(Session) {
            var rslt = AjaxResponse('home/clear_session', 'SessionName=' + Session);
            if (rslt.status == 'success') {
                $("#AllLookupFilterForm form #FilterResponse").html(rslt.message);
                location.reload();
            }
        }
    </script>

    <script src="<?= $template ?>vendors/dataTable/datatables.min.js"></script>
    <script src="<?= $template ?>assets/js/examples/datatable.js"></script>
    <script src="<?= $template ?>vendors/prism/prism.js"></script>
