<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="card">
    <div class="card-body">
        <h6 class="card-title mb-0">View Ticket</h6>
    </div>
</div>
<div class="ks-content">
    <div class="ks-body ks-content-nav">
        <div class="ks-nav-body no-margin">
            <div class="page-content">
                <div class="row">
                    <div class="col-md-12" id="ListSection">
                        <div class="card panel panel-primary block-default">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <i class="fa fa-ticket"> Ticket Information</i>
                                        </div>
                                        <div class="card-body">
                                            <table id="frutis" class="table table-striped table-bordered">
                                                <tbody>
                                                <tr class="ks-first-place">
                                                    <td class="ks-info" style="padding-bottom: 5px !important; ">
                                                        <p style="margin-left: 100px;">
                                                            <strong>#<?= $TicketData['UID'] ?></strong>
                                                            - <?= $TicketData['Subject'] ?>
                                                            <?php
                                                            if ($TicketData['Status'] == 'Open') {
                                                                echo '<span  class="ks-ticket-status badge badge-info float-right">Open</span>';
                                                            } else {
                                                                echo '<span class="ks-ticket-status badge badge-danger float-right">Closed</span>';
                                                            } ?>
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr class="ks-second-place">
                                                    <td class="ks-info" style="padding-bottom: 5px !important; ">
                                                        <p style="margin-left: 100px;"><strong>Submitted By</strong>
                                                            <br> <?= isset($CreatedBy['FullName']) ? $CreatedBy['FullName'] : '' ?>
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr class="ks-second-place">
                                                    <td class="ks-info" style="padding-bottom: 5px !important; ">
                                                        <p style="margin-left: 100px;"><strong>Submitted</strong>
                                                            <br> <?= date("d M, Y h:i A", strtotime($TicketData['SystemDate'])) ?>
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr class="ks-second-place">
                                                    <td class="ks-info" style="padding-bottom: 5px !important;">
                                                        <p style="margin-bottom: 0.2rem; margin-left: 100px;"><strong>DeadLine</strong>
                                                            <br>
                                                        <div class="row" id="MessageRow">
                                                            <div class="col-md-8" style=" margin-left: 100px;">
                                                                <?= (($TicketData['DeadLine'] != '') ? date("d M, Y", strtotime($TicketData['DeadLine'])) : 'In Review') ?>
                                                                <a href="javascript:void(0);"
                                                                   onclick="ShowInput('input');"
                                                                   class="ks-ticket-status badge badge-info float-right">Edit</a>
                                                            </div>
                                                        </div>
                                                        <form class="validate" name="UpdateDeadLineForm"
                                                              id="UpdateDeadLineForm">
                                                            <div class="row d-none" id="InputRow"
                                                                 style="margin-top: 0px;">

                                                                <input type="hidden" name="TaskID" id="TaskID"
                                                                       value="<?= $TicketID ?>">
                                                                <div class="col-md-6">
                                                                    <input data-validation-engine="validate[required]"
                                                                           type="date" name="edit_deadline"
                                                                           id="edit_deadline" class="form-control">
                                                                </div>
                                                                <div class="col-md-6" style="margin-top: 8px;">
                                                                    <a style="margin-left: 5px;"
                                                                       onclick="ShowInput('deadline');"
                                                                       href="javascript:void( 0 );"
                                                                       class="ks-ticket-status badge badge-danger float-right">Hide</a>
                                                                    <a onclick="UpdateDeadLineFormSubmit();"
                                                                       href="javascript:void( 0 );"
                                                                       class="ks-ticket-status badge badge-success float-right">Update</a>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr class="ks-second-place">
                                                    <td class="ks-info"
                                                        style="padding-bottom: 5px !important; margin-left: 100px;">
                                                        <p style="margin-left: 100px;"><strong>Module</strong>
                                                            <br> <?= $TicketData['ModuleID'] ?></p>
                                                    </td>
                                                </tr>
                                                <tr class="ks-second-place">
                                                    <td class="ks-info"
                                                        style="padding-bottom: 5px !important; margin-left: 100px;">
                                                        <p style="margin-left: 100px;"><strong>Priority</strong>
                                                            <br> <?= $TicketData['Priority'] ?></p>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card">
                                        <form enctype="multipart/form-data" class="needs-validation" novalidate=""
                                              name="TicketReplyForm" id="TicketReplyForm"
                                              onsubmit="TicketReplyFormSubmit( 'TicketReplyForm' ); return false;">
                                            <input type="hidden" name="TaskID" id="TaskID" value="<?= $TicketID ?>">
                                            <div class="card-header">
                                                <h3><i class="fa fa-pencil"> Reply</i></h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                        <label for="validationCustom04">Message</label>
                                                        <textarea id="summernote" class="form-control"
                                                                  name="message"></textarea>
                                                    </div>
                                                    <div class="col-md-8 col-lg-12">
                                                        <div class="row">
                                                            <div class="col-md-10 col-lg-10">
                                                                <label class="control-label">Attachments</label>
                                                                <input style="height: auto !important;" type="file"
                                                                       class="form-control" name="files" id="files">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12" id="ImageFiles"></div>
                                                </div>
                                                <div class="row" style="margin-top: 0px !important;">
                                                    <div class="col-md-12" id="AjaxResult"></div>
                                                </div>
                                                <div class="row" style="margin-top: 0px !important;">
                                                    <div class="col-md-12">
                                                        <button style="float: right;" onclick="TicketReplyFormSubmit();"
                                                                class="btn btn-success btn-sm" type="button">Submit
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header"><h4>Description</h4></div>
                                <div class="card-body"> <?php if ($TicketData['Message'] != '') { ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p><?= $TicketData['Message'] ?></p>

                                            </div>
                                        </div>

                                    <?php } ?></div>
                            </div>
                            <div class="row" id="CommentsDiv">

                            <div class="clearfix"><br></div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"><br/>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                "scrollY": "200px",
                "scrollCollapse": true
            });
            LoadTicketsComments();
        });
    </script>
    <script>
        function ShowInput(val) {

            if (val == 'input') {

                $("div#MessageRow").addClass('d-none');
                $("div#InputRow").removeClass('d-none');
            } else {
                $("div#MessageRow").removeClass('d-none');
                $("div#InputRow").addClass('d-none');
            }
        }

        function UpdateDeadLineFormSubmit() {
            var data = new window.FormData($("form#UpdateDeadLineForm")[0]);
            // console.log( data );
            // alert( data );
            rslt = AjaxUploadResponse("support-ticket/update-deadline-form-submit", data);
            if (rslt.status == 'success') {

                setTimeout(function () {
                    window.location.href = location.href;
                }, 2000);

            }
        }
        function LoadTicketsComments() {

            var TicketID = "<?=$TicketData['UID']?>";
            // alert( TicketID );

            AjaxRequest( "support-ticket/load_tickets_comments", "TicketID=" + TicketID, "CommentsDiv" );
        }

        function TicketReplyFormSubmit() {
            var data = new window.FormData($("form#TicketReplyForm")[0]);
            // console.log( data );
            // alert( data );
            rslt = AjaxUploadResponse("support-ticket/TicketReplyFormSubmit", data);
            if (rslt.status == 'success') {

                setTimeout(function () {
                    window.location.href = location.href;
                }, 2000);

            }
        }
    </script>
    <script src="<?= $template ?>vendors/dataTable/datatables.min.js"></script>
    <script src="<?= $template ?>assets/js/examples/datatable.js"></script>
    <script src="<?= $template ?>vendors/prism/prism.js"></script>

