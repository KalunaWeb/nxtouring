<?php

include 'header.php';

?>

    <body id="background">

<?php
$query ="";
$t = 1;
$count = count($contact['member']['child_members']);
if ($count != 0) {
foreach ($contact['member']['child_members'] as $key=>$value) {
    $query .= "q[id_in][]=".$value['related_id'];

    if ($t < $count ) {
        $query .= "&";
    }
    $t++;

}
$driver = $current->getMultipleContactsById($query);

}

?>

    <div id="newcli-container">
        <div class="container">
            <div class="newcli-form">
                    <div class="row">
                        <div class="modal-header">
                            <h1 class="modal-title">
                                <?php if (isset($_SESSION['user_id'])){echo $contact['member']['name'];}?>
                            </h1>
                        </div>
                        <div class="col-md-12">
                                <legend>Drivers</legend>
                                <ul id="driversList">
                                <?php
                                if (isset($driver)){

                                foreach($driver['members'] as $key=>$value){
                                    echo '<li>
                                            <div class="col-md-2 profile_main">'.$value["name"].'</div>
                                            <div class="col-md-4 address">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <div class="address_label first">Address</div>
                                                </div>
                                                <div class="col-xs-8 address_detail">
                                                    <address>
                                                        <strong>';
                                    if(isset($value['primary_address']['street'])) {
                                        echo $value["primary_address"]["street"];}
                                        echo '</strong><br>';
                                    if(isset($value['primary_address']['city'])) {
                                        echo $value["primary_address"]["city"];}
                                        echo '<br>';
                                    if(isset($value['primary_address']['county'])) {
                                        echo $value["primary_address"]["county"];}
                                        echo '<br>';
                                    if(isset($value['primary_address']['postcode'])) {
                                        echo $value["primary_address"]["postcode"];}
                                        echo '</address>
                                                </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-xs-4">
                                                    <div class="address_label">Phone</div>
                                                </div>
                                                <div class="col-xs-8 address_detail">
                                                    <address>';
                                    if(isset($value['phones'][0]['number'])) {
                                        echo $value["phones"][0]["number"];}
                                        echo '</address>
                                                </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-xs-4">
                                                    <div class="address_label">Email</div>
                                                </div>
                                                <div class="col-xs-8 address_detail">
                                                    <address>';
                                    if(isset($value['emails'][0]['address'])) {
                                        echo $value["emails"][0]["address"];}
                                        echo '</address>
                                                </div>
                                                </div>
                                                </div>
                                                <div class="col-md-4 address">
                                                <div class="row">
                                                <div class="col-xs-4">
                                                    <div class="address_label">Licence Number</div>
                                                </div>
                                                <div class="col-xs-8 address_detail">
                                                    <address>';
                                    if(isset($value['custom_fields']['drivers_licence_number'])) {
                                        echo '********'.substr($value["custom_fields"]["drivers_licence_number"], -8);}
                                        echo '</address>
                                                </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="row">
                                                   <div class="col-xs-4">
                                                    <div class="address_label">Date of Birth</div>
                                                </div>
                                                <div class="col-xs-8 address_detail">
                                                    <address>';
                                    if(isset($value['custom_fields']['date_of_birth'])) {
                                        echo date("jS F Y", strtotime($value["custom_fields"]["date_of_birth"]));}
                                        echo '</address>
                                                </div></div>
                                                <div class="clearfix"></div>
                                                <div class="row">
                                                   <div class="col-xs-4">
                                                    <div class="address_label">Date of Test</div>
                                                </div>
                                                <div class="col-xs-8 address_detail">
                                                    <address>';
                                    if(isset($value['custom_fields']['date_of_test'])) {
                                        echo date("jS F Y", strtotime($value["custom_fields"]["date_of_test"]));}
                                        echo '</address>
                                                </div></div>
                                                <div class="clearfix"></div>
                                                <div class="row">
                                                   <div class="col-xs-4">
                                                    <div class="address_label status">Status</div>
                                                </div>
                                                <div class="col-xs-8 address_detail">
                                                    <address>';
                                    if(isset($value["active"]) && $value['active'] == 1) {
                                        echo '<span class="alert alert-success">Authorised</span>';} else {
                                        echo '<span class="alert alert-danger">Pending Authorisation</span>';}
                                        echo '</address>
                                                </div></div>
                                                <div class="clearfix"></div>
                                                </div>
                                                

                                <div class="section row"></div>
                                </li>';
                                }
                                } else {
                                    echo "No Drivers Set";
                                }
                                ?>

                            </ul>
                        </div>
                    </div>
                <div class="col-md-2 col-md-push-9">
                    <form action="newdriver.php">
                        <div class="form-group">
                            <button class="btn-default updateBtn" id="addDriver">Add New Driver</button>
                        </div>
                    </form>
                </div>
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
