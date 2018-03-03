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
?>
<style>

    /*span.input-group-addon.profile-label{
        border-top: 1px solid #eee
    }*/
    input.form-control {
        border: none
    }
    .full {
        padding: 0;
    }
    .input-group-addon {
        background-color: #fff;
        border: none;
        min-width: 0;
    }
    .profile-label {
        min-width: 80px;
    }
    .col-md-3, .col-md-4, .col-md-2 {
        padding: 0;
    }
    .container {
        padding-right: 15px;
        padding-left: 15px;
    }
    .has-feedback .form-control{
        padding-right: 0;
    }
    .form-control {
        border: none;
        -webkit-appearance: none;
        box-shadow: none !important;
    }
    select, .contactSelect select{
        background-color: #fff;


        background-image:
            linear-gradient(45deg, transparent 50%, gray 50%),
            linear-gradient(135deg, gray 50%, transparent 50%);
        background-position:
            calc(100% - 20px) calc(1em + 2px),
            calc(100% - 15px) calc(1em + 2px),
            calc(100% - 2.5em) 0.5em;
        background-size:
            5px 5px,
            5px 5px,
            1px 1.5em;
        background-repeat: no-repeat;
    }

    select.contactSelect:focus {
        background-image:
            linear-gradient(45deg, green 50%, transparent 50%),
            linear-gradient(135deg, transparent 50%, green 50%),
            linear-gradient(to right, #ccc, #ccc);
        background-position:
            calc(100% - 15px) 1em,
            calc(100% - 20px) 1em,
            calc(100% - 2.5em) 0.5em;
        background-size:
            5px 5px,
            5px 5px,
            1px 1.5em;
        background-repeat: no-repeat;
        border-color: green;
        outline: 0;
    }
    .updateBtn {
        margin-top: 20px;
        width: 100%;
    }

    .addBtn {
        width: 33%
    }
    .address_label, .address_detail, .drive {
        background-color: #fff;
    }

    .profile_main {
        margin-top:15px;
        margin-bottom: 10px;
    }



</style>
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
                                            <input class="form-control" id="primary_address[street]" name="primary_address[street]"
                                            <?php if (isset($_SESSION['user_id'])){
                                                echo 'value="'.$contact['member']['primary_address']['street'].'"';
                                            }?>
                                        </>
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
                                                    if (isset($_SESSION['user_id'])) {
                                                        echo 'value="' . $value['number'] . '"';
                                                    };
                                                    echo '/><span class="input-group-addon contact-addon"><a href="javascript:void(0);" class="remove" id="phone'.$p.'">X</a></span>
                                                             <input type="hidden" id="'.$id.'" name="'.$id.'" value="'.$value['id'].'" /> 
                                                             </div>
                                                             </div>
                                                             </div>
                                                             </li>';
                                                    $p++;
                                                }
                                            }?>
                                        </ul>
                                    </div>
                                    <button class="btn-default addBtn" id="addphone" type="submit" value="Add">Add Phone</button>
                                    <div id="emailsWrapper">
                                        <ul id="emails"><!-- Emails Select -->
                                            <?php if (isset($_SESSION['user_id'])) {
                                                $e = 0; // Emails array index
                                                foreach ($contact['member']['emails'] as $key => $value) {
                                                    $email = "emails[" . $e . "][address]"; // Email Address
                                                    $id = "emails[" . $e . "][id]"; // ID of individual record for editing
                                                    $type = "emails[".$e."][type_id]"; // ID number of the email type
                                                    echo '<li id="email'.$e.'"><div class="form-group contactSelect"><div class="col-md-4 typeSelect">
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
                                                    if (isset($_SESSION['user_id'])) {
                                                        echo 'value="' .$value['address']. '"';
                                                    };
                                                    echo '/><span class="input-group-addon contact-addon"><a href="javascript:void(0);" class="remove" id="email'.$e.'">X</a></span><input type="hidden" id="'.$id.'" name="'.$id.'" value="'.$value['id'].'" />
                                                          </div>
                                                          </div>
                                                          </div>
                                                          </li>';
                                                    $e++;
                                                }
                                            }?>
                                        </ul>
                                    </div>
                                    <button class="btn-default addBtn" id="addemail" type="submit" value="Add">Add Email</button>
                                    <div id="linksWrapper">
                                        <ul id="links"><!-- Social Media Select -->
                                            <?php if (isset($_SESSION['user_id'])) {
                                                $l = 0; // Links array index
                                                foreach ($contact['member']['links'] as $key => $value) {
                                                    $link = "links[" . $l . "][address]"; // Link Address
                                                    $id = "links[" . $l . "][id]"; // ID of individual record for editing
                                                    $type = "links[".$l."][type_id]"; // ID number of the Link type
                                                    echo '<li id="link'.$l.'"><div class="form-group contactSelect"><div class="col-md-4 typeSelect">
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
                                                            <input class="form-control" type="text" id="'.$link.'" name="'.$link.'" ';
                                                    if (isset($_SESSION['user_id'])) {
                                                        echo 'value="' .$value['address']. '"';
                                                    };
                                                    echo '/><span class="input-group-addon contact-addon"><a href="javascript:void(0);" class="remove" id="link'.$l.'">X</a></span><input type="hidden" id="'.$id.'" name="'.$id.'" value="'.$value['id'].'" />
                                                         </div>
                                                         </div>
                                                         </div>
                                                         </li>';
                                                    $l++;
                                                }
                                            }?>
                                        </ul>
                                    </div>
                                    <button class="btn-default addBtn" id="addlink" type="submit" value="Add">Add Link</button>
                                </div>
                            </div>
                    <div class="section row"></div>
                    <div class="form-group has-feedback update-address">
                        <div class="col-md-3 profile_main">Licence Details</div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <span class="input-group-addon profile-label">Licence Number</span>
                                    <input class="form-control" id="custom_fields[drivers_licence_number]" name="custom_fields[drivers_licence_number]"/>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <span class="input-group-addon profile-label">Date of Birth</span>
                                    <input class="form-control" type="text" id="dob" name="custom_fields[date_of_birth]"/>
                                    <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <span class="input-group-addon profile-label">Date of Test</span>
                                    <input class="form-control" type="text" id="dot" name="custom_fields[date_of_test]"/>
                                    <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <span class="input-group-addon profile-label">N.I. Number</span>
                                    <input class="form-control code-group" type="text" id="custom_fields[national_insurance_number]" name="custom_fields[national_insurance_number]"/>
                                    <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div id="dvla" class="input-group">
                                    <span class="input-group-addon profile-label">D.V.L.A. Code</span>
                                    <input class="form-control code-group" type="text" id="custom_fields[dvla_code]" name="custom_fields[dvla_code]"/>
                                    <span class="feedback form-control-feedback glyphicon glyphicon-ok"></span>
                                </div>
                            </div>
                            <input type="hidden" id="parent_id" name="parent_id" value="<?php echo $_SESSION['user_id'];?>"/>
                            <input type="hidden" id="store_ids" name="store_ids" value="<?php echo $contact['member']['membership']['owned_by'];?>"/>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="section"></div>
                <fieldset>
                    <div class="col-md-3 profile_main"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-2 col-xs-12">
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