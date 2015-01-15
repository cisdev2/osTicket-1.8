<?php
$title=($cfg && is_object($cfg) && $cfg->getTitle())
    ? $cfg->getTitle() : 'osTicket :: '.__('Support Ticket System');
$signin_url = ROOT_PATH . "login.php"
    . ($thisclient ? "?e=".urlencode($thisclient->getEmail()) : "");
$signout_url = ROOT_PATH . "logout.php?auth=".$ost->getLinkToken();

header("Content-Type: text/html; charset=UTF-8\r\n");
?>
<!DOCTYPE html>
<!--[if IEMobile 7]><html class="iem7 oldie" lang="en"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="ie7 oldie" lang="en"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="ie8 oldie" lang="en"><![endif]-->
<!--[if (IE 9)&!(IEMobile)]><html class="ie9" lang="en"><![endif]-->
<!--[[if (gt IE 9)|(gt IEMobile 7)]><!--><html lang="en"><!--<![endif]-->
<!--
 * UBC CLF (Common Look and Feel) v7.0.4
 * Copyright 2012-2013 The University of British Columbia
 * UBC Communications and Marketing
 * http://brand.ubc.ca/clf
 */
-->
<head>
    <meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo Format::htmlchars($title); ?></title>
    <meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/osticket.css?c18eac4" media="screen">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>css/theme.css?c18eac4" media="screen">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>css/print.css?c18eac4" media="print">
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>scp/css/typeahead.css"
         media="screen" />
    <link type="text/css" href="<?php echo ROOT_PATH; ?>css/ui-lightness/jquery-ui-1.10.3.custom.min.css"
        rel="stylesheet" media="screen" />
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/thread.css?c18eac4" media="screen">
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/redactor.css?c18eac4" media="screen">
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/font-awesome.min.css?c18eac4">
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/flags.css?c18eac4">
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/rtl.css?c18eac4"/>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery-1.8.3.min.js?c18eac4"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery-ui-1.10.3.custom.min.js?c18eac4"></script>
    <script src="<?php echo ROOT_PATH; ?>js/osticket.js?c18eac4"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/filedrop.field.js?c18eac4"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery.multiselect.min.js?c18eac4"></script>
    <script src="<?php echo ROOT_PATH; ?>scp/js/bootstrap-typeahead.js?c18eac4"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor.min.js?c18eac4"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor-osticket.js?c18eac4"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor-fonts.js?c18eac4"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo ROOT_PATH; ?>css/filedrop.css">
    <?php
    if($ost && ($headers=$ost->getExtraHeaders())) {
        echo "\n\t".implode("\n\t", $headers)."\n";
    }
    ?>
	
	<!-- Stylesheets -->
	<link href="http://cdn.ubc.ca/clf/7.0.4/css/ubc-clf-full.min.css" rel="stylesheet">
	<link href="<?php echo ROOT_PATH; ?>css/unit.css" rel="stylesheet">
	<!--[if lte IE 7]>
	<link href="https://cdn.ubc.ca/clf/7.0.4/css/font-awesome-ie7.css" rel="stylesheet">
	<![endif]-->
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!-- Fav and touch icons -->
	<link rel="shortcut icon" href="//cdn.ubc.ca/clf/7.0.4/img/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="//cdn.ubc.ca/clf/7.0.4/img/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="//cdn.ubc.ca/clf/7.0.4/img/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="//cdn.ubc.ca/clf/7.0.4/img/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="//cdn.ubc.ca/clf/7.0.4/img/apple-touch-icon-57-precomposed.png">
	
</head>
<body>
    <div class="container">
        <!-- UBC Global Utility Menu -->
        <div class="collapse expand" id="ubc7-global-menu">
            <div id="ubc7-search" class="expand">
                <div id="ubc7-search-box">
                    <form class="form-search" method="get" action="http://www.ubc.ca/search/refine/" role="search">
                        <input type="text" name="q" placeholder="Search the Centre for Instructional Support" class="input-xlarge search-query">
                        <input type="hidden" name="label" value="Search UBC" />
                        <input type="hidden" name="site" value="*cis.apsc.ubc.ca" />
                        <button type="submit" class="btn">Search</button>
                    </form>
                </div>
            </div>
            <div id="ubc7-global-header" class="expand">
                <!-- Global Utility Header from CDN -->
            </div>
        </div>
        <!-- End of UBC Global Utility Menu -->
        <!-- UBC Header -->
        <header id="ubc7-header" class="row-fluid expand" role="banner">
            <div class="span1">
                <div id="ubc7-logo">
                    <a href="http://www.ubc.ca">The University of British Columbia</a>
                </div>
            </div>
            <div class="span2">
                <div id="ubc7-apom">
                    <a href="//cdn.ubc.ca/clf/ref/aplaceofmind">UBC - A Place of Mind</a>                        
                </div>
            </div>
            <div class="span9" id="ubc7-wordmark-block">
                <div id="ubc7-wordmark">
                    <a href="http://www.ubc.ca">The University of British Columbia</a>
                    <span class="ubc7-campus" id="ubc7-vancouver-campus">Vancouver campus</span>
                </div>
                <div id="ubc7-global-utility">
                    <button type="button" data-toggle="collapse" data-target="#ubc7-global-menu"><span>UBC Search</span></button>
                    <noscript><a id="ubc7-global-utility-no-script" href="http://www.ubc.ca/">UBC Search</a></noscript>
                </div>
            </div>
        </header>
        <!-- End of UBC Header -->
        <!-- UBC Unit Identifier -->
        <div id="ubc7-unit" class="row-fluid expand">
            <div class="span12">
                <!-- Mobile Menu Icon -->
                <div class="navbar">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target="#ubc7-unit-navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                </div>
                <!-- Read more about Unit Name Treatment on http://brand.ubc.ca/clf -->
                <!-- No Faculty Treatment --><!--<div id="ubc7-unit-name" class="ubc7-single-element"> -->
                <div id="ubc7-unit-name">
                    <a href="/"><span id="ubc7-unit-faculty">Faculty of Applied Science</span><span id="ubc7-unit-identifier">Centre for Instructional Support: Service Requests</span></a>
                </div>
            </div>
        </div>
        <!-- End of UBC Unit Identifier -->
        <!-- UBC Unit Navigation -->
        <div id="ubc7-unit-menu" class="navbar expand" role="navigation">
            <div class="navbar-inner expand">
                <div class="container">
                    <div class="nav-collapse collapse" id="ubc7-unit-navigation">
                        <ul class="nav">
							<?php 
							$activemenu = array('home'=>false,'new'=>false,'status'=>false);

							
							if(basename($_SERVER['PHP_SELF'])=="tickets.php") {
								$activemenu['status'] = true;
							} else if($nav && ($navs=$nav->getNavLinks()) && is_array($navs)) {
								foreach($navs as $name =>$nav) {
									if($nav['active']) {
										$activemenu[$name] = true;
									}
								}
							}
							
							?>
							<li<?php if($activemenu['home'] || $activemenu['new']) {echo ' class="active"';} ?>><a href="<?php echo ROOT_PATH; ?>">Submit a Request</a></li>
                            <!--<li<?php if($activemenu['new']) {echo ' class="active"';} ?>><a href="<?php echo ROOT_PATH; ?>open.php">Submit a Request</a></li>-->
                            <li<?php if($activemenu['status']) {echo ' class="active"';} ?>><a href="<?php echo ROOT_PATH; ?>view.php">Check a Request Status</a></li>
                            <li><a href="http://cis.apsc.ubc.ca">CIS Website</a></li>
							<!--
                            <li class="dropdown">
                                <div class="btn-group">
                                    <a class="btn" href="http://www.ubc.ca/">Dropdown</a>
                                    <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="ubc7-arrow blue down-arrow"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else</a></li>
                                        <li class="nav-header">Navigation header</li>
                                        <li><a href="#">Separated link</a></li>
                                        <li><a href="#">One more separated link</a></li>
                                    </ul>
                                </div>
                            </li>
							-->
                        </ul>
                    </div><!-- /.nav-collapse -->
                </div>
            </div><!-- /navbar-inner -->
        </div><!-- /navbar -->
        <!-- End of UBC Unit Navigation -->
        <!-- UBC Unit Breadcrumbs 
        <ul class="breadcrumb expand">
            <li>
                <a href="#">Faculty Name</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="#">Unit Name</a> <span class="divider">/</span>
            </li>
            <li class="active">Page Name</li>
        </ul>
        End of UBC Unit Breadcrumbs -->
        <!-- Content Area -->
        <div class="content expand" role="main">
		<div id="clfcompatibilty">

         <?php if($errors['err']) { ?>
            <div id="msg_error"><?php echo $errors['err']; ?></div>
         <?php }elseif($msg) { ?>
            <div id="msg_notice"><?php echo $msg; ?></div>
         <?php }elseif($warn) { ?>
            <div id="msg_warning"><?php echo $warn; ?></div>
         <?php } ?>
