<link rel="stylesheet" href="<?= $template ?>vendors/dataTable/datatables.min.css" type="text/css">

<div class="card">
    <div class="card-body">
        <h4>Members
            <span style="float: right;">
                <button type="button" onclick="AddLookup()"
                        class="btn btn-primary "
                        data-toggle="modal" data-target="#exampleModal">
              Add
            </button>
           </span></h4>
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
                "searching": false,
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
        function CheckMemberDetailsForm(parent) {

            var validate = $("form#" + parent).validationEngine("validate");
            if (validate == false) {
                return false;
            }

            data = $("form#" + parent).serialize();
            rslt = ajaxreqResponse("clinta_members/check_login_credentials", data);

            if (rslt.status == 'success') {

                $("#ClintaMemberModal form#MemberDetailsForm div#AjaxResults").css('display', 'none');

                MemberID = $("#ClintaMemberModal form#MemberDetailsForm input#MemberUID").val();
                $("#ClintaMemberModal form#MemberDetailsForm div#LoginInfoDiv").css('display', 'none');
                $("#ClintaMemberModal form#MemberDetailsForm div#MemberInfoDiv").css('display', '');

                rslt = ajaxreqResponse("clinta_members/get_user_data_by_id", "member_id=" + MemberID);
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
