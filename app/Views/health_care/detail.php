

<div class="ks-container">
    <div class="ks-column ks-page">
        <div class="ks-header">
            <section class="ks-title">
                <h5><a href="<?=$path?>">Home</a> <i class="fa fa-angle-right breed"></i> <a href="javascript:void(0)"> Diet Details </a></h5>
            </section>
        </div>
        <div class="ks-content">
            <div class="ks-body ks-content-nav">
                <div class="ks-nav-body no-margin">
                    <div class="page-content">
                     
                        <h3 style="text-transform: capitalize;">
                            <?=$Record['Category']?>&nbsp;-&nbsp;
                            <?=$Record['Name']?>
                        </h3>

                        <div class="row">
                            <div class="col-md-12" id="ListSection">
                                <div class="card panel panel-primary block-default">
                                    <h5 class="card-header">Nutritional Stats</h5>
                                    <div class="card-block">
                                        <div class="table-responsive">
                                            <form class="form-horizontal validate" method="post" name="AddDietDetail" id="AddDietDetail">
                                                <table id="UsersList" class="table table-bordered table-hover">
                                                    <thead style="background-color: lightgray; color: white;">
                                                    <tr>
                                                        <th colspan="2">Nutritional Items</th>
                                                        <th>value per 100g </th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>

                                                    <?php

                                                    foreach ( $NutritionalArray as $HEAD => $ND ) {
                                                        $Arr = json_encode( $ND );

                                                        echo '<tr><th colspan="2">' . $HEAD . '</th></tr>';

                                                        foreach ( $ND as $detail ) {
                                                            $ID = $detail[ 'id' ];
                                                            $Title = $detail[ 'title' ];
                                                                $healthcare= new \App\Models\HealthcareModel();
                                                            $Value = $healthcare->GetNutritionalValue( $item_uid, $ID );
// Check if $Value has at least one element and the 'Value' key exists
                                                            if (!empty($Value) && isset($Value[0]['Value'])) {
                                                                // Extract the 'Value' (in your case 52)
                                                                $NutritionalValue = $Value[0]['Value'];

                                                                // Output or manipulate $NutritionalValue as needed
                                                                echo '<tr><td width="70%" style="padding-left: 50px;">' . $detail['title'] . '</td><td>' . $NutritionalValue . ' <unit>' . $detail['unit'] . '</unit></td><td style="width: 13%;"><input type="hidden" name="diet_id" id="diet_id" value="' . $item_uid . '"/><input class="form-control validate[custom[number]]" type="text" name="fact[' . $ID . ']" value="' . $NutritionalValue . '"></td></tr>';
                                                            } else {
                                                                // Handle the case where no value is found
                                                                echo '<tr><td width="70%" style="padding-left: 50px;">' . $detail['title'] . '</td><td>N/A</td><td><input type="hidden" name="diet_id" id="diet_id" value="' . $item_uid . '"/><input class="form-control validate[custom[number]]" type="text" name="fact[' . $ID . ']" value="0"></td></tr>';
                                                            }

                                                        }
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                                <div class="clearfix form-actions">
                                                    <div class=" pull-right">
                                                        <button type="button" onclick="AddDietDetailForm()" class="btn btn-success"> <i class="icon-ok bigger-110"></i> Submit </button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div id="AjaxResult"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="clearfix"><br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function SubCategory( value ) {
        $.ajax( {

            cache: false,
            async: false,
            type: "POST",
            url: "<?=$path?>form_process/subcategory_dropdown",
            dataType: 'html',
            data: 'value=' + value,
            success: function ( data ) {

                $( '#subhead' ).html( data );
            }

        } );
    }

        function AddDietDetailForm() {
        var formdata = new window.FormData($("form#AddDietDetail")[0]);

        response = AjaxUploadResponse("diet/detail-submit", formdata);
        if (response.status === 'success') {
        $("#AjaxResult").html('<div class="alert alert-success mb-4" style="margin: 10px;" role="alert"> <strong>Success!</strong> ' + response.message + ' </div>');
        setTimeout(function () {
            location.reload();
        }, 500);
    } else {
        $("#AjaxResult").html('<div class="alert alert-danger mb-4" style="margin: 10px;" role="alert"> <strong>Error!</strong> ' + response.message + ' </div>');
    }
    }

    function AddDietDetgggailForm( parent ) {

        var validate = $( 'form#AddDietDetail' ).validationEngine( 'validate' );
        if ( validate == false ) {
            return false;
        }

        data = $( 'form#' + parent ).serialize();
        //data = new window.FormData( $( 'form#AddDocumentForm' )[ 0 ] );


        $.ajax( {

            cache: false,
            async: false,
            type: "POST",
            url: "<?=$path?>diet/detail-submit",
            dataType: 'json',
            data: data,
            success: function ( data ) {

                if ( data.status == 'success' ) {

                    $( "#AjaxResult" ).html( '<hr> <div class="alert alert-success ks-solid ks-active-border" role="alert">' + data.msg + '</div>' );
                    setTimeout( function () {
                        window.location.href = location.href;
                    }, 2000 );

                } else {

                    $( "#AjaxResult" ).html( '<hr> <div class="alert alert-danger ks-solid ks-active-border" role="alert">' + data.msg + '</div>' );
                }
            }

        } );

    }
</script>