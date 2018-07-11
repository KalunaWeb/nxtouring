<?php

require_once 'header.php';
$arr = $current -> getProductList();

foreach ($arr['products'] as $value=>$key) {
    $index = $arr['products'][$value]['custom_fields']['order'];
    $id[$index] = $arr['products'][$value]['id'];
    $name[$index]= $arr['products'][$value]['name'];
    $price[$index] = floor($arr['products'][$value]['rental_rate']['price']);
    $url[$index] = $arr['products'][$value]['icon']['url'];
    $seats[$index] = $arr['products'][$value]['custom_fields']['seats'];
    $size[$index] = $arr['products'][$value]['custom_fields']['size'];
    $licence[$index] = $arr['products'][$value]['custom_fields']['licence'];
    $deposit[$index] = $arr['products'][$value]['custom_fields']['deposit'];
    $weight[$index] = $arr['products'][$value]['custom_fields']['max_weight'];
    $main[$index] = $arr['products'][$value]['description'];
    $thumb_url[$index] = $arr["products"][$value]["icon"]["thumb_url"];

};

require_once 'modals.php';

?>
	<div class="banner-top">
		<div class="slider">
			<div class="callbacks_container">
				<ul class="rslides callbacks callbacks1" id="slider4">
                    <?php

                    $i= 1;
                    while ($i <= $arr['meta']['total_row_count']) {

                        echo'
                    <li>
                        <div class="nxlayouts-banner-top" style="background: url('.$url[$i].') no-repeat center; background-size: cover;">
                            <div class="container">

                                <div class="agileits-banner-info jarallax">

                                    <div class="agile-title">

                                        <div class="nxl-price"><p></p><span class="sicon">£'.$price[$i].'</span><p>+ vat / day</p></div>

                                        <h3>'.$name[$i].'</h3>

                                    </div>

                                </div>

                            </div>
                            
                        </div>
                    </li>';
                        $i++;
                    };?>
				</ul>
			</div>
			<div class="clearfix"> </div>
			<script src="js/responsiveslides.min.js"></script>
			<script>
						// You can also use "$(window).load(function() {"
						$(function () {
						  // Slideshow 4
						  $("#slider4").responsiveSlides({
							auto: true,
							pager:true,
							nav:false,
							speed: 500,
							namespace: "callbacks",
							before: function () {
							  $('.events').append("<li>before event fired.</li>");
							},
							after: function () {
							  $('.events').append("<li>after event fired.</li>");
							}
						  });
					
						});
			</script>
		</div>
	</div>


