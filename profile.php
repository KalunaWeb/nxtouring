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
//print_r($contact);
//for ($i=0; $i<$count; $i++) {
  //  $driver[$i] = $current -> getContactById($contact['member']['child_members'][$i]['related_id']);
//}

?>

<div id="newcli-container">
    <div class="container">
        <div class="newcli-form">
            <form id="profile" class="profileForm">
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
                                <div class="col-md-4" id="preview">
                                    <?php if (isset($_SESSION['user_id']) && $contact["member"]["icon_exists?"]) {
                                        echo '<img src="'.$contact["member"]["icon"]["url"].'">';
                                    } else { echo '<img src="images/avatar.png">';}
                                    ?>
                                    <a href="#" type="submit" class="btn uploadBtn" id="uploadBtn" data-target="#uploadModal" role="button" data-toggle="modal">Upload Image</a></div>
                                <input type="hidden" id="icon" name="icon"
                                    <?php if (isset($_SESSION['user_id']) && $contact["member"]["icon_exists?"]) {echo 'value="'.$contact["member"]["icon"]["url"].'"';} ?>
                                />
                                <input type="hidden" id="thumb" name="thumb"
                                    <?php if (isset($_SESSION['user_id']) && $contact["member"]["icon_exists?"]) {echo 'value="'.$contact["member"]["icon"]["thumb_url"].'"';} ?>
                                />
                            </div>
                            <div class="section"></div>
                            <div class="form-group has-feedback update-address">
                                <div class="col-md-3 profile_main">Address</div>
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <div class="input-group">
                                            <span class="input-group-addon profile-label">Street</span>
                                        <textarea rows="" class="form-control" id="primary_address[street]" name="primary_address[street]"><?php if (isset($_SESSION['user_id'])){echo $contact['member']['primary_address']['street'];}?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <div class="input-group">
                                            <span class="input-group-addon profile-label">Town</span>
                                            <input class="form-control" type="text" id="primary_address[city]" name="primary_address[city]"
                                                <?php if (isset($_SESSION['user_id'])){
                                                    echo 'value="'.$contact['member']['primary_address']['city'].'"';
                                                }?>/>
                                            <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <div class="input-group">
                                            <span class="input-group-addon profile-label">County</span>
                                            <input class="form-control" type="text" id="primary_address[county]" name="primary_address[county]"
                                                <?php if (isset($_SESSION['user_id'])){
                                                    echo 'value="'.$contact['member']['primary_address']['county'].'"';
                                                }?>/>
                                            <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <div class="input-group">
                                            <span class="input-group-addon profile-label">Postcode</span>
                                            <input class="form-control" type="text" id="primary_address[postcode]" name="primary_address[postcode]"
                                                <?php if (isset($_SESSION['user_id'])){
                                                    echo 'value="'.$contact['member']['primary_address']['postcode'].'"';
                                                }?>/>
                                            <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="section row"></div>
                            <div class="form-group has-feedback update-address">
                                <div class="col-md-3 profile_main">Contact Details</div>
                                <div class="col-md-4">
                                    <div id="phonesWrapper">
                                        <ul id="phones">

                                                <!-- Phones Select -->
                                                    <?php if (isset($_SESSION['user_id'])) {
                                                        $p = 0; // phones array index
                                                        foreach ($contact['member']['phones'] as $key => $value) {
                                                            $number = "phones[" . $p . "][number]"; // Phone Number
                                                            $id = "phones[" . $p . "][id]"; // ID of individual record for editing
                                                            $type = "phones[".$p."][type_id]"; // id of the type of number
                                                            echo '<li id="phone'.$p.'"><div class="form-group contactSelect"><div class="col-xs-4 typeSelect">
                                                                <div class="form-group">
                                                                <select class="form-control" id="'.$type.'" name="'.$type.'">
                                                                <option value="6001"';
                                                            if ($value['type_id'] == 6001) echo 'selected="selected"';
                                                            echo '>Work</option>
                                                                <option value="6002"';
                                                            if ($value['type_id'] == 6002) echo 'selected="selected"';
                                                            echo '>Mobile</option>
                                                                <option value="6003"';
                                                            if ($value['type_id'] == 6003) echo 'selected="selected"';
                                                            echo '>Fax</option>
                                                                <option value="6004"';
                                                            if ($value['type_id'] == 6004) echo 'selected="selected"';
                                                            echo '>Skype</option>
                                                                <option value="6005"';
                                                            if ($value['type_id'] == 6005) echo 'selected="selected"';
                                                            echo '>Home</option>
                                                                </select>
                                                                </div>
                                                                </div>
                                                                <div class="col-xs-8 typeSelect">
                                                                    <div class="form-group has-feedback input-group">
                                                                    <input class="form-control" type="text" id="'.$number.'" name="'.$number.'" maxlength="12" ';
                                                            if (isset($_SESSION['user_id']))
                                                            {
                                                                echo 'value="' . $value['number'] . '"';
                                                            };
                                                            echo '/><span class="input-group-addon profile-label contact-addon"><a href="javascript:void(0);" class="remove" id="phone'.$p.'">X</a></span>
                                                                    <input type="hidden" id="'.$id.'" name="'.$id.'" value="'.$value['id'].'" /> 
                                                                    </div>
                                                                 </div></div></li>';
                                                            $p++;
                                                        }
                                                    }?>
                                        </ul>
                                    </div>


                                    <button class="btn-default updateBtn" id="addphone" type="submit" value="Add">Add Phone</button>
                                    <div id="emailsWrapper">
                                        <ul id="emails">
                                            <li>
                                                <div class="form-group contactSelect" id="emails"><!-- Emails Select -->
                                                    <?php if (isset($_SESSION['user_id'])) {
                                                        $e = 0; // Emails array index
                                                        foreach ($contact['member']['emails'] as $key => $value) {
                                                            $email = "emails[" . $e . "][address]"; // Email Address
                                                            $id = "emails[" . $e . "][id]"; // ID of individual record for editing
                                                            $type = "emails[".$e."][type_id]"; // ID number of the email type
                                                            echo '<div class="col-md-4 typeSelect">
                                                                    <div class="form-group">
                                                                    <select class="form-control" id="'.$type.'" name="'.$type.'">
                                                                    <option value="4001"';
                                                            if ($value['type_id'] == 4001) echo 'selected="selected"';
                                                            echo '>Work</option>
                                                                    <option value="4002"';
                                                            if ($value['type_id'] == 4002) echo 'selected="selected"';
                                                            echo '>Home</option>
                                                                    </select>
                                                                  </div>
                                                                </div>
                                                                <div class="col-md-8 typeSelect">
                                                                    <div class="form-group has-feedback input-group">
                                                                        <input class="form-control" type="text" id="'.$email.'" name="'.$email.'" ';
                                                            if (isset($_SESSION['user_id']))
                                                            {
                                                                echo 'value="' .$value['address']. '"';
                                                            };
                                                            echo '/><input type="hidden" id="'.$id.'" name="'.$id.'" value="'.$value['id'].'" />
                                                                    </div>
                                                                </div>';
                                                            $e++;
                                                        }
                                                    }?>
                                                </div>

                                            </li>
                                        </ul>
                                    </div>
                                    <button class="btn-default updateBtn" id="addemail" type="submit" value="Add">Add Email</button>
                                    <div id="linksWrapper">
                                        <ul id="links">
                                            <li>
                                                <div class="form-group contactSelect" id="links"><!-- Social Media Select -->
                                                    <?php if (isset($_SESSION['user_id'])) {
                                                        $l = 0; // Links array index
                                                        foreach ($contact['member']['links'] as $key => $value) {
                                                            $link = "links[" . $l . "][address]"; // Link Address
                                                            $id = "links[" . $l . "][id]"; // ID of individual record for editing
                                                            $type = "links[".$l."][type_id]"; // ID number of the Link type
                                                            echo '<div class="col-md-4 typeSelect">
                                                        <div class="form-group">
                                                            <select class="form-control" id="'.$type.'" name="'.$type.'">
                                                                <option value="5001"';
                                                            if ($value['type_id'] == 5001) echo 'selected="selected"';
                                                            echo '>Website</option>
                                                                <option value="5002"';
                                                            if ($value['type_id'] == 5002) echo 'selected="selected"';
                                                            echo '>Facebook</option>
                                                                <option value="5003"';
                                                            if ($value['type_id'] == 5003) echo 'selected="selected"';
                                                            echo '>Twitter</option>
                                                                <option value="5004"';
                                                            if ($value['type_id'] == 5004) echo 'selected="selected"';
                                                            echo '>Linkedin</option>
                                                                <option value="5001"';
                                                            if ($value['type_id'] == 5005) echo 'selected="selected"';
                                                            echo '>IM</option>    
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 typeSelect">
                                                        <div class="form-group has-feedback input-group">
                                                            <input class="form-control" type="text" id="'.$link.'" name="'.$link.'" ';if (isset($_SESSION['user_id'])) {
                                                                echo 'value="' .$value['address']. '"';
                                                            }; echo '/><input type="hidden" id="'.$id.'" name="'.$id.'" value="'.$value['id'].'" />
                                                        </div>
                                                    </div>';
                                                            $l++;
                                                        } echo '<div class="clearfix"></div>';
                                                    }?>
                                                </div>

                                            </li>
                                        </ul>
                                    </div>
                                    <button class="btn-default updateBtn" id="addlink" type="submit" value="Add">Add Link</button>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="section"></div>
                <fieldset>
                    <div class="col-md-3 profile_main"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <button class="btn-default updateBtn" id="update" value="Update">Update</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<div id="error"></div>
