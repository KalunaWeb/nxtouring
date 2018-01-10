<!-- About modal -->
<div class="modal about-modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">wanderlust</h4>
            </div>
            <div class="modal-body">
                <div class="agileits-nxlayouts-info">
                    <img src="images/8.jpg" alt="" />
                    <p>Duis venenatis, turpis eu bibendum porttitor, sapien quam ultricies tellus, ac rhoncus risus odio eget nunc. Pellentesque ac fermentum diam. Integer eu facilisis nunc, a iaculis felis. Pellentesque pellentesque tempor enim, in dapibus turpis porttitor quis. Suspendisse ultrices hendrerit massa. Nam id metus id tellus ultrices ullamcorper.  Cras tempor massa luctus, varius lacus sit amet, blandit lorem. Duis auctor in tortor sed tristique. Proin sed finibus sem.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //About modal -->







<!-- Van Detail Modals -->


<?php

$i= 1;
while ($i <= $arr['meta']['total_row_count']) {
    echo '
  <div class="modal about-modal fade" id="vanModal'.$i.'" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header"> 
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>            
            <h4 class="modal-title">'.$name[$i].'</h4>
        </div> 
        <div class="modal-body">
        <div class="row">
          <div class="agileits-nxlayouts-info">
          <div class="col-md-6">
            <img src="'.$url[$i].'" alt="" />
          </div>
          <div class="col-md-6">
          <div class="price-bottom">
            <ul>
				<li><span><img class="infoPic" src="/images/seats.png"></span>'.$desc1[$i].'</li>
				<li><span><img class="infoPic" src="/images/door.png"></span>'.$desc2[$i].'</li>
				<li><span><img class="infoPic" src="/images/steering_wheel.png"></span>'.$desc3[$i].'</li>
				<li><span><img class="infoPic" src="/images/fuel.png"></span>'.$desc4[$i].'</li>
				<li><span><img class="infoPic" src="/images/money.png"></span>'.$desc4[$i].'</li>
			</ul>
        </div>
          </div>
          </div>

          <div class="col-md-3 col-md-offset-8 vanAvailResult">None Available</div>
          </br> 
          <div class="col-md-3 col-md-offset-8" id="bookBtn'.$i.'"></div> 
          </div>

        </div>
        <div class="modal-footer"> 
        <p>'.$main[$i].'</p>
            <span class="small" id="van-modal-footer">£'.$price[$i].' per day / £'.($price[$i]*4).' per week</span>
            <div id="response"></div>

        </div>
      </div>
    </div>
  </div>';
    $i++;
};?>