<!-- about -->
<div class="nxlayouts-about" id="about">
	<div class="container">
		<div class="nx-about-grids">

			<div class="col-md-5 col-md-push-4 nx-about-left">
				<h1>Welcome to NX Touring Ltd</h1>
				<h5>Luxury tour vehicle hire.</h5>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nisl nunc, feugiat a nulla euismod, porta vehicula nisi. Praesent molestie, elit at mattis euismod, risus augue lacinia sem, vel elementum dui sem eu nisi. Morbi eu condimentum nibh. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. <span>Donec leo orci, tempus ac porta sit amet, pulvinar ac ante. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque in mauris vel lectus aliquet imperdiet at in metus. Sed tristique, ante quis varius rhoncus, turpis nisl suscipit neque, id sollicitudin tellus purus a augue. Integer urna ex, vehicula eget tincidunt et, scelerisque non massa. Nulla convallis sodales diam, non laoreet purus.<br><br></span></p>
				<div class="more-button">
					<a href="#" data-toggle="modal" data-target="#myModal">More</a>
				</div>
			</div>
            <div class="col-md-4 col-lg-3 col-md-push-4 nx-about-left">
                <form class="form" id="searchForm">
                    <div id="searchBox">
                        <h3 class="nxl-head text-center">Check Availability</h3>
                    <div class="">
                        <div class="form-group">
                            <label for="start">Collection Date <span class="small">(From 9 a.m.)</span></label>
                            <input type="text" class="form-control" id="start" name="startDate" readonly="true"/>
                        </div>
                        <div class="form-group">
                            <label for="end">Return Date <span class="small">(Before 10 a.m.)</span></label>
                            <input type="text" class="form-control" id="end" name="endDate" readonly="true"/>
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <select class="form-control" id="location" name="location">
                                <option value="1">Bedford</option>
                                <option value="2">Stoke on Trent</option>
                                <option value="3">Maidstone</option>
                            </select>
                        </div>
                            <button type="submit" class="btn" id="searchBtn" data-target="#searchModal" role="button" data-toggle="modal">Search</button>
                    </div>
                </form>
            </div>
        </div>

            <div class="col-md-3 col-lg-4 col-md-pull-8 nx-about-left">
                <section class="slider">
                    <div id="slider" class="flexslider">
                        <ul class="slides">
                            <li>
                                <img src="images/2a.jpg" alt="" />
                            </li>
                            <li>
                                <img src="images/1a.jpg" alt="" />
                            </li>
                            <li>
                                <img src="images/4a.jpg" alt="" />
                            </li>
                            <li>
                                <img src="images/6a.jpg" alt="" />
                            </li>
                            <li>
                                <img src="images/8.jpg" alt="" />
                            </li>
                            <li>
                                <img src="images/4a.jpg" alt="" />
                            </li>
                            <li>
                                <img src="images/5a.jpg" alt="" />
                            </li>
                            <li>
                                <img src="images/7a.jpg" alt="" />
                            </li>
                            <li>
                                <img src="images/3a.jpg" alt="" />
                            </li>
                            <li>
                                <img src="images/7.jpg" alt="" />
                            </li>
                        </ul>
                    </div>
                    <div id="carousel" class="flexslider">
                        <ul class="slides">
                            <li>
                                <img src="images/2a.jpg" alt="" />
                            </li>
                            <li>
                                <img src="images/1a.jpg" alt="" />
                            </li>
                            <li>
                                <img src="images/4a.jpg" alt="" />
                            </li>
                            <li>
                                <img src="images/6a.jpg" alt="" />
                            </li>
                            <li>
                                <img src="images/8.jpg" alt="" />
                            </li>
                            <li>
                                <img src="images/4a.jpg" alt="" />
                            </li>
                            <li>
                                <img src="images/5a.jpg" alt="" />
                            </li>
                            <li>
                                <img src="images/7a.jpg" alt="" />
                            </li>
                            <li>
                                <img src="images/3a.jpg" alt="" />
                            </li>
                            <li>
                                <img src="images/7.jpg" alt="" />
                            </li>
                        </ul>
                    </div>
                </section>
            </div>
        <div class="clearfix"> </div>

	</div>
</div>
</div>


<script>
    var dateNow = new Date();
    $('#start').daterangepicker({
        ignoreReadonly: true,
        allowInputToggle: true,
        "autoApply": true,
        "singleDatePicker": true,
        "timePicker": true,
        "timePicker24Hour": true,
        "timePickerIncrement": 60,
        minDate: moment(dateNow).hours(8).minutes(0).seconds(0).milliseconds(0),
        startDate: moment(dateNow).hours(9).minutes(0).seconds(0).milliseconds(0),
        locale: {
            format: "DD MMMM YYYY    h:mm a",
            firstDay: 1
        }
    });

    $('#end').daterangepicker({
        ignoreReadonly: true,
        allowInputToggle: true,
        "autoApply": true,
        "singleDatePicker": true,
        "timePicker": true,
        "timePicker24Hour": true,
        "timePickerIncrement": 60,
        minDate: moment(dateNow).hours(9).minutes(0).seconds(0).milliseconds(0),
        startDate: moment(dateNow).hours(10).minutes(0).seconds(0).milliseconds(0).add(1,'days'),
        locale: {
            format: "DD MMMM YYYY    h:mm a",
            firstDay: 1
        }
    });

    $('#start').on('apply.daterangepicker', function(ev, picker) {


        var new_min =  picker.startDate.clone().add(1, 'days');
        var new_start = new_min.hours(10);
        $('#end').daterangepicker({
            ignoreReadonly: true,
            allowInputToggle: true,
            "autoApply": true,
            "singleDatePicker": true,
            "timePicker": true,
            "timePicker24Hour": true,
            "timePickerIncrement": 60,
            minDate: new_min,
            startDate: new_start,
            locale: {
                format: "DD MMMM YYYY    h:mm a",
                firstDay: 1
            }
        });

    });

    $('#searchModal').on('shown.bs.modal', function() {
        $("#searchResults").html("Loading...");
        var form = $('#searchForm').serializeJSON();
        var jdata = JSON.stringify(form);

        $.ajax({
            url: 'searchBox.php',
            method: 'post',
            dataType: 'json',
            data: jdata,
            success: function(data) {
                $("#searchResults").html(data);
            }
        });
    });

    $('#searchModal').on('click', '.vanSelect', function() {
        // pull data from the button clicked

        var el = $(this);
        var vanurl = el.data('van-url');
        var id = el.data('van-id');
        var start = el.data('van-start');
        var end = el.data('van-end');
        var period = el.data('van-period');
        var store = el.data('van-store');
        var name = el.data('van-name');
        var price = el.data('van-price');
        var days = el.data('van-days');
        var hirefee = el.data('van-hirefee');

        // Create Form and append it to the body

        var $form = $("<form/>").attr("id", "searchForm")
            .attr("action", vanurl)
            .attr("method", "post");
        $("body").append($form);

        // Add values to be sent

        AddParameter($form, "prod_type", name);
        AddParameter($form, "startDate",start);
        AddParameter($form, "type_id",id);
        AddParameter($form, "endDate", end);
        AddParameter($form, "days", period);
        AddParameter($form, "price", price);
        AddParameter($form, "store", store);
        AddParameter($form, "cdays", days);
        AddParameter($form, "hirefee", hirefee);
        // Send the form

        $form[0].submit();

  });

