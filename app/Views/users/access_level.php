<br>
<?php

use App\Models\Crud;

$Crud = new Crud();
$record = $Crud->SingleRecord("system_users", array("UID" => $UserID));
//print_r($record['FullName']);exit();


?>
<div class="card shadow-sm" id="kt_app_main">
    <!-- Toolbar Section -->
    <div id="kt_app_toolbar" class="app-toolbar py-4  border-bottom">
        <div id="kt_app_toolbar_container" class="container-fluid d-flex justify-content-between align-items-center">
            <div class="page-title">
                <h1 class="text-gray-900 fw-bold fs-3 my-0">
                    User "<?=$record['FullName']?>" Permissions
                </h1>
            </div>
            <div>
                <button type="button" class="btn btn-primary" onclick="AddUserAccessFormFunction()">Save Changes</button>
            </div>
        </div>
    </div>

    <form class="RollPermissionForm p-4" id="RollPermissionForm" method="post">
        <input type="hidden" id="UserID" name="UserID" value="<?= $UserID ?>">

        <?php foreach ($rolls_permissions as $Segment => $form): ?>
            <?php $SegmentKey = strtolower(str_replace(" ", "_", $Segment)); ?>
            <!-- Permissions Card -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center ">
                    <h5 class="mb-0"><?= $Segment ?></h5>
                    <div>
                        <button type="button" class="btn btn-sm btn-danger me-2" onclick="toggleCheckboxes('<?= $SegmentKey ?>', false)">Disable All</button>
                        <button type="button" class="btn btn-sm btn-success" onclick="toggleCheckboxes('<?= $SegmentKey ?>', true)">Enable All</button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row" id="segment_<?= $SegmentKey ?>">
                        <?php foreach ($form as $input): ?>
                            <div class="col-md-4 col-sm-6 mb-3">
                                <div class="form-check form-check-custom form-check-success">
                                    <input class="form-check-input" id="access_<?= $input['uid'] ?>"
                                           name="access[<?= $input['uid'] ?>]" type="checkbox" value="1"
                                        <?php if ($UserRoll != null) {
                                            foreach ($UserRoll as $access) {
                                                echo $access['AccessID'] == $input['uid'] ? 'checked' : '';
                                            }
                                        } ?> />
                                    <label class="form-check-label segment_<?= $SegmentKey ?>" for="access_<?= $input['uid'] ?>">
                                        <?= $input['title'] ?>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Save Changes Button -->
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary" onclick="AddUserAccessFormFunction()">Save Changes</button>
        </div>
    </form>

    <script>
        // Function to enable/disable checkboxes in a specific segment
        function toggleCheckboxes(segmentKey, enable) {
            // Get all checkboxes within the specific segment
            const checkboxes = document.querySelectorAll(`#segment_${segmentKey} .form-check-input`);

            // Loop through each checkbox and set its checked property
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = enable;
            });
        }
    </script>
</div>


<script>

    function AddUserAccessFormFunction() {
        var formdata = new window.FormData($("form#RollPermissionForm")[0]);

        response = AjaxUploadResponse("users/user_roll_form_submit", formdata);
        if (response.status === 'success') {
            $("#addajaxResponse").html('<div class="alert alert-success mb-4" style="margin: 10px;" role="alert"> <strong>Success!</strong> ' + response.message + ' </div>');
            setTimeout(function () {
                location.reload();
            }, 500);
        } else {
            $("#addajaxResponse").html('<div class="alert alert-danger mb-4" style="margin: 10px;" role="alert"> <strong>Error!</strong> ' + response.message + ' </div>');
        }
    }
</script>