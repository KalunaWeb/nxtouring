<?php

include 'header.php';

?>

<body id="background">

<?php 

$name = str_replace(" ", "%20", $contact['member']['name']);

$live = $current->getOpportunity($name, "live");
$archive = $current->getOpportunity($name, "all");
$old = array_reverse($archive['opportunities']);
$count = count($contact['member']['child_members']);

for ($i=0; $i<$count; $i++) {
    $driver[$i] = $current -> getContactById($contact['member']['child_members'][$i]['related_id']);
}

?>

<div id="newcli-container">
    <div class="container">
        <div class="newcli-form">
            <form id="existcli_form" class="register">
                <div class="row">
                    <div class="modal-header">
                        <h1 class="modal-title">
                            <?php if (isset($_SESSION['user_id'])){echo $contact['member']['name'];}?>
                        </h1>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <fieldset class="form-group">
                                <legend>Company Details
                                </legend>
                                <div class="form-group has-feedback details">
                                    <span class="profile_main">Address </span>
                                    <span class="editable" id="line1">
                                        <?php echo $contact['member']['primary_address']['street']?>
                                    </span>
                                </div>
                                <div class="form-group has-feedback details">
                                    <span class="profile_main">Town/City </span>
                                    <span class="editable" id="town">
                                        <?php echo $contact['member']['primary_address']['city']?>
                                    </span>
                                </div>
                                <div class="form-group has-feedback details">
                                    <span class="profile_main">County </span>
                                    <span class="editable" id="county">
                                        <?php echo $contact['member']['primary_address']['county']?>
                                    </span>
                                </div>
                                <div class="form-group has-feedback details">
                                    <span class="profile_main">Postcode </span>
                                    <span class="editable" id="postcode">
                                        <?php echo $contact['member']['primary_address']['postcode']?>
                                    </span>
                                </div>
                                <div class="form-group has-feedback details">
                                    <?php if (isset($_SESSION['user_id'])){
                                        foreach ($contact['member']['emails'] as $key => $value)
                                        {
                                            $id_address = "emails[".$i."][address]";
                                            $id_id = "emails[".$i."][id]";
                                            echo "<span class='profile_main'>".$value['email_type_name']." Email</span><span class='editable' id='".$id_address."'>".$value['address']."</span><span class='editableId' id='".$id_id."'>".$value['id']."</span>";
                                            $i++;
                                        }
                                        }?>
                                </div>
                                <div class="form-group has-feedback details">
                                    <?php
                                    foreach ($contact['member']['phones'] as $key => $value)
                                    {
                                        $id_number = "phones[".$i."][number]";
                                        $id_id = "phones[".$i."][id]";
                                        echo "<span class='profile_main'>".$value['phone_type_name']." Phone </span><span class='editable' id='".$id_number."'>".$value['number']."<span><span class='editableId' id='".$id_id."'>".$value['id']."</span>";
                                        $i++;
                                    }?>
                                </div>
                                <div class="form-group has-feedback details">
                                    <?php if (!empty($contact['member']['links'])) {
                                    foreach ($contact['member']['links'] as $key => $value)
                                    {
                                        $id_link = "links[".$i."][address]";
                                        $id_id = "links[".$i."][id]";
                                        echo "<span class='profile_main'>".$value['link_type_name']." link </span><span class='editable' id='".$id_link."'>".$value['address']."</span><span class='editableId' id='".$id_id."'>".$value['id']."</span>";
                                        $i++;
                                    }
                                    } else {
                                        echo "<span class='profile_main'>Website </span><span class='editable' id='links[][address]'></span>";
                                    }?>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset class="form-group">
                                <legend>Associated Drivers</legend>
                                <div class="form-group has-feedback details">
                                    <div>
                                    <span class="profile_main">Driver</span>
                                    <span class="profile_main">Licence Number</span>
                                    <span class="profile_main">Authorised</span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <?php
                                    if (count($contact['member']['child_members']) != 0) {
                                        foreach ($driver as $value=>$key)
                                        {
                                            echo "<div><span class='profile_main'>".$key['member']['name']."</span>
                                                    <span class='profile_main'>******".substr($key['member']['custom_fields']['drivers_licence_number'], -8)."</span>";
                                            if ($key['member']['active']){
                                                echo "<span class='auth glyphicon glyphicon-ok'></span>";
                                            } else {
                                                echo "<span class='notauth'>Pending</span>";
                                            }
                                            echo "</div><div class='clearfix'></div>";
                                        }
                                    } else {
                                        echo "No drivers to display";
                                    }
                                    ?>

                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset class=" form-group">
                                <legend>Hire Details</legend>
                                <div class="form-group details">
                                    <label class="profile_main control-label" for="prod_type">Vehicle Type</label>
                                    <input type="text" class="form-control" id="prod_type" name="prod_type" value="<?php echo $_POST["prod_type"];?>" readonly="readonly">
                                </div>
                                <div class="form-group details">
                                    <label class="profile_main control-label" for="startDate">Collection Date</label>
                                    <input type="text" class="form-control" id="startDate" name="startDate" value="<?php echo $newStart;?>" readonly="readonly">
                                </div>
                                <div class="form-group details">
                                    <label class="profile_main control-label" for="endDate">Return Date</label>
                                    <input type="text" class="form-control" id="endDate" name="endDate" value="<?php echo $newEnd;?>" readonly="readonly">
                                </div>
                                <div class="form-group details">
                                    <label class="profile_main control-label" for="hireprice">Hire Price</label>
                                    <input type="text" class="form-control" id="hireprice" name="hireprice" value="<?php echo $_POST["hirefee"].'.00'?>" readonly="readonly">
                                </div>
                                <div class="form-group details">
                                    <label class="profile_main control-label" for="options">Deposit Scheme</label>
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
                                    <label class="profile_main control-label" for="totprice">Total Price</label>
                                    <input type="text" class="form-control" id="totprice" name="totprice" value="<?php echo ($_POST["hirefee"]+($_POST["cdays"]*10)).'.00 + vat'?>" readonly="readonly">
                                </div>
                            </fieldset>

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

