function AddParameter(form, name, value) {
    var input = $("<input />").attr("type", "hidden")
        .attr("name", name)
        .attr("value", value);

    form.append(input);

}

    $("#searchForm").submit(function(e){
        e.preventDefault(e);
    });

   $('#searchForm').validate({
        rules: {
            artistName: {
                required: true,
                minlength: 2,
                maxlength: 40
            }
        },
        messages: {
            artistName: {
                required: "Please enter a the Artists Name",
                minlength: "Artist Name must be at least {0} characters long"
            }
        },
        highlight: function(element, errorClass, validClass) {
            $(element).nextAll('.form-control-feedback').show().removeClass('glyphicon-ok').addClass('glyphicon-remove');
            $(element).addClass(errorClass).removeClass(validClass);
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            $(element).nextAll('.form-control-feedback').show().removeClass('glyphicon-remove').addClass('glyphicon-ok');
            element.closest('.form-group').removeClass('has-error').addClass('has-success');
            $(element).remove();
        },
        onkeyup: false, //turn off auto validate whilst typing
        submitHandler: function (form) {
            $('#searchModal').modal('show');
        }
    });
</script>
<!-- //about -->
	<!-- vans -->	
<div class="vans jarallax" id="vans">
	<div class="container">
			<h1 class="nxl-head text-center">Vans</h1>
			<div class="nx-package-grids">

<?php 

$i= 1;
while ($i <= $arr['meta']['total_row_count']) {

	echo '<div class="col-md-4 col-sm-4 col-xs-6 text-center pricing">
		  
		  <div class="price-top">
			<a href="#" data-toggle="modal" data-target="#vanModal'.$i.'"><img src="'.$url[$i].'" alt="" class="img-responsive"/>
			<h3>'.$name[$i].'</h3></div></a>
		  </div>';
	$i++;
};?>

				<div class="clearfix"></div>
			</div>
    </div>	
</div>	
<!-- vans -->

