<?php

include 'header.php';

?>

<body id="background">

<?php

?>
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
            <form id="newDriver" class="profileForm">
                <div class="row">
                    <div class="modal-header">
                        <h1 class="modal-title">
                            New Driver Form
                        </h1>
                    </div>
                    <div class="col-md-12">
                        <fieldset class="form-group">
                            <legend>Please supply a minimum of a name and email address.<br>
                                A login will be created and sent to your driver for them to complete their details.<br>
                                All details will be required before a driver can be approved.
                            </legend>
                            <div class="form-group has-feedback upload-details">
                                <div class="col-md-3 profile_main">Images</div>
                                <div class="col-md-4" id="preview">'<img src="images/avatar.png">
                                    <input type="hidden" id="icon" name="icon"/>
                                    <a href="#" type="submit" class="btn uploadBtn" id="uploadBtn" data-target="#uploadModal" role="button" data-toggle="modal">Upload Image</a>
                                </div>
                            </div>
                            <div class="section"></div>
                            <div class="form-group has-feedback name-details">
                                <div class="col-md-3 profile_main">Name</div>
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <div class="input-group">
                                            <span class="input-group-addon profile-label">Name</span>
                                            <input class="form-control" type="text" id="name" name="name"/>
                                            <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                        </div>
                                    </div>
                                    <div id="emailsWrapper">
                                        <ul id="emails">
                                            <li id="email0">
                                                <div class="form-group contactSelect">
                                                    <div class="col-md-4 typeSelect">
                                                        <div class="form-group">
                                                            <select class="form-control" id="emails[][type_id]" name="emails[][type_id]">
                                                                <option value="4001">Work</option>
                                                                <option value="4002">Home</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 typeSelect">
                                                        <div class="form-group has-feedback input-group">
                                                            <input class="form-control" type="text" id="emails[][address]" name="emails[][address]" placeholder="Email"/>
                                                            <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button class="btn-default updateBtn addNewDriver" value="submit">Add Driver</button>
                                    </div>
                                </div>
                            </div>

                            <div class="section"></div>
                            <div class="form-group has-feedback update-address">
                                <div class="col-md-3 profile_main">Address</div>
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <div class="input-group">
                                            <span class="input-group-addon profile-label">Street</span>
                                        <input class="form-control" id="primary_address[street]" name="primary_address[street]"/>
                                            <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <div class="input-group">
                                            <span class="input-group-addon profile-label">Town</span>
                                            <input class="form-control" type="text" id="primary_address[city]" name="primary_address[city]"/>
                                            <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <div class="input-group">
                                            <span class="input-group-addon profile-label">County</span>
                                            <input class="form-control" type="text" id="primary_address[county]" name="primary_address[county]"/>
                                            <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <div class="input-group">
                                            <span class="input-group-addon profile-label">Postcode</span>
                                            <input class="form-control" type="text" id="primary_address[postcode]" name="primary_address[postcode]"/>
                                            <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="section row"></div>
                            <div class="form-group has-feedback">
                                <div class="col-md-3 profile_main">Contact Details</div>
                                <div class="col-md-4">
                                    <div id="phonesWrapper">
                                        <ul id="phones">
                                            <li id="phone0">
                                                <div class="form-group contactSelect">
                                                    <div class="col-xs-4 typeSelect">
                                                        <div class="form-group">
                                                            <select class="form-control" id="'phones[][type_id]" name="phones[][type_id]">
                                                                <option value="6001">Work</option>
                                                                <option value="6002 selected">Mobile</option>
                                                                <option value="6003">Fax</option>
                                                                <option value="6004">Skype</option>
                                                                <option value="6005">Home</option>
                                                             </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-8 typeSelect">
                                                        <div class="form-group has-feedback input-group">
                                                            <input class="form-control" type="text" id="phones[][number]" name="phones[][number]" maxlength="12" placeholder="Telephone"/>
                                                            <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div id="linksWrapper">
                                        <ul id="links">
                                            <li id="link0">
                                                <div class="form-group contactSelect">
                                                    <div class="col-md-4 typeSelect">
                                                        <div class="form-group">
                                                            <select class="form-control" id="links[][type_id]" name="links[][type_id]">
                                                                 <option value="5001">Website</option>
                                                                 <option value="5002" selected>Facebook</option>
                                                                 <option value="5003">Twitter</option>
                                                                 <option value="5004">Linkedin</option>
                                                                 <option value="5001">IM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 typeSelect">
                                                        <div class="form-group has-feedback input-group">
                                                            <input class="form-control" type="text" id="links[][address]" name="links[][address]" placeholder="Weblink / Social Media"/>
                                                            <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="section row"></div>
                            <div class="form-group has-feedback update-address">
                                <div class="col-md-3 profile_main">Licence Details</div>
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <div class="input-group">
                                            <span class="input-group-addon profile-label">Licence Number</span>
                                        <input class="form-control" id="custom_fields[drivers_licence_number]" name="custom_fields[drivers_licence_number]"/>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <div class="input-group">
                                            <span class="input-group-addon profile-label">Date of Birth</span>
                                            <input class="form-control" type="text" id="dob" name="custom_fields[date_of_birth]"/>
                                            <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <div class="input-group">
                                            <span class="input-group-addon profile-label">Date of Test</span>
                                            <input class="form-control" type="text" id="dot" name="custom_fields[date_of_test]"/>
                                            <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <div class="input-group">
                                            <span class="input-group-addon profile-label">N.I. Number</span>
                                            <input class="form-control code-group" type="text" id="custom_fields[national_insurance_number]" name="custom_fields[national_insurance_number]"/>
                                            <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                        </div>
                                    </div>
                                    <span>OR</span>
                                    <div class="form-group has-feedback">
                                        <div id="dvla" class="input-group">
                                            <span class="input-group-addon profile-label">D.V.L.A. Code</span>
                                            <input class="form-control code-group" type="text" id="custom_fields[dvla_code]" name="custom_fields[dvla_code]"/>
                                            <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                        </div>
                                        <span>The DVLA code can be obtained from <a target="_blank" href="https://www.gov.uk/view-driving-licence#before-you-start">here</a>.</span>
                                    </div>
                                    <input type="hidden" id="parent_id" name="parent_id" value="<?php echo $_SESSION['user_id'];?>">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="section"></div>
                <fieldset>
                    <div class="col-md-3 profile_main"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <button class="btn-default updateBtn addNewDriver" value="submit">Add Driver</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<div id="error"></div>

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

