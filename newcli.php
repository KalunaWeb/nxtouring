<?php

require_once 'header.php';

?>

<div id="loading">
  <button class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button>
</div>

<div id="enquiry-form-top">
<form class="form" id="searchForm">
<div class="col-md-3">
        <div id = "searchBox3">
          <h2>Artist Details</h2>


          <div class="form-group has-feedback">
            <label for="artist" class="control-label">Artist Name</label>
            <input type="text" class="form-control" id="artist" name="artist"/>
            <span class="form-control-feedback glyphicon glyphicon-ok"></span>
          </div>
          <div class="form-group has-feedback">
            <label for="website" class="control-label">Website</label>
            <input type="url" class="form-control" id="website" name="website" placeholder="http://www."/>
            <span class="form-control-feedback glyphicon glyphicon-ok"></span>
          </div>
          <div class="form-group has-feedback">
            <label for="fbook" class="control-label">Facebook</label>
            <input type="text" class="form-control" id="fbook" name="fbook"/>
            <span class="form-control-feedback glyphicon glyphicon-ok"></span>
          </div>
          <div class="form-group has-feedback">
            <label for="twitter" class="control-label">Twitter</label>
            <input type="text" class="form-control" id="twitter" name="twitter"/>
            <span class="form-control-feedback glyphicon glyphicon-ok"></span>
          </div>

        </div>
</div>
<div class="col-md-6">

    <div id = "searchBox2">
 		<div class="col-sm-6"> 
         <h2>Client Details</h2>

          <div class="form-group has-feedback">
            <label for="name" class="control-label">Client Name</label>
            <input type="text" class="form-control" id="name" name="name"/>
            <span class="form-control-feedback glyphicon glyphicon-ok"></span>
          </div>  

          <div class="form-group has-feedback">
            <label for="emails[][address]" class="control-label">Email</label>
            <input type="text" class="form-control" id="emails[][address]" name="emails[][address]" placeholder="abc@example.com"/>
            <span class="form-control-feedback glyphicon glyphicon-ok"></span>
          </div>  
          <div class="form-group has-feedback phoneUK">
            <label for="phones[][number]" class="control-label">Telephone</label>
            <input type="text" class="form-control" id="phones[][number]" name="phones[][number]"/>
            <span class="form-control-feedback glyphicon glyphicon-ok"></span>
          </div>
          <div class="form-group has-feedback">
            <label for="links[][address]" class="control-label">Website</label>
            <input type="url" class="form-control" id="links[][address]" name="links[][address]" placeholder="http://www."/>
            <span class="form-control-feedback glyphicon glyphicon-ok"></span>
          </div>


        </div>

		<div class="col-sm-6">
        <div id="clienttwo">
          <div class="form-group has-feedback">
            <label for="primary_address[street]" class="control-label">Address</label>
            <textarea rows="" type="text" class="form-control" id="primary_address[street]" name="primary_address[street]"></textarea>
            <span class="form-control-feedback glyphicon glyphicon-ok"></span>
          </div>
          <div class="form-group has-feedback">
            <label for="primary_address[city]" class="control-label">City</label>
            <input type="text" class="form-control" id="primary_address[city]" name="primary_address[city]"/>
            <span class="form-control-feedback glyphicon glyphicon-ok"></span>
          </div>
          <div class="form-group has-feedback">
            <label for="primary_address[county]">County</label>
            <select class="form-control" id="primary_address[county]" name="primary_address[county]">
			  <option>Avon</option>
			  <option>Bedfordshire</option>
			  <option>Berkshire</option>
			  <option>Borders</option>
			  <option>Buckinghamshire</option>
			  <option>Cambridgeshire</option>
			  <option>Central</option>
			  <option>Cheshire</option>
			  <option>Cleveland</option>
			  <option>Clwyd</option>
			  <option>Cornwall</option>
			  <option>County Antrim</option>
			  <option>County Armagh</option>
			  <option>County Down</option>
			  <option>County Fermanagh</option>
			  <option>County Londonderry</option>
			  <option>County Tyrone</option>
			  <option>Cumbria</option>
			  <option>Derbyshire</option>
			  <option>Devon</option>
			  <option>Dorset</option>
			  <option>Dumfries and Galloway</option>
			  <option>Durham</option>
			  <option>Dyfed</option>
			  <option>East Sussex</option>
			  <option>Essex</option>
			  <option>Fife</option>
			  <option>Gloucestershire</option>
			  <option>Grampian</option>
			  <option>Greater Manchester</option>
			  <option>Gwent</option>
			  <option>Gwynedd County</option>
			  <option>Hampshire</option>
			  <option>Herefordshire</option>
			  <option>Hertfordshire</option>
			  <option>Highlands and Islands</option>
			  <option>Humberside</option>
			  <option>Isle of Wight</option>
			  <option>Kent</option>
			  <option>Lancashire</option>
			  <option>Leicestershire</option>
			  <option>Lincolnshire</option>
			  <option>Lothian</option>
			  <option>Merseyside</option>
			  <option>Mid Glamorgan</option>
			  <option>Norfolk</option>
			  <option>North Yorkshire</option>
			  <option>Northamptonshire</option>
			  <option>Northumberland</option>
			  <option>Nottinghamshire</option>
			  <option>Oxfordshire</option>
			  <option>Powys</option>
			  <option>Rutland</option>
			  <option>Shropshire</option>
			  <option>Somerset</option>
			  <option>South Glamorgan</option>
			  <option>South Yorkshire</option>
			  <option>Staffordshire</option>
			  <option>Strathclyde</option>
			  <option>Suffolk</option>
			  <option>Surrey</option>
			  <option>Tayside</option>
			  <option>Tyne and Wear</option>
			  <option>Warwickshire</option>
			  <option>West Glamorgan</option>
			  <option>West Midlands</option>
			  <option>West Sussex</option>
			  <option>West Yorkshire</option>
			  <option>Wiltshire</option>
			  <option>Worcestershire</option>
            </select>
            <span class="form-control-feedback glyphicon glyphicon-ok"></span>
          </div>
 
          <div class="form-group has-feedback postcodeUK">
            <label for="primary_address[postcode]" class="control-label">Postcode</label>
            <input type="text" class="form-control" id="primary_address[postcode]" name="primary_address[postcode]"/>
            <span class="form-control-feedback glyphicon glyphicon-ok"></span>
          </div>
        </div>
        <input name="primary_address[country_id]" type="hidden" value="1"/>
        <input name="description" type="hidden" value=""/>
        <input name="active" type="hidden" value=true>
        <input name="locale" type="hidden" value="en-GB"/>
        <input name="membership_type" type="hidden" value="Organisation"/>
        <input name="tag_list" type="hidden" value=[]>
        <input name="store_ids" type="hidden" value="<?php echo $_GET['store_ids']; ?>"/>
        <input name="product_id" type="hidden" value="<?php echo $_GET['id']; ?>"/>
        <input name="days" type="hidden" value="<?php echo $_GET['period']; ?>"/>
        <input name="price" type="hidden" value="<?php echo $_GET['price']; ?>"/>
        <input name="product_type" type="hidden" value="<?php echo $_GET['type']; ?>"/>
          </div>

        </div>