<div class="container" id="searchContainer"></div>


	<div class="downloads jarallax" id="downloads">
		<div class="container">
			<h3 class="text-center">Downloads</h3>
			<div class="nx_services_grids">

                <div class="col-md-offset-1 col-md-4">
                    <ul>
                        <li>
                            <span class="">
                                <a href="pdf-display.php?file=Terms and Conditions of Hire&path=pdf/"><img src="images/a.jpg" alt=" " class="download_icon">
                            <h4 class="download_text">Terms and Conditions</h4></a></span>
                        </li>
                        <li>
                            <span class="">
                                <a href="pdf-display.php?file=Splitter Hire Agreement Form&path=pdf/"><img src="images/a.jpg" alt=" " class="download_icon">
                            <h4 class="download_text">Hire Agreement</h4></a></span>
                        </li>
                        <li>
                            <span class="">
                                <a href="pdf-display.php?file=Confirmation Deposit Form&path=pdf/"><img src="images/a.jpg" alt=" " class="download_icon">
                            <h4 class="download_text">Credit Card Deposit Form</h4></a></span>
                        </li>
                         <li>
                            <span class="">
                                <a href="pdf-display.php?file=Terms and Conditions of Hire&path=pdf/"><img src="images/a.jpg" alt=" " class="download_icon">
                            <h4 class="download_text">Damage Form</h4></a></span>
                        </li>
                         <li>
                            <span class="">
                                <a href="pdf-display.php?file=Terms and Conditions of Hire&path=pdf/"><img src="images/a.jpg" alt=" " class="download_icon">
                            <h4 class="download_text">Hirers Responsibilities</h4></a></span>
                        </li>
                    </ul>
                </div>


                <div class="col-md-offset-2 col-md-4">
                    <ul>
                        <li>
                            <span class="">
                                <a href="pdf-display.php?file=Terms and Conditions of Hire&path=pdf/"><img src="images/a.jpg" alt=" " class="download_icon">
                            <h4 class="download_text">Mini Splitter Van Spec</h4></a></span>
                        </li>
                        <li>
                            <span class="">
                                <a href="pdf-display.php?file=Splitter Hire Agreement Form&path=pdf/"><img src="images/a.jpg" alt=" " class="download_icon">
                            <h4 class="download_text">Standard Splitter Van Spec</h4></a></span>
                        </li>
                        <li>
                            <span class="">
                                <a href="pdf-display.php?file=Confirmation Deposit Form&path=pdf/"><img src="images/a.jpg" alt=" " class="download_icon">
                            <h4 class="download_text">Luxury Splitter Van Spec</h4></a></span>
                        </li>
                        <li>
                            <span class="">
                                <a href="pdf-display.php?file=Terms and Conditions of Hire&path=pdf/"><img src="images/a.jpg" alt=" " class="download_icon">
                            <h4 class="download_text">Large Splitter Van Spec</h4></a></span>
                        </li>
                        <li>
                            <span class="">
                                <a href="pdf-display.php?file=Terms and Conditions of Hire&path=pdf/"><img src="images/a.jpg" alt=" " class="download_icon">
                            <h4 class="download_text">Gear Van Spec</h4></a></span>
                        </li>
                    </ul>
                </div>

                <div class="clearfix"> </div>
            </div>
		</div>
	</div>
<!-- //downloads -->
<!-- testimonials -->
	<div class="testimonials jarallax" id="testimonials">
		<div class="container">
			<h3 class="nxl-head text-center">Testimonials</h3>
		</div>
		<div class="nx_testimonials_grids nx_testimonials_grids">
			<div id="owl-demo" class="owl-carousel"> 
				<div class="item nx_agileits_testimonials_grid">
					<img src="images/t2.jpg" alt=" " class="img-responsive" />
					<h4>Christopher</h4>
					<p>Donec quis turpis pellentesque justo pulvinar scelerisque placerat mattis enim.</p>
				</div>
				<div class="item nx_agileits_testimonials_grid">
					<img src="images/t1.jpg" alt=" " class="img-responsive" />
					<a href="https://www.facebook.com/paul.furssedonn?hc_ref=ARS50cK8pck83ODDE2nP3sC-Fo3x3x3TgYiCbzPy0cXFGfLmGdLUl8qSlXn7D_vIwP4"><h4>Paul Furssedonn</h4></a>
					<p>On behalf of Eternal Fear and crew, thank you for a great vehicle and fantastic service. Look forward to hiring from you again </p>
				</div>
				<div class="item nx_agileits_testimonials_grid">
					<img src="images/t2.jpg" alt=" " class="img-responsive" />
					<a href="https://www.facebook.com/aaron.james.568847?hc_ref=ARTRja3lMyqCgakWTm2EQkP_PcFaIjrkQp75qqNVKbIHFhdAMzq34eSGW4T7RpltRqc"><h4>Aaron Paul</h4></a>
					<p>Crackin' van, plenty of space - clean and tidy, exceptionally accommodating and very helpful with van pick up and drop off! Couldn't have asked for a better service - thanks bud!</p>
				</div>
				<div class="item nx_agileits_testimonials_grid">
					<img src="images/t3.jpg" alt=" " class="img-responsive" />
					<a href="https://www.facebook.com/james.burton.581730?hc_ref=ARQ0dU-AK8lY3ky5madetGERlgkY6NeXZHGQrf0N10-jnASz4EL6kpP1MdugTOlCctI"><h4>James Burton</h4></a>
					<p>Have used NX a couple of times. Really easy, friendly and helpful. The van we used is gorgeous. Xbox, TV and so much space! Better than staying in the Hilton.</p>
				</div>
				<div class="item nx_agileits_testimonials_grid">
					<img src="images/t1.jpg" alt=" " class="img-responsive" />
					<h4>Jessica</h4>
					<p>Donec quis turpis pellentesque justo pulvinar scelerisque placerat mattis enim.</p>
				</div>
				<div class="item nx_agileits_testimonials_grid">
					<img src="images/t2.jpg" alt=" " class="img-responsive" />
					<h4>Christopher</h4>
					<p>Donec quis turpis pellentesque justo pulvinar scelerisque placerat mattis enim.</p>
				</div>
				<div class="item nx_agileits_testimonials_grid">
					<img src="images/t1.jpg" alt=" " class="img-responsive" />
					<a href="https://www.facebook.com/paul.furssedonn?hc_ref=ARS50cK8pck83ODDE2nP3sC-Fo3x3x3TgYiCbzPy0cXFGfLmGdLUl8qSlXn7D_vIwP4"><h4>Paul Furssedonn</h4></a>
					<p>On behalf of Eternal Fear and crew, thank you for a great vehicle and fantastic service. Look forward to hiring from you again </p>
				</div>

			</div>
		</div>
	</div>
