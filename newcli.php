<?php

require_once("classlib.php");

if(isset($_SESSION['user_id'])) {

   $current = new current();

   $contact = $current -> getContactById($_SESSION['user_id']);

   $user = $contact['member']['name'];

}

require_once 'header.php';


if (isset($_POST['startDate'])){
    $start = DateTime::createFromFormat('Y-m-d H:i', $_POST['startDate']);
    $newStart = $start->format('d-m-Y g:i A');
}
if (isset($_POST['endDate'])) {
    $end = DateTime::createFromFormat('Y-m-d H:i', $_POST['endDate']);
    $newEnd = $end->format('d-m-Y g:i A');
}

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
        min-width: 0;
    }
    .profile-label {
        min-width: 80px;
    }
    .col-md-3, .col-md-4, .col-md-2, .col-xs-4, .col-xs-2, .col-md-12 {
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
    form.register input[type=text]{
        border: none;
        height: 34px;
        font-size: 1em;
        padding-left: 5px;
}
    button#newCliFormBtn.button {
        width:100%;
        background-image: linear-gradient(#ffffff, #fafbfb 50px);
        background-color: #fafafa;
        border-color: #ccc;
        border-radius: 3px;
        border-style: solid;
        border-width: 1px;
        box-shadow: rgba(255, 255, 255, 0.3) 0 0 0 1px inset;
        box-sizing: border-box;
        cursor: pointer;
        font-size: 12px;
        padding: 10px 12px;
        text-align: center;
        -webkit-transition: opacity .2s ease-out;
        transition: opacity .2s ease-out;
        white-space: nowrap;
        -moz-user-select: -moz-none;
        -ms-user-select: none;
        -webkit-user-select: none;
        user-select: none;
        background: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #ffffff), color-stop(100%, #e6eaec));
        background: -webkit-linear-gradient(#ffffff, #e6eaec);
        background: linear-gradient(#ffffff, #e6eaec);
        margin: auto;
    }

</style>
<div id="newcli-container">
    <div class="container">
        <div class="newcli-form">
        <form id="newCliForm" class="register">
            <div class="row">
                <div class="modal-header">
                     <h1 class="modal-title">Vehicle Hire Form</h1>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4">
                        <fieldset class="form-group">
                            <legend>Company Details
                            </legend>
                            <div class="form-group has-feedback details">
                                <label class="booking_form_main" for="artist">Artist / Job Name *</label>
                                <input class="form-control" type="text" id="artist" name="artist"/>
                                <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                            </div>
                            <div class="form-group has-feedback details">
                                <label for="name" class="booking_form_main">Company Name *</label>
                                <input class="form-control" type="text" id="name" name="name"
                                    <?php if (isset($_SESSION['user_id'])){
                                        echo 'value="'.$contact['member']['name'].'" readonly="readonly"';}?>/>
                                <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                            </div>
                            <div class="form-group has-feedback details">
                                <label class="booking_form_main" for="emails[][address]">Email *</label>
                                <input class="form-control" type="text" id="emails[][address]" name="emails[][address]"
                                    <?php if (isset($_SESSION['user_id']) && isset($contact['member']['emails'][0]['address'])){
                                        echo 'value="'.$contact['member']['emails'][0]['address'].'" readonly="readonly"';}?>/>
                                <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                            </div>
                            <div class="form-group has-feedback details">
                                <label class="booking_form_main" for="phones[][number]">Telephone *</label>
                                <input class="form-control" type="text" id="phones[][number]" name="phones[][number]" maxlength="11"
                                    <?php if (isset($_SESSION['user_id']) && isset($contact['member']['phones'][0]['number'])){
                                        echo 'value="'.$contact['member']['phones'][0]['number'].'" readonly="readonly"';}?>/>
                                <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                            </div>
                            <div class="form-group has-feedback details">
                                <label class="booking_form_main" for="links[][address]">Website *</label>
                                <input class="form-control" type="text" id="links[][address]" name="links[][address]"
                                    <?php if (isset($_SESSION['user_id']) && isset($contact['member']['links'][0]['address'])){
                                        echo 'value="http://'.$contact['member']['links'][0]['address'].'" readonly="readonly"';}?>/>
                                <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <fieldset class="form-group">
                            <legend>Company Address</legend>

                            <div class="form-group has-feedback details">
                                <label class="booking_form_main" for="line1">Address *</label>
                                <input class="form-control" id="line1" name="line1"
                                    <?php
                                    if (isset($_SESSION['user_id'])){
                                        echo ' readonly="readonly"';
                                    }
                                    if (isset($_SESSION['user_id'])){
                                        echo ' value="'.$contact['member']['primary_address']['street'].'"';
                                    }
                                    ?>
                                </>
                                <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                            </div>
                            <div class="form-group has-feedback details">
                                <label class="booking_form_main" for="town">City *</label>
                                <input class="form-control" type="text" id="town" name="town"
                                    <?php if (isset($_SESSION['user_id'])){
                                        echo 'value="'.$contact['member']['primary_address']['city'].'" readonly="readonly"';}?>/>
                                <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                            </div>
                            <div class="form-group has-feedback details">
                                <label class="booking_form_main" for="county">County *</label>
                                <input class="form-control" type="text" id="county" name="county"
                                    <?php if (isset($_SESSION['user_id'])){
                                        echo 'value="'.$contact['member']['primary_address']['county'].'" readonly="readonly"';}?>/>
                                <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                            </div>
                            <div class="form-group has-feedback details">
                                <label class="booking_form_main" for="postcode">PostCode *</label>
                                <input class="form-control" type="text" id="postcode" name="postcode"
                                    <?php if (isset($_SESSION['user_id'])){
                                        echo 'value="'.$contact['member']['primary_address']['postcode'].'" readonly="readonly"';}?>/>
                                <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                            </div>
                            <?php if (!isset($_SESSION['user_id'])) {
                                echo '<div id="postcode_lookup" class="form-group"></div>';
                            }?>

                            <!--<div class="clearfix"></div>-->
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <fieldset class=" form-group">
                            <legend>Hire Details</legend>
                            <div class="form-group details">
                                <label class="booking_form_main control-label" for="prod_type">Vehicle Type</label>
                                <input type="text" class="form-control" id="prod_type" name="prod_type" value="<?php echo $_POST["prod_type"];?>" readonly="readonly">
                            </div>
                            <div class="form-group details">
                                <label class="booking_form_main control-label" for="startDate">Collection Date</label>
                                <input type="text" class="form-control" id="startDate" name="startDate" value="<?php echo $newStart;?>" readonly="readonly">
                            </div>
                            <div class="form-group details">
                                <label class="booking_form_main control-label" for="endDate">Return Date</label>
                                <input type="text" class="form-control" id="endDate" name="endDate" value="<?php echo $newEnd;?>" readonly="readonly">
                            </div>
                            <div class="form-group details">
                                <label class="booking_form_main control-label" for="hireprice">Hire Price</label>
                                <input type="text" class="form-control" id="hireprice" name="hireprice" value="<?php echo $_POST["hirefee"].'.00'?>" readonly="readonly">
                            </div>
                            <div class="form-group details">
                                <label class="booking_form_main control-label" for="options">Deposit Scheme</label>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-secondary active">
                                        <input type="radio" name="options" id="option1" autocomplete="off" value="40" checked> £10 per day
                                    </label>
                                    <label class="btn btn-secondary">
                                        <input type="radio" name="options" id="option2" autocomplete="off" value="41"> £600 Refundable
                                    </label>
                                </div>
                            </div>

                            <div class="form-group details">
                                <label class="booking_form_main control-label" for="totprice">Total Price</label>
                                <input type="text" class="form-control" id="totprice" name="totprice" value="<?php echo ($_POST["hirefee"]+($_POST["cdays"]*10)).'.00 + vat'?>" readonly="readonly">
                            </div>
                        </fieldset>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <fieldset class="">
                            <legend>Misc.
                            </legend>
                        <div class="form-group details drivers">
                            <label class="booking_form_main" for="drivers">Number of Drivers</label>
                            <select class="form-control" id="drivers" name="drivers">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                            </select>
                        </div>
                            <div class="misc">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="collection" name="collection" checked/>Customer Collecting
                                </label>
                            </div>
                            <div class="misc">
                                <label class="checkbox-inline">
                                    <input class="checkbox" type="checkbox" id="delivery" name="delivery" checked/>Customer Returning
                                </label>

                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <fieldset class="row4">
                            <legend>Terms and Mailing
                            </legend>
                            <div class="agreement">
                                <label class="checkbox-inline">
                                    <input class="checkbox" type="checkbox" id="terms" name="terms"/>
                                    I accept the <a href="#">Terms and Conditions</a>  *
                                </label>
                                <span class="feedback2 form-control-feedback glyphicon glyphicon-ok"></span>
                            </div>
                            <div class="agreement">
                                <label class="checkbox-inline">
                                    <input class="checkbox" type="checkbox" id="news" name="news"/>
                                    I want to receive collection and offers from NX Touring
                                </label>

                            </div>
                            <input type="hidden" name="type_id" id="type_id" value="<?php echo $_POST['type_id'];?>"/>
                            <input type="hidden" name="days" id="days" value="<?php echo $_POST['days'];?>"/>
                            <input type="hidden" name="store_ids" id="store_ids" value="<?php echo $_POST['store'];?>"/>
                            <input type="hidden" name="primary_address[country_id]" id="primary_address[country_id]" value="1"/>
                            <input type="hidden" name="price" id="price" value="<?php echo $_POST['price'];?>"/>
                            <input type="hidden" name="line2" id="line2"/>
                            <input type="hidden" name="line3" id="line3"/>
                            <input type="hidden" name="child_member" id="child_member"/>
                            <input type="hidden" name="child_name" id="child_name"/>
                        </fieldset>
                    </div>
                    <div class="col-md-4">

                        <div>
                            <label class="obinfo">* obligatory fields
                            </label>
                        </div>
                        <div><button id="newCliFormBtn" class="button">Book Now &raquo;</button></div>
                    </div>
                </div>
            </div>
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

        $('#postcode_lookup').getAddress({
            api_key: 'yn2CSzTYFUmrb5KshUq0EA12157',
            output_fields: {
                line_1: '#line1',
                line_2: '#line2',
                line_3: '#line3',
                post_town: '#town',
                county: '#county',
                postcode: '#postcode'
            },
            onLookupSuccess: function(){
                $('#getaddress_dropdown').addClass("selectpicker").addClass("form-control");
                if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
                    $('.selectpicker').selectpicker('mobile');
                }

            },
            onAddressSelected: function () {
                $('#getaddress_dropdown').hide();
            }

    });

        $("#newCliForm").submit(function(e){
            e.preventDefault();
        });

        $('input:radio[name=options]').change(function() {
            if (this.value == 40) {
                var total = parseInt('<?php echo $_POST["hirefee"]?>') + (parseInt('<?php echo $_POST["cdays"]?>')*10);
                total = total + ".00 + vat";
                $("#totprice").val(total);
            }
            if (this.value == 41) {
                var total = parseInt('<?php echo $_POST["hirefee"]?>') + 600;
                total = total + ".00 + vat";
                $("#totprice").val(total);
            }
        });

        $("#newCliForm").validate({
            rules: {
                artist: {
                    required: true,
                    minlength: 2,
                    maxlength: 40
                },
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
                      url: "test-email-val.php",
                        type: "post",
                        dataFilter: function(data) {
                            var json = JSON.parse(data);
                            console.log(json.code);
                            if(json.status === "success") {
                                return '"true"';
                            }
                            if(json.code != null) {
                                $('#child_member').val(json.code);
                                $('#child_name').val(json.name);
                                return '"true"';
                            }
                            if(json.error != null) {
                                return "\"" + json.error + "\"";
                            }
                        }
                    }
                },
                "phones[][number]": {
                    required: true,
                    phoneUK: true,
                    minlength: 10,
                    maxlength: 12
                },
                "links[][address]": {
                    required: true,
                    url: true,
                    normalizer: function( value ) {
                        var url = value;

                        // Check if it doesn't start with http:// or https:// or ftp://
                        if ( url && url.substr( 0, 7 ) !== "http://"
                            && url.substr( 0, 8 ) !== "https://"
                            && url.substr( 0, 6 ) !== "ftp://" ) {
                            // then prefix with http://
                            url = "http://" + url;
                        }

                        // Return the new url
                        return url;
                    }
                },
                "line1": {
                    required: true,
                    minlength: 8,
                    maxlength: 100
                },
                "town": {
                    required: true

                },
                "county": {
                    required: true
                },
                "postcode": {
                    required: true,
                    postcodeUK: true
                },
                terms: {
                    required: true
                }
            },
            messages: {
                artist: {
                    required: "Please enter a the Artists Name",
                    minlength: "Artist Name must be at least {0} characters long"
                },

                website: {
                    url: "Please enter a valid URL (include the http:// part)"

                },
                name: {
                    required: "Please enter your name / company name",
                    minlength: "Please enter at least 3 characters"
                },
                "emails[][address]": {
                    required: "Please input your email address",
                    email: "Please input a valid email address"
                },
                "links[][address]": {
                    url: "Please enter a valid URL (include the http:// part)"
                },
                "line1": {
                    required: "Please enter your address"
                },
                "town": {
                    required: "Please enter your city"
                },
                "county": {
                    required: "Please enter your county"
                },
                "postcode": {
                    required: "Please enter your postcode"
                },
                terms:{
                    required: "Please read and agree to our terms and conditions"
                }
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

                var formdata = $('#newCliForm').serializeJSON();
                var jdata = JSON.stringify(formdata);

                $.ajax({
                    url: 'booking.php',
                    method: 'post',
                    dataType: 'json',
                    data: jdata,
                    beforeSend: function(){
                        $("#loading").show();
                    },
                    success: function(response) {
                        if (response == 'ok') {
                            alert ("Thank you for your business, You will receive a confirmation email shortly");
                            window.location.href = "index.php";
                        } else {
                            alert ("There was an error, please try later or contact our office");
                        }

                    }
                });
            }
        });
    });

</script>
