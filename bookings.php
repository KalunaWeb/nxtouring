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
            <legend>Current Bookings</legend>
            <div class="form-group has-feedback upload-details">
                <div class="col-md-3 profile_main">Current Bookings</div>
                <div class="col-md-7 address">
                    <ul>
                        <li>
                            <div class="row stripe">
                            <div class="col-md-4 strip0">
                                <span>Job Name</span>
                            </div>
                            <div class="col-md-3 strip0">
                                <span>Start Date</span>
                            </div>
                            <div class="col-md-3 strip0">
                                <span>End Date</span>
                            </div>
                            <div class="col-md-2 strip0">
                                <span>Status</span>
                            </div></div>
                        </li>
                        <?php
                        $x=0;
                        if ($live['meta']['total_row_count'] != 0) {
                            foreach ($live['opportunities'] as $value=>$key) {
                                if ($x == 0) {
                                    $x =1;
                                } else {
                                    $x =0;
                                }
                                echo "<li>
                            <div class='row stripe'>
                            <div class='col-md-4 strip".$x."'>
                                <span>".$key['subject']."</span>
                            </div>
                            <div class='col-md-3 strip".$x."'>
                                <span>".date("d-m-Y",strtotime($key['starts_at']))."</span>
                            </div>
                            <div class='col-md-3 strip".$x."'>
                                <span>".date("d-m-Y",strtotime($key['ends_at']))."</span>
                            </div>
                            <div class='col-md-2 strip".$x."'>
                                <span>".$key['state_name']."</span>
                            </div></div>
                        </li>";
                            }
                        } else {
                            echo "No bookings to display";
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="form-group has-feedback upload-details">
                <div class="col-md-3 profile_main">Archive Bookings</div>
                <div class="col-md-7 address">
                    <ul>
                        <li>
                            <div class="row stripe">
                            <div class="col-md-4 strip0">
                                <span>Job Name</span>
                            </div>
                            <div class="col-md-3 strip0">
                                <span>Start Date</span>
                            </div>
                            <div class="col-md-3 strip0">
                                <span>End Date</span>
                            </div>
                            <div class="col-md-2 strip0">
                                <span>Status</span>
                            </div>
                            </div>
                        </li>
                        <?php
                        if ($archive['meta']['total_row_count'] != 0) {
                            foreach ($old as $value=>$key) {
                                if ($x == 0) {
                                $x =1;
                                } else {
                                    $x =0;
                                }
                                echo "<li>
                                    <div class='row stripe'>
                                    <div class='col-md-4 strip".$x."'>
                                        <span>".$key['subject']."</span>
                                    </div>
                                    <div class='col-md-3 strip".$x."'>
                                        <span>".date("d-m-Y",strtotime($key['starts_at']))."</span>
                                    </div>
                                    <div class='col-md-3 strip".$x."'>
                                        <span>".date("d-m-Y",strtotime($key['ends_at']))."</span>
                                    </div>
                                    <div class='col-md-2 strip".$x."'>
                                        <span>".$key['status_name']."</span>
                                    </div></div>
                                </li>";
                            }
                        } else {
                            echo "No bookings to display";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </fieldset>
    </div>
                </div>
            </form>
        </div>
    </div>
</div>