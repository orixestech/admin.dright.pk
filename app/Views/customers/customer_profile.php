<?php

use App\Models\LookupModal;

$LookupOptionData = new LookupModal();
$Province = $LookupOptionData->LookupOptionBYID($Customer['Province']);
$Province = isset($Province[0]['Name']) && $Province[0]['Name'] !== '' ? $Province[0]['Name'] : '';

$City = $LookupOptionData->LookupOptionBYID( $Customer[ 'City' ] );
$City = $City[0]['Name'];

$Speciality = $LookupOptionData->LookupOptionBYID( $Customer[ 'Speciality' ] );
$Speciality = isset($Speciality[0]['Name']) && $Speciality[0]['Name'] !== '' ? $Speciality[0]['Name'] : '';

$Category = $LookupOptionData->LookupOptionBYID( $Customer[ 'Category' ] );
$Category = isset($Category[0]['Name']) && $Category[0]['Name'] !== '' ? $Category[0]['Name'] : '';

//$statusurl = $this->Orixes->SeoUrl( 'module/customer/status/' . $Customer[ 'UID' ] );
$statusurl = '';

$filename = "Backup-" . $Customer[ 'UID' ] . ".json";
$filedir = "desktop_backups/";
$file = "desktop_backups/Backup-" . $Customer[ 'UID' ] . ".json";
if ( file_exists( $file ) ) {
    $JSON = json_decode( file_get_contents( "desktop_backups/Backup-" . $Customer[ 'UID' ] . ".json" ), true );


} else {
    $JSON = '';
}

?>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Customer Profile</h6>
                <ul class="nav nav-tabs mb-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile-tab-content" role="tab" aria-controls="profile-tab-content" aria-selected="true">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="discount-tab" data-toggle="tab" href="#discount-tab-content" role="tab" aria-controls="discount-tab-content" aria-selected="false">Discount</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="users-tab" data-toggle="tab" href="#users-tab-content" role="tab" aria-controls="users-tab-content" aria-selected="false">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="json-tab" data-toggle="tab" href="#json-tab-content" role="tab" aria-controls="json-tab-content" aria-selected="false">Latest JSON</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- Profile Tab -->
                    <div class="tab-pane fade show active" id="profile-tab-content" role="tabpanel" aria-labelledby="profile-tab">
                        <h6>Customer Details</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Full Name:</strong> <?= $Customer['Name'] ?></p>
                                <p><strong>Province:</strong> <?= isset($Province) ? $Province: '' ?></p>
                                <p><strong>Email:</strong> <?= $Customer['Email'] ?></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>City:</strong> <?= isset($City) ? $City : '' ?></p>
                                <p><strong>Contact Number:</strong> <?= $Customer['ContactNo'] ?></p>
                                <p><strong>Category:</strong> <?= isset($Category) ? $Category: '' ?></p>
                            </div>
                        </div>
                        <?php if ($Customer['Type'] != 'SN') { ?>
                            <h6>PA Details</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Full Name:</strong> <?= $Customer['PAName'] ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Contact No:</strong> <?= $Customer['PAContactNo'] ?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- Discount Tab -->
                    <div class="tab-pane fade" id="discount-tab-content" role="tabpanel" aria-labelledby="discount-tab">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Percentage</th>
                                <th>Expire Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $cnt = 0;
                            foreach ($Discounts as $D) {
                                $cnt++; ?>
                                <tr>
                                    <td><?= $cnt ?></td>
                                    <td><img style="height: 60px;" src="<?= $path . 'upload/discount/' . $D['DiscountImage'] ?>"></td>
                                    <td><?= $D['DiscountTitle'] ?></td>
                                    <td><?= $D['DiscountPercent'] ?>%</td>
                                    <td><?= date('d M, Y', strtotime($D['DiscountExpireDate'])) ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Users Tab -->
                    <div class="tab-pane fade" id="users-tab-content" role="tabpanel" aria-labelledby="users-tab">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Contact</th>
                                <th>User Type</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($Users as $User) { ?>
                                <tr>
                                    <td><?= $User['FullName'] ?></td>
                                    <td><?= $User['Email'] ?></td>
                                    <td><?= $User['Password'] ?></td>
                                    <td><?= $User['Contact'] ?></td>
                                    <td><?= $User['UserType'] ?></td>
                                    <td>
                                        <a href="javascript:void(0);" onclick="AddUser()" class="btn btn-gradient-primary btn-sm"><i class="fa fa-plus-square"></i></a>
                                        <a href="javascript:void(0);" onclick="EditUser(<?= $User['UID'] ?>)" class="btn btn-secondary btn-sm"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript:void(0);" onclick="DeleteUser(<?= $User['UID'] ?>)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- JSON Tab -->
                    <div class="tab-pane fade" id="json-tab-content" role="tabpanel" aria-labelledby="json-tab">
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo view('customers/add_user'); ?>
<?php echo view('customers/update_user'); ?>

<script>
    function AddUser() {
        $('#AddUserModal').modal('show');

    }
    function EditUser(id) {

            var Items = AjaxResponse("customers/get_record", "id=" + id);
         $('#UpdateUserModal form#UpdateUserForm input#UID').val(Items.record.UID);
            $('#UpdateUserModal form#UpdateUserForm select#UserType').val(Items.record.UserType);
            $('#UpdateUserModal form#UpdateUserForm input#FullName').val(Items.record.FullName);
            $('#UpdateUserModal form#UpdateUserForm input#Contact').val(Items.record.Contact);
            $('#UpdateUserModal form#UpdateUserForm input#PrimaryQualification').val(Items.record.Pqualification);
            $('#UpdateUserModal form#UpdateUserForm input#AdvanceQualification').val(Items.record.Aqualification);
            $('#UpdateUserModal form#UpdateUserForm input#Email').val(Items.record.Email);
            $('#UpdateUserModal form#UpdateUserForm input#Password').val(Items.record.Password);
        $('#UpdateUserModal').modal('show');

    }
    function DeleteUser(id) {
        if (confirm("Are you Sure U want to Delete this?")) {
            response = AjaxResponse("customers/delete_user", "id=" + id);
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

    function FormSectionHide() {
        $( "#ListSection" ).removeClass( "col-md-8" );
        $( "#ListSection" ).addClass( "col-md-12" );
        $( "#FormSection" ).hide();
    }


</script>