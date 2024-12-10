<?php


$ExtendedModel = new \App\Models\ExtendedModel();

?>

<div class="ks-container">
    <div class="ks-column ks-page">
        <div class="ks-header">
            <section class="ks-title">
                <h5><a href="<?=$path?>">Home</a> <i class="fa fa-angle-right breed"></i><a href="<?=$path?>module/extended_profiles/list">Extended Profile</a>
                    <i class="fa fa-angle-right breed"></i><a  href="javascript:void(0);">Details</a></h5>
            </section>
        </div>
        <div class="ks-content">
            <div class="ks-body ks-profile">
                <div class="ks-header">
                    <div class="ks-user">
                        <div class="ks-info">
                            <div class="ks-name">
                                <h2><?=$HospitalData[0]['FullName']?></h2>
                            </div>
                            <?php
                            if( $HospitalData[0]['Email'] != '' ){
                                echo'<div class="ks-description">
                                           <strong>Email:</strong> '.$HospitalData[0]['Email'].'
                                        </div>';
                            }
                            if( $HospitalData[0]['ContactNo'] != '' ){
                                echo' <div class="ks-description">
                                                <strong>ContactNo:</strong>  '.$HospitalData[0]['ContactNo'].'
                                            </div>';
                            }?>
                        </div>
                    </div>
                </div>
                <div class="ks-tabs-container ks-tabs-default ks-tabs-no-separator ks-full ks-light">
                    <ul class="nav ks-nav-tabs">
                        <li class="nav-item"> <a class="nav-link active" href="#" data-toggle="tab" data-target="#settings" aria-expanded="false">Settings</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="#" data-toggle="tab" data-target="#users" aria-expanded="false">Users</a> </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="settings" role="tabpanel" aria-expanded="false">
                            <div class="ks-users-tab">

                                <div class="card panel panel-default ks-widget ks-widget-progress-list">
                                    <div class="card-header">
                                        Admin Settings

                                        <div class="ks-controls">
                                            <a href="#" class="ks-control ks-update"><span class="fa fa-repeat"></span></a>
                                        </div>
                                    </div>
                                    <div class="card-block" style="padding: 25px;">
                                        <form class="validate" role="form" enctype="multipart/form-data" onsubmit="UpdateAdminSettings(); return false;" id="AdminSettingsForm"
                                              name="AdminSettingsForm">
                                            <input type="hidden" name="DBName" id="DBName" value="<?=$HospitalData[0]['DatabaseName']?>">
                                            <?php
                                            $specialized_mode = array();
                                            $specialized_mode['general'] = 'General';
                                            $specialized_mode['cancer'] = 'Cancer Hospital';
                                            $specialized_mode['general_pharmacy'] = 'General Pharmacy';
                                            //echo'<pre>'; print_r( $HospitalAdminSettings );
                                            if( count( $HospitalAdminSettings ) > 0 ){
                                                foreach( $HospitalAdminSettings as $record ){

                                                    switch ($record['Key']) {
                                                        case 'app_version':
                                                            echo '<div class="form-group row">
                                                                        <label class="col-sm-3 col-md-4 col-lg-2 col-xs-3 form-control-label">' . $record['Name'] . ':</label>
                                                                        <div class="col-sm-9 col-md-8 col-lg-6 col-xs-9">
                                                                            <select id="' . $record['Key'] . '" name="' . $record['Key'] . '" class="form-control">
                                                                                    <option '.( ( $record["Description"] == '' )? 'selected' : '' ).' value="">Select Version</option>
                                                                                    <option '.( ( $record["Description"] == 'ClinTa-Pharmacy' )? 'selected' : '' ).' value="ClinTa-Pharmacy">ClinTa Pharmacy</option>
                                                                                    <option '.( ( $record["Description"] == 'ClinTa-Extended' )? 'selected' : '' ).' value="ClinTa-Extended">ClinTa Extended</option>
                                                                                    <option '.( ( $record["Description"] == 'ClinTa-Laris' )? 'selected' : '' ).' value="ClinTa-Extended">ClinTa Laris</option>
                                                                            </select>
                                                                        </div>
                                                                  </div>';
                                                            break;
                                                        case 'lab_services':
                                                            $serviceGroup = $ExtendedModel->GetExtendedLookupsDataByDBOrID( $HospitalData[0]['DatabaseName'], 'service_group');
                                                            echo '<div class="form-group row">
                                                                    <label class="col-sm-3 col-md-4 col-lg-2 col-xs-3 form-control-label">' . $record['Name'] . ':</label>
                                                                    <div class="col-sm-9 col-md-8 col-lg-6 col-xs-9">
                                                                            <select id="' . $record['Key'] . '" name="' . $record['Key'] . '" class="form-control">
                                                                            <option value="">Select Group</option>';
                                                            foreach ($serviceGroup as $value) {
                                                                echo '<option value=' . $value['UID'] . ' ' . (($value["UID"] == $record["Description"]) ? "Selected" : "") . ' >' . $value['Name'] . '</option>';
                                                            }
                                                            echo '</select>
                                                                     </div>
                                                                </div>';
                                                            break;
                                                        case 'radiology_service':
                                                            $serviceGroup = $ExtendedModel->GetExtendedLookupsDataByDBOrID($HospitalData[0]['DatabaseName'], 'service_group');
                                                            echo '<div class="form-group row">
                                                                        <label class="col-sm-3 col-md-4 col-lg-2 col-xs-3 form-control-label">' . $record['Name'] . ':</label>
                                                                        <div class="col-sm-9 col-md-8 col-lg-6 col-xs-9">
                                                                                <select id="' . $record['Key'] . '" name="' . $record['Key'] . '" class="form-control">
                                                                                <option value="">Select Group</option>';
                                                            foreach ($serviceGroup as $value) {
                                                                echo '<option value=' . $value['UID'] . ' ' . (($value["UID"] == $record["Description"]) ? "Selected" : "") . ' >' . $value['Name'] . '</option>';
                                                            }
                                                            echo '</select>
                                                                      </div>
                                                                  </div>';
                                                            break;
                                                        case 'ot_services':

                                                            $serviceGroup = $ExtendedModel->GetExtendedLookupsDataByDBOrID($HospitalData[0]['DatabaseName'], 'service_group');
                                                            echo '<div class="form-group row">
                                                                    <label class="col-sm-3 col-md-4 col-lg-2 col-xs-3 form-control-label">' . $record['Name'] . ':</label>
                                                                    <div class="col-sm-9 col-md-8 col-lg-6 col-xs-9">
                                                                            <select id="' . $record['Key'] . '" name="' . $record['Key'] . '" class="form-control">
                                                                                <option value="">Select Group</option>';
                                                            foreach ($serviceGroup as $value) {
                                                                echo '<option value=' . $value['UID'] . ' ' . (($value["UID"] == $record["Description"]) ? "Selected" : "") . ' >' . $value['Name'] . '</option>';
                                                            }
                                                            echo '</select>
                                                                      </div>
                                                                   </div>';
                                                            break;
                                                        case'pharma_prescription';
                                                            echo '<div class="form-group row">
                                                                        <label class="col-sm-3 col-md-4 col-lg-2 col-xs-3 form-control-label">' . $record['Name'] . ':</label>
                                                                      <div class="col-sm-9 col-md-8 col-lg-6 col-xs-9">
                                                                            <div class="radio radio-inline">
                                                                                <label>
                                                                                    <input ' . (("1" == $record["Description"]) ? "checked='checked'" : " ") . ' type="radio" id="' . $record['Key'] . '" name="' . $record['Key'] . '" value="1" >
                                                                                  Yes
                                                                                </label>
                                                                            </div>
                                                                             <div class="radio radio-inline">
                                                                                <label>
                                                                                    <input ' . (("0" == $record["Description"]) ? "checked='checked'" : " ") . ' type="radio" id="' . $record['Key'] . '" name="' . $record['Key'] . '" value="0" >
                                                                                  No
                                                                                </label>
                                                                            </div>
                                                                      </div>
                                                                  </div>';
                                                            break;
                                                        case'invoice_signature';
                                                            echo '<div class="form-group row">
                                                                    <label class="col-sm-3 col-md-4 col-lg-2 col-xs-3 form-control-label">' . $record['Name'] . ':</label>
                                                                  <div class="col-sm-9 col-md-8 col-lg-6 col-xs-9">
                                                                        <div class="radio radio-inline">
                                                                            <label>
                                                                                <input ' . (("1" == $record["Description"]) ? "checked='checked'" : " ") . ' type="radio" id="' . $record['Key'] . '" name="' . $record['Key'] . '" value="1" >
                                                                              Yes
                                                                            </label>
                                                                        </div>
                                                                         <div class="radio radio-inline">
                                                                            <label>
                                                                                <input ' . (("0" == $record["Description"]) ? "checked='checked'" : " ") . ' type="radio" id="' . $record['Key'] . '" name="' . $record['Key'] . '" value="0" >
                                                                              No
                                                                            </label>
                                                                        </div>
                                                                  </div>
                                                              </div>';
                                                            break;
                                                        case'application_mode';
                                                            echo '<div class="form-group row">
                                                                    <label class="col-sm-3 col-md-4 col-lg-2 col-xs-3 form-control-label">' . $record['Name'] . ':</label>
                                                                  <div class="col-sm-9 col-md-8 col-lg-6 col-xs-9">
                                                                        <div class="radio radio-inline">
                                                                            <label>
                                                                                <input ' . (("Online" == $record["Description"]) ? "checked='checked'" : " ") . ' type="radio" id="' . $record['Key'] . '" name="' . $record['Key'] . '" value="Online" >
                                                                              Online 
                                                                            </label>
                                                                        </div>
                                                                         <div class="radio radio-inline">
                                                                            <label>
                                                                                <input ' . (("Offline" == $record["Description"]) ? "checked='checked'" : " ") . ' type="radio" id="' . $record['Key'] . '" name="' . $record['Key'] . '" value="Offline" >
                                                                              Offline
                                                                            </label>
                                                                        </div>
                                                                  </div>
                                                              </div>';
                                                            break;
                                                        case'pharmacy_setup';
                                                            echo '<div class="form-group row">
                                                                        <label class="col-sm-3 col-md-4 col-lg-2 col-xs-3 form-control-label">' . $record['Name'] . ':</label>
                                                                      <div class="col-sm-9 col-md-8 col-lg-6 col-xs-9">
                                                                            <div class="radio radio-inline">
                                                                                <label>
                                                                                    <input ' . ((1 == $record["Description"]) ? "checked='checked'" : " ") . ' type="radio" id="' . $record['Key'] . '" name="' . $record['Key'] . '" value="1" >
                                                                                  Internal 
                                                                                </label>
                                                                            </div>
                                                                             <div class="radio radio-inline">
                                                                                <label>
                                                                                    <input ' . ((2 == $record["Description"]) ? "checked='checked'" : " ") . ' type="radio" id="' . $record['Key'] . '" name="' . $record['Key'] . '" value="2" >
                                                                                  External
                                                                                </label>
                                                                            </div>
                                                                      </div>
                                                                  </div>';
                                                            break;
                                                        case 'drug_category':
                                                            $Category = $ExtendedModel->GetExtendedProductCategoriesByDBName( $HospitalData[0]['DatabaseName'] );
                                                            echo '<div class="form-group row">
                                                                <label class="col-sm-3 col-md-4 col-lg-2 col-xs-3 form-control-label">' . $record['Name'] . ':</label>
                                                                <div class="col-sm-9 col-md-8 col-lg-6 col-xs-9">
                                                                <select id="' . $record['Key'] . '" name="' . $record['Key'] . '" class="form-control">
                                                                    <option value="">Select Category</option>';
                                                            foreach ($Category as $C) {
                                                                echo '<option value=' . $C['UID'] . ' ' . (($C['UID'] == $record['Description']) ? "Selected" : " ") . '>' . $C['Title'] . '</option>';
                                                            }
                                                            echo '</select>
                                                                 </div>
                                                              </div>';
                                                            break;
                                                        case 'specialized_mode':
                                                            //$specialized_mode = config_item('specialized_mode');
                                                            echo '<div class="form-group row">
                                                                <label class="col-sm-3 col-md-4 col-lg-2 col-xs-3 form-control-label">' . $record['Name'] . ':</label>
                                                                <div class="col-sm-9 col-md-8 col-lg-6 col-xs-9">
                                                                <select multiple="multiple"  id="' . $record['Key'] . '" name="' . $record['Key'] . '[]" class="form-control">
                                                                    <option value=" ">Select Mode</option>';
                                                            $options = explode(",", $record['Description']);
                                                            foreach ($specialized_mode as $sm => $sv) {
                                                                echo '<option value=' . $sm . ' ' . ((in_array($sm, $options)) ? "selected" : " ") . ' >' . $sv . '</option>';
                                                            }
                                                            echo '</select>
                                                              </div>
                                                              </div>';
                                                            break;
                                                        case'application_setup';
                                                            echo '<div class="form-group row">
                                                                        <label class="col-sm-3 col-md-4 col-lg-2 col-xs-3 form-control-label">' . $record['Name'] . ':</label>
                                                                      <div class="col-sm-9 col-md-8 col-lg-6 col-xs-9">
                                                                            <div class="radio radio-inline">
                                                                                <label>
                                                                                    <input ' . (("Cloud" == $record["Description"]) ? "checked='checked'" : " ") . ' type="radio" id="' . $record['Key'] . '" name="' . $record['Key'] . '" value="Cloud" >
                                                                                 Cloud
                                                                                </label>
                                                                            </div>
                                                                             <div class="radio radio-inline">
                                                                                <label>
                                                                                    <input ' . (("IN-House" == $record["Description"]) ? "checked='checked'" : " ") . ' type="radio" id="' . $record['Key'] . '" name="' . $record['Key'] . '" value="IN-House" >
                                                                                  In House
                                                                                </label>
                                                                            </div>
                                                                      </div>
                                                                  </div>';
                                                            break;
                                                        case'sms_notification';
                                                            echo '<div class="form-group row">
                                                             <label class="col-sm-3 col-md-4 col-lg-2 col-xs-3 form-control-label">' . $record['Name'] . ':</label>
                                                              <div class="col-sm-9 col-md-8 col-lg-6 col-xs-9">
                                                                  <select id="' . $record['Key'] . '" name="' . $record['Key'] . '" class="form-control">
                                                                    <option value="" ' . (($record["Description"] == '') ? 'selected' : '') . '>Please Select</option>
                                                                    <option value="Yes" ' . (($record["Description"] == 'Yes') ? 'selected' : '') . '>Yes</option>
                                                                    <option value="No" ' . (($record["Description"] == 'No') ? 'selected' : '') . '>No</option>
                                                                  </select>                           
                                                              </div>
                                                             </div>';
                                                            break;
                                                        case'sms_notification_number';
                                                            echo '<div class="form-group row">
                                                             <label class="col-sm-3 col-md-4 col-lg-2 col-xs-3 form-control-label">' . $record['Name'] . ':</label>
                                                              <div class="col-sm-9 col-md-8 col-lg-6 col-xs-9">
                                                                  <input  value="' . $record['Description'] . '" type="text" maxlength="11" id="' . $record['Key'] . '" name="' . $record['Key'] . '"  class="form-control input-sm validate[custom[integer], minSize[11]]" />                        
                                                              </div>
                                                             </div>';
                                                            break;
                                                        case'profile_logo';
                                                            echo '<div class="form-group row">
                                                                  <label class="col-sm-3 col-md-4 col-lg-2 col-xs-3 form-control-label">' . $record['Name'] . ':</label>
                                                                  <div class="col-sm-9 col-md-8 col-lg-6 col-xs-9">
                                                                      <input   type="file" id="' . $record['Key'] . '" name="' . $record['Key'] . '"  class="form-control input-sm" style="width: 50%;float: left;"/>
                                                                      <img src="" height="80" style="float: right;">
                                                                  </div>
                                                              </div>';
                                                            break;
                                                        case'pdf_header';
                                                        case'pdf_header_pharmacy';
                                                        case'pdf_footer_pharmacy';
                                                            echo '<div class="form-group row">
                                                                  <label class="col-sm-3 col-md-4 col-lg-2 col-xs-3 form-control-label">' . $record['Name'] . ':</label>
                                                                  <div class="col-sm-9 col-md-8 col-lg-6 col-xs-9">
                                                                      <textarea rows="4" type="text" id="' . $record['Key'] . '" name="' . $record['Key'] . '" placeholder="Please enter your value" class="form-control">' . $record['Description'] . '</textarea>
                                                                      <small class="red">This content will appear in PDF same as enter maximum of four lines.</small>
                                                                  </div>
                                                              </div>';
                                                            break;
                                                        case'prescription_pharmacist';
                                                        case'opd_service_fee_editable';
                                                            echo '<div class="form-group row">
                                                                <label class="col-sm-3 col-md-4 col-lg-2 col-xs-3 form-control-label">' . $record['Name'] . ':</label>
                                                              <div class="col-sm-9 col-md-8 col-lg-6 col-xs-9">
                                                                    <div class="radio radio-inline">
                                                                        <label>
                                                                            <input ' . (("1" == $record["Description"]) ? "checked='checked'" : " ") . ' type="radio" id="' . $record['Key'] . '" name="' . $record['Key'] . '" value="1" >
                                                                          Yes
                                                                        </label>
                                                                    </div>
                                                                     <div class="radio radio-inline">
                                                                        <label>
                                                                            <input ' . (("0" == $record["Description"]) ? "checked='checked'" : " ") . ' type="radio" id="' . $record['Key'] . '" name="' . $record['Key'] . '" value="0" >
                                                                          No
                                                                        </label>
                                                                    </div>
                                                              </div>
                                                          </div>';
                                                            break;
                                                        case 'pharmacy_printer':
                                                            echo '<div class="form-group row">
                                                                <label class="col-sm-3 col-md-4 col-lg-2 col-xs-3 form-control-label">' . $record['Name'] . ':</label>
                                                                <div class="col-sm-9 col-md-8 col-lg-6 col-xs-9">
                                                                    <select id="' . $record['Key'] . '" name="' . $record['Key'] . '" class="form-control">
                                                                        <option value="" ' . (($record['Description'] == '') ? 'selected' : '') . '>Select Pharmacy Printer Setup</option>
                                                                        <option value="Thermal" ' . (($record['Description'] == 'Thermal') ? 'selected' : '') . '>Thermal</option>
                                                                        <option ' . (($record['Description'] == 'A4') ? 'selected' : '') . ' value="A4" >A4</option>
                                                                    </select>
                                                                </div>
                                                              </div>';
                                                            break;
                                                        default:
                                                            echo '<div class="form-group row">
                                                                      <label class="col-sm-3 col-md-4 col-lg-2 col-xs-3 form-control-label">' . $record['Name'] . ':</label>
                                                                      <div class="col-sm-9 col-md-8 col-lg-6 col-xs-9">
                                                                      <input type="text" id="' . $record['Key'] . '" name="' . $record['Key'] . '" placeholder="Please enter your value" value="' . $record['Description'] . '" class="form-control input-sm" />
                                                                      </div>
                                                                  </div>';
                                                            break;
                                                    }
                                                }
                                            } ?>
                                            <div class="row">
                                                <div class="col-md-12" id="AdminSettingResponse"></div>
                                                <div class="col-md-8">
                                                    <button  type="button" onclick="UpdateAdminSettings();" class="btn btn-success btn-sm pull-right">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="users" role="tabpanel" aria-expanded="false">
                            <div class="ks-users-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table id="UsersList" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th width="80">#</th>
                                                    <th>Name</th>
                                                    <th>UserName</th>
                                                    <th>Email</th>
                                                    <th>Mobile No</th>
                                                    <th width="120">Actions
                                                        <a onclick="AddNewUserModal( '<?=$HospitalData[0]['DatabaseName']?>' );" title="Add New Admin User" style="padding: 2px 10px !important; height: 20px !important;" href="javascript:void(0);"
                                                           class="pull-right btn btn-primary btn-sm"><span class="fa fa-plus"></span></a>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $cnt = 0;
                                                foreach( $HospitalAdminUsers as $HAU ){
                                                    $cnt++;
                                                    echo'<tr>
                                                                    <td>'.$cnt.'</td>
                                                                    <td>'.$HAU['FullName'].'</td>
                                                                    <td>'.$HAU['Username'].'</td>
                                                                    <td>'.$HAU['Email'].'</td>
                                                                    <td>'.$HAU['MobileNo'].'</td>
                                                                    <td>
                                                                        <a title="Edit User" href="javascript:void(0);" onclick="ExtendedEditUserModal( \''.$HospitalData[0]['DatabaseName'].'\' , '.$HAU['UID'].' );" class="btn btn-primary-outline ks-no-text"><span class="fa fa-pencil ks-icon"></span></a>
                                                                        <a title="Assign All AccessLevels" href="javascript:void(0);" onclick="AssignAllExtendedAccessToUser( \''.$HospitalData[0]['DatabaseName'].'\' , '.$HAU['UID'].' );" class="btn btn-danger-outline ks-no-text"><span class="fa fa-recycle ks-icon"></span></a>
                                                                    </td>
                                                                 </tr>';
                                                }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--    --><?php //$this->load->view( "inner-html/extended-add-user-modal" ); ?>
