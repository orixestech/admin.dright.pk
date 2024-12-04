









<form enctype="multipart/form-data" class="validate" name="TicketReplyForm" id="TicketReplyForm" onsubmit="TicketReplyFormSubmit( 'TicketReplyForm' ); return false;">
    <input type="hidden" name="TaskID" id="TaskID" value="<?=$TicketID?>">
    <div class="card panel panel-primary block-default">
        <h5 class="card-header">
            <i class="fa fa-pencil">  Reply</i>
        </h5>
        <div class="card-block">
            <div class="row">
                <div class="col-md-12">
                    <label>Message</label>
                    <textarea id="summernote" name="message"></textarea>
                </div>
                <div class="col-md-8 col-lg-12">
                    <div class="row">
                        <div class="col-md-10 col-lg-10">
                            <label class="control-label">Attachments</label>
                            <input style="height: auto !important;" type="file" class="form-control" name="files" id="files">
                        </div>
                        <div class="col-md-2 col-lg-2" style="padding-right: 0px !important;">
                            <button id="AddFile" style="margin-top: 30px;" class="btn btn-info btn-sm" type="button">Add More</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="ImageFiles"></div>
            </div>
            <div class="row" style="margin-top: 0px !important;">
                <div class="col-md-12" id="AjaxResult" ></div>
            </div>
            <div class="row" style="margin-top: 0px !important;">
                <div class="col-md-12">
                    <button style="float: right;" onclick="TicketReplyFormSubmit();" class="btn btn-success btn-sm" type="button">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>
