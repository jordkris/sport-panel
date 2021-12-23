<?php require_once('config.php'); ?>
<!DOCTYPE html>
<html lang="en-US">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-store,no-cache">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title itemprop="name">SPORT | <?php echo '' . htmlspecialchars($_GET["match"]) . ''; ?> Live Stream - <?php echo $_SERVER['HTTP_HOST']; ?>
	</title>
	<meta name="description" content="Watch live Sports stream online on the biggest Index to access any Sports live online. We provide you with free high quality Broadcast in multiple language...">
	<meta content="NOINDEX, NOFOLLOW" name="robots">
	<meta name="keywords" content="SPORTS | TV HD Live Stream" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="author" content="admin">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<meta property="og:locale" content="en_US">
	<meta property="og:keywords" content="SPORTS | TV HD Live Stream">
	<meta property="og:title" content="SPORT | <?php echo '' . htmlspecialchars($_GET["match"]) . ''; ?> Live Stream" />
	<meta property="og:description" content="Watch live Sports stream online on the biggest Index to access any Sports live online. We provide you with free high quality Broadcast in multiple language...">
	<meta property="og:type" content="website" />
	<meta property="og:author" content="Admin">
	<meta property="og:site_name" content="Stream Livefull">
	<meta property="og:image" content="https://i.imgur.com/hl4snYC.jpg" />
	<meta property="og:locale" content="en_US">
	<meta property="og:type" content="website">
	<meta property="og:site_name" content="Stream Livefull">
	<link rel="stylesheet" id="bootstrap-css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" media="all">
	<link rel="stylesheet" id="jasny-css" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css" type="text/css" media="all">
	<!-- <link rel="stylesheet" id="awesome-css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" media="all"> -->
	<script src="https://kit.fontawesome.com/5e59a4bfec.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" id="simple-css" href="//cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" type="text/css" media="all">
	<link rel="stylesheet" id="google-font" href="//fonts.googleapis.com/css?family=Oswald|Open+Sans" type="text/css" media="all">
	<link rel="stylesheet" href="<?= $site_url; ?>/css/datatables.css" type="text/css" media="all">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" rel="stylesheet" />

	<link rel="stylesheet" id="style-font" href="<?php echo $site_url; ?>/css/style.min.css" type="text/css" media="all">
	<link rel="stylesheet" id="style-font" href="<?php echo $site_url; ?>/css/custom.css" type="text/css" media="all">
	<link rel="stylesheet" id="style-font" href="<?php echo $site_url; ?>/css/comments.css" type="text/css" media="all">
	<link rel="shortcut icon" href="<?= $site_url; ?>/img/favicon.gif">
</head>

