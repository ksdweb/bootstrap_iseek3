<!-- Staff Toolkit -->
    <div class="hidden-print">  
      <div class="row">
        <div class="col-lg-12">
          <div class="toolkit large-text" id="toolkit-anchor">&nbsp;<i class="fa fa-briefcase"></i>&nbsp;&nbsp;<?php echo t("Toolkit"); ?>
          <a data-toggle="collapse" data-target="#footer-box" aria-expanded="true" aria-controls="footer-box" class="visible-xs collapser"><i class="fa fa-angle-down"></i></a>  
          </div>
        </div>
      </div>

      <div class="row collapse in" id="footer-box">
        <div class="col-lg-12 footer-border">
        <div class="footer-background toolkit-row">
        <div class="col-md-3 left-menu">
           <div class="row underline left-menu-top">
              <div  class="partners content-large-text">
                <?php
                        // switch depending on domain
                        // 555
                        if (require_login_display_local('newyork')) {
                                echo "<h5 class=\"content-large-text\">Quicklinks - " . t("New York") . "</h5>";
                        // 131
                        } elseif (require_login_display_local('geneva')) {
                                echo "<h5 class=\"content-large-text\">Quicklinks - " . t("Geneva") . "</h5>";
                        // 60
                        } elseif (require_login_display_local('addisababa')) {
                                echo "<h5 class=\"content-large-text\">Quicklinks - " . t("Addis Ababa") . "</h5>";
                        // 61
                        } elseif (require_login_display_local('bangkok')) {
                                echo "<h5 class=\"content-large-text\">Quicklinks - " . t("Bangkok") . "</h5>";
                        // 62
                        } elseif (require_login_display_local('beirut')) {
                                echo "<h5 class=\"content-large-text\">Quicklinks - " . t("Beirut") . "</h5>";
                        // 63
                        } elseif (require_login_display_local('nairobi')) {
                                echo "<h5 class=\"content-large-text\">Quicklinks - " . t("Nairobi") . "</h5>";
                        // 64
                        } elseif (require_login_display_local('santiago')) {
                                echo "<h5 class=\"content-large-text\">Quicklinks - " . t("Santiago") . "</h5>";
                        // 65
                        } elseif (require_login_display_local('vienna')) {
                                echo "<h5 class=\"content-large-text\">Quicklinks - " . t("Vienna") . "</h5>";
                        // external
                        } else {
                        }
                ?>
                <?php print $menu_quicklinks; ?>
              </div>
          </div>
          <div class="about-us">
              <img src="<?php echo "/" . drupal_get_path('theme', 'bootstrap_iseek3') . '/images/' . t('iseek-logo-white.png'); ?>" class="img-responsive" id="logo-footer" alt="iseek logo"/>
                <p class="content-large-text">
                    <a href="<?php echo url("node/11537"); ?>"><?php echo t("About us"); ?> <i class="fa fa-angle-double-right"></i></a>
                </p>
                <div class="medium-text">
                  <p><?php echo t("The United Nations Intranet, iSeek, was developed in 2005 to encourage knowledge-sharing throughout the UN system. Its mission statement is: One Intranet for one UN worldwide."); ?></p>
                </div>
                <p class="content-large-text">
                    <a href="<?php echo url("contact"); ?>"><?php echo t("Contact us"); ?> <i class="fa fa-angle-double-right"></i></a>
                </p>
              
        </div>
        </div>
          <div class="col-md-3">
           <div class="footer-menu-items">
            <div class="content-large-text" id="key-tools">
              <?php print $menu_ktt; ?>
            </div>
            <h5 class="content-large-text underline"><?php print t("Key tools"); ?></h5>
            <div class="medium-text">
              <?php print $menu_ktb; ?>
            </div>             
          </div>

        </div>
        <div class="col-md-3">
          <div class="footer-menu-items"> 
            <h5 class="content-large-text underline"><?php print t("Staff development"); ?></h5>
            <div class="medium-text">
              <?php print $menu_staff; ?>
            </div> 
            <h5 class="content-large-text underline"><?php print t("Pay, benefits and insurance"); ?></h5>
            <div class="medium-text">
              <?php print $menu_pay; ?>
            </div> 
            <h5 class="content-large-text underline"><?php print t("Security"); ?></h5>
            <div class="medium-text">
              <?php print $menu_security; ?>
            </div> 
            <h5 class="content-large-text underline"><?php print t("Travel"); ?></h5>
            <div class="medium-text">
              <?php print $menu_travel; ?>
            </div> 
            <h5 class="content-large-text underline"><?php print t("Health and wellbeing"); ?></h5>
            <div class="medium-text">
              <?php print $menu_health; ?>
            </div> 

          </div>
        </div>
        <div class="col-md-3">
          <div class="footer-menu-items"> 
            <h5 class="content-large-text underline"><?php print t("Rules and regulations"); ?></h5>
            <div class="medium-text">
              <?php print $menu_rules; ?>
            </div> 
            <h5 class="content-large-text underline"><?php print t("References and manuals"); ?></h5>
            <div class="medium-text">
              <?php print $menu_reference; ?>
            </div> 

            <h5 class="content-large-text underline"><?php print t("Ethics and internal justice"); ?></h5>
            <div class="medium-text">
              <?php print $menu_ethics; ?>
            </div> 
              <h5 class="content-large-text underline"><?php print t("Finance and budget"); ?></h5>
              <div class="medium-text">
                <?php print $menu_finance; ?>
            </div> 
              <h5 class="content-large-text underline"><?php print t("ICT"); ?></h5>
              <div class="medium-text">
                <?php print $menu_ict; ?>
            </div>
          </div>
        </div>
              <div class="about-us-xs visible-xs visible-sm">
                <img src="<?php echo "/" . drupal_get_path('theme', 'bootstrap_iseek3') . '/images/' . t('iseek-logo-white.png'); ?>" class="img-responsive" id="logo-footer" alt="iseek logo"/>
                <p class="content-large-text">
			<a href="<?php echo url("node/11537"); ?>"><?php echo t("About us"); ?> <i class="fa fa-angle-double-right"></i></a>
                </p>
                <div class="medium-text">
                  <p><?php echo t("The United Nations Intranet, iSeek, was developed in 2005 to encourage knowledge-sharing throughout the UN system. Its mission statement is: One Intranet for one UN worldwide."); ?></p>
                </div>
                <p class="content-large-text">
                 	<a href="/contact"><?php echo t("Contact us"); ?> <i class="fa fa-angle-double-right"></i></a> 
                </p>
            </div>
        </div>
      </div>
    </div><!-- / main .container -->
  </div> 
    <p>&nbsp;</p>
    <footer class="blog-footer visible-xs hidden-print">
      
        <a href="#top-bar">Back to top</a>
      
      <p>
        <?php print render($page['footer']); ?>
      </p>

    </footer>
  </div> <!-- main container -->
