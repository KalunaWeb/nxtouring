<?php

include 'header.php';

?>

    <body id="background">

<?php
$id_array =[];
$count = count($contact['member']['child_members']);
if ($count != 0) {


    for ($i=0; $i<$count; $i++) {
        $driver[$i] = $current->getContactById($contact['member']['child_members'][$i]['related_id']);

    }

}

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
                                <legend>Drivers
                                </legend>
                                <ul>
                                    <li>

                                    </li>
                                <?php
                                if (isset($driver)){

                                foreach($driver as $key=>$value){
                                    echo '<li>
                                            <div class="col-md-2 profile_main">'.$value["member"]["name"].'</div>
                                            <div class="col-md-4 address">
                                                <div class="col-xs-4">
                                                    <div class="address_label">Address<br><br><br><br><br>Phone<br>Email</div>
                                                </div>
                                                <div class="col-xs-8 address_detail">
                                                    <address>
                                                        <strong>';
                                    if(isset($value['member']['primary_address']['street'])) {
                                        echo $value["member"]["primary_address"]["street"];}
                                        echo '</strong><br>';
                                    if(isset($value['member']['primary_address']['city'])) {
                                        echo $value["member"]["primary_address"]["city"];}
                                        echo '<br>';
                                    if(isset($value['member']['primary_address']['county'])) {
                                        echo $value["member"]["primary_address"]["county"];}
                                        echo '<br>';
                                    if(isset($value['member']['primary_address']['postcode'])) {
                                        echo $value["member"]["primary_address"]["postcode"];}
                                        echo '<br><br><abbr title="Phone">Phone:</abbr> ';
                                    if(isset($value['member']['phones'][0]['number'])) {
                                        echo $value["member"]["phones"][0]["number"];}
                                        echo '</address>
                                                </div>
                                                </div>
                                                <div class="col-md-4 address">
                                                <div class="col-xs-4">
                                                    <div class="address_label">Licence Number<br><br>Date of Birth<br><br>Date of Test<br><br>Status</div>
                                                </div>
                                                <div class="col-xs-8 address_detail">
                                                    <address>';
                                    if(isset($value['member']['custom_fields']['drivers_licence_number'])) {
                                        echo '********'.substr($value["member"]["custom_fields"]["drivers_licence_number"], -8);}
                                        echo '<br><br>';
                                    if(isset($value['member']['custom_fields']['date_of_birth'])) {
                                        echo date("jS F Y", strtotime($value["member"]["custom_fields"]["date_of_birth"]));}
                                        echo '<br><br>';
                                    if(isset($value['member']['custom_fields']['date_of_test'])) {
                                        echo date("jS F Y", strtotime($value["member"]["custom_fields"]["date_of_test"]));}
                                        echo '</address>
                                                </div>
                                                </div>
                                                

                                <div class="section row"></div>
                                </li>';
                                }
                                } else {
                                    echo "No Drivers Set";
                                }
                                ?>

                            </ul>
                                <div class="section row"></div>
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