<script>

    jQuery.validator.addMethod('phoneUK', function(phone_number, element) {
        return this.optional(element) || phone_number.length > 9 &&
            phone_number.match(/^(((\+44)? ?(\(0\))? ?)|(0))( ?[0-9]{3,4}){3}$/);
    }, 'Please specify a valid phone number');

    jQuery.validator.addMethod("postcodeUK", function(value, element) {
        return this.optional(element) || /^[A-Z]{1,2}[0-9]{1,2} ?[0-9][A-Z]{2}$/i.test(value);
    }, "Please specify a valid Postcode");


    $(document).ready(function () {

        $('#dob').daterangepicker({
            "autoApply": true,
            "autoUpdateInput": false,
            "singleDatePicker": true,
            "showDropdowns": true,
            locale: {
                cancelLabel: 'Clear',
                format: "DD MMMM YYYY",
                firstDay: 1
            }
        });
        $('#dot').daterangepicker({
            "autoApply": false,
            "autoUpdateInput": true,
            "singleDatePicker": true,
            "showDropdowns": true,
            locale: {
                format: "DD MMMM YYYY",
                firstDay: 1
            }
        });




        $("#newDriver").submit(function(e){
            e.preventDefault();
        });

            $('#newDriver').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3,
                        remote: {
                            url: "test-val.php",
                            type: "post"
                        }
                    },
                    "emails[][address]": {
                        required: true,
                        email: true,
                        remote: {
                            url: "check-email.php",
                            type: "post",
                            data: {
                                name: function() {
                                    return $( "#name" ).val();
                                }
                            }
                        }
                    },
                    "phones[][number]": {
                        phoneUK: true,
                        minlength: 10,
                        maxlength: 12
                    },
                    "links[][address]": {
                        url: true,
                        normalizer: function (value) {
                            var url = value;

                            // Check if it doesn't start with http:// or https:// or ftp://
                            if (url && url.substr(0, 7) !== "http://"
                                && url.substr(0, 8) !== "https://"
                                && url.substr(0, 6) !== "ftp://") {
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
                        minlength: 8,
                        maxlength: 100

                    },
                    "primary_address[county]": {
                        minlength: 3,
                    },

                    "primary_address[postcode]": {
                        postcodeUK: true
                    },
                    "custom_fields[national_insurance_number]": {
                        require_from_group: [1, ".code-group"]
                    },
                    "custom_fields[dvla_code]": {
                        require_from_group: [1, ".code-group"]
                    }

                },
                messages: {

                    website: {
                        url: "Please enter a valid URL (include the http:// part)"

                    },
                    name: {
                        required: "Please enter your drivers name",
                        minlength: "Please enter at least 3 characters"
                    },
                    "emails[][address]": {
                        required: "Please input your email address",
                        email: "Please input a valid email address"
                    },
                    "links[][address]": {
                        url: "Please enter a valid URL (include the http:// part)"
                    }
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).nextAll('.form-control-feedback').show().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                    $(element).addClass(errorClass).removeClass(validClass);
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                success: function (element) {
                    $(element).nextAll('.form-control-feedback').show().removeClass('glyphicon-remove').addClass('glyphicon-ok');
                    element.closest('.form-group').removeClass('has-error').addClass('has-success');
                    $(element).remove();
                },
                onkeyup: false, //turn off auto validate whilst typing
                submitHandler: function (form) {

                    var formdata = $('#newDriver').serializeJSON();
                    var jdata = JSON.stringify(formdata);
                    console.log(jdata);
                    if (jdata != "{}") {
                        $.ajax({
                            url: 'newdriver-process.php',
                            method: 'post',
                            dataType: 'json',
                            data: jdata,
                            beforeSend: function () {
                                $("#loading").show();
                            },
                            success: function (response) {
                                if (response == 'ok') {
                                    alert("Thank you for your business, You will receive a confirmation email shortly");
                                    window.location.href = "index.php";
                                } else {
                                    alert("There was an error, please try later or contact our office");
                                }

                            }
                        });
                    }
                }
            });
        })
</script>