</div>
</div>
<div class="col-md-3">
        <div id = "searchBox3">
          <h2>Booking Details</h2>
          <div class="form-group has-feedback">
            <label for="<? echo $_GET['id'];?>" class="control-label">Vehicle Type</label>
            <input type="text" class="form-control" id="<? echo $_GET['id'];?>" name="<? echo $_GET['id'];?>" value="<?php echo $_GET['type']?>" readonly="readonly">
          </div>
          <div class="form-group has-feedback">
            <label for="startDate" class="control-label">Collection Date</label>
            <input type="text" class="form-control" id="startDate" name="startDate" value="<?php echo $_GET['start_date'];?>" readonly="readonly">
          </div>
          <div class="form-group has-feedback">
            <label for="endDate" class="control-label">Return Date</label>
            <input type="text" class="form-control" id="endDate" name="endDate" value="<?php echo $_GET['end_date'];?>" readonly="readonly">
          </div>
			<span class="small">Hire period finishes at 10am on the return date</span>
           <button class="contact-form__button btn confirmbtn" type="submit_button" id="submit_button">Confirm Booking</button>

          </form>
        </div>
</div>
</div>

<div id="error"></div>



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
                maxlength: 40,
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
                    type: "post",
                  }
            },
            "emails[][address]": {
                required: true,
                email: true,
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
            	required: true,

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
            },
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

