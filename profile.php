<?php

include 'header.php';

?>

<body id="background">

<!-- Upload Modal -->
<div class="modal upload-modal fade" id="uploadModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Upload Image</h3>
            </div>
            <div class="modal-body">
                <div class="agileits-nxlayouts-info">
                    <div>User images are 140px by 140px - for best results upload a square photo that can be scaled to this size. Use a jpg, png, or gif image, under 1MB.

                    </div>
                    <p>Choose an image to upload</p>
                    <form id="uploadform" action="image_upload.php" method="post" enctype="multipart/form-data">
                        <input class="btn-default browseBtn" id="uploadImage" type="file" accept="image/*" name="image" />

                    </form>
                    <div id="err"></div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-10 col-xs-9">
                    <input class="btn-default uploadBtn" id="button" type="submit" value="Upload">
                </div>
                <div class="col-md-2 col-xs-2">
                    <button type="button" class="btn-default uploadBtn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {


    $("#button").click(function(e) {
        e.preventDefault();

        //var formData = new FormData();
        //formData.append('file', $('input[type=file]')[0].files[0]);
        var form = $('form')[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
        $.ajax({
            url: "image_upload.php",
            type: "POST",
            data:  formData,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend : function()
            {
                //$("#preview").fadeOut();
                $("#err").fadeOut();
                },
            success: function(data)
            {
                if(data=='invalid file')
                {
                    // invalid file format.
                    $("#err").html("Invalid File !").fadeIn();
                } else {
                    // view uploaded file.
                    var source = '<img src="'+data+'" height="140px" /><a href="#" type="submit" class="btn uploadBtn" id="uploadBtn" data-target="#uploadModal" role="button" data-toggle="modal">Change Image</a>';

                    $("#preview").html(source).fadeIn();
                    $("#icon").val(data);
                    $("#thumb").val(data);
                    $('form')[0].reset();
                    $('#uploadModal').modal('hide');
                }
            },
            error: function(e)
            {
                $("#err").html(e).fadeIn();
            }
        });
    })
});
</script>
<!-- //Upload Modal -->
<div id="newcli-container">
    <div class="container">
        <div class="newcli-form">
            <form id="profile" class="profileForm">
                <fieldset class="row">
                    <div class="modal-header">
                        <h1 class="modal-title">
                            <?php if (isset($_SESSION['user_id'])){echo $contact['member']['name'];}?>
                        </h1>
                    </div>
                    <div class="col-md-12">
                        <fieldset>
                            <legend>Basic Information
                            </legend>
                            <div class="upload-details">
                                <div class="col-md-3 profile_main">Profile Image</div>
                                <div class="col-md-4" id="preview">
                                    <?php if (isset($_SESSION['user_id']) && $contact["member"]["icon_exists?"]) {
                                        echo '<img src="'.$contact["member"]["icon"]["url"].'">';
                                    } else { echo '<img src="images/avatar.png">';}
                                    ?>
                                    <a href="#" type="submit" class="btn uploadBtn" id="uploadBtn" data-target="#uploadModal" role="button" data-toggle="modal">Upload Image</a></div>
                                <input type="hidden" id="icon" name="icon"
                                    <?php if (isset($_SESSION['user_id']) && $contact["member"]["icon_exists?"]) {echo 'value="'.$contact["member"]["icon"]["url"].'"';} ?>
                                />
                                <input type="hidden" id="thumb" name="thumb"
                                    <?php if (isset($_SESSION['user_id']) && $contact["member"]["icon_exists?"]) {echo 'value="'.$contact["member"]["icon"]["thumb_url"].'"';} ?>
                                />
                            </div>
                            <div class="section"></div>
                            <div class="update-address">
                                <div class="col-md-3 profile_main">Address</div>
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <div class="input-group">
                                            <span class="input-group-addon profile-label">Street</span>
                                            <input class="form-control" id="primary_address[street]" name="primary_address[street]"
                                            <?php if (isset($_SESSION['user_id'])){
                                                echo 'value="'.$contact['member']['primary_address']['street'].'"';
                                            }?>
                                        </>
                                        <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <div class="input-group">
                                        <span class="input-group-addon profile-label">Town</span>
                                        <input class="form-control" type="text" id="primary_address[city]" name="primary_address[city]"
                                            <?php if (isset($_SESSION['user_id'])){
                                                echo 'value="'.$contact['member']['primary_address']['city'].'"';
                                            }?>/>
                                        <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <div class="input-group">
                                        <span class="input-group-addon profile-label">County</span>
                                        <input class="form-control" type="text" id="primary_address[county]" name="primary_address[county]"
                                            <?php if (isset($_SESSION['user_id'])){
                                                echo 'value="'.$contact['member']['primary_address']['county'].'"';
                                            }?>/>
                                        <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <div class="input-group">
                                        <span class="input-group-addon profile-label">Postcode</span>
                                        <input class="form-control" type="text" id="primary_address[postcode]" name="primary_address[postcode]"
                                            <?php if (isset($_SESSION['user_id'])){
                                                echo 'value="'.$contact['member']['primary_address']['postcode'].'"';
                                            }?>/>
                                        <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="section row"></div>
                    <div class="update-address">
                        <div class="col-md-3 profile_main">Contact Details</div>
                        <div class="col-md-4">
                            <div id="phonesWrapper">
                                <ul id="phones">
                                    <!-- Phones Select -->
                                    <?php if (isset($_SESSION['user_id'])) {
                                        $p = 0; // phones array index
                                        foreach ($contact['member']['phones'] as $key => $value) {
                                            $number = "phones[" . $p . "][number]"; // Phone Number
                                            $id = "phones[" . $p . "][id]"; // ID of individual record for editing
                                            $type = "phones[".$p."][type_id]"; // id of the type of number
                                            echo '<li id="phone'.$p.'"><div class="form-group contactSelect"><div class="col-xs-4 typeSelect">
                                                            <div class="form-group">
                                                            <select class="form-control" id="'.$type.'" name="'.$type.'">
                                                            <option value="6001"';
                                            if ($value['type_id'] == 6001) echo 'selected="selected"';
                                            echo '>Work</option>
                                                             <option value="6002"';
                                            if ($value['type_id'] == 6002) echo 'selected="selected"';
                                            echo '>Mobile</option>
                                                             <option value="6003"';
                                            if ($value['type_id'] == 6003) echo 'selected="selected"';
                                            echo '>Fax</option>
                                                             <option value="6004"';
                                            if ($value['type_id'] == 6004) echo 'selected="selected"';
                                            echo '>Skype</option>
                                                             <option value="6005"';
                                            if ($value['type_id'] == 6005) echo 'selected="selected"';
                                            echo '>Home</option>
                                                             </select>
                                                             </div>
                                                             </div>
                                                             <div class="col-xs-8 typeSelect">
                                                             <div class="form-group has-feedback input-group">
                                                             <input class="form-control phonesNew" type="text" id="'.$number.'" name="'.$number.'" maxlength="12" ';
                                            if (isset($_SESSION['user_id'])) {
                                                echo 'value="' . $value['number'] . '"';
                                            };
                                            echo '/><span class="feedback form-control-feedback glyphicon glyphicon-ok"></span><span class="input-group-addon contact-addon"><a href="javascript:void(0);" class="remove" id="phone'.$p.'">X</a></span>
                                                             <input type="hidden" id="'.$id.'" name="'.$id.'" value="'.$value['id'].'" /> 
                                                             </div>
                                                             </div>
                                                             </div>
                                                             </li>';
                                            $p++;
                                        }
                                    }?>
                                </ul>
                            </div>
                            <div id="emailsWrapper">
                                <ul id="emails"><!-- Emails Select -->
                                    <?php if (isset($_SESSION['user_id'])) {
                                        $e = 0; // Emails array index
                                        foreach ($contact['member']['emails'] as $key => $value) {
                                            $email = "emails[" . $e . "][address]"; // Email Address
                                            $id = "emails[" . $e . "][id]"; // ID of individual record for editing
                                            $type = "emails[".$e."][type_id]"; // ID number of the email type
                                            echo '<li id="email'.$e.'"><div class="form-group contactSelect"><div class="col-xs-4 typeSelect">
                                                          <div class="form-group">
                                                          <select class="form-control" id="'.$type.'" name="'.$type.'">
                                                          <option value="4001"';
                                            if ($value['type_id'] == 4001) echo 'selected="selected"';
                                            echo '>Work</option>
                                                          <option value="4002"';
                                            if ($value['type_id'] == 4002) echo 'selected="selected"';
                                            echo '>Home</option>
                                                          </select>
                                                          </div>
                                                          </div>
                                                          <div class="col-xs-8 typeSelect">
                                                          <div class="form-group has-feedback input-group">
                                                          <input class="form-control emailsNew" type="text" id="'.$email.'" name="'.$email.'" ';
                                            if (isset($_SESSION['user_id'])) {
                                                echo 'value="' .$value['address']. '"';
                                            };
                                            echo '/><span class="feedback form-control-feedback glyphicon glyphicon-ok"></span><span class="input-group-addon contact-addon"><a href="javascript:void(0);" class="remove" id="email'.$e.'">X</a></span><input type="hidden" id="'.$id.'" name="'.$id.'" value="'.$value['id'].'" />
                                                          </div>
                                                          </div>
                                                          </div>
                                                          </li>';
                                            $e++;
                                        }
                                    }?>
                                </ul>
                            </div>
                            <div id="linksWrapper">
                                <ul id="links"><!-- Social Media Select -->
                                    <?php if (isset($_SESSION['user_id'])) {
                                        $l = 0; // Links array index
                                        foreach ($contact['member']['links'] as $key => $value) {
                                            $link = "links[" . $l . "][address]"; // Link Address
                                            $id = "links[" . $l . "][id]"; // ID of individual record for editing
                                            $type = "links[".$l."][type_id]"; // ID number of the Link type
                                            echo '<li id="link'.$l.'"><div class="form-group contactSelect"><div class="col-xs-4 typeSelect">
                                                         <div class="form-group">
                                                         <select class="form-control" id="'.$type.'" name="'.$type.'">
                                                         <option value="5001"';
                                            if ($value['type_id'] == 5001) echo 'selected="selected"';
                                            echo '>Website</option>
                                                         <option value="5002"';
                                            if ($value['type_id'] == 5002) echo 'selected="selected"';
                                            echo '>Facebook</option>
                                                         <option value="5003"';
                                            if ($value['type_id'] == 5003) echo 'selected="selected"';
                                            echo '>Twitter</option>
                                                         <option value="5004"';
                                            if ($value['type_id'] == 5004) echo 'selected="selected"';
                                            echo '>Linkedin</option>
                                                         <option value="5001"';
                                            if ($value['type_id'] == 5005) echo 'selected="selected"';
                                            echo '>IM</option>    
                                                         </select>
                                                         </div>
                                                         </div>
                                                         <div class="col-xs-8 typeSelect">
                                                         <div class="form-group has-feedback input-group">
                                                            <input class="form-control linksNew" type="text" id="'.$link.'" name="'.$link.'" ';
                                            if (isset($_SESSION['user_id'])) {
                                                echo 'value="' .$value['address']. '"';
                                            };
                                            echo '/><span class="feedback form-control-feedback glyphicon glyphicon-ok"></span><span class="input-group-addon contact-addon"><a href="javascript:void(0);" class="remove" id="link'.$l.'">X</a></span><input type="hidden" id="'.$id.'" name="'.$id.'" value="'.$value['id'].'" />
                                                         </div>
                                                         </div>
                                                         </div>
                                                         </li>';
                                            $l++;
                                        }
                                    }?>
                                </ul>
                            </div>
                            <button class="btn-default addBtn" id="addphone" type="submit" value="Add">Add Phone</button>
                            <button class="btn-default addBtn" id="addemail" type="submit" value="Add">Add Email</button>
                            <button class="btn-default addBtn" id="addlink" type="submit" value="Add">Add Link</button>
                        </div>
                    </div>
                    <div class="section row"></div>
                    <?php
                    if ($contact['member']['membership_type']=="Contact") {
                    echo '<div class="update-licence">
                        <div class="col-md-3 profile_main">Licence Details</div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <span class="input-group-addon profile-label">Licence Number</span>
                                    <input class="form-control" id="custom_fields[drivers_licence_number]" name="custom_fields[drivers_licence_number]"';
                    if (isset($contact['member']['custom_fields']['drivers_licence_number'])) {
                        echo ' value="'.$contact['member']['custom_fields']['drivers_licence_number'].'"';
                    }
                    echo '/><span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <span class="input-group-addon profile-label">Date of Birth</span>
                                    <input class="form-control" type="text" id="dob" name="custom_fields[date_of_birth]"';
                    if (isset($contact['member']['custom_fields']['date_of_birth'])) {
                        echo ' value="'.date("d-m-Y",strtotime($contact['member']['custom_fields']['date_of_birth'])).'"';
                    }
                    echo '/>
                                    <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <span class="input-group-addon profile-label">Date of Test</span>
                                    <input class="form-control" type="text" id="dot" name="custom_fields[date_of_test]"';
                    if (isset($contact['member']['custom_fields']['date_of_test'])) {
                        echo ' value="'.date("d-m-Y",strtotime($contact['member']['custom_fields']['date_of_test'])).'"';
                    }
                    echo '/>
                                    <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <span class="input-group-addon profile-label">N.I. Number</span>
                                    <input class="form-control code-group" type="text" id="custom_fields[national_insurance_number]" name="custom_fields[national_insurance_number]"';
                    if (isset($contact['member']['custom_fields']['national_insurance_number'])) {
                        echo ' value="'.$contact['member']['custom_fields']['national_insurance_number'].'"';
                    }
                    echo '/>
                                    <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div id="dvla" class="input-group">
                                    <span class="input-group-addon profile-label">D.V.L.A. Code</span>
                                    <input class="form-control code-group" type="text" id="custom_fields[dvla_code]" name="custom_fields[dvla_code]"';
                    if (isset($contact['member']['custom_fields']['dvla_code'])) {
                        echo ' value="'.$contact['member']['custom_fields']['dvla_code'].'"';
                    }
                    echo '/>
                                    <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div id="dvla" class="input-group">
                                    <span class="input-group-addon profile-label">Endorsments</span>
                                    <input class="form-control code-group" type="text" id="custom_fields[endorsements]" name="custom_fields[endorsements]"';
                    if (isset($contact['member']['custom_fields']['endorsements'])) {
                        echo ' value="'.$contact['member']['custom_fields']['endorsements'].'"';
                    }
                    echo '/>
                                    <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                </div>
                            </div>
                            
                                </div>
                            </div>
                    <div class="section row"></div>';}?>

                    <div class="update-address">
                        <div class="col-md-3 profile_main">Password</div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <span class="input-group-addon profile-label">Password</span>
                                    <input class="form-control" id="password1" name="password1" placeholder="New Password"/>
                                    <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <span class="input-group-addon profile-label">Password</span>
                                    <input class="form-control" id="password2" name="password2" placeholder="Repeat Password"/>
                                    <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="parent_id" name="parent_id" value="<?php echo $_SESSION['user_id'];?>"/>
                    <input type="hidden" id="store_ids" name="store_ids" value="<?php if(isset($contact['member']['membership']['owned_by'])){echo $contact['member']['membership']['owned_by'];}?>"/>
                </fieldset>
            <fieldset>
                <div class="row">
            <div class="col-md-2 col-md-push-7 col-xs-12">
                <div class="form-group">
                    <button class="btn-default updateBtn value="submit">Update</button>
                </div>
            </div>
                </div>
        </fieldset>

        </form>
    </div>
    </div>
</div>
</div>
<div id="loading"><img src="images/loading2.gif"></div>
<script>

    $(document).ready(function () {
        var dateNow = new Date();
        $('#dob').daterangepicker({
            "autoApply": true,
            "autoUpdateInput": false,
            "singleDatePicker": true,
            "showDropdowns": true,
            startDate: moment(dateNow).subtract(23, 'years'),
            maxDate: moment(dateNow).subtract(23, 'years'),
            locale: {
                cancelLabel: 'Clear',
                format: "DD MMMM YYYY",
                firstDay: 1
            }
        });
        $('#dot').daterangepicker({
            "autoApply": false,
            "autoUpdateInput": false,
            "singleDatePicker": true,
            "showDropdowns": true,
            startDate: moment(dateNow).subtract(2, 'years'),
            maxDate: moment(dateNow).subtract(2, 'years'),
            locale: {
                cancelLabel: 'Clear',
                format: "DD MMMM YYYY",
                firstDay: 1
            }
        });

        $('input[name="custom_fields[date_of_birth]"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD MMMM YYYY'));
        });

        $('input[name="custom_fields[date_of_birth]"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        $('input[name="custom_fields[date_of_test]"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD MMMM YYYY'));
        });

        $('input[name="custom_fields[date_of_test]"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });


        jQuery.validator.addMethod('phoneUK', function(phone_number, element) {
            return this.optional(element) || phone_number.length > 9 &&
                phone_number.match(/^(((\+44)? ?(\(0\))? ?)|(0))( ?[0-9]{3,4}){3}$/);
        }, 'Please specify a valid phone number');

        jQuery.validator.addMethod("postcodeUK", function(value, element) {
            return this.optional(element) || /^[A-Z]{1,2}[0-9]{1,2} ?[0-9][A-Z]{2}$/i.test(value);
        }, "Please specify a valid Postcode");


        $("#update").click(function(e) {
            e.preventDefault();
        });


        $("#profile").validate({

            rules: {
                "emails[0][address]": {
                    required: true,
                    email: true
                },
                "phones[0][number]": {
                    required: true,
                    phoneUK: true,
                    minlength: 10,
                    maxlength: 12
                },
                "links[0][address]": {
                    required: true,
                    url: true,
                    normalizer: function( value ) {
                        var url = value;
                        // Check if it doesn't start with http:// or https:// or ftp://
                        if ( url && url.substr( 0, 7 ) !== "http://" && url.substr( 0, 8 ) !== "https://" && url.substr( 0, 6 ) !== "ftp://" ) {
                            // then prefix with http://
                            url = "http://" + url;
                        }

                        // Return the new url
                        return url;
                    }
                },
                "primary_address[street]": {
                    minlength: 8,
                    maxlength: 100
                },
                "primary_address[city]": {
                    minlength: 2,
                    maxlength: 100
                },
                "primary_address[county]": {
                    minlength: 2,
                    maxlength: 100
                },
                "primary_address[postcode]": {
                    postcodeUK: true
                },
                "custom_fields[drivers_licence_number]" :{
                    minlength: 14,
                    maxlength: 17
                },
                "custom_fields[date_of_birth]" : {
                    date: true
                },
                "custom_fields[date_of_test]" : {
                    date: true
                },
                "custom_fields[national_insurance_number]": {
                    require_from_group: [1, ".code-group"],
                    minlength: 8,
                    maxlength: 11
                },
                "custom_fields[dvla_code]": {
                    require_from_group: [1, ".code-group"],
                    minlength: 8,
                    maxlength: 11
                },
                "password2": {
                    equalTo: "#password1"
                }
            },
            messages: {
                "emails[][address]": {
                    email: "Please input a valid email address"
                },
                "links[][address]": {
                    url: "Please enter a valid URL (include the http:// part)"
                },
                "password2":{
                    equalTo: "Please make sure passwords match"
                }
            },
            errorPlacement: function(error, element) {
                $(element).parents('.form-group').append(error)
            },
            highlight: function(element, errorClass, validClass) {
                $(element).nextAll('.form-control-feedback').show().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                $(element).addClass(errorClass).removeClass(validClass);
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element) {
                $(element).nextAll('.form-control-feedback').show().removeClass('glyphicon-remove').addClass('glyphicon-ok');
                element.closest('.form-group').removeClass('has-error').addClass('has-success');
                $(element).remove();
            },
            onkeyup: false, //turn off auto validate whilst typing
            submitHandler: function (form) {

                var form = $('#profile').serializeJSON();
                var jdata = JSON.stringify(form);

                if (jdata !="{}"){
                    $.ajax({
                        url: 'update.php',
                        method: 'post',
                        dataType: 'json',
                        data: jdata,
                        beforeSend: function(){
                            $("#loading").show();
                        },
                        success: function(data) {
                            $("#loading").hide();
                            alert ("Updated!")
                        }
                    });
                }
            }
        });

        var phoneIndex = <?php echo $p;?>;
        var emailIndex = <?php echo $e;?>;
        var linksIndex = <?php echo $l;?>;
        var numOfPhones = 1;
        var numOfEmails = 1;
        var numOfLinks = 1;

        //Add New link Section

        $('#addlink').click(function (e) {
            e.preventDefault();
            if (numOfLinks < 5) {
                numOfLinks++;
                linksIndex++;
                var number = '<li id="link'+linksIndex+'"><div class="form-group contactSelect">'+
                    '<div class="col-xs-4 typeSelect"><div class="form-group">' +
                    '<select class="form-control" id="links['+linksIndex+'][type_id]" name="links['+linksIndex+'][type_id]"> '+
                    '<option value="5001">Website</option>' +
                    '<option value="5002">Facebook</option>' +
                    '<option value="5003">Twitter</option>' +
                    '<option value="5004">Linkedin</option>' +
                    '<option value="5005">IM</option>'+
                    '</select></div></div><div class="col-xs-8 typeSelect">' +
                    '<div class="for-group has-feedback input-group">' +
                    '<input class="form-control linksNew" type="text" id="links['+linksIndex+'][address]" name="links['+linksIndex+'][address]" maxlength="12" placeholder="Web / Social Media"/>'+
                    '<span class="input-group-addon contact-addon"><a href="javascript:void(0);" class="remove" id="link'+ linksIndex +'"> X </span>' +
                    '</div></div></div></li><div class="clearfix"></div>';

            $('#links').append(number);
                $(".linksNew").each(function(){
                    $(this).rules("add", {
                        required: true,
                        url: true,
                        normalizer: function( value ) {
                            var url = value;
                            // Check if it doesn't start with http:// or https:// or ftp://
                            if ( url && url.substr( 0, 7 ) !== "http://" && url.substr( 0, 8 ) !== "https://" && url.substr( 0, 6 ) !== "ftp://" ) {
                                // then prefix with http://
                                url = "http://" + url;
                            }

                            // Return the new url
                            return url;
                        }
                    })
                });
            }

        });

        // Add New Email section

        $('#addemail').click(function (e) {
            e.preventDefault();
            if (numOfEmails < 2) {
                numOfEmails++;
                emailIndex++;
                var number = '<li id="email'+emailIndex+'"><div class="form-group contactSelect">'+
                    '<div class="col-xs-4 typeSelect"><div class="form-group">' +
                    '<select class="form-control" id="emails['+emailIndex+'][type_id]" name="emails['+emailIndex+'][type_id]"> '+
                    '<option value="4001">Work</option>' +
                    '<option value="4002">Home</option>' +
                    '</select></div></div><div class="col-xs-8 typeSelect">' +
                    '<div class="for-group has-feedback input-group">' +
                    '<input class="form-control emailsNew" type="text" id="emails['+emailIndex+'][address]" name="emails['+emailIndex+'][address]" maxlength="12" placeholder="Email"/>'+
                    '<span class="input-group-addon contact-addon"><a href="javascript:void(0);" class="remove" id="email'+emailIndex+'"> X </span>' +
                    '</div></div></div></li><div class="clearfix"></div>';

            $('ul#emails').append(number);
                $(".emailsNew").each(function(){
                    $(this).rules("add", {
                        email: true,
                        required: true
                    })
                });
            }

        });

        // Add New Phones Section


        $('#addphone').click(function (e) {
            e.preventDefault();

            if (numOfPhones < 5) {
                numOfPhones++;
                phoneIndex++;
                var number = '<li id="phone'+phoneIndex+'"><div class="form-group contactSelect">'+
                    '<div class="col-xs-4 typeSelect"><div class="form-group">' +
                    '<select class="form-control" id="phones['+phoneIndex+'][type_id]" name="phones['+phoneIndex+'][type_id]"> '+
                    '<option value="6001">Work</option>' +
                    '<option value="6002">Mobile</option>' +
                    '<option value="6003">Fax</option>' +
                    '<option value="6004">Skype</option>' +
                    '<option value="6005">Home</option>'+
                    '</select></div></div><div class="col-xs-8 typeSelect">' +
                    '<div class="for-group has-feedback input-group">' +
                    '<input class="form-control phonesNew" type="text" id="phones['+phoneIndex+'][number]" name="phones['+phoneIndex+'][number]" maxlength="12" placeholder="Phone"/>'+
                    '<span class="input-group-addon contact-addon"><a href="javascript:void(0);" class="remove" id="phone'+phoneIndex+'">X</a></span>' +
                    '</div></div></div></li><div class="clearfix"></div>';
                $('ul#phones').append(number);

                $(".phonesNew").each(function(){
                    $(this).rules("add", {
                        required: true,
                        phoneUK: true,
                        minlength: 10,
                        maxlength: 12
                    })
                });
            }
        });
        // Remove Sections

        $(document).on("click", "a.remove" , function() {
            var section = $(this).attr('id');
            var sectionToCut = "li#" + section;
            $(sectionToCut).remove();
            if (section.substring(0,4) == "phon") {
                numOfPhones--;
            }
            if (section.substring(0,4) == "emai") {
                numOfEmails--;
            }
            if (section.substring(0,4) == "link") {
                numOfLinks--;
            }

        });



    });
