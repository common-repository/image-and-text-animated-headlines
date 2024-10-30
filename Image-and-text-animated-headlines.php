<?php
/*
Plugin Name: Image and text animated headlines
Plugin URI: 
Description: Choose among 3 animation scripts and create animated headlines with your own text and images   
Version: 1.0
Author: Deimos Mavrozoumis
Author URI: https://plugfame.wordpress.com
*/

////////////Requires files
require('animation1.php');
require('animation2.php');
require('animation3.php');
//

//allow redirection, even if my theme starts to send output to the browser
add_action('init', 'imtah_do_output_buffer');
function imtah_do_output_buffer() {
  ob_start();
}

add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' );
////////////////////////////////Animation 1 activate and deactivate functions

function imtah_animation1_activation() {///This function is here bacause wordpress need it here in order to work ?
  global $wpdb;
  $table_name = $wpdb->prefix . "imtah_animation1Table";
  $charset_collate = $wpdb->get_charset_collate();

  $sql = "CREATE TABLE  $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    name tinytext NOT NULL,
    textColor tinytext NOT NULL,
    text1 tinytext NOT NULL,
    text2 tinytext NOT NULL,
    text3 tinytext NOT NULL,
    text4 tinytext NOT NULL,
    imagepath tinytext NOT NULL,
    url tinytext NOT NULL,
    textFont tinytext NOT NULL,
    PRIMARY KEY  (id)
  ) $charset_collate;";

  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  dbDelta( $sql );

}

register_activation_hook(__FILE__, 'imtah_animation1_activation');