<script>
    var dateNow = new Date();
    $('.startModal').daterangepicker({

        "sideBySide": true,
        "singleDatePicker": true,
        "autoApply": true,
        "timePicker": true,
        "timePicker24Hour": true,
        "timePickerIncrement": 60,
        "locale": {
            "format": "MMMM Do YYYY [at] h:[00] a ",
            "separator": " - ",

            "firstDay": 1
        },
        "startDate": moment().add(1, 'hours'),
        "minDate": moment()
    });

    $('.endModal').daterangepicker({

        singleDatePicker: true,
        autoApply: true,
        "singleDatePicker": true,
        "timePicker": true,
        "timePicker24Hour": true,
        "timePickerIncrement": 60,
        minDate: moment(),
        startDate: moment(dateNow).add(1,'days').hours(10).minutes(0).seconds(0).milliseconds(0),
        locale: {
            format: "MMMM Do YYYY [at 10:00 am]",
            firstDay: 1
        }
    });

    $('.startModal').on('apply.daterangepicker', function(ev, picker) {

        var new_min =  picker.startDate.clone().add(1, 'days');
        var new_start = new_min.hours(10);
        $('.endModal').daterangepicker({

            autoApply: true,
            "singleDatePicker": true,
            "timePicker": true,
            "timePicker24Hour": true,
            "timePickerIncrement": 60,
            minDate: new_min,
            startDate: new_start,
            locale: {
                format: "MMMM Do YYYY [at] h:mm a",
                firstDay: 1
            }
        });

    });

    $( '.van2' ).click(function(e) {
        e.preventDefault();
        var string = "#vanCheck"+$(this).attr('id');
        var form = $(string).serializeJSON();
        var jdata = JSON.stringify(form);

        $.ajax({
            url: 'searchBox2.php',
            method: 'post',
            dataType: 'json',
            data: jdata,
            success: function(data) {
                var btn="#bookBtn"+data['loop'];
                $('#vanAlertModal').modal('toggle');
                $('#vanAlertName').html(data['name']);
                $('#vanThumb').attr("src", data['thumb']);
                $('#vanResult').html(data['result']);

                if (data['available'] == true) {
                    $('#vanBookBtn').html(data['buttonCode']);
                }
                else {
                    $('#vanBookBtn').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>')

                }
            }
        });
    });



    $("#searchForm").submit(function(e){
        e.preventDefault(e);
    });

    $('#searchForm').validate({
        rules: {
            artistName: {
                required: true,
                minlength: 2,
                maxlength: 40
            }
        },
        messages: {
            artistName: {
                required: "Please enter a the Artists Name",
                minlength: "Artist Name must be at least {0} characters long"
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
            $('#searchModal').modal('show');
        }
    });
</script>

<!-- // Van Detail Modal -->


<!-- Van Availability Check Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="vanAvail">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title">Availability Check</h5>
            </div>
            <div class="modal-body" id="vanModal">

            </div>
            <div class="modal-footer">
                <div class="col-xs-10">
                    <span class="small" id="modal-footer">Pictures are for indication only and not necessarily the vehicle booked</span>
                </div>
                <div class="col-xs-2">
                    <?php if ($user == "Guest") {
                        echo '<button  type="submit" class="btn" id="searchBtnModal" data-target="#searchModal2" role="button" data-toggle="modal">Check</button>';
                    } else {
                        echo '<button type="submit" class="contact-form__button btn confirmbtn" id="searchBtnModal">Check</button>';
                    }
                    ?>
                </div>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- Search Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="searchModal">
    <div class="modal-dialog" id="result-modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title">Vehicles Available within that date range.</h5>
            </div>
            <div class="modal-body" id="searchResults">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
                <div class="col-xs-10">
                    <span class="small" id="modal-footer">Pictures are for indication only and not necessarily the vehicle booked</span>
                </div>
                <div class="col-xs-2">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- Profile bookings Modal -->
<div class="modal about-modal fade" id="profileModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php if (isset($contact)) {echo '
        <div class="modal-header"> 
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>            
            <h4 class="modal-title">< '.$contact['member']['name'] . '</h4>
        </div> 
        <div class="modal-body">
         <div id="main">
            <div id="profile-content">
              <div class="profile profileBox">
                <form id="details">
                  <table>
                    <tr>
                      <td></td>
                      <td class="editableId" id="name">'.$contact['member']['name'].'</td>
                    </tr>
                    <tr>
                      <td>Address:</td>
                      <td class="editable" id="[primary_address][street]">'
                .$contact['member']['primary_address']['street'].'</td>
                    <tr>
                      <td></td>
                      <td class="editable" id="[primary_address][city]">'
                .$contact['member']['primary_address']['city'].'
                      </td>
                    <tr>
                      <td></td>
                      <td class="editable" id="[primary_address][county]">'
                .$contact['member']['primary_address']['county'].'
                      </td>
                    <tr>
                      <td></td>
                      <td class="editable" id="[primary_address][postcode]">'
                .$contact['member']['primary_address']['postcode'].'
                      </td>
                    </tr>';

                $i = 0;
                foreach ($contact['member']['emails'] as $key => $value)
                {
                    $id_address = "emails[".$i."][address]";
                    $id_id = "emails[".$i."][id]";
                    echo "<tr><td>".$value['email_type_name']." email: </td><td class='editable' id='".$id_address."'>".$value['address']."</td><td class='editableId' id='".$id_id."'>".$value['id']."</td></tr>";
                    $i++;
                }
                $i = 0;
                foreach ($contact['member']['phones'] as $key => $value)
                {
                    $id_number = "phones[".$i."][number]";
                    $id_id = "phones[".$i."][id]";
                    echo "<tr><td>".$value['phone_type_name']." phone: </td><td class='editable' id='".$id_number."'>".$value['number']."</td><td class='editableId' id='".$id_id."'>".$value['id']."</td></tr>";
                    $i++;
                }
                $i = 0;
                foreach ($contact['member']['links'] as $key => $value)
                {
                    $id_link = "links[".$i."][address]";
                    $id_id = "links[".$i."][id]";
                    echo "<tr><td>".$value['link_type_name']." link: </td><td class='editable' id='".$id_link."'>".$value['address']."</td><td class='editableId' id='".$id_id."'>".$value['id']."</td></tr>";
                    $i++;}

                echo '<td></td>
        </table>
      </form>
    </div>
  </div><!-- Content Div End -->
</div>
</div>
  <div class="modal-footer" id="tbl">
    <button type="button" class="btn btn-default xx">Edit</button>
    <button type="button" class="btn btn-default cancel">Cancel</button>
    <button type="button" class="btn btn-default cls" data-dismiss="modal">Close</button>
  </div>';}?>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- //Profile Modal -->

<!-- Current bookings Modal -->
<div class="modal about-modal fade" id="currentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Current Bookings</h4>
            </div>
            <div class="modal-body">
                <div class= "profile currentHire">
                    <h4>Live Bookings</h4>
                    <table>
                        <tr><th>Artist</th><th>Start date</th><th>End Date</th><th>State</th></tr>
                        <?php if (isset($live)) {
                        foreach ($live['opportunities'] as $value=>$key)
                        {

                            echo "<tr><td>".$key['subject']."</td><td>".date("d-m-Y",strtotime($key['starts_at']))."</td><td>".date("d-m-Y",strtotime($key['ends_at']))."</td><td>".$key['state_name']."</td></tr>";
                        }
                        ?>
                    </table>
                </div>
                <div class= "profile currentHire">
                    <h4>Archived Bookings</h4>
                    <table id="bookings">
                        <?php
                        if ($archive['meta']['total_row_count'] != 0) {
                            echo "<tr><th>Artist</th><th>Start date</th><th>End Date</th><th>State</th><th></th></tr>";
                            foreach ($old as $value=>$key) {
                                echo "<tr><td>".$key['subject']."</td><td>".date("d-m-Y",strtotime($key['starts_at']))."</td><td>".date("d-m-Y",strtotime($key['ends_at']))."</td><td>".$key['state_name']."</td><td>".$key['status_name']."</td></tr>";
                            }
                        } else {
                            echo "No bookings to display";
                        }};
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $('#tbl').on('click','.xx',function() {
        var resetModal = $('#profileModal').html();
        var form = $('#details').serializeJSON();
        var jdata = JSON.stringify(form);

        if (jdata !="{}"){
            $.ajax({
                url: 'update.php',
                method: 'post',
                dataType: 'json',
                data: jdata,
                success: function(data) {
                    console.log(data + "success");
                }
            });
        }


        $(".editable").each(
            function(){
                // If input fields exist
                if ($(this).find('input').length){
                    // change to text with a value of the input filed
                    $(this).text($(this).find('input').val());
                }
                else {
                    // Take the vlaue of the text field
                    var t = $(this).text();
                    // Get the id of the text field
                    var name = this.id;
                    // Change the text to an input with a value of t and an id of name
                    $(this).html($('<input />',{'value' : t, 'name' : name}).val(t, name));
                }
            });
        $(".editableId").each(
            function(){
                $('.xx').text("Edit");
                $('.cancel').hide();
                $('.cls').show();
                // If input fields exist
                if ($(this).find('input').length){
                    // change to text with a value of the input filed
                    $(this).text($(this).find('input').val());
                }
                else {
                    $('.xx').text("Update");
                    $('.cancel').show();
                    $('.cls').hide();
                    // Take the vlaue of the text field
                    var t = $(this).text();
                    // Get the id of the text field
                    var name = this.id;

                    var hidden = "hidden";
                    // Change the text to an input with a value of t and an id of name
                    $(this).html($('<input />',{'value' : t, 'name' : name, 'type' : hidden}).val(t, name));
                }
            });
        $('.cancel').on('click', function() {
            $('#profileModal').html(resetModal);
        });
    });

</script>

<!-- //Current bookings modal -->

<!-- Login / out Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalLogIn">
    <div class="modal-dialog" id="login-modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">NX Touring Log In</h4>
            </div>
            <div class="modal-body">
                <form class="form-signin" method="post" id="loginform">
                    <div id="error"><!-- error will be shown here ! --></div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email address" name="email" id="email" />
                        <span id="check-e"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
                    </div>

                    <hr />

                    <div class="form-group">
                        <button  type="submit" class="btn btn-default" name="btnlogin" id="btnlogin" data-target="#modalLogIn" role="button">
                            <span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In
                        </button>
                    </div>
                    <input type="hidden" name="valid" value="1" />
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- //login modal -->

<!-- New Client Modal -->
<div class="modal about-modal fade clientBooking" id="newCliModal"  tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h1 class="modal-title">New Client Booking Form</h1>
            </div>
            <div class="modal-body">
                <form id="clientForm" class="register">
                    <div class="row">
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
                                        <label for=""terms">*  I accept the <a href="#">Terms and Conditions</a></label>
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
</div>
<!-- //new Client modal -->
<script>

    jQuery.validator.addMethod('phoneUK', function(phone_number, element) {
        return this.optional(element) || phone_number.length > 9 &&
            phone_number.match(/^(((\+44)? ?(\(0\))? ?)|(0))( ?[0-9]{3,4}){3}$/);
    }, 'Please specify a valid phone number');

    jQuery.validator.addMethod("postcodeUK", function(value, element) {
        return this.optional(element) || /^[A-Z]{1,2}[0-9]{1,2} ?[0-9][A-Z]{2}$/i.test(value);
    }, "Please specify a valid Postcode");


    $(document).ready(function () {

        $("#clientForm").submit(function(e){
            e.preventDefault(e);
        });


        $("#clientForm").validate({
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
                "primary_address[county]": {
                    required: true
                },
                "primary_address[postcode]": {
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
                "primary_address[street]": {
                    required: "Please enter your address"
                },
                "primary_address[city]": {
                    required: "Please enter your city"
                },
                "primary_address[county]": {
                    required: "Please enter your county"
                },
                "primary_address[postcode]": {
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

                var formdata = $('#clientForm').serializeJSON();
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


<!-- Van Available Alert Modal-->

<div class="modal about-modal fade" id="vanAlertModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="vanAlertName"></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-2 col-md-2">
                        <img id="vanThumb" alt="" />
                    </div>
                    <div class="col-xs-9 col-md-10"><p id="vanResult"></p></div>
                </div>
            </div>
            <div class="modal-footer" id="vanBookBtn"></div>
        </div>
    </div>
</div>


<script>

    $('#vanAlertModal').on('click', '#van', function() {

        var $el = $(this);
        var $id = $el.data('van-id');
        var $start = $el.data('van-start');
        var $end = $el.data('van-end');
        var $period = $el.data('van-period');
        var $store = $el.data('van-store');
        var $name = $el.data('van-name');
        var $price = $el.data('van-price');

        $('#type_id').attr('name', $id);
        $('#type_id').val($name);
        $('#startDate').val($start);
        $('#endDate').val($end);
        $('#store').val($store);
        $('#product').val($id);
        $('#days').val($period);
        $('#price').val($price);
        $('#prod_type').val($name);
    });
</script>
<!-- //Van Alert Modal -->