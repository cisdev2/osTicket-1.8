</div></div>
        <!-- End of Content Area -->
		
		<div class="row-fluid expand content">
			<div id="subsidiary" style="padding: 0 15px 15px 15px;" class="sidebar aside span-12">
				<div id="section-4" class="widget section-widget widget-section-widget"><div class="widget-wrap widget-inside"><hr>
				<div id="contact-footer" class="column">

				<div class="span4">
				<p><strong>Jim Sibley</strong><br>
				Director<br>
				Tel: 604 822 9241<br>
				E-mail: jim.sibley@ubc.ca</p>
				</div>

				<div class="span4">
				<p><strong>Sophie Spiridonoff</strong><br>
				Educational Technology Consultant<br>
				Tel: 604 822 9572<br>
				E-mail: sophie.spiridonoff@ubc.ca</p>
				</div>

				<div class="span4">
				<p><strong>CIS Office</strong><br>
				Room 2205 - <a href="http://www.maps.ubc.ca/PROD/index_detail.php?locat1=306">CEME Building</a><br> 
				6250 Applied Science Lane<br>
				Vancouver, BC Canada V6T 1Z4<br>
				</p>
				</div>

				</div>
				</div></div>	
				</div><!-- #subsidiary .aside -->
		</div>
		
        <!-- Footer Area Unit Menu - Mobile Only -->
		<?php
		/*
        <div id="ubc7-unit-alternate-navigation" class="navbar expand visible-phone" role="navigation">
            <div class="navbar-inner expand">
                <div class="container">
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li class="active"><a href="#">Home</a></li>
                            <li><a href="#">First Link</a></li>
                            <li><a href="#">Second Link</a></li>
                            <li><a href="#">Third Link</a></li>
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
                        </ul>
                    </div><!-- /.nav-collapse -->
                </div>
            </div><!-- /navbar-inner -->
        </div><!-- /navbar --> */
		?>
        <!-- End of Footer Area Unit Menu -->
        <footer id="ubc7-footer" class="expand" role="contentinfo">
		
		
			<!--
            <div class="row-fluid expand" id="ubc7-unit-footer">
			            <div class="span10" id="ubc7-unit-address">
                <div id="ubc7-address-unit-name">CIS Office</div>
                                <div id="ubc7-address-campus">Vancouver Campus</div>                <div id="ubc7-address-street">CEME 2205 - 6250 Applied Science Lane</div>                                <div id="ubc7-address-location">
                    <span id="ubc7-address-city">Vancouver</span>, <span id="ubc7-address-province">BC</span> <span id="ubc7-address-country">Canada</span> <span id="ubc7-address-postal">V6T 1Z4</span> 
                </div>
                                                <div id="ubc7-address-website">Website <a href="http://cis.apsc.ubc.ca">cis.apsc.ubc.ca</a></div>                            </div>
            </div>-->
			
			
			
			
            <!--<div class="row-fluid expand ubc7-back-to-top">
                <div class="span2">
                    <a href="#">Back to top <div class="ubc7-arrow up-arrow grey"></div></a>
                </div>
            </div>-->
            <div class="row-fluid expand" id="ubc7-global-footer">
                <div class="span5" id="ubc7-signature"><a href="http://www.ubc.ca/">The University of British Columbia</a></div>
                <div class="span7" id="ubc7-footer-menu">
                </div>
            </div>
            <div class="row-fluid expand" id="ubc7-minimal-footer">
                <div class="span12">
                    <ul>
                        <li><a href="//cdn.ubc.ca/clf/ref/emergency">Emergency Procedures</a> <span class="divider">|</span></li>
                        <li><a href="//cdn.ubc.ca/clf/ref/terms">Terms of Use</a> <span class="divider">|</span></li>
                        <li><a href="//cdn.ubc.ca/clf/ref/copyright">Copyright</a> <span class="divider">|</span></li>
                        <li><a href="//cdn.ubc.ca/clf/ref/accessibility">Accessibility</a> <span class="divider">|</span></li> 
						<li><a href="<?php echo ROOT_PATH; ?>open.php">Generic Request Form</a> <span class="divider">|</span></li>
						<li><a href="<?php echo ROOT_PATH; ?>scp/">Support Login</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div> <!-- /container -->
    <!-- Placed javascript at the end for faster loading -->
    <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
    <script src="//cdn.ubc.ca/clf/7.0.4/js/ubc-clf.min.js"></script>
	<div id="overlay"></div>
	
	<div id="loading">
		<div id="loadinginner">
		<h4><?php echo __('Request Processing');?></h4>
		<p><?php echo __('Please wait... it will take a second!');?></p>
		</div>
	</div>
	<?php
	if (($lang = Internationalization::getCurrentLanguage()) && $lang != 'en_US') { ?>
		<script type="text/javascript" src="ajax.php/i18n/<?php
			echo $lang; ?>/js"></script>
	<?php } ?>
	
</body>
</html>
