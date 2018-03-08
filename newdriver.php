<?php

include 'header.php';

?>

<body id="background">

<?php

?>

<div id="newcli-container">
    <div class="container">
        <div class="newcli-form">
            <form id="newDriver" class="profileForm" method="post" enctype="multipart/form-data">
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
                                                    <div class="col-xs-4 typeSelect">
                                                        <div class="form-group">
                                                            <select class="form-control" id="emails[0][type_id]" name="emails[0][type_id]">
                                                                <option value="4001">Work</option>
                                                                <option value="4002">Home</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-8 typeSelect">
                                                        <div class="form-group has-feedback input-group">
                                                            <input class="form-control" type="text" id="emails[0][address]" name="emails[0][address]" placeholder="Email"/>
                                                            <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn-default updateBtn addNewDriver" value="submit">Add Driver</button>
                                </div>
                            </div>

                            <div class="section"></div>
                            <div class="form-group has-feedback update-address">
                                <div class="col-md-3 profile_main">Address</div>
                                <div class

                                     ="col-md-4">
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
                                <div class="col-md-4 left">
                                    <div id="phonesWrapper">
                                        <ul id="phones">
                                            <li id="phone0">
                                                <div class="form-group contactSelect">
                                                    <div class="col-xs-4 typeSelect">
                                                        <div class="form-group">
                                                            <select class="form-control" id="phones[0][type_id]" name="phones[0][type_id]">
                                                                <option value="6001">Work</option>
                                                                <option value="6002">Mobile</option>
                                                                <option value="6003">Fax</option>
                                                                <option value="6004">Skype</option>
                                                                <option value="6005">Home</option>
                                                             </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-8 typeSelect">
                                                        <div class="form-group has-feedback input-group">
                                                            <input class="form-control" type="text" id="phones[0][number]" name="phones[0][number]" maxlength="12" placeholder="Telephone"/>
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
                                                    <div class="col-xs-4 typeSelect">
                                                        <div class="form-group">
                                                            <select class="form-control" id="links[0][type_id]" name="links[0][type_id]">
                                                                 <option value="5001">Website</option>
                                                                 <option value="5002">Facebook</option>
                                                                 <option value="5003">Twitter</option>
                                                                 <option value="5004">Linkedin</option>
                                                                 <option value="5001">IM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-8 typeSelect">
                                                        <div class="form-group has-feedback input-group">
                                                            <input class="form-control" type="text" id="links[0][address]" name="links[0][address]" placeholder="Weblink / Social Media"/>
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
                                </div>
                                    <div class="section row"></div>
                                    <div class="form-group has-feedback upload-details">
                                        <div class="col-md-3 profile_main">Images</div>
                                        <div class="col-md-4" id="preview1"><!--<img src="images/avatar.png">
                                    <input type="hidden" id="icon" name="icon"/>
                                    <a href="#" type="submit" class="btn uploadBtn" id="uploadBtn" data-target="#uploadModal" role="button" data-toggle="modal">Upload Image</a>-->
                                            <p>Choose an Profile image to upload</p>
                                            <input class="btn-default browseBtn" id="profileUp" type="file" accept="image/*" name="profile" />
                                            <p>Driving Licence Front Scan</p>
                                            <input class="btn-default browseBtn" id="frontUp" type="file" accept="image/*" name="front" />
                                            <p>Driving Licence Rear Scan</p>
                                            <input class="btn-default browseBtn" id="rearUp" type="file" accept="image/*" name="rear" />
                                        </div>
                                    </div>

                                    <input type="hidden" id="parent_id" name="parent_id" value="<?php echo $_SESSION['user_id'];?>"/>
                                    <input type="hidden" id="store_ids" name="store_ids" value="<?php echo $contact['member']['membership']['owned_by'];?>"/>
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
            "autoUpdateInput": true,
            "singleDatePicker": true,
            "showDropdowns": true,
            locale: {
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

var driverForm = $('form#newDriver');

        driverForm.submit(function (e) {
            e.preventDefault();
            formData = new FormData(this);

        });


        driverForm.validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                "profileUP": {
                    accept: "jpg|jpe?g|gif",
                    filesize: 1048576
                },
                "emails[0][address]": {
                    required: true,
                    email: true
                    /*remote: {
                        url: "check-email.php",
                        type: "post",
                        data: {
                            name: function () {
                                return $("#name").val();
                            }
                        }
                    }*/
                },
                "phones[0][number]": {
                    phoneUK: true,
                    minlength: 10,
                    maxlength: 12
                },
                "links[0][address]": {
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

                    minlength: 3,
                    maxlength: 100
                },
                "primary_address[city]": {
                    minlength: 3,
                    maxlength: 100

                },
                "primary_address[county]": {
                    minlength: 3,
                },

                "primary_address[postcode]": {
                    postcodeUK: true
                },
                "custom_fields[national_insurance_number]": {
                    //require_from_group: [1, ".code-group"]
                },
                "custom_fields[dvla_code]": {
                    //require_from_group: [1, ".code-group"]
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
                "emails[0][address]": {
                    required: "Please input your email address",
                    email: "Please input a valid email address"
                },
                "links[0][address]": {
                    url: "Please enter a valid URL (include the http:// part)"
                },
                "profileUp": "File must be JPG, GIF or PNG, less than 1MB"
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

                if (formData !== "{}") {
                    $.ajax({
                        url: 'newdriver-process.php',
                        type: 'POST',
                        //dataType: 'json',
                        data: formData,
                        success: function (data) {
                            alert(data)
                            window.history.go(-1)
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                }
            }
        })
    })

</script>