</script>
<!-- footer -->
<div class="nx_agileits-footer">
    <div class="container">
        <div class="col-md-9 col-sm-12 wthree-footer-left">
            <div class="navbar-header page-scroll">
                <h2><a class="navbar-brand" href="index.php">NX Touring</a></h2>
                <P id="footer-line">Luxury Vehicle Hire</P>
            </div>
            <div class="list-footer">
                <ul class="footer-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden"><a class="page-scroll" href="#page-top"></a>	</li>
                    <li><a class="page-scroll scroll" href="index.php#home">Home</a></li>
                    <li><a class="page-scroll scroll" href="index.php#about">About</a></li>
                    <li><a class="page-scroll scroll" href="index.php#vans">vans</a></li>
                    <li><a class="page-scroll scroll" href="index.php#downloads">Downloads</a></li>
                    <li><a class="page-scroll scroll" href="index.php#testimonials">Testimonials</a></li>
                    <li><a class="page-scroll scroll" href="index.php#contact">Contact</a></li>

                </ul>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 wthree-footer-right">
            <div class="agile-social-icons">
                <ul>
                    <li><a href="#" class="fa fa-instagram" aria-hidden="true"></a></li>
                    <li><a href="#" class="fa fa-facebook" aria-hidden="true"></a></li>
                    <li><a href="#" class="fa fa-twitter" aria-hidden="true"></a></li>
                    <li><a href="#" class="fa fa-share-square" aria-hidden="true"></a></li>
                </ul>
            </div>
            <div class="nx-mail">
                <ul>
                    <li><span class="fa fa-envelope icon" aria-hidden="true"></span><a href="mailto:info@nxtouring.co.uk">info@nxtouring.co.uk</a></li>
                    <li><span class="fa fa-phone" aria-hidden="true"></span><p>07771 767367</p></li>
                </ul>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
</body>