<!-- //testimonials -->

<!--contact -->
<?php
$a = rand(0,9);
$b = rand(0,9);
?>
<div class="contact jarallax" id="contact">
		<div class="container">
			<h3 class="nxl-head text-center">contact us</h3>
			<div class="agileits_nxlayouts-contact">
				<div class="col-md-6 col-sm-12 agileinfo-contact-left">
					<div class="nxls-address">
						<span class="fa fa-map-marker icon" aria-hidden="true"></span>
						<h6>Address:</h6><p>2 Great North Road, Chawston, Beds. MK44 3BD</p>
					</div>
					<div class="nxls-address mail">
						<span class="fa fa-envelope icon" aria-hidden="true"></span>
						<h6>Mail:</h6><a href="mailto:info@example.com">info@nxtouring.co.uk</a>
					</div>
					<div class="nxls-address">
						<span class="fa fa-phone icon" aria-hidden="true"></span>
						<h6>Phone:</h6><p>07771 767367</p>
					</div>
					<form id="contactForm">
                        <div class="form-group has-feedback col-md-6 front">
                            <input class="form-control" type="text" id="cont_name" name="cont_name" placeholder="Name"/>
                            <span class="feedback form-control-feedback captcha-feedback glyphicon glyphicon-ok"></span>
                        </div>
                        <div class="form-group has-feedback col-md-6 front">
                            <input class="form-control" type="text" id="cont_mail" name="cont_mail" placeholder="Email"/>
                            <span class="feedback form-control-feedback captcha-feedback glyphicon glyphicon-ok"></span>
                        </div>
                        <div class="form-group has-feedback col-md-12 front">
						<textarea placeholder="Your Message" name="con_msg" id="con_msg"></textarea>
                            <span class="feedback form-control-feedback captcha-feedback glyphicon glyphicon-ok"></span>
                        </div>

                        <div class="form-group col-xs-8 front">
                            <div class="input-group">
                                <div class="input-group-addon">What is <?php echo $a ." + " . $b ?> ?</div>
                                <input class="form-control" type="text" id="cont_val" name="cont_val" maxlength="2"/>
                                <span class="feedback2 form-control-feedback glyphicon glyphicon-ok"></span>
                            </div>



                        </div>
                        <button class="button" name="send" id="send">SEND</button>
					</form>	
				</div>
				<div class="col-md-6 col-sm-12  agileits_nxlayouts-map">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9783.41583251746!2d-0.3067820964797418!3d52.19152726817355!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4877c6026352dd79%3A0x6705a6588544a90c!2sNX+Touring+Ltd!5e0!3m2!1sen!2suk!4v1504910197018" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
