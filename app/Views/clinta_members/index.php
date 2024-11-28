<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">
<?php

$session = session();
$SessionFilters = $session->get('MemberFilters');
$Name='';
if (isset($SessionFilters['Name']) && $SessionFilters['Name'] != '') {
    $Name = $SessionFilters['Name'];
}
?>
<div class="card">
    <div class="card-body">
        <h4>Members
          </h4>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <h5>Search Filters</h5>
                <hr>
                <form method="post" name="AllMemberFilterForm" id="AllMemberFilterForm"
                      onsubmit="SearchFilterFormSubmit('AllMemberFilterForm');">
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label class="form-control-label no-padding-right">Name:</label>
                                <input type="text" id="Name" name="Name" placeholder=" Name"
                                       class="form-control "  value="<?=$Name;?>" data-validation-engine="validate[required]"
                                       data-errormessage="MAC Address is required"/>
                            </div>
                            <div class="form-group col-md-12" style="float: right">
                                 <span style="float: right;">
                                    <button class="btn btn-outline-primary" onclick="ClearAllFilter('MemberFilters');"
                                            type="button">Clear</button>

                                <button class="btn btn-outline-success"
                                        onclick="SearchFilterFormSubmit('AllMemberFilterForm');"
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
                <th>Membership Date/Time</th>
                <th>Member ID</th>
                <th>Member Type</th>
                <th>Full Name</th>
                <th>Last Login</th>

                                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>Sr No</th>
                <th>Membership Date/Time</th>
                <th>Member ID</th>
                <th>Member Type</th>
                <th>Full Name</th>
                <th>Last Login</th>

                                <th>Actions</th>
            </tr>
            </tfoot>
        </table>
    </div>
    <?php echo view('clinta_members/modal/premium-modal'); ?>
    <?php echo view('clinta_members/modal/clinta-member-modal'); ?>


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
                    "url": "<?= $path ?>clinta_members/members-data",
                    "type": "POST"
                }
            });});

    </script>
    <script>
        function CheckMemberDetailsForm() {

            var formdata = new window.FormData($("form#MemberDetailsForm")[0]);

            rslt = AjaxUploadResponse("clinta_members/check_login_credentials", formdata);

            if (rslt.status == 'success') {

                $("#ClintaMemberModal form#MemberDetailsForm div#AjaxResults").css('display', 'none');

                MemberID = $("#ClintaMemberModal form#MemberDetailsForm input#MemberUID").val();
                $("#ClintaMemberModal form#MemberDetailsForm div#LoginInfoDiv").css('display', 'none');
                $("#ClintaMemberModal form#MemberDetailsForm div#MemberInfoDiv").css('display', '');

                rslt = AjaxUploadResponse("clinta_members/get_user_data_by_id", "member_id=" + MemberID);
                if (rslt != null) {

                    //alert( rslt.toSource() );

                    memberhtml = '';
                    memberhtml += '<div class="col-md-12">\
									<h4 style="text-align: center;"><strong>' + rslt.FullName + '</strong> <label class="badge badge-success"><small>' + rslt.MemberType + '</small></label></h4>\
								</div>\
								<div class="col-md-5">\
									<h5 style="text-align: center;"><strong>MemberID</strong> : ' + rslt.MemberID + '</h5>\
								</div>\
								<div class="col-md-5">\
									<h5 style="text-align: center;"><strong>Password</strong> : ' + rslt.Password + '</h5>\
								</div>\
								<div class="col-md-2">\
									<a target="_blank" href="https://www.clinta.biz/healthcare/auto-login/' + rslt.AutoLoginCode + '" class="btn btn-success btn-sm">Login</a>\
								</div>';
                }

                $("#ClintaMemberModal form#MemberDetailsForm div#MemberInfoDiv").html(memberhtml);


            } else {
                $("#ClintaMemberModal form#MemberDetailsForm div#AjaxResults").css('display', '');
                $("#AjaxResults").html('<div class="alert alert-danger ks-solid ks-active-border text-center" role="alert">' + rslt.msg + '</div>');
            }

        }
        function SearchFilterFormSubmit(parent) {

            var data = $("form#" + parent).serialize();
            var rslt = AjaxResponse('clintamember/search_filter', data);
            if (rslt.status == 'success') {
                $("#AllMemberFilterForm form #FilterResponse").html(rslt.message);
                location.reload();
            }
        }

        function ClearAllFilter(Session) {
            var rslt = AjaxResponse('home/clear_session', 'SessionName=' + Session);
            if (rslt.status == 'success') {
                $("#AllMemberFilterForm form #FilterResponse").html(rslt.message);
                location.reload();
            }
        }
        function ShiftToPremium(id) {
            $("#ShiftToPremiumModal form#PremiumForm input#MemberUID").val(id);

            $('#ShiftToPremiumModal').modal('show');

        }
        function CheckUserDetails(id) {


            $("#ClintaMemberModal form#MemberDetailsForm input#MemberUID").val(id);


            $("#ClintaMemberModal").modal({
                show: true,
                backdrop: 'static'
            });
        }
    </script>

    <script src="<?= $template ?>vendors/dataTable/datatables.min.js"></script>
    <script src="<?= $template ?>assets/js/examples/datatable.js"></script>
    <script src="<?= $template ?>vendors/prism/prism.js"></script>