<script>

    $(document).ready(function () {

        var phoneIndex = <?php echo $p;?>;
        var emailIndex = <?php echo $e;?>;
        var linksIndex = <?php echo $l;?>;
        var numOfPhones = 1;
        var numOfEmails = 1;
        var numOfLinks = 1;

        //Add New link Section

        $('#addlink').click(function (e) {
            e.preventDefault();
            if (numOfLinks < 5) {
                numOfLinks++;
                linksIndex++;
                var number = '<li id="link'+linksIndex+'"><div class="form-group contactSelect">'+
                    '<div class="col-md-4 typeSelect"><div class="form-group">' +
                    '<select class="form-control" id="links['+linksIndex+'][type_id]" name="links['+linksIndex+'][type_id]"> '+
                    '<option value="5001">Website</option>' +
                    '<option value="5002">Facebook</option>' +
                    '<option value="5003">Twitter</option>' +
                    '<option value="5004">Linkedin</option>' +
                    '<option value="5005">IM</option>'+
                    '</select></div></div><div class="col-md-8 typeSelect">' +
                    '<div class="for-group has-feedback input-group">' +
                    '<input class="form-control" type="text" id="links['+linksIndex+'][number]" name="links['+linksIndex+'][number]" maxlength="12"/>'+
                    '<span class="input-group-addon profile-label contact-addon"><a href="javascript:void(0);" class="remove" id="link'+ linksIndex +'"> X </span>' +
                    '</div></div></div></li><div class="clearfix"></div>';

            $('#links').append(number);
            }

        });

        // Add New Email section

        $('#addemail').click(function (e) {
            e.preventDefault();
            if (numOfEmails < 2) {
                numOfEmails++;
                emailIndex++;
                var number = '<li id="email'+emailIndex+'"><div class="form-group contactSelect">'+
                    '<div class="col-md-4 typeSelect"><div class="form-group">' +
                    '<select class="form-control" id="emails['+emailIndex+'][type_id]" name="emails['+emailIndex+'][type_id]"> '+
                    '<option value="4001">Work Email</option>' +
                    '<option value="4002">Home Email</option>' +
                    '</select></div></div><div class="col-md-8 typeSelect">' +
                    '<div class="for-group has-feedback input-group">' +
                    '<input class="form-control" type="text" id="emails['+emailIndex+'][address]" name="emails['+emailIndex+'][address]" maxlength="12"/>'+
                    '<span class="input-group-addon profile-label contact-addon"><a href="javascript:void(0);" class="remove" id="email'+emailIndex+'"> X </span>' +
                    '</div></div></div></li><div class="clearfix"></div>';

            $('ul#emails').append(number);
            }

        });

        // Add New Phones Section


        $('#addphone').click(function (e) {
            e.preventDefault();

            if (numOfPhones < 5) {
                numOfPhones++;
                phoneIndex++;
                var number = '<li id="phone'+phoneIndex+'"><div class="form-group contactSelect">'+
                    '<div class="col-xs-4 typeSelect"><div class="form-group">' +
                    '<select class="form-control" id="phones['+phoneIndex+'][type_id]" name="phones['+phoneIndex+'][type_id]"> '+
                    '<option value="6001">Work</option>' +
                    '<option value="6002">Mobile</option>' +
                    '<option value="6003">Fax</option>' +
                    '<option value="6004">Skype</option>' +
                    '<option value="6005">Home</option>'+
                    '</select></div></div><div class="col-xs-8 typeSelect">' +
                    '<div class="for-group has-feedback input-group">' +
                    '<input class="form-control" type="text" id="phones['+phoneIndex+'][number]" name="phones['+phoneIndex+'][number]" maxlength="12"/>'+
                    '<span class="input-group-addon profile-label contact-addon"><a href="javascript:void(0);" class="remove" id="phone'+phoneIndex+'">X</a></span>' +
                    '</div></div></div></li><div class="clearfix"></div>';
                $('ul#phones').append(number);
            }
        });
        // Remove Sections

        $(document).on("click", "a.remove" , function() {
            var section = $(this).attr('id');
            var sectionToCut = "li#" + section
            console.log(section.substring(0,4) + " " +numOfPhones+" "+numOfEmails+" "+numOfLinks);
            $(sectionToCut).remove();
            if (section.substring(0,4) == "phon") {
                numOfPhones--;
                console.log(numOfPhones);
            }
            if (section.substring(0,4) == "emai") {
                numOfEmails--;
            }
            if (section.substring(0,4) == "link") {
                numOfLinks--;
            }

        });

        $("#update").click(function(e) {
            e.preventDefault();

            var form = $('#profile').serializeJSON();
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

        })
    });
</script>
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