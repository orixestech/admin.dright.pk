
<div class="modal" id="AddRCCReceiptsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <form method="post" action="" name="AddRCCReceiptsForm" id="AddRCCReceiptsForm" class="needs-validation" novalidate=""
                enctype="multipart/form-data">
                <input type="hidden" name="UID" id="UID" value="0">
                <input type="hidden" name="RepresentativeUID" id="RepresentativeUID" value="">
                <div class="modal-header">
                    <h5 class="modal-title">Add </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-12">Receipt Prefix:</label>
                                <div class="col-sm-12">
                                    <input type="text" id="serial_prefix" name="serial_prefix" class="form-control validate[required]"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-12">Receipt Start Serial:</label>
                                <div class="col-sm-12">
                                    <input type="number" min="1" id="start_serial" name="start_serial" class="form-control validate[required]"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-12">Receipt End Serial:</label>
                                <div class="col-sm-12">
                                    <input type="number" min="1" id="end_serial" name="end_serial" class="form-control validate[required]"/>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="AddRCCReceiptsFormFunction()">Save changes</button>
                </div>
            </form>
            <div class="mt-4" id="ajaxResponse"></div>
            <div class="clearfix"><br></div>
            <div class="row form-group">
                <div class="col-md-12" id="serials" style="overflow: auto; max-height: 500px;">
<!--                    --><?php //$healthcare = new \App\Models\HealthcareModel();
//                    $Data = $healthcare->get_rcc_receipts_data_by_id( 55 );
//                    foreach ($Data as $record){
//                        echo '<span class="pull-left badge badge-pill badge-success" style="margin-right: 10px; margin-bottom: 5px; font-size:13px;">'.$record['ReceiptNo'].'</span>';
//                    }
//
//                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<script>


    function AddRCCReceiptsFormFunction() {
        var formdata = new window.FormData($("form#AddRCCReceiptsForm")[0]);

        response = AjaxUploadResponse("representative/rec-submit", formdata);
        if (response.status === 'success') {
            $("#ajaxResponse").html('<div class="alert alert-success mb-4" style="margin: 10px;" role="alert"> <strong>Success!</strong> ' + response.message + ' </div>');
            setTimeout(function() {
                location.reload();
            }, 500);
        } else {
            $("#ajaxResponse").html('<div class="alert alert-danger mb-4" style="margin: 10px;" role="alert"> <strong>Error!</strong> ' + response.message + ' </div>');
        }
    }
</script>
<script src="<?= $template ?>assets/js/examples/form-validation.js"></script>