<!--    --><?php //$this->load->view( "inner-html/extended-edit-user-modal" ); ?>
    <script type="text/javascript">
        function AddNewUserModal( dbname ) {

            $("#AddNewUser form#AddNewUserForm input#DBName").val( dbname );

            $('#AddNewUser').modal({
                show: true,
                backdrop: 'static',
                keyboard: false
            })
        }

        function ExtendedEditUserModal( DBNAME, UID ) {

            $("#EditNewUser form#EditUserForm input#id").val( UID );
            $("#EditNewUser form#EditUserForm input#DBName").val( DBNAME );

            rslt = ajaxreqResponse( "form_process/extended_admin_user_data_by_id", "dbname=" + DBNAME + "&uid=" + UID  );
            if( rslt != '' ){

                $("#EditNewUser form#EditUserForm input#name").val( rslt.FullName );
                $("#EditNewUser form#EditUserForm input#user_name").val( rslt.Username );
                $("#EditNewUser form#EditUserForm input#email").val( rslt.Email );
                $("#EditNewUser form#EditUserForm input#contactno").val( rslt.MobileNo );
                $("#EditNewUser form#EditUserForm select#usertype").val( rslt.AccessLevel );
                if(  rslt.BranchID == 0 ){
                    $("#EditNewUser form#EditUserForm select#branch").val('');
                    $("#EditNewUser form#EditUserForm div#branchdiv").css( 'display', 'none' );
                }else{
                    $("#EditNewUser form#EditUserForm select#branch").val( rslt.BranchID );
                    $("#EditNewUser form#EditUserForm div#branchdiv").css( 'display', '' );
                }
            }

            $('#EditNewUser').modal({
                show: true,
                backdrop: 'static',
                keyboard: false
            })
        }

        function ExtendedAdminUserFormSubmit( parent ) {

            var validate = $( "form#" + parent ).validationEngine( 'validate' );
            if( validate == false ){
                return false;
            }

            data = $("form#" + parent).serialize();

            rslt = ajaxreqResponse( "form_process/extended_admin_user_form_submit", data );
            if( rslt.status == 'success' ){

                if( rslt.form_type == 'add' ){

                    $("form#AddNewUserForm div#AjaxResult").css( 'display', '' );
                    $("form#AddNewUserForm div#AjaxResult").html( '<div class="alert alert-success ks-solid ks-active-border" role="alert">' + rslt.msg + '</div>' );
                    setTimeout( function () {
                        $("#AddNewUser form#AddNewUserForm")[0].reset();
                        $("#AddNewUser").modal( 'hide' );
                        window.location.href = location.href;
                    }, 1500 );
                }else{

                    $("form#EditUserForm div#AjaxResult").css( 'display', '' );
                    $("form#EditUserForm div#AjaxResult").html( '<div class="alert alert-success ks-solid ks-active-border" role="alert">' + rslt.msg + '</div>' );
                    setTimeout( function () {
                        $("#EditNewUser").modal( 'hide' );
                        window.location.href = location.href;
                    }, 1500 );

                }
            }else{
                if( rslt.form_type == 'add' ){
                    $("form#AddNewUserForm div#AjaxResult").html( '<div class="alert alert-danger ks-solid ks-active-border" role="alert">' + rslt.msg + '</div>' );
                    setTimeout( function () {
                        $("form#AddNewUserForm div#AjaxResult").css( 'display', 'none' );
                    }, 1500 );

                }else{

                    $("form#EditUserForm div#AjaxResult").html( '<div class="alert alert-danger ks-solid ks-active-border" role="alert">' + rslt.msg + '</div>' );
                    setTimeout( function () {
                        $("form#EditUserForm div#AjaxResult").css( 'display', 'none' );
                    }, 1500 );
                }
            }
        }

        function AssignAllExtendedAccessToUser( DBNAME, UID ) {

            rslt = ajaxRequest( "form_process/assign_extended_access_to_user", "dbname=" + DBNAME + "&id=" + UID );
            if( rslt.status == 'success' ){
                window.location.href = location.href;
            }

        }

        function UpdateAdminSettings() {

            var formData = new window.FormData($("form#AdminSettingsForm")[0]);
            var rslt = ajaxUploadResponse("module/update_extended_admin_settings", formData);
            if (rslt.status == 'success') {

                $(" div#AdminSettingResponse").html( '<div class="alert alert-success ks-solid ks-active-border" role="alert">' + rslt.msg + '</div>' );
                setTimeout(function () {
                    window.location = location.href;
                }, 1000);

            } else {

                $(" div#AdminSettingResponse").html( '<div class="alert alert-danger ks-solid ks-active-border" role="alert">' + rslt.msg + '</div>' );
            }
        }
    </script>
