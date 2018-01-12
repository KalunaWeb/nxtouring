<?php

require_once 'header.php';
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
                                <div class="nxl-price"><p></p><span class="sicon">£'.$price[$i].'</span><p>+ vat / day</p></div>

                            <div class="agileits-banner-info jarallax">
                                <h3 class="agile-title">'.$name[$i].'</h3>
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
			<div class="col-md-4 nx-about-left">
				  <section class="slider">
					<div id="slider" class="flexslider">
					  <ul class="slides">
						<li>
							<img src="images/8.jpg" alt="" />
						</li>
						<li>
							<img src="images/9.jpg" alt="" />
						</li>
						<li>
							<img src="images/7.jpg" alt="" />
						</li>
						<li>
							<img src="images/8.jpg" alt="" />
						</li>
						<li>
							<img src="images/9.jpg" alt="" />
						</li>
						<li>
							<img src="images/7.jpg" alt="" />
						</li>
						<li>
							<img src="images/6.jpg" alt="" />
						</li>
						<li>
							<img src="images/7.jpg" alt="" />
						</li>
						<li>
							<img src="images/8.jpg" alt="" />
						</li>
						<li>
							<img src="images/9.jpg" alt="" />
						</li>
					  </ul>
					</div>
					<div id="carousel" class="flexslider">
					  <ul class="slides">
						<li>
							<img src="images/8.jpg" alt="" />
						</li>
						<li>
							<img src="images/9.jpg" alt="" />
						</li>
						<li>
							<img src="images/7.jpg" alt="" />
						</li>
						<li>
							<img src="images/8.jpg" alt="" />
						</li>
						<li>
							<img src="images/9.jpg" alt="" />
						</li>
						<li>
							<img src="images/7.jpg" alt="" />
						</li>
						<li>
							<img src="images/6.jpg" alt="" />
						</li>
						<li>
							<img src="images/7.jpg" alt="" />
						</li>
						<li>
							<img src="images/8.jpg" alt="" />
						</li>
						<li>
							<img src="images/9.jpg" alt="" />
						</li>
					  </ul>
					</div>
				  </section>
			</div>
			<div class="col-md-5 nx-about-left">
				<h1>Welcome to NX Touring Ltd</h1>
				<h5>Luxury tour vehicle hire.</h5>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nisl nunc, feugiat a nulla euismod, porta vehicula nisi. Praesent molestie, elit at mattis euismod, risus augue lacinia sem, vel elementum dui sem eu nisi. Morbi eu condimentum nibh. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. <span>Donec leo orci, tempus ac porta sit amet, pulvinar ac ante. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque in mauris vel lectus aliquet imperdiet at in metus. Sed tristique, ante quis varius rhoncus, turpis nisl suscipit neque, id sollicitudin tellus purus a augue. Integer urna ex, vehicula eget tincidunt et, scelerisque non massa. Nulla convallis sodales diam, non laoreet purus.<br><br></span></p>
				<div class="more-button">
					<a href="#" data-toggle="modal" data-target="#myModal">More</a>
				</div>
			</div>
            <div class="col-md-3 nx-about-left">
                <form class="form" id="searchForm">
                    <div id="searchBox">
                        <h3 class="nxl-head text-center">Check Availability</h3>


                        <?php if ($user == "Guest") {
                            echo '<div class="hidden">';
                        } else {
                            echo '<div>';
                        }
                        ?>
                        <div>
                            <input type="hidden" class="form-control" id="clientName" name="clientName" <?php if (isset($contact['member']['name'])) {echo'value="'.$contact['member']['name'].'"';}?> readonly="readonly">
                        </div>
                    </div>
                    <div class="">
                        <div class="form-group">
                            <label for="startDate">Collection Date <span class="small">(From 9 a.m.)</span></label>
                            <input type="text" class="form-control" id="start" name="startDate">
                        </div>
                        <div class="form-group">
                            <label for="endDate">Return Date <span class="small">(Before 10 a.m.)</span></label>
                            <input type="text" class="form-control" id="end" name="endDate">
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
			<div class="clearfix"> </div>
		</div>
	</div>
