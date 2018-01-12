<?php

require_once 'header.php';

?>

<div id="newcli-container">
    <div class="container">
        <div class="newcli-form">
        <form id="clientForm" class="register">
            <div class="row">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h1 class="modal-title">New Client Booking Form</h1>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4">
                        <fieldset class="form-group">
                            <legend>Company Details
                            </legend>
                            <div class="form-group has-feedback details">
                                <label for="name" class="booking_form_main">Name *</label>
                                <input class="form-control" type="text" id="name" name="name"/>
                                <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                            </div>
                            <div class="form-group has-feedback details">
                                <label class="booking_form_main" for="emails[][address]">Email *</label>
                                <input class="form-control" type="text" id="emails[][address]" name="emails[][address]"/>
                                <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                            </div>
                            <div class="form-group has-feedback details">
                                <label class="booking_form_main" for="phones[][number]">Telephone *</label>
                                <input class="form-control" type="text" id="phones[][number]" name="phones[][number]" maxlength="11"/>
                                <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                            </div>
                            <div class="form-group has-feedback details">
                                <label class="booking_form_main" for="links[][address]">Website *</label>
                                <input class="form-control" type="text" id="links[][address]" name="links[][address]" value="http://"/>
                                <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <fieldset class="form-group">
                            <legend>Company Address</legend>
                            <div class="form-group has-feedback details">
                                <label class="booking_form_main" for="primary_address[street]">Address *</label>
                                <textarea rows="" class="form-control" id="primary_address[street]" name="primary_address[street]"></textarea>
                                <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                            </div>
                            <div class="form-group has-feedback details">
                                <label class="booking_form_main" for="primary_address[city]">City *</label>
                                <input class="form-control" type="text" id="primary_address[city]" name="primary_address[city]"/>
                                <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                            </div>
                            <div class="form-group has-feedback details">
                                <label class="booking_form_main" for="primary_address[county]">County *</label>
                                <input class="form-control" type="text" id="primary_address[county]" name="primary_address[county]"/>
                                <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                            </div>
                            <div class="form-group has-feedback details">
                                <label class="booking_form_main" for="primary_address[postcode]">PostCode *</label>
                                <input class="form-control" type="text" id="primary_address[postcode]" name="primary_address[postcode]"/>
                                <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-4">
                        <fieldset class=" form-group">
                            <legend>Hire Details</legend>
                            <div class="form-group details">
                                <label class="booking_form_main control-label" for="type_id">Vehicle Type</label>
                                <input type="text" class="form-control" id="type_id" name="" value="" readonly="readonly">
                            </div>
                            <div class="form-group details">
                                <label class="booking_form_main control-label" for="startDate">Collection Date</label>
                                <input type="text" class="form-control" id="startDate" name="startDate" value="" readonly="readonly">
                            </div>
                            <div class="form-group details">
                                <label class="booking_form_main control-label" for="endDate">Return Date</label>
                                <input type="text" class="form-control" id="endDate" name="endDate" value="" readonly="readonly">
                            </div>
                        </fieldset>

                        <div class="infobox"><p>Hire Commences at 9am on the date of collection and finishes at 10am on the day of return.</p></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <fieldset class="row4">
                            <legend>Terms and Mailing
                            </legend>
                            <div class="agreement">
                                <label for="terms">*  I accept the <a href="#">Terms and Conditions</a></label>
                                <input class="checkbox" type="checkbox" id="terms" name="terms"/>
                                <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                            </div>
                            <div class="agreement">
                                <label for="agree">I want to receive news and offers from NX Touring</label>
                                <input class="checkbox" type="checkbox" id="agree" name="agree"/>

                            </div>
                            <div>
                                <label class="obinfo">* obligatory fields
                                </label>
                            </div>
                        </fieldset>
                    </div>
                    <div><button class="button">Book Now &raquo;</button></div>
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
                    <li><a class="page-scroll scroll" href="#home">Home</a></li>
                    <li><a class="page-scroll scroll" href="#about">About</a></li>
                    <li><a class="page-scroll scroll" href="#vans">vans</a></li>
                    <li><a class="page-scroll scroll" href="#downloads">Downloads</a></li>
                    <li><a class="page-scroll scroll" href="#testimonials">Testimonials</a></li>				<li><a class="page-scroll scroll" href="#contact">Contact</a></li>

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
    $("#searchForm").submit(function(e){
          e.preventDefault(e);
            });

    $("#searchForm").validate({
        rules: {
            artist: {
                required: true,
                minlength: 2,
                maxlength: 40
            },

            website: {
            	required: false,
            	url: true

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
                email: true
                //remote: {
                  //  url: "test-val.php",
                    //type: "post",
                  //}
            },
            "phones[][number]": {
            	required: true,
            	phoneUK: true,
            	minlength: 10,
              maxlength: 12
            },
            "links[][address]": {
            	required: true,
            	url: true
            },
            "primary_address[street]": {
            	required: true,
            	minlength: 8,
            	maxlength: 100
            },
            "primary_address[city]": {
            	required: true

            },
            "primary_address[postcode]": {
            	required: true,
              postcodeUK: true
            }
        },
        messages: {
            artist: {
                required: "Please enter a the Artists Name",
                minlength: "Password must be at least {0} characters long"
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
            "primary_address[street]": {
            	required: "Please enter your address"
            },
            "primary_address[city]": {
            	required: "Please enter your city"
            },
            "primary_address[postcode]": {
            	required: "Please enter your postcode"
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

			 	var formdata = $('#searchForm').serializeJSON();
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

