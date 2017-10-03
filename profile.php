<?php

require_once("classes.php");

include 'header.php';

?>

<body id="background">

<?php 

$name = str_replace(" ", "%20", $contact['member']['name']);

$live = $current->getOpportunity($name, "live");
$archive = $current->getOpportunity($name, "all");
$old = array_reverse($archive['opportunities']);
print_r ($old);

?>

<div class="container" id="main">
  <div class="row">
    <div id="profile-content">
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
      </div>

	</form>
    </div><!-- Content Div End -->
  </div> <!-- Row end --> 
</div>

     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/serializeJSON.js"></script>
    <script type="text/javascript" src="js/jquery_validate.js"></script>
    <script type="text/javascript" src="js/additional_methods.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

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