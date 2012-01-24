<?php
  class Custom_Theme_Options {
    private $sections;  //sections for theme management
    
    /* Initialize */
    function __construct(){
      $this->checkboxes = array();
      $this->settings = array();
      $this->get_settings();
      
      $this->sections['general'] = __('General');
      $this->sections['homepage'] = __('Home Page');
      $this->sections['footer']  = __('Footer');
      $this->sections['post'] = __('Posts');
      $this->sections['advertising'] = __('Advertising');
      $this->sections['social']= __('Social Networking');
      $this->sections['content_slider'] = __('Content Slider');
      
      add_action('admin_menu', array(&$this, 'add_pages'));
      add_action('admin_init',array(&$this, 'register_settings'));
      
      if ( ! get_option(THEME_OPTIONS)){
        $this->initialize_settings();
      } 
    }
    
    
    /* Define all settings and their defaults */
    public function get_settings(){
      
      /* GENERAL SETTINGS */
      $this->settings['favicon'] = array(
        'section'     => 'general',
        'title'       => __('Custom Favicon'),
        'desc'        => __('A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image'),
        'type'        => 'text',
        'std'         => __(get_bloginfo('url') . '/favicon.ico'),
      );

      $this->settings['colour_scheme'] = array(
        'section'     => 'general',
        'title'       => 'Colour Scheme',
        'desc'        => 'Choose a Colour Scheme',
        'type'        => 'select',
        'std'         => 'dark',
        'choices'     => array(
          'light' => 'Light',
          'dark'  => 'Dark'
        )
      );

      $this->settings['sidebar_location'] = array(
        'section'     => 'general',
        'title'       => 'Sidebar Location',
        'desc'        => 'Choose a location for the Sidebar',
        'type'        => 'select',
        'std'         => 'right',
        'choices'     => array(
          'left'  => 'Left',
          'right' => 'Right',
          'none'  => 'None'                      
        )
      );
      
      /* HOMEPAGE SETTINGS */
      $this->settings['sidebar_on_homepage'] = array(
        'section'     => 'homepage',
        'title'       => 'Sidebar on Homepage?',
        'desc'        => 'Should the sidebar be displayed on the homepage?',
        'type'        => 'checkbox',
        'std'         => '0',
      );
      
      $this->settings['page_title_on_homepage'] = array(
        'section'     => 'homepage',
        'title'       => 'Page Title on Homepage?',
        'desc'        => 'If Homepage is set to static content, should the Title be displayed?',
        'type'        => 'checkbox',
        'std'         => '0'      
      );
      
      
      /* FOOTER SETTINGS */
      $this->settings['copyright'] = array(
        'section'     => 'footer',
        'title'       => 'Copyright Text',
        'desc'        => 'Enter the text to be displayed with the copyright.',
        'type'        => 'text',
        'std'         => '&copy;'        
      );
      
      $this->settings['ga_code'] = array(
        'section'     => 'footer',
        'title'       => 'Google Analytics Code',
        'desc'        => 'Paste in your Google Analytics or other tracking codes.',
        'type'        => 'textarea',
        'std'         => ''
      );
      
      /* POST SETTINGS */
      // 
      // $this->settings['post_listings_heading'] = array(
      //   'section'     => 'post',
      //   'title'       => '',
      //   'desc'        => 'Lists of Posts',
      //   'type'        => 'heading'
      // );
      // 
      // $this->settings['post_listing_archives'] = array(
      //   'section'       => 'post',
      //   'title'         => 'Post Format: Archives',
      //   'desc'          => 'What post content should be displayed on an Archive list?',
      //   'type'          => 'select',
      //   'std'           => 'excerpt',
      //   'choices'       => array(
      //     'excerpt'    => 'Excerpt',
      //     'content'   => 'Full Content'
      //   )
      // );
      // 
      // $this->settings['post_listing_search'] = array(
      //   'section'       => 'post',
      //   'title'         => 'Post Format: Search',
      //   'desc'          => 'What post content should be displayed on a Search Result list?',
      //   'type'          => 'select',
      //   'std'           => 'excerpt',
      //   'choices'       => array(
      //     'excerpt'    => 'Excerpt',
      //     'content'   => 'Full Content'
      //   )
      // );
      // 
      // $this->settings['single_post_heading'] = array(
      //   'section'     => 'post',
      //   'title'       => '',
      //   'desc'        => 'Single Post',
      //   'type'        => 'heading'
      // );
      
      $this->settings['display_author'] = array(
        'section'     => 'post',
        'title'       => 'Author Location',
        'desc'        => 'Where to display Author information on a Post',
        'type'        => 'select',
        'std'         => 'top',
        'choices'     => array(
          'top'   => 'Top of Post',
          'end'   => 'End of Post',
          'none'  => 'Do Not Show'
        )
      );
      
      $this->settings['display_metadata'] = array(
        'section'     => 'post',
        'title'       => 'Display Custom Metadata',
        'desc'        => 'Should Custom Fields be displayed on posts?',
        'type'        => 'checkbox',
        'std'         => '0'
      );
      
      $this->settings['display_date'] = array(
        'section'     => 'post',
        'title'       => 'Date Location',
        'desc'        => 'Where to display the Date on a Post',
        'type'        => 'select',
        'std'         => 'end',
        'choices'     => array(
          'top'   => 'Top of Post',
          'end'   => 'End of Post',
          'non'   => 'Do Not Show'
        )
      );
      
      /* SOCIAL NETWORK SETTINGS */
      $this->settings['twitter_username'] = array(
        'section'     => 'social',
        'title'       => 'Twitter Username',
        'desc'        => 'Your Twitter username',
        'type'        => 'text',
        'std'         => ''
      );
      
      $this->settings['facebook_username'] = array(
        'section'     => 'social',
        'title'       => 'Facebook Username',
        'desc'        => 'Your Facebook username, not the email address',
        'type'        => 'text',
        'std'         => ''        
      );
      
      /* ADVERTISING SETTINGS */
      $this->settings['bottom_leaderboard'] = array(
        'section'     => 'advertising',
        'title'       => 'Leaderboard Ad Space: Footer',
        'desc'        => 'Leaderbard (728 x 90 pixels) between content and footer',
        'type'        => 'textarea',
        'std'         => ''
      );
      
      $this->settings['sidebar_ad1'] = array(
        'section'     => 'advertising',
        'title'       => 'Sidebar Ad Space: #1',
        'desc'        => 'Sidebar (180 x 150 pixels), first after the Top Sidebar',
        'type'        => 'textarea',
        'std'         => ''
      );

      $this->settings['sidebar_ad2'] = array(
        'section'     => 'advertising',
        'title'       => 'Sidebar Ad Space: #2',
        'desc'        => 'Sidebar (180 x 150 pixels), second after the Top Sidebar.',
        'type'        => 'textarea',
        'std'         => ''
      );
      
      $this->settings['sidebar_ad3'] = array(
        'section'     => 'advertising',
        'title'       => 'Sidebar Ad Space: #3',
        'desc'        => 'Sidebar (180 x 150 pixels), first after the Bottom Sidebar.',
        'type'        => 'textarea',
        'std'         => ''
      );

      $this->settings['sidebar_ad4'] = array(
        'section'     => 'advertising',
        'title'       => 'Sidebar Ad Space: #4',
        'desc'        => 'Sidebar (180 x 150 pixels), second after the Bottom Sidebar.',
        'type'        => 'textarea',
        'std'         => ''
      );      
   
      /* CONTENT SLIDER SETTINGS */
      $this->settings['content_slider_enabled'] = array(
        'section'       => 'content_slider',
        'title'         => 'Enabled on Homepage?',
        'desc'          => 'Enable the Content Slider on the Homepage',
        'type'          => 'checkbox',
        'std'           => '1'
      );
      
      $this->settings['content_slider_category'] = array(
          'section'     => 'content_slider',
          'title'       => 'Source Category',
          'desc'        => 'Select the category Posts will be selected from.',
          'type'        => 'select',
          'std'         => '',
          'choices'     => $this->category_list()
      );
      
      $this->settings['content_slider_num_items'] = array(
        'section'       => 'content_slider',
        'title'         => 'Number of Items to Display',
        'desc'          => 'How many Items should be displayed in Slider?',
        'type'          => 'text',
        'std'           => '4'
      );
      
      $this->settings['content_slider_menu_location'] = array(
        'section'       => 'content_slider',
        'title'         => 'Menu Location',
        'desc'          => 'Choose on which side of the featured content slider the menu should appear.',
        'type'          => 'select',
        'std'           => 'left',
        'choices'       => array(
          'left'    => 'Left',
          'right'   => 'Right'
          )
      );
        
      $this->settings['content_slider_content_header'] = array(
        'section'       => 'content_slider',
        'type'          => 'heading',
        'title'         => '',
        'desc'          => 'Slide Content Configuration'
      );
      
      $this->settings['content_slider_content'] = array(
        'section'       => 'content_slider',
        'title'         => 'Slide Content',
        'desc'          => 'Choose Which content section to display in Slide. Note: Content will be cut-off if it doesn\' fit.',
        'type'          => 'select',
        'std'           => 'excerpt',
        'choices'       => array(
          'excerpt'    => 'Excerpt',
          'content'   => 'Full Content'
        )
      );
      
      $this->settings['content_slider_call_to_action'] = array(
        'section'       => 'content_slider',
        'title'         => 'Content Link',
        'desc'          => 'What can a visitor click on to read more about the slide?',
        'type'          => 'select',
        'std'           => 'link',
        'choices'       => array(
          'link'    => 'Separate Link',
          'title'   => 'Slide Title',
          'none'    => 'No Link'
        )
      );
      
      $this->settings['content_slider_show_image'] = array(
        'section'       => 'content_slider',
        'title'         => 'Include Feature Image',
        'desc'          => 'Display the Feature Image for the Post/Page, if it exists.',
        'type'          => 'checkbox',
        'std'           => '0'
      );
      
      
      
   }

    private function category_list(){
       $categories = get_categories('hide_empty=0&orderby=name');
       $cats = array();
       foreach ($categories as $cat){
         $cats[$cat->cat_ID] = $cat->cat_name;
       }
       return $cats;
     }
    
    public function load_scripts(){
      wp_enqueue_script('jquery-ui-tabs');
      wp_enqueue_script('admin_options_script',get_bloginfo('template_directory') . '/admin/admin.js');
      wp_enqueue_script('styled-checkbox',get_bloginfo('template_directory') . '/admin/styled_checkbox.js');
    }

    public function load_styles(){
      wp_enqueue_style('admin_options',get_bloginfo('template_directory') . '/admin/admin.css');
    }
    
        
    /* add pages to admin menu */
    public function add_pages(){                    
      $admin_page = add_theme_page(THEME_NAME, THEME_NAME . ' Options','edit_theme_options', THEME_SLUG, array(&$this,'display_page'));

      add_action('wp_print_scripts', array(&$this, 'load_scripts'));
      add_action('admin_print_styles-' . $admin_page, array(&$this, 'load_styles'));
    }
    
   
    
    /* HTML to display options page */
    public function display_page(){
      echo '<div class="wrap custom_theme_options">
      <div class="icon32" id="icon-options-general"></div>
      <h2>' .__('Theme Options') . '</h2>
      <form action="options.php" method="post">
      ';
        settings_fields(THEME_OPTIONS);        
        echo '<div class="ui-tabs"><ul class="ui-tabs-nav">';
        foreach ($this->sections as $section_slug => $section){
          echo '<li><a href=#' . $section_slug . '_tab">' . $section . '</a></li>';
        }
        echo '</ul>';
        do_settings_sections($_GET['page']);
        echo '</div>'; //ui-tabs
        echo '<p class="submit"><input name="Submit" type="submit" class="button-primary" value="' . __( 'Save Changes' ) . '" /></p>
        </form>';
        echo '<script type="text/javascript">
      		jQuery(document).ready(function($) {
      			var sections = [];';

      			foreach ( $this->sections as $section_slug => $section )
      				echo "sections['$section'] = '$section_slug';";

      			echo 'var wrapped = $(".wrap h3").wrap("<div class=\"ui-tabs-panel\">");
      			wrapped.each(function() {
      				$(this).parent().append($(this).parent().nextUntil("div.ui-tabs-panel"));
      			});
      			$(".ui-tabs-panel").each(function(index) {
      				$(this).attr("id", sections[$(this).children("h3").text()]+"_tab");
      				if (index > 0)
      					$(this).addClass("ui-tabs-hide");
      			});
      			$(".ui-tabs").tabs({
      				fx: { opacity: "toggle", duration: "fast" }
      			});

      			$("input[type=text], textarea").each(function() {
      				if ($(this).val() == $(this).attr("placeholder") || $(this).val() == "")
      					$(this).css("color", "#999");
      			});

      			$("input[type=text], textarea").focus(function() {
      				if ($(this).val() == $(this).attr("placeholder") || $(this).val() == "") {
      					$(this).val("");
      					$(this).css("color", "#000");
      				}
      			}).blur(function() {
      				if ($(this).val() == "" || $(this).val() == $(this).attr("placeholder")) {
      					$(this).val($(this).attr("placeholder"));
      					$(this).css("color", "#999");
      				}
      			});

      			$(".wrap h3, .wrap table").show();

      			// This will make the "warning" checkbox class really stand out when checked.
      			// I use it here for the Reset checkbox.
      			$(".warning").change(function() {
      				if ($(this).is(":checked"))
      					$(this).parent().css("background", "#c00").css("color", "#fff").css("fontWeight", "bold");
      				else
      					$(this).parent().css("background", "none").css("color", "inherit").css("fontWeight", "normal");
      			});

      			// Browser compatibility
      			if ($.browser.mozilla) 
      			         $("form").attr("autocomplete", "off");
      		});
      	</script>              
        </div>';
    }
    
    /* HTML output for individual settings */
    public function display_setting($args = array()){
      extract($args);
      
      $options = get_option(THEME_OPTIONS);
      if (!isset($options[$id]) && 'type' != 'checkbox'){
        $options[$id] = $std;
      }elseif (! isset($options[$id])){
        $options[$id] = 0;
      }      
      $field_class = '';
      if ($class != ''){
        $field_class = ' class="' . $class . '"';
      }
      
      switch($type){
        
        case 'heading':
          echo '</td></tr><tr valign="top"><td colspan="2"><h4>' . $desc . '</h4>';
        	break;
       
        case 'checkbox':
        	echo '<input class="checkbox' . $field_class . '" type="checkbox" id="' . $id . '" name="'. THEME_OPTIONS . '[' . $id . ']" value="1" ' . checked( $options[$id], 1, false ) . ' />';
        	if($desc != ''){
        	  echo '<span class="description">' . $desc . '</span>';
        	}
        	break;
       
        case 'select':
        	echo '<select class="select' . $field_class . '" name="'. THEME_OPTIONS . '[' . $id . ']">';
        	foreach ( $choices as $value => $label ) {
        		echo '<option value="' . esc_attr( $value ) . '"' . selected( $options[$id], $value, false ) . '>' . $label . '</option>';        	  
        	}
        	echo '</select>';
        	if ( $desc != '' ){
        		echo '<span class="description">' . $desc . '</span>';
          }
        	break;
     
        case 'radio':
        	$i = 0;
        	foreach ( $choices as $value => $label ) {
        		echo '<input class="radio' . $field_class . '" type="radio" name="'. THEME_OPTIONS . '[' . $id . ']" id="' . $id . $i . '" value="' . esc_attr( $value ) . '" ' . checked( $options[$id], $value, false ) . '> <label for="' . $id . $i . '">' . $label . '</label>';
        		if ( $i < count( $options ) - 1 )
        			echo '<br />';
        		$i++;
        	}
        	if ( $desc != '' ){
        		echo '<span class="description">' . $desc . '</span>';
          }
        	break;
    
        case 'textarea':
        	echo '<textarea class="' . $field_class . '" id="' . $id . '" name="'. THEME_OPTIONS . '[' . $id . ']" placeholder="' . $std . '">' . wp_htmledit_pre( $options[$id] ) . '</textarea>';
        	if ( $desc != '' ){
        		echo '<span class="description">' . $desc . '</span>';
        	}
        	break;

        case 'password':
        	echo '<input class="regular-text' . $field_class . '" type="password" id="' . $id . '" name="'. THEME_OPTIONS . '[' . $id . ']" value="' . esc_attr( $options[$id] ) . '" />';
        	if ( $desc != '' ){
        		echo '<br /><span class="description">' . $desc . '</span>';        	  
        	}
        	break;
        case 'text':
        default:
          echo '<input class="regular-text' . $field_class . '" type="text" id="' . $id . '" name="'. THEME_OPTIONS . '[' . $id . ']" placeholder="' . $std . '" value="' . esc_attr( $options[$id] ) . '" />';
          if ($desc != ''){
            echo '<span class="description">' . $desc. '</span>';
          }
          break;
        
      }
      
    }
    
    /*Description for section */
    public function display_section(){
      //code
    }
    

    /* Intialize settings to their default values */
    public function initialize_settings(){
      $default_settings = array();
      foreach($this->settings as $id => $setting){
        if($setting['type'] !='heading'){
          $default_settings[$id] = $setting['std'];
        }
      }
      update_option(THEME_OPTIONS,$default_settings);
    }
    
    /* Register settings via the WP Settings API */
    public function register_settings(){
      register_setting(THEME_OPTIONS, THEME_OPTIONS, array(&$this, 'validate_settings'));
      foreach($this->sections as $slug=>$title){
        add_settings_section($slug,$title,array(&$this, 'display_section'),THEME_SLUG);
      }
      $this->get_settings();
      
      foreach($this->settings as $id => $setting) {
        $setting['id'] = $id;
        $this->create_setting($setting);
      }
    }
    
    public function create_setting($args = array()){
      $defaults = array(
        'id'        => 'default_field',
        'title'     => 'Default Field',
        'desc'      => 'Default Description',
        'std'       => '',
        'type'      => 'text',
        'section'   => 'general',
        'choices'   => array(),
        'class'     => ''        
      );

      extract(wp_parse_args($args,$defaults));
      
      $field_args = array(
        'type'      => $type,
        'id'        => $id,
        'desc'      => $desc,
        'std'       => $std,
        'choices'   => $choices,
        'label_for' => $id,
        'class'     => $class        
      );
      
      if ($type == 'checkbox'){
        $this->checkboxes[] = $id;
      }
      
      add_settings_field($id,$title,array($this,'display_setting'), THEME_SLUG, $section, $field_args);
    }
    
    public function validate_settings( $input ) {

  		if ( ! isset( $input['reset_theme'] ) ) {
  			$options = get_option( THEME_OPTIONS );

  			foreach ( $this->checkboxes as $id ) {
  				if ( isset( $options[$id] ) && ! isset( $input[$id] ) )
  					unset( $options[$id] );
  			}

  			return $input;
  		}
  		return false;

  	}
    
  }//class
  
  // create Theme Options
  $theme_options = new Custom_Theme_Options();
  
  /* theme_options loader: get theme option from database */
  function theme_option( $option ) {
  	$options = get_option(THEME_OPTIONS);
  	if ( isset( $options[$option] ) )  	  
  		return $options[$option];
  	else
  		return false;
  }
  
?>