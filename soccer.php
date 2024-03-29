<?php require_once('config.php');?>
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
    <link rel="stylesheet" id="awesome-css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" media="all"> 
    <link rel="stylesheet" id="simple-css" href="//cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" type="text/css" media="all"> 
    <link rel="stylesheet" id="google-font" href="//fonts.googleapis.com/css?family=Oswald|Open+Sans" type="text/css" media="all"> 
    <link rel="stylesheet" id="style-font" href="<?php echo $site_url;?>/css/style.min.css" type="text/css" media="all"> 
    <link rel="stylesheet" id="style-font" href="<?php echo $site_url;?>/css/comments.css" type="text/css" media="all"> 
    <link rel="shortcut icon" href="/img/favicon.gif"> 
  </head> 
  <body class="movie single"> 
    <header> 
      <div class="navbar navbar-default navbar-fixed-top" style="background-color: #013369;"> 
        <div class="container"> 
          <div class="navbar-header"> 
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar" aria-expanded="false"> 
              <span class="icon-options-vertical">
              </span> 
            </button> 
            <div class="navbar-brand"><?php echo '' . htmlspecialchars($_GET["match"]) . ''; ?>
            </div> 
          </div> 
          <nav class="collapse navbar-collapse" id="main-navbar"> 
            <ul class="nav navbar-nav navbar-right"> 
              <li> 
                <a href="/"> 
                  <span class="icon fa fa-home">
                  </span> Home 
                </a> 
              </li> 
              <li> 
                <a href="javascript:void(0)" onclick="window.location.href='nba.php'"> 
                  <span class="icon fa fa-play-circle-o">
                  </span> NBA 
                </a> 
              </li> 
              <li> 
                <a href="javascript:void(0)" onclick="window.location.href='mlb.php'"> 
                  <span class="icon fa fa-play-circle-o">
                  </span> MLB 
                </a> 
              </li> 
              <li> 
                <a href="javascript:void(0)" onclick="window.location.href='ufc.php'"> 
                  <span class="icon fa fa-play-circle-o">
                  </span> UFC 
                </a> 
              </li> 
              <li> 
                <a href="javascript:void(0)" onclick="window.location.href='boxing.php'"> 
                  <span class="icon fa fa-play-circle-o">
                  </span> BOXING 
                </a> 
              </li> 
              <li> 
                <a href="javascript:void(0)" onclick="window.location.href='register.php'"> 
                  <span class="icon fa fa-user-circle-o">
                  </span> Login / Register 
                </a> 
              </li> 
              <li> 
              </li> 
            </ul> 
          </nav> 
        </div> 
      </div> 
    </header> 
    <div id="main"> 
      <div id="player"> 
        <span class="player-cover">
        </span> 
        <div class="container"> 
          <div id="video"> 
            <div id="video-player" class="embed-responsive embed-responsive-16by9 video pointer nocontext"> 
              <video style="object-fit: cover;" id="videoPlayer" class="embed-responsive-item" preload="none" poster="<?= $site_url; ?>/img/soccer.jpg"> 
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
          <center>
            <img style="max-width:100%;height:auto;padding: 15px;" src="<?php echo $site_url;?>/img/4k.png">
          </center> 
          <br /> 
          <center>
          </center> 
        </div> 
        <div class="container" itemscope itemtype="https://schema.org/Movie"> 
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
                <div class="col-md-offset-3"> 
                  <h3 style="color:#fffefc"><?php echo '' . htmlspecialchars($_GET["match"]) . ''; ?>
                  </h3> 
                </div> 
                <div class="row"> 
                  <div class="col-md-3 text-center hidden-xs hidden-sm"> 
                    <img src="<?= $site_url; ?>/img/soccer2.png" alt="<?php echo '' . htmlspecialchars($_GET["match"]) . ''; ?> Live Stream" width="185" height="278" class="img-responsive inblock main-poster"> 
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
                  <br> 
                  <div class="col-md-9"> 
                    <p class="lead" itemprop="description" style="text-align: justify;">Watch Sport in Live Broadcast from all over the world. No matter where you are you can always watch your favorite teams play live online. Catch the latest in live Sport entertainment with full access allSport matches! Watch Live Sport Broadcasts & Special Events Emissions Live Online 3000+ PREMIUM TV CHANNELS, 800+ PREMIUM MOVIE CHANNELS, 500+ PREMIUM MUSIC CHANNELS, 1500+ LOCAL TV CHANNELS, COMFORTABLE INTERFACE, NO HARDWARE REQUIRED, 24/7 WORLD-WIDE SUPPORT.
                    </p> 
                  </div> 
                </div> 
                <br> 
                <center>
                  <a href="#" onclick="window.location.href='<?php echo $site_url;?>/register.php'" data-ajax="false">
                    <img class="img-responsive" align="center" src="/img/Live.png">
                  </a>
                </center> 
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
                                  <img src="<?php echo $site_url;?>/img/ff.gif" width="20" height="20">&nbsp;Flash P2P
                                </span> 
                              </span> 
                              <span class="ext-right pull-right"> 
                                <span class="ext-speed nomobile">
                                  <script type="text/javascript"> document.write(Math.floor(Math.random()*3200));
                                  </script> Kb/s
                                </span> 
                                <span class="ext-icon label label-primary"> STREAM 
                                </span> 
                              </span> 
                            </li> 
                            <li class="ext-row pointer" style="display:block!important;visibility:visible!important;opacity:1!important"> 
                              <span class="ext-title ease" style="display:block!important;visibility:visible!important;opacity:1!important"> 
                                <span>
                                  <img src="<?php echo $site_url;?>/img/ff.gif" width="20" height="20">&nbsp;Castasap
                                </span> 
                              </span> 
                              <span class="ext-right pull-right"> 
                                <span class="ext-speed nomobile">
                                  <script type="text/javascript"> document.write(Math.floor(Math.random()*2200));
                                  </script> Kb/s
                                </span> 
                                <span class="ext-icon label label-primary"> STREAM 
                                </span> 
                              </span> 
                            </li> 
                            <li class="ext-row pointer" style="display:block!important;visibility:visible!important;opacity:1!important"> 
                              <span class="ext-title ease" style="display:block!important;visibility:visible!important;opacity:1!important"> 
                                <span>
                                  <img src="<?php echo $site_url;?>/img/ff.gif" width="20" height="20">&nbsp;Liveshare
                                </span> 
                              </span> 
                              <span class="ext-right pull-right"> 
                                <span class="ext-speed nomobile">
                                  <script type="text/javascript"> document.write(Math.floor(Math.random()*2200));
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
                    <div id="iframe-overlay"> 
                      <div class="row-mobile"> 
                        <div style="padding: 20px; background: white; margin-top: 50px; overflow: hidden; font-family: sans-serif!important;"> 
                          <div class="col-md-12"> 
                            <div class="row"> 
                              <div class="comment-wrapper"> 
                                <div class="comments-title">10 Comments
                                </div> 
                                <div class="comment-area"> 
                                  <input class="comment-input" placeholder="Write a comment..." type="text"> 
                                  <div class="share-facebook" display="block"> 
                                    <label class="uiInputLabelInput _55sg _kv1"> 
                                      <input id="js_e4" type="checkbox">
                                      <span>
                                      </span> 
                                    </label> 
                                    <label class="_3-99 _2ern _50f8 _5kx5 uiInputLabelLabel" for="js_e4">Send also to Facebook
                                    </label> 
                                  </div> 
                                  <div class="commbt"> 
                                    <a href="#" data-toggle="modal" data-target="#player-modal" class="js-clickoffer comment-button x-domain">Comment
                                    </a> 
                                  </div> 
                                </div> 
                              </div> 
                              <div class="comment-row"> 
                                <img class="profile-img" src="https://i.imgur.com/Wx6NVdV.png" alt=""> 
                                <div class="user-wrapper"> 
                                  <div class="username">Terry Barnes
                                  </div> 
                                  <div class="clear">
                                  </div> 
                                  <div class="user-comment">Thank you very much - was lookin for for a veery long time
                                  </div> 
                                  <div class="like-reply time"> 
                                    <a href="#" data-toggle="modal" data-target="#player-modal">Reply
                                    </a> · 
                                    <a href="#" data-toggle="modal" data-target="#player-modal" class="js-clickoffer like">
                                      <i>
                                        <img src="https://www.seeklogo.net/wp-content/uploads/2016/06/Facebook-Like-400x400.png" width="15" height="15">
                                      </i> 52
                                    </a> · 
                                    <a href="#" data-toggle="modal" data-target="#player-modal">Like
                                    </a> · 12 minute ago 
                                  </div> 
                                </div> 
                                <div class="clear">
                                </div> 
                              </div> 
                              <div class="comment-row"> 
                                <img class="profile-img" src="https://i.imgur.com/rChvxTY.png" alt=""> 
                                <div class="user-wrapper"> 
                                  <div class="username">Taylor Mackenzie
                                  </div> 
                                  <div class="clear">
                                  </div> 
                                  <div class="user-comment">OMG amazing! I love this site
                                  </div> 
                                  <div class="like-reply time"> 
                                    <a href="#" data-toggle="modal" data-target="#player-modal">Reply
                                    </a> · 
                                    <a href="#" data-toggle="modal" data-target="#player-modal" class="js-clickoffer like">
                                      <i>
                                        <img src="https://www.seeklogo.net/wp-content/uploads/2016/06/Facebook-Like-400x400.png" width="15" height="15">
                                      </i> 118
                                    </a> · 
                                    <a href="#" data-toggle="modal" data-target="#player-modal">Like
                                    </a> · 15 minute ago 
                                  </div> 
                                </div> 
                                <div class="clear">
                                </div> 
                              </div> 
                              <div class="comment-row"> 
                                <img class="profile-img" src="https://i.imgur.com/X6flv3p.png" alt=""> 
                                <div class="user-wrapper"> 
                                  <div class="username">Joseph J. Trumbull
                                  </div> 
                                  <div class="clear">
                                  </div> 
                                  <div class="user-comment">Great selection and quality is better than TV Cable, no kidding.
                                  </div> 
                                  <div class="like-reply time"> 
                                    <a href="#" data-toggle="modal" data-target="#player-modal">Reply
                                    </a> · 
                                    <a href="#" data-toggle="modal" data-target="#player-modal" class="js-clickoffer like">
                                      <i>
                                        <img src="https://www.seeklogo.net/wp-content/uploads/2016/06/Facebook-Like-400x400.png" width="15" height="15">
                                      </i> 35
                                    </a> · 
                                    <a href="#" data-toggle="modal" data-target="#player-modal">Like
                                    </a> · 15 minute ago 
                                  </div> 
                                </div> 
                                <div class="clear">
                                </div> 
                              </div> 
                              <div class="comment-row"> 
                                <img class="profile-img" src="https://i.imgur.com/lz7BAqo.png" alt=""> 
                                <div class="user-wrapper"> 
                                  <div class="username">Pastor Shahuano
                                  </div> 
                                  <div class="clear">
                                  </div> 
                                  <div class="user-comment">Sign up was really easy. In 2 minutes I was hooked up
                                  </div> 
                                  <div class="like-reply time"> 
                                    <a href="#" data-toggle="modal" data-target="#player-modal">Reply
                                    </a> · 
                                    <a href="#" data-toggle="modal" data-target="#player-modal" class="js-clickoffer like">
                                      <i>
                                        <img src="https://www.seeklogo.net/wp-content/uploads/2016/06/Facebook-Like-400x400.png" width="15" height="15">
                                      </i> 178
                                    </a> · 
                                    <a href="#" data-toggle="modal" data-target="#player-modal">Like
                                    </a> · 17 minute ago 
                                  </div> 
                                </div> 
                                <div class="clear">
                                </div> 
                              </div> 
                              <div class="comment-row" id="fbFeedbackContent"> 
                                <img class="profile-img" src="https://i.imgur.com/j8DF2ao.png" alt=""> 
                                <div class="user-wrapper"> 
                                  <div class="username">Eric Mn
                                  </div> 
                                  <div class="clear">
                                  </div> 
                                  <div class="user-comment">Yes this really works! Just got my free account
                                  </div> 
                                  <div class="like-reply time"> 
                                    <a href="#" data-toggle="modal" data-target="#player-modal">Reply
                                    </a> · 
                                    <a href="#" data-toggle="modal" data-target="#player-modal" class="js-clickoffer like">
                                      <i>
                                        <img src="https://www.seeklogo.net/wp-content/uploads/2016/06/Facebook-Like-400x400.png" width="15" height="15">
                                      </i> 48
                                    </a> · 
                                    <a href="#" data-toggle="modal" data-target="#player-modal">Like
                                    </a> · 30 minute ago 
                                  </div> 
                                </div> 
                                <div class="clear">
                                </div> 
                              </div> 
                              <div class="comment-row"> 
                                <img class="profile-img" src="https://i.imgur.com/PZV8zzG.png" alt=""> 
                                <div class="user-wrapper"> 
                                  <div class="username">Samuel H. Beck
                                  </div> 
                                  <div class="clear">
                                  </div> 
                                  <div class="user-comment">Live streaming work on my telly , its Cool !!
                                  </div> 
                                  <div class="like-reply time"> 
                                    <a href="#" data-toggle="modal" data-target="#player-modal">Reply
                                    </a> · 
                                    <a href="#" data-toggle="modal" data-target="#player-modal" class="js-clickoffer like">
                                      <i>
                                        <img src="https://www.seeklogo.net/wp-content/uploads/2016/06/Facebook-Like-400x400.png" width="15" height="15">
                                      </i> 52
                                    </a> · 
                                    <a href="#" data-toggle="modal" data-target="#player-modal">Like
                                    </a> · 45 minute ago 
                                  </div> 
                                </div> 
                                <div class="clear">
                                </div> 
                              </div> 
                              <div class="comment-row"> 
                                <img class="profile-img" src="https://i.imgur.com/QUYPOTZ.png" alt=""> 
                                <div class="user-wrapper"> 
                                  <div class="username">Laura Velez Garcia
                                  </div> 
                                  <div class="clear">
                                  </div> 
                                  <div class="user-comment">10/10 WEBSITE , Fantastic Library !! would recomended this to everyone.
                                  </div> 
                                  <div class="like-reply time"> 
                                    <a href="#" data-toggle="modal" data-target="#player-modal">Reply
                                    </a> · 
                                    <a href="#" data-toggle="modal" data-target="#player-modal" class="js-clickoffer like">
                                      <i>
                                        <img src="https://www.seeklogo.net/wp-content/uploads/2016/06/Facebook-Like-400x400.png" width="15" height="15">
                                      </i> 35
                                    </a> · 
                                    <a href="#" data-toggle="modal" data-target="#player-modal">Like
                                    </a> · 1 hour ago 
                                  </div> 
                                </div> 
                                <div class="clear">
                                </div> 
                              </div> 
                              <div class="comment-row"> 
                                <img class="profile-img" src="https://i.imgur.com/tu2nETS.png" alt=""> 
                                <div class="user-wrapper"> 
                                  <div class="username">Brenda Liggett
                                  </div> 
                                  <div class="clear">
                                  </div> 
                                  <div class="user-comment">Excited, Happy Watching guys !!!
                                  </div> 
                                  <div class="like-reply time"> 
                                    <a href="#" data-toggle="modal" data-target="#player-modal">Reply
                                    </a> · 
                                    <a href="#" data-toggle="modal" data-target="#player-modal" class="js-clickoffer like">
                                      <i>
                                        <img src="https://www.seeklogo.net/wp-content/uploads/2016/06/Facebook-Like-400x400.png" width="15" height="15">
                                      </i> 78
                                    </a> · 
                                    <a href="#" data-toggle="modal" data-target="#player-modal">Like
                                    </a> · 2 hour ago 
                                  </div> 
                                </div> 
                                <div class="clear">
                                </div> 
                              </div> 
                              <div class="comment-row sub"> 
                                <img class="profile-img" src="https://i.imgur.com/XbiDb7c.png" alt=""> 
                                <div class="user-wrapper"> 
                                  <div class="username">Alfred Lendio Jr.
                                  </div> 
                                  <div class="clear">
                                  </div> 
                                  <div class="user-comment">Thanks, I'm so glad to be watching 
                                    <img src="https://i.imgur.com/delYypL.png" style="height: 13px;">
                                  </div> 
                                  <div class="like-reply time"> 
                                    <a href="#" data-toggle="modal" data-target="#player-modal">Reply
                                    </a> · 
                                    <a href="#" data-toggle="modal" data-target="#player-modal" class="js-clickoffer like">
                                      <i>
                                        <img src="https://www.seeklogo.net/wp-content/uploads/2016/06/Facebook-Like-400x400.png" width="15" height="15">
                                      </i> 35
                                    </a> · 
                                    <a href="#" data-toggle="modal" data-target="#player-modal">Like
                                    </a> · 2 hour ago 
                                  </div> 
                                </div> 
                                <div class="clear">
                                </div> 
                              </div> 
                              <div class="comment-row"> 
                                <img class="profile-img" src="https://i.imgur.com/KLmX3Ui.png" alt=""> 
                                <div class="user-wrapper"> 
                                  <div class="username">Jenifer Lopez
                                  </div> 
                                  <div class="clear">
                                  </div> 
                                  <div class="user-comment">Love that so many are available in HD
                                  </div> 
                                  <div class="like-reply time"> 
                                    <a href="#" data-toggle="modal" data-target="#player-modal">Reply
                                    </a> · 
                                    <a href="#" data-toggle="modal" data-target="#player-modal" class="js-clickoffer like">
                                      <i>
                                        <img src="https://www.seeklogo.net/wp-content/uploads/2016/06/Facebook-Like-400x400.png" width="15" height="15">
                                      </i> 78
                                    </a> · 
                                    <a href="#" data-toggle="modal" data-target="#player-modal">Like
                                    </a> · 2 hour ago 
                                  </div> 
                                </div> 
                                <div class="clear">
                                </div> 
                              </div> 
                            </div> 
                          </div> 
                        </div> 
                      </div> 
                    </div> 
                  </div> 
                </div> 
                </article> 
              </div> 
          </div> 
          <div id="player-modal" class="modal fade nocontext"> 
            <div class="modal-dialog"> 
              <div class="modal-content"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x
                </button> 
                <div class="modal-header text-center"> you must create a free account in order to watch live stream 
                </div> 
                <div class="modal-body"> 
                  <img class="img-responsive" src="/img/soccer.jpg" width="780" height="439" alt="<?php echo '' . htmlspecialchars($_GET["match"]) . ''; ?> Live Stream"> 
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
                    <button class="btn btn-danger btn-lg btn-responsive" onclick="window.location.href='<?php echo $site_url;?>/register.php'"> 
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
          <a href="<?php echo $site_url;?>/"><?php echo $_SERVER['HTTP_HOST']; ?>
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
            <script data-cfasync="false" src="<?php echo $site_url;?>/assets/js/email-decode.min.js">
            </script>
            <script type="text/javascript"> document.write(Math.floor(Math.random()*12733));
            </script>
          </span> Users Online 
        </div> 
      </div> 
    </div> 
  </footer> 
  <script type="text/javascript" src="//code.jquery.com/jquery-2.2.0.min.js" defer>
  </script> 
  <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" defer>
  </script> 
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js" defer>
  </script> 
  <script type="text/javascript" src="<?php echo $site_url;?>/js/scripts.min.js" defer>
  </script> 
  <?php include('histats.php');?>
  </body> 
</html>