</div>
<script>
var a = <?php echo $a;?>;
var b = <?php echo $b;?>;

    $(document).ready(function () {
    /*$("#contactForm").submit(function(e){
        e.preventDefault(e);
    });*/

    $("#contactForm").validate({
        rules: {
            cont_name: {
                required: true,
                minlength: 2,
                maxlength: 40
            },
            cont_mail: {
                required: true,
                email: true
            },
            con_msg: {
            required: true
            },
            cont_val: {
                required: true,
                minlength: 1,
                maxlength: 2,
                number: true,
                remote: {
                   url: "cont-val.php",
                    type: "post",
                    data: {
                       number_one: <?php echo $a;?>,
                        number_two: <?php echo $b;?>
                    }
                }
            }
        },
        highlight: function(element, errorClass, validClass) {
            $(element).nextAll('.form-control-feedback').show().removeClass('glyphicon-ok').addClass('glyphicon-remove');
            $(element).addClass(errorClass).removeClass(validClass);
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            $(element).nextAll('.form-control-feedback').show().removeClass('glyphicon-remove').addClass('glyphicon-ok');
            element.closest('.form-group').removeClass('has-error').addClass('has-success');
            $(element).remove();
        },
        //onkeyup: false, //turn off auto validate whilst typing
        submitHandler: function (form) {

        var formdata = $('#contactForm').serializeJSON();
        var jdata = JSON.stringify(formdata);

        $.ajax({
            url: 'contact.php',
            method: 'post',
            dataType: 'json',
            data: jdata,

            success: function(response) {
                    alert ("Thank you for your enquiry, a member of the team will contact you shortly");
                $("input:text").val("");
                $("#con_msg").val("");
                $(".form-control-feedback").hide().addClass('glyphicon-remove');

            }
        });
    }
    });
    });
</script>
<!-- //contact -->
<script src="js/owl.carousel.js"></script>  
	<script>
		$(document).ready(function() { 
			$("#owl-demo").owlCarousel({
			  autoPlay: true, //Set AutoPlay to 3 seconds
			  items :3,
			  itemsDesktop : [640,2],
			  itemsDesktopSmall : [414,1],
			  navigation : true,
			  loop: false,
			  // THIS IS THE NEW PART
				afterAction: function(el){
					//remove class active
					this
					.$owlItems
					.removeClass('active');
					//add class active
					this
					.$owlItems //owl internal $ object containing items
					.eq(this.currentItem + 1)
					.addClass('active')
					}
			// END NEW PART
		 
			});
			
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
					<li><a class="page-scroll scroll" href="#home">Home</a></li>
					<li><a class="page-scroll scroll" href="#about">About</a></li>
					<li><a class="page-scroll scroll" href="#vans">vans</a></li>
					<li><a class="page-scroll scroll" href="#downloads">Downloads</a></li>
					<li><a class="page-scroll scroll" href="#testimonials">Testimonials</a></li>				<li><a class="page-scroll scroll" href="#contact">Contact</a></li>
					
				</ul>
			</div>
		</div>
		<div class="col-md-3 col-sm-12 wthree-footer-right">
			<div class="agile-social-icons">
				<ul>
					<li><a href="#" class="fa fa-instagram" aria-hidden="true"></a></li>
					<li><a href="https://www.facebook.com/nxtoursupport" class="fa fa-facebook" aria-hidden="true"></a></li>
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

			
<!-- FlexSlider -->
  <script defer src="js/jquery.flexslider.js"></script>
	<script type="text/javascript">
    $(window).load(function(){
      $('#carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: true,
        slideshow: false,
        itemWidth: 102,
        itemMargin: 5,
        asNavFor: '#slider'
      });

      $('#slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: true,
        slideshow: true,
        sync: "#carousel",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  </script>
<!-- //FlexSlider -->

<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- here starts scrolling icon -->
<script type="text/javascript">
    $(document).ready(function() {
        $().UItoTop({ easingType: 'easeOutQuart' });
    });
</script>

<!-- start-smoth-scrolling -->
		<script type="text/javascript" src="js/move-top.js"></script>
		<script type="text/javascript" src="js/easing.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();

					$('html,body').animate({scrollTop:$(this.hash).offset().top - 88},1000);
				});
			});
		</script>
		<!-- /ends-smoth-scrolling -->
	<!-- //here ends scrolling icon -->
<!-- log in / out script -->
<script>

    $(document).on('click','.navbar-collapse.in',function(e) {
        if( $(e.target).is('a:not(".dropdown-toggle")') ) {
            $(this).collapse('hide');
        }
    });
</script>


</body>	
</html>