</div>


<script>
    $('#start').daterangepicker({

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
        var $el = $(this);
        var $id = $el.data('van-id');
        var $start = $el.data('van-start');
        var $end = $el.data('van-end');
        var $period = $el.data('van-period');
        var $store = $el.data('van-store');
        var $name = $el.data('van-name');
        var $price = $el.data('van-price');

        $('#type_id').attr('name', $id);
        $('#type_id').val($name);
        $('#startDate').val($start);
        $('#endDate').val($end);
        $('#store').val($store);
        $('#product').val($id);
        $('#days').val($period);
        $('#price').val($price);
        $('#prod_type').val($name);
    });



    $("#searchForm").submit(function(e){
        e.preventDefault(e);
    });

   $('#searchForm').validate({
        rules: {
            artistName: {
                required: true,
                minlength: 2,
                maxlength: 40,
            },
        },
        messages: {
            artistName: {
                required: "Please enter a the Artists Name",
                minlength: "Artist Name must be at least {0} characters long"
            },
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
<!-- modal -->
	<div class="modal about-modal fade" id="myModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header"> 
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
						<h4 class="modal-title">wanderlust</h4>
				</div> 
				<div class="modal-body">
					<div class="agileits-nxlayouts-info">
						<img src="images/8.jpg" alt="" />
						<p>Duis venenatis, turpis eu bibendum porttitor, sapien quam ultricies tellus, ac rhoncus risus odio eget nunc. Pellentesque ac fermentum diam. Integer eu facilisis nunc, a iaculis felis. Pellentesque pellentesque tempor enim, in dapibus turpis porttitor quis. Suspendisse ultrices hendrerit massa. Nam id metus id tellus ultrices ullamcorper.  Cras tempor massa luctus, varius lacus sit amet, blandit lorem. Duis auctor in tortor sed tristique. Proin sed finibus sem.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- //modal -->

<div class="container" id="searchContainer"></div>


	<div class="downloads jarallax" id="downloads">
		<div class="container">
			<h3 class="text-center">Downloads</h3>
			<div class="nx_services_grids">

                <div class="col-md-offset-1 col-md-3">
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


                <div class="col-md-offset-4 col-md-3">
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
						<input type="text" class="name" name="cont_name" placeholder="Name" required="">
						<input type="email" class="mail" name="cont_mail" placeholder="Email" required="">
						<textarea placeholder="Your Message" required="" name="con_msg"></textarea>
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


    $("#contactForm").submit(function(e){
        e.preventDefault(e);
    });

    $ ('#send').click(function(){
        var formdata = $('#contactForm').serializeJSON();
        var jdata = JSON.stringify(formdata);

        $.ajax({
            url: 'contact.php',
            method: 'post',
            dataType: 'json',
            data: jdata,

            success: function(response) {
                    console.log(response);

            }
        });
    })
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
			  loop: true,
			  // THIS IS THE NEW PART
				afterAction: function(el){
					//remove class active
					this
					.$owlItems
					.removeClass('active')
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
				<h2><a class="navbar-brand" href="index.html">NX Touring</a></h2>
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
	$("#modalLogIn").submit(function(e) {
   $.ajax({
           type: "POST",
           url: 'login_process.php',
           data: $("#loginform").serialize(), // serializes the form's elements.
           success: function(data) {
            if (data == "ok") { window.location.href = "index.php";
           } else { 
            $('#error').html(data);
            $('#modalLogIn').modal('show');

           }}
         });
    e.preventDefault(); // avoid to execute the actual submit of the form.
});


$("#logout").submit(function() {
   $.ajax({
           type: "POST",
           url: 'logout.php',
           success: function()
           {
               window.location.href = "index.php";
           }
         });
});

    $(document).on('click','.navbar-collapse.in',function(e) {
        if( $(e.target).is('a:not(".dropdown-toggle")') ) {
            $(this).collapse('hide');
        }
    });
</script>


</body>	
</html>