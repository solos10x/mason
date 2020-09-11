<?php 
include_once("class/db.php");
include_once("class/html.php");
include_once("class/process.php");

$db = new db();
$html = new html($db);
$process = new process($db);

$title = siteName;
?>
<?php 

echo $html->homepageHeader("", $title, "", ""); 
echo $html->mainSlider();

?> 

		<!--Eco Template content-->
		<div class="content">
			<!--Eco Template section-->
			<section class="eco_services_environment">
				<!--Eco Template section content-->
				<div class="container">
					<!--Eco Template Heading-->
					<div class="eco_headings">
						<h3><b>Earners</b> Fund</h3>
						<!--<h6>Selflessness and Integrity</h6>-->
						<span><i class="fa fa-leaf"></i></span>
					</div>
					<!--Eco services-->
					<div class="eco_services">
						<div class="row">
							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="eco_items-services">
									<div class="eco_service_cols">
										<span><i class="fa fa-cog"></i></span>
										<div>
											<h4>Instant Package</h4>
											<p>Get <?php echo $process->getinstantSetUp("incentive");  ?>% incentive between 30 minutes - 7 days </p>
										</div>
									</div>
									<div class="eco_service_cols">
										<span><i class="fa fa-smile-o"></i></span>
										<div>
											<h4>Listed Package</h4>
											<p>Gain <?php echo $process->getlistedSetUp("incentive"); ?>% incentive between 24 hours - 10 days </p>
										</div>
									</div>
								</div>
							</div>
							<!--Eco Template section content center img-->
							<div class="col-md-4 col-sm-6 col-xs-12 hidden-sm-down">
								<figure><div class="thumb-widthout-layer"><img src="<?php echo URL ?>images/eco-services-center-img.png" alt=""></div></figure>
							</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="eco_items-services">
									<div class="eco_service_cols rtl_service">
										<span><i class="fa fa-recycle"></i></span>
										<div>
											<h4>Referral Bonus</h4>
											<p>Gain $<?php echo $process->getReferralBonus(); ?> for every user you refer to the platform and who commits into the system </p>
										</div>
									</div>
									<div class="eco_service_cols rtl_service">
										<span><i class="fa fa-check-square-o"></i></span>
										<div>
											<h4>Held Incentive</h4>
											<p>A little amount with-held and released when user re-commits. It provides sustainability</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--Eco Template section content ends-->
			</section>
			<!--Eco Template section ends-->
            
			
            <!--Eco Template section-->
			<section>
				<!--Eco Template section content-->
				<div class="container">
					<!--Eco Template Heading-->
					<div class="eco_headings">
						<h3><b>How It </b> Works</h3>
						<h6> </h6>
						<span><i class="icon-nature-2"></i></span>
					</div>
					<!--Eco services-->
					<div class="eco_featured_causes">
						<div class="row">
							
                            <!--Eco services flip colums-->
								<div class="col-md-4 col-sm-6 col-xs-12 responsive-devider-50">
									<div class="eco_flip-container">
										<div class="flipper feature-blog">
											<div class="front">
												<figure>
													<div class="eco-thumb">
														<img src="<?php echo URL ?>images/home-btm-img01.jpg" alt="">
													</div>
												</figure>
												<div class="feature_blog_caption">
													<h5><a href="#">Outgoing Activity</a></h5>
													<p>The system is automated. A list is pushed out of recipients who have previously donated. You simply click on a recipient of your choice and make him or her a donation based on what you can afford.</p>
                                                    
												 
												</div>
											</div>
											<div class="back eco-thumb-bg">	
												<div class="feature_blog_caption">
													<h3>Donate</h3>
													<p>The history of this record is recorded in your outgoing transactions. You can monitor and track all these activities from your dashboard</p>
													 
												</div>
											</div>
										</div>
									</div>
								</div>
								
                                <!--Eco services flip colums-->
								<div class="col-md-4 col-sm-6 col-xs-12 responsive-devider-50">
									<div class="eco_flip-container">
										<div class="flipper feature-blog">
											<div class="front">
												<figure>
													<div class="eco-thumb">
														<img src="<?php echo URL ?>images/home-btm-img02.jpg" alt="">
													</div>
												</figure>
												<div class="feature_blog_caption">
													<h5><a href="#">Incoming Activity</a></h5>
													<p> As soon as you donate to a recipient and you are confirmed, the system allocates you a unique ID known as Donation ID. Your ID is queued up while the system releases list on a daily basis in an hierachy manner. </p>
												 
												</div>
											</div>
											<div class="back eco-thumb-bg">	
												<div class="feature_blog_caption">
													<h3>Receive</h3>
													 
													<p> The record of all your incoming or already received donations are recorded in this section. You can monitor and track the record of all these activities in your dashboard</p>
													 
													 
												</div>
											</div>
										</div>
									</div>
								</div>
                                
								<!--Eco services flip colums-->
								<div class="col-md-4 col-sm-6 col-xs-12 responsive-devider-50">
									<div class="eco_flip-container">
										<div class="flipper feature-blog">
											<div class="front">
												<figure>
													<div class="eco-thumb">
														<img src="<?php echo URL ?>images/home-btm-img03.jpg" alt="">
													</div>
												</figure>
												<div class="feature_blog_caption">
													<h5><a href="#">Hold Donation</a></h5>
													<p> Haha! Do not worry, this with-held sum will always be released to you. A percentage of your incentive and referal bonuses is with-held back in the system and released to you when your re-commit (re-donate).    </p>
												 
												</div>
											</div>
											<div class="back eco-thumb-bg">	
												<div class="feature_blog_caption">
													<h3>Re-commit</h3>
													<p> You can track all the with-held amounts of yours in your dashboard. Also, the bonuses you are entitled to for referring new users to the platform can also be tracked and monitored </p>
												 
												</div>
												
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--Eco services flip colums ends-->
						</div>
					</div>
				<!--Eco Template section content ends-->
			</section>
			<!--Eco Template section ends-->
            

			<!--Eco Template section-->
			<div class="eco_filing_form">
				<!--Eco donation form-->
				<div class="container">
					
					<div class="eco_donation_form">
						<div class="row">
							<div class="col-md-6 col-sm-6 responsive-col-xs">
								<div class="eco_form_importer">
									<!--Eco Template Heading-->
									<div class="eco_headings">
										<h3><b>Why</b> Wait?</h3>
										<p style="color:initial"> Be a part of an amazing community of willing minds ready to collaborate. A system that thrives on sincerity and dedication of it's users</p>
									</div>
									<!--Eco donation form-->

									<!--Eco input your detail-->
									<div class="eco_input_your_detail">
											<div class="form-submit-eco-btn">
												<a href="<?php echo URL ?>signup"><button class="lg-button">Join Now</button></a>
											</div>
										 
									</div>
									<!--Eco input your detail ends-->
								</div>
							</div>
							<div class="col-md-6 col-sm-6 responsive-col-xs">
								<!--Eco Process of count up-->
								<div class="eco_process_of_counter">
									<ul class="eco_counter">
										<li class="left-side">
											<div class="eco_count_up">
												<span><i class="fa fa-users"></i></span>
												<h3><span class="counter-up">1,200</span>k+</h3>
												<p>Sign Ups</p>
											</div>
										</li>
										<li class="right-side">
											<div class="eco_count_up">
												<span><i class="fa fa-money fa-2x"></i></span>
												<h3>&#8358; <span class="counter-up">4000000</span>+</h3>
												<p>Paid Donations</p>
											</div>
										</li>
										<li class="left-side">	
											<div class="eco_count_up">
												<span><i class="fa fa-money"></i></span>
												<h3> &#8358; <span class="counter-up">21000000</span>+</h3>
												<p>Incentives Gained</p>
											</div>
										</li>
										
										<li class="right-side">	
											<div class="eco_count_up no-margin-bottom">
												<span><i class="fa fa-recycle"></i></span>
												<h3><span class="counter-up">2700</span>+</h3>
												<p>Activities</p>
											</div>
										</li>
									</ul>
								</div>
								<!--Eco Process of count up ends-->
							</div>
						</div>
					</div>
				</div>
				<!--Eco container ends-->
			</div>
			<!--Eco donation form ends-->

			   
<?php echo $html->homepageFooter(""); ?>	