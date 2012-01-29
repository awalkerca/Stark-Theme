      <?php if ($ad = theme_option('bottom_leaderboard')){ ?>
        <div id="leaderboard_ad" class="ad leaderboard">
          <?= $ad ?>
        </div>        
      <?php }?>
    </div> <?php // #main ?>
      
    </div> <?php // #container ?>
    <div id="footer">      

      <?php
        $footer_args = array(
            'theme_location'            => 'secondary-menu',
            'container_id'              => 'footer_main_menu',
            'link_before'               => '<span>',
            'link_after'                => '</span>',
            'depth'                     => 1
        );
           
      wp_nav_menu($footer_args); 

			?>
		  <?php $copyright = theme_option('copyright'); ?>
      <p class="copyright"><?= $copyright; ?></p>			
    </div>
    <?php wp_footer();?>
    <script type="text/javascript">
    <?php
			$google_code = stripslashes(theme_option('ga_code'));			
		?>
			<?=$google_code?>
		</script>		
  </body>
</html>