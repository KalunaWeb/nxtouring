<?php

include 'header.php';

?>

    <body id="background">

<?php

$count = count($contact['member']['child_members']);
for ($i=0; $i<$count; $i++) {
  $driver[$i] = $current -> getContactById($contact['member']['child_members'][$i]['related_id']);
}

print_r($driver);
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
                                <?php

                                foreach($driver as $key=>$value){
                                    echo '<li>
                                          <div class="form-group has-feedback update-address">
                                          <div class="col-md-2 profile_main">'.$value["member"]["name"].'</div>
                                          <div class="col-md-4">
                                            <div class="form-group has-feedback">
                                                <div class="input-group">
                                                    <span class="input-group-addon profile-label">Street</span>
                                                    <input class="form-control" id="primary_address[street]" name="primary_address[street]" value="';
                                    if(isset($value['member']['primary_address']['street'])) {
                                        echo $value["member"]["primary_address"]["street"];}
                                        echo '"/>
                                                    </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                    <div class="input-group">
                                                        <span class="input-group-addon profile-label">Town</span>
                                                        <input class="form-control" type="text" id="primary_address[city]" name="primary_address[city]" value="';
                                    if(isset($value['member']['primary_address']['city'])) {
                                        echo $value["member"]["primary_address"]["city"];}
                                        echo '"/>
                                                        <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                                    </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <div class="input-group">
                                                            <span class="input-group-addon profile-label">County</span>
                                                            <input class="form-control" type="text" id="primary_address[county]" name="primary_address[county]" value="';
                                    if(isset($value['member']['primary_address']['county'])) {
                                        echo $value["member"]["primary_address"]["county"];}
                                        echo '"/>
                                                <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                            </div>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <div class="input-group">
                                                <span class="input-group-addon profile-label">Postcode</span>
                                                <input class="form-control" type="text" id="primary_address[postcode]" name="primary_address[postcode] value="';
                                    if(isset($value['member']['primary_address']['postcode'])) {
                                        echo $value["member"]["primary_address"]["postcode"];}
                                        echo '"/>
                                                <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                            </div>
                                        </div>
                                        <div class="form-group has-feedback">
                                                        <div class="input-group">
                                                            <span class="input-group-addon profile-label">Email</span>
                                                            <input class="form-control" type="text" id="emails[][address]" name="primary_address[county]" value="';
                                    if(isset($value['member']['emails'][0]['address'])) {
                                        echo $value["member"]["emails"][0]["address"];}
                                        echo '"/>
                                                <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                            </div>
                                        </div>
                                        <div class="form-group has-feedback">
                                                        <div class="input-group">
                                                            <span class="input-group-addon profile-label">Phone</span>
                                                            <input class="form-control" type="text" id="phones[][number]" name="primary_address[county]" value="';
                                    if(isset($value['member']['phones'][0]['number'])) {
                                        echo $value["member"]["phones"][0]["number"];}
                                        echo '"/>
                                                <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                            <div class="form-group has-feedback">
                                                <div class="input-group">
                                                    <span class="input-group-addon profile-label">Drivers Licence</span>
                                                    <input class="form-control" id="custom_fields[drivers_licence_number]" name="primary_address[street]" value="';
                                    if(isset($value['member']['custom_fields']['drivers_licence_number'])) {
                                        echo $value["member"]["custom_fields"]["drivers_licence_number"];}
                                        echo '"/>
                                                    </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                    <div class="input-group">
                                                        <span class="input-group-addon profile-label">Date Of Birth</span>
                                                        <input class="form-control" type="text" id="custom_fields[date_of_birth]" name="primary_address[city]" value="';
                                    if(isset($value['member']['custom_fields']['date_of_birth'])) {
                                        echo $value["member"]["custom_fields"]["date_of_birth"];}
                                        echo '"/>
                                                        <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                                    </div>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <div class="input-group">
                                                            <span class="input-group-addon profile-label">Date of Test</span>
                                                            <input class="form-control" type="text" id="custom_fields[date_of_test]" name="primary_address[county]" value="';
                                    if(isset($value['member']['custom_fields']['date_of_test'])) {
                                        echo $value["member"]["custom_fields"]["date_of_test"];}
                                        echo '"/>
                                                <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                            </div>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <div class="input-group">
                                                <span class="input-group-addon profile-label">N.I. Number</span>
                                                <input class="form-control" type="text" id="custom_fields[national_insurance_number]" name="primary_address[postcode] value="'.$value['member']['custom_fields']['national_insurance_number'].'"/>
                                                <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="section row"></div>
                                </li>';
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
