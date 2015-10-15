    </div><!-- /container -->
    <div id="push"></div>
    </div><!--jake oct5-->
    <footer>
    	<div class="container" id="footer">
    		<p class="text-center paddingTop">&copy; Intermountain Center for Disaster Preparedness</p>
            <p class="text-center"><a href="siteMap.php">Site Map</a>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href="adminLanding.php">Admin</a></p>
            
            
            <address itemscope itemtype="http://schema.org/Organization">
                <article class="text-center">
                    <span class="hidden" itemprop="name">Intermountain Center for Disaster Preparedness</span><br>
                    <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                    <span itemprop="streetAddress">8th Ave C St</span><br>
                    <span itemprop="addressLocality">Salt Lake City</span>,
                    <span itemprop="addressRegion">UT</span>,
                    <span itemprop="postalCode">84143</span><br>
                    </div><!--end of the address-->
                </article>
                
                <article class="text-center">
                    <span itemprop="telephone">801.408.7061</span><br>
                </article>
            </address>
            
            <!-- social icons -->
            <ul class="soc">
    			<li><a class="soc-facebook" href="https://www.facebook.com/pages/Intermountain-Center-for-Disaster-Preparedness/369673569780460" target="_blank"></a></li>
    			<li><a class="soc-twitter" href="https://twitter.com/INterDisaster" target="_blank"></a></li>
    			<li><a class="soc-google soc-icon-last" href="#"></a></li>
			</ul>

            
        </div><!-- end of container --> 
    </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <?php
	if ($page != events) {
    		echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>';
		}
    ?>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <?php
	if($page == 'admin'){
			echo '<script src="js/tooltip.js"></script>';
		}
	?>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>