function imtah_animation1_deactivation() {                    
  global $wpdb;
  $table_name= $wpdb->prefix . 'imtah_animation1Table';
  $sql = "DROP TABLE IF EXISTS $table_name";
  $wpdb->query($sql);
  delete_option( 'imtah_animation1_font');
  delete_option( 'imtah_animation1_image_attachment_id');
  delete_option( 'imtah_animation1_name');
  delete_option( 'imtah_animation1_text_color');
  delete_option( 'imtah_animation1_text1');
  delete_option( 'imtah_animation1_text2');
  delete_option( 'imtah_animation1_text3');
  delete_option( 'imtah_animation1_text4');
  delete_option( 'imtah_animation1_url');

  unregister_setting( 'imtah_settings', 'imtah_animation1_name', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  unregister_setting( 'imtah_settings', 'imtah_animation1_text1', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  unregister_setting( 'imtah_settings', 'imtah_animation1_text2', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  unregister_setting( 'imtah_settings', 'imtah_animation1_text3', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  unregister_setting( 'imtah_settings', 'imtah_animation1_text4', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  unregister_setting( 'imtah_settings', 'imtah_animation1_image_attachment_id', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  unregister_setting( 'imtah_settings', 'imtah_animation1_text_color', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  unregister_setting( 'imtah_settings', 'imtah_animation1_font', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  unregister_setting( 'imtah_settings', 'imtah_animation1_url', array('type' => 'string','sanitize_callback' => 'sanitize_text_field')); 

}
register_deactivation_hook(__FILE__, 'imtah_animation1_deactivation');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////Animation 2 activate and deactivate functions

function imtah_animation2_activation() {///This function is here bacause wordpress need it here in order to work
  global $wpdb;
  $table_name = $wpdb->prefix . "imtah_animation2Table";
  $charset_collate = $wpdb->get_charset_collate();

  $sql = "CREATE TABLE  $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    name tinytext NOT NULL,
    textColor tinytext NOT NULL,
    text1 tinytext NOT NULL,
    text2 tinytext NOT NULL,
    text3 tinytext NOT NULL,
    text4 tinytext NOT NULL,
    imagepath1 tinytext NOT NULL,
    imagepath2 tinytext NOT NULL,
    url tinytext NOT NULL,
    textFont tinytext NOT NULL,
    PRIMARY KEY  (id)
  ) $charset_collate;";

  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  dbDelta( $sql );

  //update_option( 'imtah_animation2_name', 'Name1');
}

register_activation_hook(__FILE__, 'imtah_animation2_activation');


function imtah_animation2_deactivation() { 
                    
  global $wpdb;
  $table_name= $wpdb->prefix . 'imtah_animation2Table';
  $sql = "DROP TABLE IF EXISTS $table_name";
  $wpdb->query($sql);
  delete_option( 'imtah_animation2_font');
  delete_option( 'imtah_animation2_image_attachment_id1');
  delete_option( 'imtah_animation2_image_attachment_id2');
  delete_option( 'imtah_animation2_name');
  delete_option( 'imtah_animation2_text_color');
  delete_option( 'imtah_animation2_text1');
  delete_option( 'imtah_animation2_text2');
  delete_option( 'imtah_animation2_text3');
  delete_option( 'imtah_animation2_text4');
  delete_option( 'imtah_animation2_url');

  unregister_setting( 'imtah_settings', 'imtah_animation2_font', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  unregister_setting( 'imtah_settings', 'imtah_animation2_image_attachment_id1', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  unregister_setting( 'imtah_settings', 'imtah_animation2_image_attachment_id2', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  unregister_setting( 'imtah_settings', 'imtah_animation2_name', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  unregister_setting( 'imtah_settings', 'imtah_animation2_text_color', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  unregister_setting( 'imtah_settings', 'imtah_animation2_text1', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  unregister_setting( 'imtah_settings', 'imtah_animation2_text2', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  unregister_setting( 'imtah_settings', 'imtah_animation2_text3', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  unregister_setting( 'imtah_settings', 'imtah_animation2_text4', array('type' => 'string','sanitize_callback' => 'sanitize_text_field')); 
  unregister_setting( 'imtah_settings', 'imtah_animation2_url', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
}

register_deactivation_hook(__FILE__, 'imtah_animation2_deactivation');

////////////////////////////////Animation 3 activate and deactivate functions

function imtah_animation3_activation() {///This function is here bacause wordpress need it here in order to work

  global $wpdb;
  $table_name = $wpdb->prefix . "imtah_animation3Table";
  $charset_collate = $wpdb->get_charset_collate();

  $sql = "CREATE TABLE  $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    name tinytext NOT NULL,
    textColor tinytext NOT NULL,
    text1 tinytext NOT NULL,
    text2 tinytext NOT NULL,
    text3 tinytext NOT NULL,
    text4 tinytext NOT NULL,
    imagepath1 tinytext NOT NULL,
    imagepath2 tinytext NOT NULL,
    url tinytext NOT NULL,
    textFont tinytext NOT NULL,
    PRIMARY KEY  (id)
  ) $charset_collate;";

  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  dbDelta( $sql );

 // update_option( 'imtah_animation3_name', 'Name1');
}

register_activation_hook(__FILE__, 'imtah_animation3_activation');


function imtah_animation3_deactivation() { 
                     
  global $wpdb;
  $table_name= $wpdb->prefix . 'imtah_animation3Table';
  $sql = "DROP TABLE IF EXISTS $table_name";
  $wpdb->query($sql);
  delete_option( 'imtah_animation3_font');
  delete_option( 'imtah_animation3_image_attachment_id1');
  delete_option( 'imtah_animation3_image_attachment_id2');
  delete_option( 'imtah_animation3_name');
  delete_option( 'imtah_animation3_text_color');
  delete_option( 'imtah_animation3_text1');
  delete_option( 'imtah_animation3_text2');
  delete_option( 'imtah_animation3_text3');
  delete_option( 'imtah_animation3_text4');
  delete_option( 'imtah_animation3_url');

  unregister_setting( 'imtah_settings', 'imtah_animation3_font', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  unregister_setting( 'imtah_settings', 'imtah_animation3_image_attachment_id1', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  unregister_setting( 'imtah_settings', 'imtah_animation3_image_attachment_id2', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  unregister_setting( 'imtah_settings', 'imtah_animation3_name', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  unregister_setting( 'imtah_settings', 'imtah_animation3_text_color', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  unregister_setting( 'imtah_settings', 'imtah_animation3_text1', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  unregister_setting( 'imtah_settings', 'imtah_animation3_text2', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  unregister_setting( 'imtah_settings', 'imtah_animation3_text3', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  unregister_setting( 'imtah_settings', 'imtah_animation3_text4', array('type' => 'string','sanitize_callback' => 'sanitize_text_field')); 
  unregister_setting( 'imtah_settings', 'imtah_animation3_url', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
}

register_deactivation_hook(__FILE__, 'imtah_animation3_deactivation');
////////////////////////////////////////////////////    
///////////Create custom page menu and subpages/////////////////////////

add_action( 'admin_menu', 'imtah_settings_menu' );

///Add Home page
function imtah_settings_menu() {
  add_menu_page( 'Animated_headlines', 'Animated headlines', 'administrator', 'imtah_settings', 'imtah_home_page_html' );

  add_submenu_page( 'imtah_settings', 'Animation 1 ','Animation1 settings', 'administrator', 'animaton_1_settings','imtah_animation1_html');

  add_submenu_page( 'imtah_settings', 'Animation 2','Animation2 settings', 'administrator', 'animaton_2_settings','imtah_animation2_html');

  add_submenu_page( 'imtah_settings', 'Animation 3','Animation3 settings', 'administrator', 'animaton_3_settings','imtah_animation3_html');

}



//Add Jquery
add_action( 'wp_enqueue_scripts','imtah_add_Jquery');

function imtah_add_Jquery(){
  wp_enqueue_script('jquery');
} 

///Homepage html setting
function imtah_home_page_html() {
  wp_enqueue_media();
  imtah_display_animation_home_html();
}

///Add animation1 html page
function imtah_animation1_html(){
  wp_enqueue_media();
  imtah_display_animation1_html();
}

///Add animation2 html page
function imtah_animation2_html(){
  wp_enqueue_media();
  imtah_display_animation2_html();
}

///Add animation3 html page
function imtah_animation3_html(){
  wp_enqueue_media();
  imtah_display_animation3_html();
}

////////////////////////////////////////////////////////
function imtah_display_animation_home_html(){
  ?>
  <div style=" width:50%; padding-top:20px;">

    <h1>Image and text animated headlines</h1>
    <p>  Image and text animation headlines is a collection of animated Javascripts which can be used in your post and your widget sidebars. Users are able to enter their own images and texts and create their unique animated headlines. This tool can be used to emphasize your post, promote sales offers and generally advertise any product.<br></p>

    <h2><br>Use of image and text animated headlines</h2>
    <p>  Before using this plugin, firstly you must create and then save a recipe at the animation settings pages. After saving the recipe you, can insert a shortcode with the following syntax: [canvasanimationX attributes="Y"] where X=the animation number (1,2 or 3) and Y is the given animation name. For example, if you have made a recipe for animation 2 and the  recipe name is test1, the shortcode will be: <h3>[canvasanimation2 attributes="test1"]</h3> </p>
    <img src="<?php echo plugin_dir_url( __FILE__ ) . '/directions1.JPG'; ?>" height="400" width="400">
    <p><br>You can also use the plugin as a widget from the customize menu, simple select the animation and the recipe from the dropdown boxes.</p> 

    <h2><br>Creating a recipe</h2>
    <p>At each animation settings you can set four different text fields, these text fields will be shown as a sequence until the animation ends.You can also choose the pictures you want for the animation sequence and  give a url link for the click event. By leaving any text field empty, you can skip an animation sequence or disable the url link.<br>Finally, after setting the text and image fields, you can click on the update button and run the animation. Then, if you like it, you can save it and give a name to it for the recipe list table which later can be used as a shortcode or widget</p>
    <h2><br>Url text field</h2>
    <p>At the Url text field you can enter any link outside your blog by entering the http:// prefix, for example if you want to visit google at the click event, you must enter http://google.com. If you want to link to a post or a page inside your blog, you must copy the page link from your browser address bar, for example if you want to link to a post that the full address of the post is https://somesite.com/2018/08/12/post6/ you must copy the 2018/08/12/post6 and then paste it at the url field of the animation settings page. </p>
  </div>
  <?php 

}

///////////////////////////////Color Picker//////////////////////////////////////////
add_action( 'admin_enqueue_scripts', 'imtah_enqueue_color_picker' );

function imtah_enqueue_color_picker( $hook_suffix ) {
  // first check that $hook_suffix is appropriate for your admin page
  wp_enqueue_style( 'wp-color-picker' );
  wp_enqueue_script( 'my-script-handle', plugins_url('js/my-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}
//////////////////////////////Static increment variable for giving unique id////////////

function imtah_inc_id() {
  STATIC $cAnimCount = 0;
  $cAnimCount++;
  return $cAnimCount;
}
/////////////////hide featured image of post if (animation && home)////////////

function imtah_hide_feature_image( $html, $post_id, $post_image_id) {
  global $my_post_id_array;
  if (  is_home() && (in_array($post_id, $my_post_id_array))  ) 
  {
    return ''; 
  } 
  else
  {
    return $html;
  }
}

$my_post_id_array=array();

foreach  (get_posts() as $mypost) {

  if (  has_shortcode($mypost->post_content, 'canvasanimation1' ) ||has_shortcode($mypost->post_content, 'canvasanimation2' )||has_shortcode($mypost->post_content, 'canvasanimation3' )) 
  {
    $my_post_id_array[] = $mypost->ID;
  } 
}

add_filter( 'post_thumbnail_html', 'imtah_hide_feature_image', 10, 3 );

/////////////////////Remove shortcode when in single post///////////////////////////

function imtah_remove_shortcode_from_index($content) {
    if ( is_singular() ) {
    $content = strip_shortcodes( $content );
    }
  return $content;
}
add_filter('the_content', 'imtah_remove_shortcode_from_index');

////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////// 
//Widget code starts here/
// Register and load the widget


function imtah_wpb_load_widget() {
  register_widget( 'imtah_wpb_widget' );
}
add_action( 'widgets_init', 'imtah_wpb_load_widget' );


////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////// 
// Creating the widget 
class imtah_wpb_widget extends WP_Widget {


  function __construct() { 
    parent::__construct(
      // Base ID of your widget
      'wpb_widget', 

      // Widget name will appear in UI
      __('Image and text animation headlines', 'wpb_widget_domain'), 

      // Widget description
      array( 'description' => __( 'Create your own animated headline', 'wpb_widget_domain' ),
      'customize_selective_refresh' => false ) 
    );
  }    
  public function giveMeInstance($instance){
    wp_die( $message = $instance['select1']  );
  }

  ///////////////////////////////////////////////////////////////////////
  // The widget form (for the backend )
  public function form( $instance ) {
    ?>
    <?php // Textarea Field ?>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'textarea' ) ); ?>"><?php _e( 'Head Title:', 'text_domain' ); ?></label>
      <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'textarea' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'textarea' ) ); ?>"><?php echo wp_kses_post( $textarea ); ?></textarea>
    </p>

    <p>

      <label for="<?php echo $this->get_field_id( 'select1' ); ?>"><?php _e( 'Select animation', 'text_domain' ); ?></label>

        <select onchange="callMe(event)" name="<?php echo $this->get_field_name( 'select1' ); ?>" id="<?php echo $this->get_field_id( 'select1' ); ?>" class="widefat">

          <option style="display:none" > <?php echo $instance['select1'];?> </option>
          <option value="animation1">animation1</option>
          <option value="animation2">animation2</option>
          <option value="animation3">animation3</option> 

        </select>
       <?php $this->get_field_name( 'select1' ); ?>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id( 'select2' ); ?>"><?php _e( 'Select attributes', 'text_domain' ); ?></label>
      <select name="<?php echo $this->get_field_name( 'select2' ); ?>" id="<?php echo $this->get_field_id( 'select2' ); ?>" class="widefat">
      <option style="display:none" > <?php echo esc_html($instance['select2']);?> </option>

      <?php
      global $wpdb;
      $tempVar="imtah_".$instance['select1']."Table"; 
      $result = $wpdb->get_results("SELECT name FROM {$wpdb->prefix}{$tempVar}");
      // Loop through options and add each one to the select dropdown
      foreach ( $result as $value ) {
        echo '<option value="'.esc_html($value->name).'">'.esc_html($value->name).'</option>';
      } 
      ?>
      </select>
      <?php
      $this->get_field_name( 'select2' ); 
      ?>
    </p>


    <script>//

    function callMe(event){

      //get the id of select box 1
      var target = event.target || event.srcElement;
      var id = '#'+target.id
      var selection = jQuery(id).val();


      switch(selection)  
      {     
        case "animation1":
          var id1 = id.replace("select1", "select2");
          jQuery(id1).empty();
          <?php global $wpdb; $result = $wpdb->get_results("SELECT name FROM {$wpdb->prefix}imtah_animation1Table"); ?>
          var jArray1 = <?php echo json_encode($result); ?>;
          for(var i=0; i<jArray1.length; i++){
            jQuery(id1).append('<option value="'+jArray1[i].name+'">'+jArray1[i].name+'</option>');
          }
        break;

        case "animation2":
          var id2 = id.replace("select1", "select2");
          jQuery(id2).empty();
          <?php global $wpdb; $result = $wpdb->get_results("SELECT name FROM {$wpdb->prefix}imtah_animation2Table"); ?>
          var jArray2 = <?php echo json_encode($result); ?>;
          for(var i=0; i<jArray2.length; i++){
            jQuery(id2).append('<option value="'+jArray2[i].name+'">'+jArray2[i].name+'</option>');
          }


        break;

        case "animation3":
          var id3 = id.replace("select1", "select2");
          jQuery(id3).empty();
          <?php global $wpdb; $result = $wpdb->get_results("SELECT name FROM {$wpdb->prefix}imtah_animation3Table"); ?>
          var jArray3 = <?php echo json_encode($result); ?>;
          for(var i=0; i<jArray3.length; i++){
            jQuery(id3).append('<option value="'+jArray3[i].name+'">'+jArray3[i].name+'</option>');
          }
        break;


      }

    };

    </script>

    <?php

  } 

  // Update widget settings
  public function update( $new_instance, $old_instance ) {

    $instance = $old_instance;
    $instance['select1'] = isset( $new_instance['select1'] ) ? wp_strip_all_tags( $new_instance['select1'] ) : '';
    $instance['select2']   = isset( $new_instance['select2'] ) ? wp_strip_all_tags( $new_instance['select2'] ) : '';
    $instance['textarea'] = isset( $new_instance['textarea'] ) ? wp_kses_post( $new_instance['textarea'] ) : '';
    return $instance;
  }

  // Display the widget
  public function widget( $args, $instance ) {

    extract( $args );

    // Check the widget options

    $select1   = isset( $instance['select1'] ) ? $instance['select1'] : '';
    $select2   = isset( $instance['select2'] ) ? $instance['select2'] : '';
    $textarea = isset( $instance['textarea'] ) ? $instance['textarea'] : '';
    $sqlSelect1 = "imtah_".$select1."Table";
    // WordPress core before_widget hook (always include )
    echo $before_widget;

    // Display the widget
    echo '<div>';
    if ( $textarea ) {
      echo '<h2>' . esc_html($textarea) . '</h2>';
    }
    // Display select field
    if ( isset( $select2) && $select2!='') {

      global $wpdb;
      $myQuery = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}{$sqlSelect1} WHERE name = '{$select2}'");

      switch ($sqlSelect1) {   
      case 'imtah_animation1Table':

        echo do_shortcode('[imtah_animation1 name="'.$myQuery->name.'" text_color="'.$myQuery->textColor.'" text1="'.$myQuery->text1.'" text2="'.$myQuery->text2.'" text3="'.$myQuery->text3.'" text4="'.$myQuery->text4.'" image="' .$myQuery->imagepath.'" url="' .$myQuery->url.'" font="' .$myQuery->textFont.'"]');

      break;

      case 'imtah_animation2Table':
        echo do_shortcode('[imtah_animation2 name="'.$myQuery->name.'" text_color="'.$myQuery->textColor.'" text1="'.$myQuery->text1.'" text2="'.$myQuery->text2.'" text3="'.$myQuery->text3.'" text4="'.$myQuery->text4.'" image1="' .$myQuery->imagepath1.'" image2="' .$myQuery->imagepath2.'" url="' .$myQuery->url.'" font="' .$myQuery->textFont.'"]');
      break; 

      case 'imtah_animation3Table':
        echo do_shortcode('[imtah_animation3 name="'.$myQuery->name.'" text_color="'.$myQuery->textColor.'" text1="'.$myQuery->text1.'" text2="'.$myQuery->text2.'" text3="'.$myQuery->text3.'" text4="'.$myQuery->text4.'" image1="' .$myQuery->imagepath1.'" image2="' .$myQuery->imagepath2.'" url="' .$myQuery->url.'" font="' .$myQuery->textFont.'"]');
      break; 

      }     
    }
    echo '</div>';

    // WordPress core after_widget hook (always include )
    echo $after_widget;


  }

}// Class wpb_widget ends here
?>