<div class="container" id="main">
  <div class="row">
    <div id="profile-content">
        <form>
      <div class="col-md-4 profile profileBox">
      <form id="details">
      <table id="tbl">
<tr>
<td>Name :</td>
<td class="editable" id="name"><?php echo $contact['member']['name'];?></td>
</tr>
<tr>
<td>Address:</td>
<td class="editable" id="[primary_address][street]">
<?php echo $contact['member']['primary_address']['street'];?>
</td><tr>
<td></td>
<td class="editable" id="[primary_address][city]">
<?php echo $contact['member']['primary_address']['city'];?>
</td><tr><td></td>
<td class="editable" id="[primary_address][county]">
<?php echo $contact['member']['primary_address']['county'];?>
</td><tr><td></td>
<td class="editable" id="[primary_address][postcode]">
<?php echo $contact['member']['primary_address']['postcode'];?>
</td>
		
      <?php
      $i = 0;
      	foreach ($contact['member']['emails'] as $key => $value)
      		{	
      			$id_address = "emails[".$i."][address]";
            $id_id = "emails[".$i."][id]";
      			echo "<tr><td>".$value['email_type_name']." email: </td><td class='editable' id='".$id_address."'>".$value['address']."</td><td><input type='hidden' id='".$id_id."' value='".$value['id']."'></tr></td>";
      			$i++;
      		}
      	$i = 0;
      	foreach ($contact['member']['phones'] as $key => $value)
      		{
      			$id = "phones[".$i."][number]";
      			echo "<tr><td>".$value['phone_type_name']." phone: </td><td class='editable' id='".$id."'>".$value['number']."</td></tr>";
      			$i++;
      		}
      	$i = 0;
      	foreach ($contact['member']['links'] as $key => $value)
      		{
      			$id = "links[".$i."][address]";
      			echo "<tr><td>".$value['link_type_name']." link: </td><td class='editable' id='".$id."'>".$value['address']."</td></tr>";
      			$i++;
      		}?> 
      		<td></td><td class="xx">Edit</td>
      	</table>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-6">
	      <div class= "profile currentHire">
	      <h4>Live Bookings</h4>
	      <table>
	      <tr><th>Artist</th><th>Start date</th><th>End Date</th><th>State</th></tr>
		      <?php 
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
			}
		    ?>
	      </table>
	      </div>
          <div class= "profile currentHire">
              <h4>Drivers</h4>
              <table id="bookings">
                  <?php
                  if (count($contact['member']['child_members']) != 0) {
                      echo "<tr><th>Driver</th><th>Licence Number</th></tr>";
                      foreach ($driver as $value=>$key) {
                          echo "<tr><td>".$key['member']['name']."</td><td>".$key['member']['custom_fields']['drivers_licence_number']."</td></tr>";
                      }
                  } else {
                      echo "No drivers to display";
                  }
                  ?>
              </table>
          </div>
      </div>

	</form>
    </div><!-- Content Div End -->
  </div> <!-- Row end --> 
</div>

<script>
	$('#tbl').on('click','.xx',function() {
		var form = $('#details').serializeJSON();
  		var jdata = JSON.stringify(form);

  		if (jdata =="{}"){
  			console.log("empty");
  		}else {
  			console.log(jdata);
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
});
</script>