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
                <div class='agileits-nxlayouts-info'>
                    <div id="itemList"></div>
                    <div class='section'></div>
                    <div class='row'>
                        <div class='col-xs-7'>
                            <div id="driverList"></div>
                            <div id='nodriver'>No drivers have been assigned</div>
                        </div>
                        <div class='col-xs-5'>
                            <!--<div class="info">There are <span id="allocated"></span> of <span id="total"></span> drivers allocated to this job.</div>-->
                            <div class='info'>
                                <button class='btn driverBtn' id="driverBtn" data-toggle="modal" href="#driversModal">Add / Remove Drivers</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Close</span></button>
            </div>
        </div>
    </div>
</div>
<!-- //jobs modal -->
<!-- Drivers modal -->
<div class="modal about-modal fade" id="driversModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title">There are <span id="allocated"></span> drivers allocated to this job.<br>Maximum of <span id="total"></span> driver<span id="s"></span>.</h5>
            </div>
            <div class="modal-body" id="driverBody">
                <div id="driverSelect">
                    <div class="list-group">
                        <?php
                        if ($contact['member']['child_members']!= []) {

                        $driveList = [];
                        $query ="";
                        $t = 1;
                        foreach ($contact['member']['child_members'] as $key=>$value) {
                            $driveList[$t]['related_id'] = $value['related_id'];
                            $driveList[$t]['related_name'] = $value['related_name'];
                            $query .= "q[id_in][]=".$value['related_id'];
                            if ($t < $count ) {$query .= "&";}
                            $t++;
                        }
                        $query = $query . "&filtermode=all";

                        $driver = $current->getMultipleContactsById($query); /// if inactive make disabled

                        foreach ($driver['members'] as $key => $value) {
                            if (isset($value['icon']['thumb_url'])) {
                                $icon = $value['icon']['thumb_url'];
                            } else {
                                $icon = "images/avatar.png";
                            }
                            if ($value['active'] == null){
                                $active = " disabled";
                            } else {
                                $active ="";
                            }
                            echo "<div class='row'>
                                    <div class='col-xs-2'><img src='".$icon."' height='42px' width='42px'></div>
                                    <div class='col-xs-10'><button type='button' class='list-group-item list-group-item-action name".$active."' id='" . $value['id'] . "'>" . $value['name'] . "</button>
                                    <span class='glyphicon glyphicon-check check' id='check" . $value['id'] . "'></span></div>
                                  </div>";
                        }} else {
                            echo "<div class='row'>
                                    <div class='col-xs-12'><button type='button' class='list-group-item list-group-item-action name' id='redirect'>No Drivers Available.<br>Click to add drivers.</button>
                                    </div>
                                  </div>";
                        }
                        ?>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Close</span></button>
            </div>
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

                                $items=[];
                                $opportunity =[];

                                $totalitems = $current -> getListItems($key['id']);

                                foreach ($totalitems['opportunity_items'] as $x=>$oppItems) {

                                    $items['opportunity_items'][$x]['item_id'] = $oppItems['item_id'];
                                    $items['opportunity_items'][$x]['name'] = $oppItems['name'];
                                    $items['opportunity_items'][$x]['chargeable_days'] = $oppItems['chargeable_days'];
                                    $items['opportunity_items'][$x]['charge_amount'] = $oppItems['charge_amount'];
                                    $items['opportunity_items'][$x]['item_assets'] = $oppItems['item_assets'];
                                    $items['opportunity_items'][$x]['quantity'] = $oppItems['quantity'];
                                }
                                $items = json_encode($items, JSON_UNESCAPED_SLASHES);

                                $opportunity['subject'] = $live['opportunities'][$i]['subject'];
                                $opportunity['id'] = $live['opportunities'][$i]['id'];
                                $opportunity['created_at'] = $live['opportunities'][$i]['created_at'];
                                $opportunity['charge_total'] = $live['opportunities'][$i]['charge_total'];
                                $opportunity['charge_including_tax_total'] = $live['opportunities'][$i]['charge_including_tax_total'];
                                $opportunity['state'] = $live['opportunities'][$i]['state'];
                                $opportunity = json_encode($opportunity);
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
                                $items=[];
                                $opportunity =[];

                                $totalitems = $current -> getListItems($key['id']);

                                foreach ($totalitems['opportunity_items'] as $x=>$oppItems) {

                                $items['opportunity_items'][$x]['item_id'] = $oppItems['item_id'];
                                $items['opportunity_items'][$x]['name'] = $oppItems['name'];
                                $items['opportunity_items'][$x]['chargeable_days'] = $oppItems['chargeable_days'];
                                $items['opportunity_items'][$x]['charge_amount'] = $oppItems['charge_amount'];
                                $items['opportunity_items'][$x]['item_assets'] = $oppItems['item_assets'];
                                $items['opportunity_items'][$x]['quantity'] = $oppItems['quantity'];
                                }
                                $items = json_encode($items, JSON_UNESCAPED_SLASHES);

                                $opportunity['subject'] = $old[$i]['subject'];
                                $opportunity['id'] = $old[$i]['id'];
                                $opportunity['created_at'] = $old[$i]['created_at'];
                                $opportunity['charge_total'] = $old[$i]['charge_total'];
                                $opportunity['charge_including_tax_total'] = $old[$i]['charge_including_tax_total'];
                                $opportunity = json_encode($opportunity);

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
        $(document).ready(function () {

            $(document).on('show.bs.modal', '.modal', function (event) {
                var zIndex = 1040 + (10 * $('.modal:visible').length);
                $(this).css('z-index', zIndex);
                setTimeout(function() {
                    $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
                }, 0);
            });

        var allocated=0;
        var total =0;
        var ids = [];
        var s="";
        // Get the ids of each driver from the drop down

        $(function(){
            $('.name').each(function(){
                ids[ids.length] = $(this).attr('id');
            })
        });

        // Sort Out the date format

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

        $('#redirect').click(function(){
            window.location.href = "newdriver.php";
        })

        // check for click on the opportunity list

        $('a.link').on('click', function() {

            // Clean the drop down menu in case its not the first use
            $.each(ids, function(index, value){
                $('#'+ value).removeClass("list-group-item-info")
                $('#check'+ value).hide();
            });

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

            // add the opportunity id to the drivers in the drop down
            $('.name').attr('data-id', number);

            var html = "<ul><li><div class='row'><div class='col-md-3 col-md-push-9 jobinfo'>Job Number: <span>" + number;
            html += "</span></div></div><div class='row jobdate'><div class='col-md-3 col-md-push-9 jobinfo'>Date: "+date;
            html += "</div></div></li><li><div class='row'><div class='col-xs-6'><strong>Product</strong></div><div class='col-xs-3'><strong>Duration</strong></div><div class='col-xs-3'><strong>Cost</strong></div></div></li>";

            var driverHtml = "<ul id='dlist'><li><div class='row drivers'><div class='col-xs-12'><span><strong>Assigned Drivers</strong></span></div></div></li>";

            $('#jobName').html(name);

            // Go through each item on the opportunity

            $.each(items['opportunity_items'],function(ref, index){

                //if there are items that are not client drivers
                if (index['item_id'] != null && index['item_id'] !== 42){
                    html+= "<li><div class='row'><div class='col-xs-6'>"+index['name']+" </div><div class='col-xs-3'> "+parseInt(index['chargeable_days'])+" days</div><div class='col-xs-3'> £"+parseFloat(index['charge_amount']).toFixed(2) + "</div></div></li>"
                }

                // if there are items that are client drivers
                if (index['item_id'] != null && index['item_id'] === 42){
                    total = parseInt(index['quantity']);
                    if (total !== 1){
                        s = "s";
                    }
                    allocated =0;

                    $.each(index['item_assets'], function(array, driver){

                        if (driver['stock_level_asset_number'] !== "Group Booking") {
                            $.each(ids, function(index, value){

                                // if the driver is already allocated, change button colour
                               if (value == driver['stock_level_member_id']){
                                   $('#'+ value).addClass("list-group-item-info")
                                   $('#check'+ value).show();
                               }
                            });
                            $('#nodriver').hide();
                            driverHtml += "<li id='id"+driver['stock_level_member_id']+"'><div class='driverName drivers'><span>"+driver['stock_level_asset_number']+"</span></div></li>";
                            allocated++;
                        }

                    });
                    driverHtml += "</ul>";
                    $('#allocated').html(allocated);
                    $('#total').html(total);
                    $('#s').html(s);
                }
            });
                html += "<li><div class='row jobTotal'><div class='col-md-3 col-md-push-9 jobinfo'>Sub-Total: " + invoiceSub;
                html += "</div></div><div class='row'><div class='col-md-3 col-md-push-9 jobinfo'>Vat: "+vat;
                html += "</div></div><div class='row'><div class='col-md-3 col-md-push-9 jobinfo'><strong>Total: "+invoiceTotal+"</strong>";
                html += "</div></div></li></ul>";
                //html += driverHtml+"</ul>";
                $('#itemList').html(html);
                $('#driverList').html(driverHtml);

                if (age === "old" || opp['state'] !== 3) {
                    $('.info').hide();
                }
        })

        // Add / Remove Drivers


        $('.name').click(function(){
            var el = $(this);
            var driverId = $(el).attr('id');
            var oppId = el.data('id');
            var status ="";
            var driver = $('#'+driverId);



            if (driver.hasClass("list-group-item-info"))
            {
                driver.removeClass("list-group-item-info");
                $('#check'+driverId).hide();
                status = "remove";
            } else {
                if (allocated < total) {
                    driver.addClass("list-group-item-info");
                    $('#check'+driverId).show();
                    status = "add";
                }
            }

            $.ajax({
                url: 'add-remove-driver.php',
                method: 'post',
                data: {opp_id:oppId, id:driverId, status:status},
                success: function(data) {
                    var data = $.parseJSON(data);
                    console.log(data);
                    if (data.status==="added") {
                        $('#nodriver').hide();
                        $('ul#dlist').append("<li id=id"+data.id+"><div class='col-xs-8 driverName drivers'><span>"+data.name+"</span></div></li>");
                        allocated++;
                    }
                    if (data.status==="deleted") {

                        $('li#id'+data.id).remove();
                        allocated--;
                        if (allocated == 0) {
                            $('#nodriver').show();
                        }
                    }
                    $('#allocated').html(allocated);
                }
            });
        })
        });
    </script>