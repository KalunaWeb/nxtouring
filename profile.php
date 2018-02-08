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
            <form id="existcli_form" class="profileForm">
                <div class="row">
                    <div class="modal-header">
                        <h1 class="modal-title">
                            <?php if (isset($_SESSION['user_id'])){echo $contact['member']['name'];}?>
                        </h1>
                    </div>
                    <div class="col-md-12">
                        <fieldset class="form-group">
                            <legend>Basic Information
                            </legend>
                            <div class="form-group has-feedback upload-details">
                                <div class="col-md-3 profile_main">Profile Image</div>
                                <div class="col-md-4" id="preview"><img src="images/avatar.png">
                                    <a href="#" type="submit" class="btn uploadBtn" id="uploadBtn" data-target="#uploadModal" role="button" data-toggle="modal">Upload Image</a></div>
                            </div>
                            <div class="section"></div>
                            <div class="form-group has-feedback update-address">
                                <div class="col-md-3 profile_main">Address</div>
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <div class="input-group">
                                            <span class="input-group-addon profile-label">Street</span>
                                        <textarea rows="" class="form-control" id="line1" name="line1"><?php if (isset($_SESSION['user_id'])){echo $contact['member']['primary_address']['street'];}?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <div class="input-group">
                                            <span class="input-group-addon profile-label">Town</span>
                                            <input class="form-control" type="text" id="town" name="town" placeholder="Town"
                                                <?php if (isset($_SESSION['user_id'])){
                                                    echo 'value="'.$contact['member']['primary_address']['city'].'"';
                                                }?>/>
                                            <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <div class="input-group">
                                            <span class="input-group-addon profile-label">County</span>
                                            <input class="form-control" type="text" id="county" name="county" placeholder="County"
                                                <?php if (isset($_SESSION['user_id'])){
                                                    echo 'value="'.$contact['member']['primary_address']['county'].'"';
                                                }?>/>
                                            <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <div class="input-group">
                                            <span class="input-group-addon profile-label">Postcode</span>
                                            <input class="form-control" type="text" id="postcode" name="postcode" placeholder="Postcode"
                                                <?php if (isset($_SESSION['user_id'])){
                                                    echo 'value="'.$contact['member']['primary_address']['postcode'].'"';
                                                }?>/>
                                            <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="section"></div>
                            <div class="form-group has-feedback update-address">
                                <div class="col-md-3 profile_main">Contact Details</div>
                                <div class="col-md-4">
                                <div class="form-group has-feedback">
                                <div class="input-group">
                                    <?php if (isset($_SESSION['user_id'])){
                                        $i=0;
                                        foreach ($contact['member']['emails'] as $key => $value) {
                                            $id_address = "emails[" . $i . "][address]";
                                            $id_id = "emails[" . $i . "][id]";
                                            echo '<span class="input-group-addon profile-label">'.$value['email_type_name'].' Email</span><input type="text" class="form-control" id="'.$id_address.'" value="' . $value['address'] . '"/>';
                                            $i++;
                                        }
                                    }?>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <?php if (isset($_SESSION['user_id'])){
                                        $i=0;
                                        foreach ($contact['member']['phones'] as $key => $value) {
                                            $id_number = "phones[".$i."][number]";
                                            $id_id = "phones[".$i."][id]";
                                            echo '<span class="input-group-addon profile-label">'.$value['phone_type_name'].' Phone</span><input type="text" class="form-control" id="'.$id_number.'" value="' . $value['number'] . '"/>';
                                            $i++;
                                        }
                                    }?>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <?php if (!empty($contact['member']['links'])) {
                                        $i=0;
                                        foreach ($contact['member']['links'] as $key => $value) {
                                            $id_link = "links[".$i."][address]";
                                            $id_id = "links[".$i."][id]";
                                            echo '<span class="input-group-addon profile-label">'.$value['link_type_name'].' Email</span><input type="text" class="form-control" id="'.$id_link.'" value="' . $value['address'] . '"/>';
                                            $i++;
                                        }
                                    } else {
                                        echo "<span class='input-group-addon'>Website</span><input type='text' id='links[][address]' class='form-control'/>";
                                    }?>
                                </div>
                            </div>
                                </div>
                            </div>
                        </fieldset>
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