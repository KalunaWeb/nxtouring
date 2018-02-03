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
          <div class="col-md-6 col-xs-5">
            <img src="'.$url[$i].'" alt="" />
          </div>
          <div class="col-md-6 col-xs-7">
          <div class="price-bottom">
            <ul>
				<li><span><img class="infoPic" src="images/seats.png"></span>'.$seats[$i].'</li>
				<li><span><img class="infoPic" src="images/weight.png"></span>'.$weight[$i].'</li>
				<li><span><img class="infoPic" src="images/tape.png"></span>'.$size[$i].'</li>
				<li><span><img class="infoPic" src="images/licence.png"></span>'.$licence[$i].'</li>
				<li><span><img class="infoPic" src="images/money.png"></span>'.$deposit[$i].'</li>
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

</script>

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
                <div class="col-md-10 col-xs-9">
                    <span class="small" id="modal-footer">Pictures are for indication only and not necessarily the vehicle booked</span>
                </div>
                <div class="col-md-2 col-xs-2">
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