<body class="movie single">
	<div class="navbar navbar-default" style="background-color: #013369;top:0;position:sticky;z-index:100;">
		<div class="container" style="height:65px;">
			<div class="navbar-header">
				<div class="navbar-brand" style="position:absolute;"><a href="<?= $site_url; ?>">SPORT | <?php echo '' . htmlspecialchars($_GET["match"]) . ''; ?> Live Stream</a>
				</div>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar" aria-expanded="false">
					<span class="icon-options-vertical">
					</span>
				</button>
			</div>
			<nav class="collapse navbar-collapse" id="main-navbar">
				<ul class="nav navbar-nav navbar-right" style="background-color:#013369;">
					<?php
					$topbar = json_decode(file_get_contents('topbar.json'), true);
					$sportData = json_decode(file_get_contents('sportData.json'), true);
					// $url = '?';
					// $url .= isset($_GET['startdate']) ? 'startdate=' . $_GET['startdate'] . '&' : '';
					// $url .= isset($_GET['enddate']) ? 'enddate=' . $_GET['enddate'] . '&' : '';
					// $url .= isset($_GET['state']) ? 'state=' . $_GET['state'] . '&' : '';
					$counter = 0;
					foreach ($topbar as $t) {
						if ($counter < 5) {
							// $link = $url . 'gendersport=' . $t;
					?>
							<li class="top-menu">
								<!-- <a href="javascript:void(0)" onclick="changeParam('')"> -->
								<a id="<?= str_replace(',', '-', $t); ?>" href="javascript:void(0)" class="gender-sport">
									<span class="icon fa fa-play-circle-o"></span><?= $sportData[$t]; ?>
								</a>
							</li>
					<?php $counter++;
						} else {
							break;
						}
					} ?>
					<?php for ($i = 0; $i < 5; $i++) { ?>
						<li class="loading-menu" style="display:none;">
							<a href="javascript:void(0)">
								<span class="icon fa fa-play-circle-o"></span>
								<span class="loading-label"></span>
							</a>
						</li>
					<?php } ?>
					<!-- <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">More <span class="caret"></span></a></li> -->
				</ul>
			</nav>
		</div>
	</div>
	<div id="main">
		<div id="player">
			<span class="player-cover">
			</span>
			<!-- <div class="container">
				<img src="https://dummyimage.com/768x554/000000/ffffff&text=Loading%20%20%20" id="img-sport-left" />
				<img src="https://dummyimage.com/768x554/000000/ffffff&text=Loading%20%20%20" id="img-sport-right" />
			</div> -->
			<div class="container">
				<!-- <div id="video" class="text-center">
					<img src="https://dummyimage.com/768x554/000000/ffffff&text=Loading%20%20%20" style="width: 100%;" class="img-sport" />
				</div> -->
				<div id="video">
					<div id="video-player" class="embed-responsive embed-responsive-16by9 video pointer nocontext">
						<video style="object-fit: cover;" id="videoPlayer" class="embed-responsive-item img-sport" preload="none">
							<p>Your browser doesn't support HTML5 video
							</p>
						</video>
						<span class="spinner-wrapper">
							<span class="vam">
								<span class="spinner loading">
								</span>
							</span>
						</span>
						<span class="play-wrapper ease">
							<span class="vam">
								<span id="play_btn" class="play-btn-border ease">
									<i class="fa fa-play-circle headline-round ease" aria-hidden="true">
									</i>
								</span>
							</span>
							<div class="media-controls ease">
								<div id="leftControls" class="pull-left">
									<button type="button" name="Play" class="btn icon-control-play" id="play_btn">
									</button>
									<button id="volumeInc_btn" name="Volume" class="btn icon-volume-2">
									</button>
									<button id="timeContainer" class="btn">
										<i class="fa fa-circle" style="color:red">
										</i>
										<span class="dmax">LIVE
										</span>
									</button>
								</div>
								<div id="progressContainer">
									<span id="progress-bar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
									</span>
								</div>
								<div id="rightControls" class="pull-right">
									<div id="sliderContainer">
										<div id="slider" class="ui-slider ui-slider-vertical ui-widget ui-widget-content ui-corner-all">
											<div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min" style="height: 50%;">
											</div>
											<span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="bottom: 50%;">
											</span>
										</div>
									</div>
									<div id="setting_btn" class="btn-group dropup">
										<button name="Setting" class="btn icon-settings dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<span class="glyphicon glyphicon-hd-video">
											</span>
										</button>
										<ul class="dropdown-menu dropdown-menu-right">
											<li class="hq active">HD 1080p
											</li>
											<li class="hq">HD 720p
											</li>
										</ul>
									</div>
									<button id="fullscreen_btn" name="Fullscreen" class="btn icon-size-fullscreen pull-right">
									</button>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
		<div class="text-center">
			<img style="max-width:100%;height:auto;padding: 15px;" src="<?php echo $site_url; ?>/img/4k.png">
		</div>
		<br />
	</div>
	<div id="description" itemscope itemtype="https://schema.org/Movie">
		<div class="container">
			<div class="row">
				<article id="post-400710" class="post col-md-12">
					<header class="entry-header">
						<div itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
							<meta itemprop="worstRating" content="1">
							<meta itemprop="bestRating" content="10">
							<meta itemprop="ratingValue" content="4.7">
							<meta itemprop="ratingCount" content="9">
						</div>
					</header>
					<div class="entry-content">
						<div class="row">
							<div class="col-md-3 text-center hidden-xs hidden-sm">
								<img src="https://dummyimage.com/768x554/000000/ffffff&text=Loading%20%20%20" alt="<?php echo '' . htmlspecialchars($_GET["match"]) . ''; ?> Live Stream" width="185" height="278" class="img-responsive inblock main-poster img-desc">
								<div class="rating-star" title="6.4 out of 10 stars" itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
									<i class="fa fa-star">
									</i>
									<i class="fa fa-star">
									</i>
									<i class="fa fa-star">
									</i>
									<i class="fa fa-star">
									</i>
									<i class="fa fa-star">
									</i>
									<i class="fa fa-star">
									</i>
									<i class="fa fa-star">
									</i>
									<i class="fa fa-star">
									</i>
									<i class="fa fa-star-o">
									</i>
									<i class="fa fa-star-o">
									</i>
									<div class="movie-rating">
										<span itemprop="ratingValue">8.4
										</span>/
										<span itemprop="bestRating">10
										</span> by
										<span itemprop="ratingCount">12.281
										</span> users
									</div>
								</div>
							</div>
							<div class="col-md-9">
								<h3 style="color:#fffefc;margin-top:0;"><?= isset($_GET["match"]) ? htmlspecialchars($_GET["match"]) : 'Match is empty'; ?></h3>
								<!-- <p class="lead" itemprop="description" style="text-align: justify;">
									UFC live stream , play-by-play Live Broadcast - UFC live stream. To watch UFC online in best quality as well performance we advice you to use google chrome as browser. You should as well disable Adblock or any adblocker, those are blocking needed resources to start most of the streams. UFC online video and links from international TV Channels - we do our best to provide you with multiples language feeds. Live and Results. Where can I watch `UFC` online - Here free and legit !
								</p> -->
								<p id="description" class="lead" itemprop="description" style="text-align: justify;">Watch Sport in Live Broadcast from all over the world. No matter where you are you can always watch your favorite teams play live online. Catch the latest in live Sport entertainment with full access allSport matches! Watch Live Sport Broadcasts & Special Events Emissions Live Online 3000+ PREMIUM TV CHANNELS, 800+ PREMIUM MOVIE CHANNELS, 500+ PREMIUM MUSIC CHANNELS, 1500+ LOCAL TV CHANNELS, COMFORTABLE INTERFACE, NO HARDWARE REQUIRED, 24/7 WORLD-WIDE SUPPORT.</p>
							</div>
						</div>
						<br>
						<div class="row" style="padding-top:10px;">
							<div class="container">
								<div class="row" style="margin-bottom: 20px;">
									<div class="col-lg-2">
										<!-- <ul id="loading-log"></ul> -->
										<label for="gender-sport"><i class="fas fa-running"></i> Gender Sport</label>
										<!-- <input type="hidden" id="gender-sport" value="" /> -->
										<select id="gender-sport" class="form-control real-data">
											<?php
											foreach ($sportData as $key => $val) {
											?>
												<option value="<?= strtolower($key); ?>"><?= $val; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-lg-2">
										<!-- <ul id="loading-log"></ul> -->
										<label for="state"><i class="fas fa-globe-asia"></i> State</label>
										<!-- <select id="state" multiple="multiple" class="category-menu" size="10" style="width:100%;"> -->
										<select id="state" class="form-control real-data">
											<option value="all">All</option>
											<?php
											$stateData = json_decode(file_get_contents('stateData.json'), true);
											$stateKey = array_keys($stateData);
											foreach ($stateData as $key => $val) {
											?>
												<option value="<?= strtolower($key); ?>"><?= $val; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-lg-3">
										<label for="start-date"><i class="far fa-calendar-alt"></i> Start Date <span id="status-bar-start-date" class="status-bar"></span></label>
										<input id="start-date" type="text" class="form-control real-data" readonly>
									</div>
									<div class="col-lg-3">
										<label for="end-date"><i class="far fa-calendar-alt"></i> End Date <span id="status-bar-end-date" class="status-bar"></span></label>
										<input id="end-date" type="text" class="form-control real-data" readonly>
									</div>
									<div class="col-lg-2">
										<label for="threads"><i class="fas fa-microchip"></i> Threads</label>
										<input type="number" id="threads" class="form-control real-data" min="1" max="10" value="4">
									</div>
								</div>
								<div class="row" style="margin-bottom: 20px;">
									<div class="col-lg-6">
										<label for="progress-bar-url"><i class="fas fa-link"></i> URLs <span id="status-bar-url" class="status-bar"></span></label><br />
										<div id="progress-bar-url" class="progress-bar-striped">
											<div style="width: 0%;">
												<p>0%</p>
											</div>
										</div>

									</div>
									<div class="col-lg-6">
										<label for="progress-bar-schedule"><i class="far fa-clock"></i> Schedules <span id="status-bar-schedule" class="status-bar"></span></label><br />
										<div id="progress-bar-schedule" class="progress-bar-striped">
											<div style="width: 0%;">
												<p>0%</p>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<span style="float:left;">Status : <span id="status-bar-all"></span></span>
										<!-- <button id="start-loading" class="btn btn-success"><i class="icon fa fa-play"></i> Start</button>
										<button id="stop-loading" class="btn btn-danger" style="display:none;"><i class="icon fa fa-stop"></i> Stop</button> -->
									</div>
									<div class="col-lg-6">
										<span style="float:right;">Available Schedule : <span id="true-schedule">0</span></span>
									</div>
								</div>
								<div class="table-responsive">
									<table id="schedule-table" class="table display table-stripped" style="width:100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Home</th>
												<th>Away</th>
												<th class="text-center">Description</th>
												<th>Date</th>
												<th>Link</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-12">
								<section id="external-download" style="display:block!important;visibility:visible!important;opacity:1!important">
									<h3 class="widget-title" style="display:block!important;visibility:visible!important;opacity:1!important">
										<span>Alternative Stream Link
										</span>
									</h3>
									<a href="#" data-toggle="modal" data-target="#player-modal">
										<div class="section-content" style="display:block!important;visibility:visible!important;opacity:1!important">
											<ul id="ext-download" style="display:block!important;visibility:visible!important;opacity:1!important">
												<li class="ext-row pointer" style="display:block!important;visibility:visible!important;opacity:1!important">
													<span class="ext-title ease" style="display:block!important;visibility:visible!important;opacity:1!important">
														<span>
															<img src="<?php echo $site_url; ?>/img/ff.gif" width="20" height="20">&nbsp;Flash P2P
														</span>
													</span>
													<span class="ext-right pull-right">
														<span class="ext-speed nomobile">
															<script type="text/javascript">
																document.write(Math.floor(Math.random() * 3200));
															</script> Kb/s
														</span>
														<span class="ext-icon label label-primary"> STREAM
														</span>
													</span>
												</li>
												<li class="ext-row pointer" style="display:block!important;visibility:visible!important;opacity:1!important">
													<span class="ext-title ease" style="display:block!important;visibility:visible!important;opacity:1!important">
														<span>
															<img src="<?php echo $site_url; ?>/img/ff.gif" width="20" height="20">&nbsp;Castasap
														</span>
													</span>
													<span class="ext-right pull-right">
														<span class="ext-speed nomobile">
															<script type="text/javascript">
																document.write(Math.floor(Math.random() * 2200));
															</script> Kb/s
														</span>
														<span class="ext-icon label label-primary"> STREAM
														</span>
													</span>
												</li>
												<li class="ext-row pointer" style="display:block!important;visibility:visible!important;opacity:1!important">
													<span class="ext-title ease" style="display:block!important;visibility:visible!important;opacity:1!important">
														<span>
															<img src="<?php echo $site_url; ?>/img/ff.gif" width="20" height="20">&nbsp;Liveshare
														</span>
													</span>
													<span class="ext-right pull-right">
														<span class="ext-speed nomobile">
															<script type="text/javascript">
																document.write(Math.floor(Math.random() * 2200));
															</script> Kb/s
														</span>
														<span class="ext-icon label label-primary"> STREAM
														</span>
													</span>
												</li>
											</ul>
										</div>
								</section>
								</a>
							</div>
						</div>
					</div>
				</article>
			</div>
		</div>
	</div>
	</div>
	<div id="player-modal" class="modal fade nocontext">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header text-center"> 
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
					<h3 class="text-center">
						<strong>you must create a free account in order to watch live stream</strong>
					</h3>
				</div>
				<div class="modal-body">
					<img class="img-responsive img-desc" src="https://dummyimage.com/768x554/000000/ffffff&text=Loading%20%20%20" width="780" height="439" alt="<?php echo '' . htmlspecialchars($_GET["match"]) . ''; ?> Live Stream">
					<span class="img-cover">
					</span>
					<span class="offerlay ease">
					</span>
					<span class="modal-text ease">Join the network of satisfied members and try this service for
						<strong>Free.
						</strong> Fill out the signup form and
						<strong>start streaming instantly.
						</strong>
					</span>
					<div class="modal-ft ease">
						<ul>
							<li>
								<span class="icon fa fa-play-circle-o">
								</span> Unlimited Access
							</li>
							<li>
								<span class="icon fa fa-film">
								</span> Live or On Demand
							</li>
							<li>
								<span class="icon icon-ban">
								</span> Ads Free
							</li>
							<li>
								<span class="icon icon-screen-desktop">
								</span> All Platforms
							</li>
						</ul>
					</div>
				</div>
				<div class="modal-footer">
					<div class="text-center">
						<button class="btn btn-danger btn-lg btn-responsive" onclick="window.location.href='<?php echo $site_url; ?>/register.php'">
							<span class="btn-bg">
								<span class="icon icon-arrow-right-circle">
								</span>
							</span> Create Free Account
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	</section>
	</div>
	</div>
	<div id="dmca-modal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x
					</button>
					<h3 class="text-center">
						<strong>DMCA Notice
						</strong>
					</h3>
				</div>
				<div class="page-content" style="padding: 10px;">
					<p><?php echo $_SERVER['HTTP_HOST']; ?> respects the intellectual property of others. <?php echo $_SERVER['HTTP_HOST']; ?> takes matters of Intellectual Property very seriously and is committed to meeting the needs of content owners while helping them manage publication of their content online. It should be noted that <?php echo $_SERVER['HTTP_HOST']; ?> is a simple search engine of TV series available at a wide variety of third party websites.
					</p>
					<p>If you believe that your copyrighted work has been copied in a way that constitutes copyright infringement and is accessible on this site, you may notify our copyright agent, as set forth in the
						<strong>Digital Millennium Copyright Act
						</strong> of 1998 (DMCA). For your complaint to be valid under the DMCA, you must provide the following information when providing notice of the claimed copyright infringement:
					</p>
					<ul>
						<li>A physical or electronic signature of a person authorized to act on behalf of the copyright owner Identification of the copyrighted work claimed to have been infringed
						</li>
						<li>Identification of the material that is claimed to be infringing or to be the subject of the infringing activity and that is to be removed
						</li>
						<li>Information reasonably sufficient to permit the service provider to contact the complaining party, such as an address, telephone number, and, if available, an electronic mail address
						</li>
						<li>A statement that the complaining party "in good faith believes that use of the material in the manner complained of is not authorized by the copyright owner, its agent, or law"
						</li>
						<li>A statement that the "information in the notification is accurate", and "under penalty of perjury, the complaining party is authorized to act on behalf of the owner of an exclusive right that is allegedly infringed"
						</li>
					</ul>
					<p>The above information must be submitted as a written, faxed or emailed notification using
						<span class="pointer" data-toggle="modal" data-target="#dmca-modal">
							<strong>this form
							</strong>
						</span>
					</p>
				</div>
			</div>
		</div>
	</div>
	<div id="privacy-modal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="dmca-form" method="POST" action="p/dmca-notice/">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x
						</button>
						<h3 class="text-center">
							<strong>Privacy Policy
							</strong>
						</h3>
					</div>
					<div class="page-content" style="padding: 10px;">
						<p>We recognize that your privacy is important. This document outlines the types of personal information we receive and collect when you use <?php echo $_SERVER['HTTP_HOST']; ?>, as well as some of the steps we take to safeguard information. We hope this will help you make an informed decision about sharing personal information with us. <?php echo $_SERVER['HTTP_HOST']; ?> strives to maintain the highest standards of decency, fairness and integrity in all our operations. Likewise, we are dedicated to protecting our customers&acute;, consumers&acute; and online visitors privacy on our website.
						</p>
						<h3>Personal Information
						</h3>
						<p><?php echo $_SERVER['HTTP_HOST']; ?> collects personally identifiable information from the visitors to our website only on a voluntary basis. Personal information collected on a voluntary basis may include name, postal address, email address, company name and telephone number.
						</p>
						<p>This information is collected if you request information from us, participate in a contest or sweepstakes, and sign up to join our email list or request some other service or information from us. The information collected is internally reviewed, used to improve the content of our website, notify our visitors of updates, and respond to visitor inquiries.
						</p>
						<p>Once information is reviewed, it is discarded or stored in our files. If we make material changes in the collection of personally identifiable information we will inform you by placing a notice on our site. Personal information received from any visitor will be used only for internal purposes and will not be sold or provided to third parties.
						</p>
						<h3>Use of Cookies and Web Beacons
						</h3>
						<p>We may use cookies to help you personalize your online experience. Cookies are identifiers that are transferred to your computer&acute;s hard drive through your Web browser to enable our systems to recognize your browser. The purpose of a cookie is to tell the Web server that you have returned to a specific page. For example, if you personalize the sites pages, or register with any of our site&acute;s services, a cookie enables <?php echo $_SERVER['HTTP_HOST']; ?> to recall your specific information on subsequent visits.
						</p>
						<p>You have the ability to accept or decline cookies by modifying your Web browser; however, if you choose to decline cookies, you may not be able to fully experience the interactive features of the site.
						</p>
						<p>A web beacon is a transparent image file used to monitor your journey around a single website or collection of sites. They are also referred to as web bugs and are commonly used by sites that hire third-party services to monitor traffic. They may be used in association with cookies to understand how visitors interact with the pages and content on the pages of a web site.
						</p>
						<p>We may serve third-party advertisements that use cookies and web beacons in the course of ads being served on our web site to ascertain how many times you&acute;ve seen an advertisement. No personally identifiable information you give us is provided to them for cookie or web beacon use, so they cannot personally identify you with that information on our web site.
						</p>
						<p>Some third-party advertisements may be provided by Google, which uses cookies to serve ads on this site. Google uses the DART cookie, which enables it to serve ads to our users based on their visits to this site and other sites on the Web. You may opt out of the use of the DART cookie by visiting the Google ad and content network privacy policy.
						</p>
						<p>Browsers can be set to accept or reject cookies or notify you when a cookie is being sent. Privacy software can be used to override web beacons. Taking either of these actions shouldn&acute;t cause a problem with our site, should you so choose.
						</p>
						<h3>Children&acute;s Online Privacy Protection Act
						</h3>
						<p>This website is directed to adults; it is not directed to children under the age of 13. We operate our site in compliance with the Children&acute;s Online Privacy Protection Act, and will not knowingly collect or use personal information from anyone under 13 years of age.
						</p>
						<h3>Non-Personal Information
						</h3>
						<p>In some cases, we may collect information about you that is not personally identifiable. We use this information, which does not identify individual users, to analyze trends, to administer the site, to track users&acute; movements around the site and to gather demographic information about our user base as a whole. The information collected is used solely for internal review and not shared with other organizations for commercial purposes.
						</p>
						<h3>Release of Information
						</h3>
						<p>If <?php echo $_SERVER['HTTP_HOST']; ?> is sold, the information we have obtained from you through your voluntary participation in our site may transfer to the new owner as a part of the sale in order that the service being provided to you may continue. In that event, you will receive notice through our website of that change in control and practices, and we will make reasonable efforts to ensure that the purchaser honors any opt-out requests you might make of us.
						</p>
						<h3>How You Can Correct or Remove Information
						</h3>
						<p>We provide this privacy policy as a statement to you of our commitment to protect your personal information. If you have submitted personal information through our website and would like that information deleted from our records or would like to update or correct that information, please use our
							<a href="/contact/">
								<strong>Contact
								</strong>
							</a> page.
						</p>
						<h3>Updates and Effective Date
						</h3>
						<p><?php echo $_SERVER['HTTP_HOST']; ?> reserves the right to make changes in this policy. If there is a material change in our privacy practices, we will indicate on our site that our privacy practices have changed and provide a link to the new privacy policy. We encourage you to periodically review this policy so that you will know what information we collect and how we use it.
						</p>
						<h3>Agreeing to Terms
						</h3>
						<p>If you do not agree to <?php echo $_SERVER['HTTP_HOST']; ?> Privacy Policy as posted here on this website, please do not use this site or any services offered by this site.
						</p>
						<p>Your use of this site indicates acceptance of this privacy policy.
						</p>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div id="contact-modal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="dmca-form" method="POST" action="p/dmca-notice/">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x
						</button>
						<h3 class="text-center">
							<strong>Contact Us
							</strong>
						</h3>
					</div>
					<div class="page-content" style="padding: 10px;">
						<p>If you want to remove a television channel from <?php echo $_SERVER['HTTP_HOST']; ?> please read our DMCA Notice.
						</p>
						<p style="padding-left: 20px;">Email :
							<b>support@<?php echo $_SERVER['HTTP_HOST']; ?>
							</b>
						</p>
					</div>
				</form>
			</div>
		</div>
	</div>
	<footer id="site-footer">
		<div class="container">
			<div class="row">
				<div class="site-links col-md-12 text-center">
					<ul>
						<li>
							<a href="javascript:void(0)" data-toggle="modal" data-target="#privacy-modal">Privacy
							</a>
						</li>
						<li>
							<a href="javascript:void(0)" data-toggle="modal" data-target="#dmca-modal">DMCA Notice
							</a>
						</li>
						<li>
							<a href="javascript:void(0)" data-toggle="modal" data-target="#contact-modal">Contact
							</a>
						</li>
					</ul>
				</div>
				<div class="site-credit col-md-12 text-center"> &copy;2019
					<a href="<?php echo $site_url; ?>/"><?php echo $_SERVER['HTTP_HOST']; ?>
					</a> - All rights reserved.
				</div>
				<div class="site-note col-md-12 text-center">Disclaimer: All of the free sports found on this website are hosted on third-party servers that are freely available to watch online on <?php echo $_SERVER['HTTP_HOST']; ?> for all internet users. Any legal issues regarding the free online sports on this website should be taken up with the actual file hosts themselves. <?php echo $_SERVER['HTTP_HOST']; ?> is not responsible for the accuracy, compliance, copyright, legality, decency, or any other aspect of the content of other linked sites. In case of any copyright claims, Please contact the source websites directly file owners or host sites. By accessing this site you agree to be bound by our Privacy Policy.
				</div>
				<div id="counter" data-min="12234" data-max="12733">
					<span class="globe">
						<span class="fa fa-globe">
						</span>
					</span>
					<span class="counter-value">
						<!-- <script data-cfasync="false" src="<?php echo $site_url; ?>/assets/js/email-decode.min.js"> -->
						</script>
						<script type="text/javascript">
							document.write(Math.floor(Math.random() * 12733));
						</script>
					</span> Users Online
				</div>
			</div>
		</div>
	</footer>
	<script type="text/javascript" src="//code.jquery.com/jquery-2.2.0.min.js">
	</script>
	<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
	</script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js">
	</script>
	<script type="text/javascript" src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js">
	</script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js">
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
	</script>
	<script>
		localStorage.setItem('state-data', JSON.stringify(<?= json_encode($stateData); ?>))
	</script>
	<script type="text/javascript" src="<?= $site_url; ?>/js/script.js">
	</script>
	<script type="text/javascript" src="<?= $site_url; ?>/js/scripts.min.js"></script>
	<?php //include('histats.php'); 
	?>
</body>

</html>