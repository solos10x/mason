  <!-- BEGIN REGISTRATION FORM -->
            <form class="register-form" action="" method="post">
            <?php echo $signUpErr; ?>
                <h3>Join the family</h3>
                <p> It is simple. Simply perfect </p>
                
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Email</label>
                    <div class="input-icon">
                        <i class="fa fa-envelope"></i>
                        <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email" value="<?php echo $signUpEmail; ?>"/> </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password" value="<?php echo $signUpPassword; ?>"/> </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
                    <div class="controls">
                        <div class="input-icon">
                            <i class="fa fa-lock"></i>
                            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword" /> </div>
                    </div>
                </div>
           
           <p> Enter Referral Username </p>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Referral</label>
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <input class="form-control placeholder-no-fix" type="text" placeholder="Referral username" name="referral" value="<?php echo $signUpReferral; ?>"/> </div>
                </div>
                
                <div class="form-group">
                    <label class="mt-checkbox mt-checkbox-outline">
                        By clicking Sign Up, you agree to the
                        <a href="<?php echo URL ?>terms" class="cl-h-ast">Terms of Service </a> &
                        <a href="<?php echo URL ?>privacy" class="cl-h-ast">Privacy Policy </a>
                       
                    </label>
                    <div id="register_tnc_error"> </div>
                </div>
                
                <div class="form-actions">
                    <button id="register-back-btn" type="button" class="btn red btn-outline"> Back </button>
                    <button type="submit" id="register-submit-btn" class="btn green pull-right btn-wrap green-btn" name="signup"> Sign Up </button>
                </div>
                
            </form>
            <!-- END REGISTRATION FORM -->
            
            
            <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic" rel="stylesheet" type="text/css">
	<link href="//fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    
    
    
    
    
			<!--Eco Template section-->
			<section>
				<!--Eco Template section content-->
				<div class="container">
					<!--Eco Template Heading-->
					<div class="eco_headings">
						<h3><b>Greener</b> Levels</h3>
						<h6>Go up the ladder</h6>
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
													<h5><a href="#">Simplified Payment System</a></h5>
													<p> You are matched within 12 hours of joining the system to pay someone which qualifies you to move to level 1</p>
													<div class="eco-progress-row">
														<div class="progress skill-bar">
															<span class="eco_progress-heading skill"> &nbsp; &nbsp;0</span>
															<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="10">
																<span class="skill"><i class="val">Level</i></span>
																<small>12 hours count down</small>
																<small class="pull-right">Goal: &#8358; 5,000</small>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="back eco-thumb-bg">	
												<div class="feature_blog_caption">
													<h3>Protege Cycler</h3>
													<h5>Level 0 of the Greener Pastures Cycle </h5>
													<p> Sign Up and get matched within 12 hours to pay a Mentor the sum of &#8358; 5,000 </p>
													<div class="eco-progress-row">
														<div class="progress skill-bar">
															<span class="eco_progress-heading skill"> &nbsp; &nbsp; 0</span>
															<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="10">
																<span class="skill"><i class="val">Level</i></span>
																<small>12 Hours Count down</small>
																<small class="pull-right">Goal: &#8358; 5,000</small>
															</div>
														</div>
													</div>
													<a href="<?php echo URL ?>signup" class="lg-button">Sign Up Now</a>
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
													<h5><a href="#">Pay and Get Paid</a></h5>
													<p> When matched to pay someone, complete the transaction and get confirmed within 24 hours to qualify you to move to a new level</p>
													<div class="eco-progress-row">
														<div class="progress skill-bar">
															<span class="eco_progress-heading skill">&nbsp; &nbsp; 1</span>
															<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40">
																<span class="skill"><i class="val">Level</i></span>
																<small>24 hours count down</small>
																<small class="pull-right">Goal:  &#8358; 20,000</small>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="back eco-thumb-bg">	
												<div class="feature_blog_caption">
													<h3>Mentor Cycler</h3>
													<h5>Level 1 of the Greener Pastures Cycle</h5>
													<p>Get matched at this stage to receive payment from four (4) protege cyclers and  as such, get a total of  &#8358; 20,000</p>
													<div class="eco-progress-row">
														<div class="progress skill-bar">
															<span class="eco_progress-heading skill">&nbsp; &nbsp; 1</span>
															<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="20">
																<span class="skill"><i class="val">Level</i></span>
																<small>24 Hours Count down</small>
																<small class="pull-right">Goal: &#8358; 20,000</small>
															</div>
														</div>
													</div>
													<a href="<?php echo URL ?>signup" class="lg-button">Sign Up Now</a>
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
													<h5><a href="#">Keep Upgrading Levels</a></h5>
													<p>After completing level 1 cycle, there are more levels that can be advanced to with the maximum level at Level 6 </p>
													<div class="eco-progress-row">
														<div class="progress skill-bar">
															<span class="eco_progress-heading skill">&nbsp; &nbsp; 6</span>
															<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
																<span class="skill"><i class="val">Level </i></span>
																<small>Go up the ladder</small>
																<small class="pull-right">Goal: &#8358; 1,000,000</small>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="back eco-thumb-bg">	
												<div class="feature_blog_caption">
													<h3>Alpha Cycler</h3>
													<h5>Level 6 of the Greener Pastures Cycle</h5>
													<p> At this stage, you get paired with four (4) Elders to pay you a total sum of &#8358; 1,000,000 </p>
													<div class="eco-progress-row">
														<div class="progress skill-bar">
															<span class="eco_progress-heading skill">&nbsp; &nbsp; 6</span>
															<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
																<span class="skill"><i class="val">Level</i></span>
																<small>Go Up the Ladder</small>
																<small class="pull-right">Goal: &#8358; 1,000,000</small>
															</div>
														</div>
													</div>
													<a href="<?php echo URL ?>signup" class="lg-button">sign up now</a>
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