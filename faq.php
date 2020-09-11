<?php 
include_once("class/db.php");
include_once("class/html.php");
include_once("class/session.php");

$db = new db();
$html = new html($db);
$session = new session($db);

$title = 'IPM Xchange Platform';

?>
<?php 
echo $html->homepageHead("", $title, "", "");
?>

    <!-- Start Page Banner -->
    <div class="page-banner" style="padding:40px 0; background: url(images/slide-02-bg.jpg) center #f9f9f9;">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2><strong><strong/></h2>
            <p><strong>WE ARE PROFESSIONALS<strong/></p>
          </div>
          <div class="col-md-6">
            <ul class="breadcrumbs">
              <li><a href="#">Home</a></li>
              <li>FAQ</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- End Page Banner -->


    <!-- Start Content -->
    <div id="content">
      <div class="container">
        <div class="page-content">


          <div class="row">

            <div class="col-md-12">

              <!-- Classic Heading -->
              <h1 class="classic-title"><span>FAQ</span></h1><br/>
				<div class="container padding-top-large">
					<h2 class="classic-title">
						<strong class="bold-text">Q) </strong>
						<span>How does IPM Exchange Platform work?</span>
					</h2>
					<div class="line main-bg"></div>
					<div class="row margin-bottom-medium">
						<div class="col-md-12">
							<div class="light-text margin-top-medium wow slideInLeft" data-wow-duration="2s">
							   IPM Exchange is a financial exchange and social networking platform for everyone in the world with access to internet. We exchange donations and receive incentives in return to fulfil one another's dreams. For instance if one wishes to start a project, buy a new gadget, computer or any big wish you ever dreamt of in life. There are millions of good hearted folks around the world to connect with and share donations so you send to others and receive from others.
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<br/>
				<div class="container padding-top-large">
					<h2 class="classic-title">
						<strong class="bold-text">Q) </strong>
						<span>Forgot login details? </span>
					</h2>
					<div class="line main-bg"></div>
					<div class="row margin-bottom-medium">
						<div class="col-md-12">
							<div class="light-text margin-top-medium wow slideInLeft" data-wow-duration="2s">
							   Click on "Forgot Password" just below the Login detail, type in the email address used to signup then the system will send you an email or an OTP with a new password. 
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<br/>
				<div class="container padding-top-large">
					<h2 class="classic-title">
						<strong class="bold-text">Q) </strong>
						<span>Who to contact for support? </span>
					</h2>
					<div class="line main-bg"></div>
					<div class="row margin-bottom-medium">
						<div class="col-md-12">
							<div class="light-text margin-top-medium wow slideInLeft" data-wow-duration="2s">
							   Support is available on the live chat 24/5days a week and responds in timely and orderly manner. 
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<br/>
				<div class="container padding-top-large">
					<h2 class="classic-title">
						<strong class="bold-text">Q) </strong>
						<span>What currency is used on the platform?</span>
					</h2>
					<div class="line main-bg"></div>
					<div class="row margin-bottom-medium">
						<div class="col-md-12">
							<div class="light-text margin-top-medium wow slideInLeft" data-wow-duration="2s">
							   The platform accepts all currencies including Bitcoins. You can add up to two payment processor in your account. 
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="container padding-top-large">
					<h2 class="classic-title">
						<strong class="bold-text">Q) </strong>
						<span>Does IPM Exchange accept international participants? </span>
					</h2>
					<div class="line main-bg"></div>
					<div class="row margin-bottom-medium">
						<div class="col-md-12">
							<div class="light-text margin-top-medium wow slideInLeft" data-wow-duration="2s">
							  Yes, the platform is used globally and we encourage users to take advantage of bitcoins crypto currency. 
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<br/>
				<div class="container padding-top-large">
					<h2 class="classic-title">
						<strong class="bold-text">Q) </strong>
						<span>What is Bitcoins?  </span>
					</h2>
					<div class="line main-bg"></div>
					<div class="row margin-bottom-medium">
						<div class="col-md-12">
							<div class="light-text margin-top-medium wow slideInLeft" data-wow-duration="2s">
							  Bitcoins and other coins are alternative currencies knows as crypto currencies which can be used to buy goods and services in many countries globally. They are easy to transfer and can be sent to anyone anywhere in the world with a click of a button with nearly no transaction charges.  
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<br/>
				<div class="container padding-top-large">
					<h2 class="classic-title">
						<strong class="bold-text">Q) </strong>
						<span>What is the advantage of Bitcoins  </span>
					</h2>
					<div class="line main-bg"></div>
					<div class="row margin-bottom-medium">
						<div class="col-md-12">
							<div class="light-text margin-top-medium wow slideInLeft" data-wow-duration="2s">
							  The ability and freedom to control your own money, Bitcoins is the cheapest currency to transact and its accepted internationally. There’s no limit influences like banks, middlemen or holidays. Actually you have the full control of your money and the freedom to buy, sell and transfer to anyone around the world. 
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<br/>
				<div class="container padding-top-large">
					<h2 class="classic-title">
						<strong class="bold-text">Q) </strong>
						<span>Is it easy and quick to sell my bitcoins? </span>
					</h2>
					<div class="line main-bg"></div>
					<div class="row margin-bottom-medium">
						<div class="col-md-12">
							<div class="light-text margin-top-medium wow slideInLeft" data-wow-duration="2s">
							   Bitcoins is easily sold for cash online and then you can simply withdraw your money into your bank account the entire process takes just a day and the fees are nominal. 
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<br/>
				<div class="container padding-top-large">
					<h2 class="classic-title">
						<strong class="bold-text">Q) </strong>
						<span>How to get in contact with my IPM recipient? </span>
					</h2>
					<div class="line main-bg"></div>
					<div class="row margin-bottom-medium">
						<div class="col-md-12">
							<div class="light-text margin-top-medium wow slideInLeft" data-wow-duration="2s">
							   Once you have reserved someone’s capital on the platform, select recipient and the system will display the complete details of the recipient and fund transfer options. 
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<br/>
				<div class="container padding-top-large">
					<h2 class="classic-title">
						<strong class="bold-text">Q) </strong>
						<span>The in-chat app interaction? </span>
					</h2>
					<div class="line main-bg"></div>
					<div class="row margin-bottom-medium">
						<div class="col-md-12">
							<div class="light-text margin-top-medium wow slideInLeft" data-wow-duration="2s">
							   IPM Xchange is an online social and financial exchange platform, so we have integrated an application to chat with other participants in real-time reducing cost to call donor or recipient. 
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="container padding-top-large">
					<h2 class="classic-title">
						<strong class="bold-text">Q) </strong>
						<span>Where do I find the participant to transact with?</span>
					</h2>
					<div class="line main-bg"></div>
					<div class="row margin-bottom-medium">
						<div class="col-md-12">
							<div class="light-text margin-top-medium wow slideInLeft" data-wow-duration="2s">
							  When you login onto your account, on the left side menu, you will find most functions on our platform and you click on capital to show the types of capital listed on the platform. Then, select your preferred option and a donation list will be presented to you, select arecipient of your choice and proceed with transaction amount.  
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<br/>
				<div class="container padding-top-large">
					<h2 class="classic-title">
						<strong class="bold-text">Q) </strong>
						<span>What is Hold donations? </span>
					</h2>
					<div class="line main-bg"></div>
					<div class="row margin-bottom-medium">
						<div class="col-md-12">
							<div class="light-text margin-top-medium wow slideInLeft" data-wow-duration="2s">
							  When you receive a donation from another participant, the system holds a percentage of your expected donation and keeps it until you recommit another donation and then your held percentage is released with your incoming donation. 
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<br/>
				<div class="container padding-top-large">
					<h2 class="classic-title">
						<strong class="bold-text">Q) </strong>
						<span>Where do I find my donation transactions?  </span>
					</h2>
					<div class="line main-bg"></div>
					<div class="row margin-bottom-medium">
						<div class="col-md-12">
							<div class="light-text margin-top-medium wow slideInLeft" data-wow-duration="2s">
							  You could either find it at the bottom of your dashboard where you have your activities or you could navigate through the menu at the left hand corner of your screen to find transactions
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<br/>
				<div class="container padding-top-large">
					<h2 class="classic-title">
						<strong class="bold-text">Q) </strong>
						<span>When do I get my referral reward? </span>
					</h2>
					<div class="line main-bg"></div>
					<div class="row margin-bottom-medium">
						<div class="col-md-12">
							<div class="light-text margin-top-medium wow slideInLeft" data-wow-duration="2s">
							  Your referral reward is 20$ for each user you direct to this system and it will show up in the Hold donation section after your referee has made a donation. You will get the referral bonus on your next transaction in the system 
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
            </div>
          </div>

          <!-- Divider -->
          <div class="hr1" style="margin-bottom:50px;"></div>

          <!-- Divider -->
          <div class="hr1" style="margin-bottom:50px;"></div>
        </div>
      </div>
    </div>
    <!-- End content -->

<?php echo $html->homepageFooter(""); ?>