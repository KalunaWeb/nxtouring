<?php

include 'header.php';

?>

    <body id="background">

<?php

$name = str_replace(" ", "%20", $contact['member']['name']);

$live = $current->getOpportunity($name, "live");
$archive = $current->getOpportunity($name, "inactive");
$old = array_reverse($archive['opportunities']);
$count = count($contact['member']['child_members']);
$client = json_encode($contact);
?>
<!-- jobs modal -->
<div class="modal about-modal fade" id="jobsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="jobName"></h4>
            </div>
            <div class="modal-body" id="jobBody">

            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
<!-- //jobs modal -->
<!-- Drivers modal -->
<div class="modal about-modal fade" id="driversModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="driverName">Name</h4>
            </div>
            <div class="modal-body" id="driverBody">
One fine body list
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
<!-- //Drivers modal -->
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
                <div class="col-md-3 profile_main">Live Orders</div>
                <div class="col-md-7 address">
                    <ul>
                        <li class="mobile-hidden">
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
                            $i =0;
                            foreach ($live['opportunities'] as $value=>$key) {

                                $items = json_encode($current -> getListItems($key['id']), JSON_UNESCAPED_SLASHES);
                                $opportunity = json_encode($live['opportunities'][$i]);
                                if ($x == 0) {
                                    $x =1;
                                } else {
                                    $x =0;
                                }
                                echo "<li class='mobile-show'>
                            <div class='row stripe'>
                            <div class='col-md-4 strip".$x."'><div class='row mobile-show mobile-bookings'><div class='col-xs-6'>Job Name</div>
                                <a class='link' href='#jobsModal' data-target='#jobsModal' data-toggle='modal' data-items='".$items."' data-opp='".$opportunity."' data-client='".$client."' data-age='new'><div class='col-xs-6'>".$key['subject']."</div></a></div>
                            </div>
                            <div class='col-md-3 strip".$x."'><div class='row mobile-show mobile-bookings'><div class='col-xs-6'>Start Date</div>
                                <a class='link' href='#jobsModal' data-target='#jobsModal' data-toggle='modal' data-items='".$items."' data-opp='".$opportunity."' data-client='".$client."' data-age='new'><div class='col-xs-6'>".date("d-m-Y",strtotime($key['starts_at']))."</div></a></div>
                            </div>
                            <div class='col-md-3 strip".$x."'><div class='row mobile-show mobile-bookings'><div class='col-xs-6'>End Date</div>
                                <a class='link' href='#jobsModal' data-target='#jobsModal' data-toggle='modal' data-items='".$items."' data-opp='".$opportunity."' data-client='".$client."' data-age='new'><div class='col-xs-6'>".date("d-m-Y",strtotime($key['ends_at']))."</div></a></div>
                            </div>
                            <div class='col-md-2 strip".$x."'><div class='row mobile-show mobile-bookings'><div class='col-xs-6'>Status</div>
                                <a class='link' href='#jobsModal' data-target='#jobsModal' data-toggle='modal' data-items='".$items."' data-opp='".$opportunity."' data-client='".$client."' data-age='new'><div class='col-xs-6'>".$key['state_name']."</div></a></div>
                            </div></div>
                        </li>
                        <li class='mobile-hidden'>
                                    <div class='row stripe'>
                                    <div class='col-md-4 strip".$x."'>
                                        <a class='link' href='#jobsModal' data-target='#jobsModal' data-toggle='modal' data-items='".$items."' data-opp='".$opportunity."' data-client='".$client."' data-age='new'><span>".$key['subject']."</span>
                                    </div>
                                    <div class='col-md-3 strip".$x."'>
                                        <span>".date("d-m-Y",strtotime($key['starts_at']))."</span>
                                    </div>
                                    <div class='col-md-3 strip".$x."'>
                                        <span>".date("d-m-Y",strtotime($key['ends_at']))."</span>
                                    </div>
                                    <div class='col-md-2 strip".$x."'>
                                        <span>".$key['status_name']."</span></a>
                                    </div></div>
                                </li>";
                                $i++;
                            }
                        } else {
                            echo "No bookings to display";
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="form-group has-feedback upload-details">
                <div class="col-md-3 profile_main">Archive Orders</div>
                <div class="col-md-7 address">
                    <ul>
                        <li class="mobile-hidden">
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
                            $i=0;
                            foreach ($old as $value=>$key) {

                                $items = json_encode($current -> getListItems($key['id']), JSON_UNESCAPED_SLASHES);
                                $opportunity = json_encode($old[$i]);
                                if ($x == 0) {
                                $x =1;
                                } else {
                                    $x =0;
                                }
                                echo "<li class='mobile-show'>
                            <div class='row stripe'>
                            <div class='col-md-4 strip".$x."'><div class='row mobile-show mobile-bookings'><div class='col-xs-6'>Job Name</div>
                                <a class='link' href='#jobsModal' data-target='#jobsModal' data-toggle='modal' data-items='".$items."' data-opp='".$opportunity."' data-client='".$client."' data-age='old'><div class='col-xs-6'>".$key['subject']."</div></a></div>
                            </div>
                            <div class='col-md-3 strip".$x."'><div class='row mobile-show mobile-bookings'><div class='col-xs-6'>Start Date</div>
                                <a class='link' href='#jobsModal' data-target='#jobsModal' data-toggle='modal' data-items='".$items."' data-opp='".$opportunity."' data-client='".$client."' data-age='old'><div class='col-xs-6'>".date("d-m-Y",strtotime($key['starts_at']))."</div></a></div>
                            </div>
                            <div class='col-md-3 strip".$x."'><div class='row mobile-show mobile-bookings'><div class='col-xs-6'>End Date</div>
                                <a class='link' href='#jobsModal' data-target='#jobsModal' data-toggle='modal' data-items='".$items."' data-opp='".$opportunity."' data-client='".$client."' data-age='old'><div class='col-xs-6'>".date("d-m-Y",strtotime($key['ends_at']))."</div></a></div>
                            </div>
                            <div class='col-md-2 strip".$x."'><div class='row mobile-show mobile-bookings'><div class='col-xs-6'>Status</div>
                                <a class='link' href='#jobsModal' data-target='#jobsModal' data-toggle='modal' data-items='".$items."' data-opp='".$opportunity."' data-client='".$client."' data-age='old'><div class='col-xs-6'>".$key['state_name']."</div></a></div>
                            </div></div>
                        </li>
                        <li class='mobile-hidden'>
                                    <div class='row stripe'>
                                    <div class='col-md-4 strip".$x."'>
                                        <a class='link' href='#jobsModal' data-target='#jobsModal' data-toggle='modal' data-items='".$items."' data-opp='".$opportunity."' data-client='".$client."' data-age='old'><span>".$key['subject']."</span>
                                    </div>
                                    <div class='col-md-3 strip".$x."'>
                                        <span>".date("d-m-Y",strtotime($key['starts_at']))."</span>
                                    </div>
                                    <div class='col-md-3 strip".$x."'>
                                        <span>".date("d-m-Y",strtotime($key['ends_at']))."</span>
                                    </div>
                                    <div class='col-md-2 strip".$x."'>
                                        <span>".$key['status_name']."</span></a>
                                    </div></div>
                                </li>";
                                $i++;
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

    <script>

        $.date = function(dateObject) {
            var d = new Date(dateObject);
            var day = d.getDate();
            var month = d.getMonth() + 1;
            var year = d.getFullYear();
            if (day < 10) {
                day = "0" + day;
            }
            if (month < 10) {
                month = "0" + month;
            }
            var date = day + "/" + month + "/" + year;

            return date;
        };



        $('a.link').on('click', function() {
            // pull data from the button clicked

            var el = $(this);
            var items = el.data('items');
            var opp = el.data('opp');
            var contact = el.data('client');
            var age = el.data('age');
            var name = opp['subject'];
            var number = opp['id'];
            var date = $.date(opp['created_at']);
            var invoiceSub = parseFloat(opp['charge_total']).toFixed(2);
            var invoiceTotal = parseFloat(opp['charge_including_tax_total']).toFixed(2);
            var vat = parseFloat(invoiceTotal-invoiceSub).toFixed(2);
            var driverHtml = "<div class='row'><div class='col-md-6'><ul><li><div class='row drivers'><div class='col-xs-12'><span><strong>Assigned Drivers</strong></span></div></div></li>";
            var html = "<div class='agileits-nxlayouts-info'><ul class='itemList'><li><div class='row'><div class='col-md-3 col-md-push-9 jobinfo'>Job Number: " + number;
            html += "</div></div><div class='row jobdate'><div class='col-md-3 col-md-push-9 jobinfo'>Date: "+date;
            html += "</div></div></li><li><div class='row'><div class='col-xs-6'><strong>Product</strong></div><div class='col-xs-3'><strong>Duration</strong></div><div class='col-xs-3'><strong>Cost</strong></div></div></li>";


            $('#jobName').html(name);


            console.log(items);
            console.log(opp);
            $.each(items['opportunity_items'],function(ref, index){

                //if there are items that are not client drivers
                if (index['item_id'] != null && index['item_id'] !== 42){
                    html+= "<li><div class='row'><div class='col-xs-6'>"+index['name']+" </div><div class='col-xs-3'> "+parseInt(index['chargeable_days'])+" days</div><div class='col-xs-3'> £"+parseFloat(index['charge_amount']).toFixed(2) + "</div></div></li>"
                }

                if (index['item_id'] != null && index['item_id'] === 42){

                    var allocated =0;
                    $.each(index['item_assets'], function(array, driver){

                        total = parseInt(index['quantity']);

                        if (driver['stock_level_asset_number'] !== "Group Booking") {
                            driverHtml += "<li><div class='col-xs-8 driverName drivers'><span>"+driver['stock_level_asset_number']+"</span></div></li>";

                        } else {
                            driverHtml += "<div>No drivers have been assigned<br></div>";
                        }
                        allocated++;
                    })
                    driverHtml += "</ul></div><div class='col-md-6'><div class='info'>There are " + allocated;
                    driverHtml += " of "+ total +" drivers allocated to this job.</div><div class='col-xs-6 col-xs-push-4 info'><button class='btn driverBtn' data-target='#driversModal' data-toggle='modal' >Add / Remove Drivers</button></div></div>";
                }


            });
                html += "<li><div class='row jobTotal'><div class='col-md-3 col-md-push-9 jobinfo'>Sub-Total: " + invoiceSub;
                html += "</div></div><div class='row'><div class='col-md-3 col-md-push-9 jobinfo'>Vat: "+vat;
                html += "</div></div><div class='row'><div class='col-md-3 col-md-push-9 jobinfo'><strong>Total: "+invoiceTotal+"</strong>";
                html += "</div></div></li><div class='section'></div>";

                html += driverHtml+"</ul>";
                $('#jobBody').html(html);
                console.log(contact);
                if (age === "old") {
                    $('.info').hide();
                }
        }
        )
    </script>