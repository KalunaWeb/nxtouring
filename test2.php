<?php

include 'header.php';

?>

<body id="background">

<?php

?>
<style>

    /*span.input-group-addon.profile-label{
        border-top: 1px solid #eee
    }*/
    input.form-control {
        border: none
    }
    .full {
        padding: 0;
    }
    .input-group-addon {
        background-color: #fff;
        border: none;
        min-width:100px;
    }
    .col-md-3, .col-md-4, .col-md-2 {
        padding: 0;
    }
    .container {
        padding-right: 15px;
        padding-left: 15px;
    }
    .has-feedback .form-control{
        padding-right: 0;
    }
    .form-control {
        border: none;
        -webkit-appearance: none;
        box-shadow: none !important;
    }
    select, .contactSelect select{
        background-color: #fff;


        background-image:
            linear-gradient(45deg, transparent 50%, gray 50%),
            linear-gradient(135deg, gray 50%, transparent 50%);
        background-position:
            calc(100% - 20px) calc(1em + 2px),
            calc(100% - 15px) calc(1em + 2px),
            calc(100% - 2.5em) 0.5em;
        background-size:
            5px 5px,
            5px 5px,
            1px 1.5em;
        background-repeat: no-repeat;
    }

    select.contactSelect:focus {
        background-image:
            linear-gradient(45deg, green 50%, transparent 50%),
            linear-gradient(135deg, transparent 50%, green 50%),
            linear-gradient(to right, #ccc, #ccc);
        background-position:
            calc(100% - 15px) 1em,
            calc(100% - 20px) 1em,
            calc(100% - 2.5em) 0.5em;
        background-size:
            5px 5px,
            5px 5px,
            1px 1.5em;
        background-repeat: no-repeat;
        border-color: green;
        outline: 0;
    }
    .updateBtn {
        margin-top: 20px;
        width: 100%;
    }

    .addBtn {
        width: 33%
    }
    .address_label, .address_detail, .drive {
        background-color: #fff;
    }

    .profile_main {
        margin-top:15px;
        margin-bottom: 10px;
    }


</style>
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
                    <div class="col-md-12 full">
                        <fieldset class="form-group">
                            <legend class="mobile-hidden">Please supply a minimum of a name and email address.<br>
                                A login will be created and sent to your driver for them to complete their details.<br>
                                All details will be required before a driver can be approved.
                            </legend>

                            <div class="section"></div>
                            <div class="form-group has-feedback name-details">
                                <div class="col-md-3 profile_main mobile-hidden">Name</div>
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
                                                    <div class="col-xs-3 typeSelect">
                                                        <div class="form-group">
                                                            <select class="form-control" id="emails[0][type_id]" name="emails[0][type_id]">
                                                                <option value="4001">Work</option>
                                                                <option value="4002">Home</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-9 typeSelect">
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

                                    <div class="form-group mobile-hidden">
                                        <button class="btn-default updateBtn addNewDriver" value="submit">Add Driver</button>
                                    </div>

                            </div>

                            <div class="section"></div>
                            <div class="form-group has-feedback update-address">
                                <div class="col-md-3 profile_main mobile-hidden">Address</div>
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
                                <div class="col-md-3 profile_main mobile-hidden">Contact Details</div>
                                <div class="col-md-4 left">
                                    <div id="phonesWrapper">
                                        <ul id="phones">
                                            <li id="phone0">
                                                <div class="form-group contactSelect">
                                                    <div class="col-xs-4 typeSelect">
                                                        <div class="form-group">
                                                            <select class="form-control" id="'phones[0][type_id]" name="phones[0][type_id]">
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
                                <div class="col-md-3 profile_main mobile-hidden">Licence Details</div>
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
                <!--<div class="section"></div>-->
                <fieldset>
                    <div class="col-md-3 profile_main"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-2 col-xs-12">
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