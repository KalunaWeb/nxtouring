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
				<li><span><img class="infoPic" src="/images/seats.png"></span>'.$seats[$i].'</li>
				<li><span><img class="infoPic" src="/images/weight.png"></span>'.$weight[$i].'</li>
				<li><span><img class="infoPic" src="/images/tape.png"></span>'.$size[$i].'</li>
				<li><span><img class="infoPic" src="/images/licence.png"></span>'.$licence[$i].'</li>
				<li><span><img class="infoPic" src="/images/money.png"></span>'.$deposit[$i].'</li>
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
<script>
    $("#modalLogIn").submit(function(e) {
        $.ajax({
            type: "POST",
            url: 'login_process.php',
            data: $("#loginform").serialize(), // serializes the form's elements.
            success: function(data) {
                if (data == "ok") {
                    window.location.href = "index.php";
                } else {
                    $('#error').html(data);
                    $('#modalLogIn').modal('show');

                }
            }
        });
        e.preventDefault(); // avoid to execute the actual submit of the form.
    });


    $("#logout").submit(function() {
        $.ajax({
            type: "POST",
            url: 'logout.php',
            success: function()
            {
                window.location.href = "index.php";
            }
        });
    });

</script>
<!-- //login modal -->
