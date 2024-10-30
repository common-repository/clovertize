<?php
/*
Plugin Name: Clovertize
Plugin URI: TBD
Description: Add the luck of the Irish to your WP site
Version: 1.0
Author: michaelkay
Author URI: TBD
License: GPL2
*/
class clovertize_plugin extends WP_Widget {

// constructor
function clovertize_plugin() {
	// Name
	parent::WP_Widget(false, $name = __('Clovertize', 'clovertize_plugin'),
	// Widget description
	array( 'description' => __( 'Add clovers to your WP site', 'clovertize_domain' ), )  );
    }
	
// widget form creation
function form($instance) {

	// Check values
	if( $instance) {
		$title = esc_attr($instance['title']);
		$select = esc_attr($instance['select']);
		$URL = esc_attr($instance['URL']);
	} else {
		 $title = 'Clovertize';
		 $select = '';
		 $URL = '';
		}
?>
<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Clovertize', 'clovertize_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('select'); ?>"><?php _e('Button type', 'clovertize_plugin'); ?></label>
<select name="<?php echo $this->get_field_name('select'); ?>" id="<?php echo $this->get_field_id('select'); ?>" class="widefat">

<?php
$options = array(__('Square', 'clovertize_plugin'), __('Bar', 'clovertize_plugin'), __('Button', 'clovertizer_plugin'), __('Custom', 'clovertizer_plugin'));
//__('Banner', 'clovertize_plugin'), 
foreach ($options as $option) {
echo '<option value="' . $option . '" id="' . $option . '"', $select == $option ? ' selected="selected"' : '', '>', $option, '</option>';
}
?>
</select>
</p>

<p>

<label for="<?php echo $this->get_field_id('URL'); ?>"><?php _e('Custom Image URL', 'clovertize_plugin'); ?></label>
<br>(This is only used if the Button type is set to Custom)
<input class="widefat" id="<?php echo $this->get_field_id('URL'); ?>" name="<?php echo $this->get_field_name('URL'); ?>" type="text" value="<?php echo $URL; ?>" />
</p>

<?php
}

// update widget
function update($new_instance, $old_instance) {
      $instance = $old_instance;
      // Fields
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['select'] = strip_tags($new_instance['select']);
	  $instance['URL'] = strip_tags($new_instance['URL']);
     return $instance;
}

// display widget
function widget($args, $instance) {
   extract( $args );
   // these are the widget options
   $title = apply_filters('widget_title', $instance['title']);
   $select = $instance['select'];
   $URL = $instance['URL'];
   echo $before_widget;
   // Display the widget
   echo '<div class="widget-text clovertize_plugin_box">';

   // Check if title is set
   if ( $title ) {
      echo $before_title . $title . $after_title;
   }

	// Get $select value
    if ( $select == 'Bar' ) {
		echo '<div class="clovertize_bar" style="width: 250px; height: 50px"><a href="#" onclick="clovertize_add(clovertize_custom.plugin_url);return false;"><img src="';
        echo WP_PLUGIN_URL . '/clovertize/images/bar.png';
		echo '" border="0" alt="Clovertize"/></a></div></div>';
        } else if ( $select == 'Square' ) {
		echo '<div class="clovertize_square" style="width: 250px; height: 250px"><a href="#" onclick="clovertize_add(clovertize_custom.plugin_url);return false;"><img src="';
        echo WP_PLUGIN_URL . '/clovertize/images/square.png';
		echo '" border="0" alt="Clovertize"/></a></div></div>';
        } else if ( $select == 'Button' ) {
		echo '<div class="clovertize_Button"><a href="#" onclick="clovertize_add(clovertize_custom.plugin_url);return false;">';
        echo '<img src="' . WP_PLUGIN_URL . '/clovertize/images/button.png';
		echo '" border="1" alt="Clovertize"/> Clovertize</a></div></div>';
        } else if ( $select == 'Custom' ) {
		echo '<div class="clovertize_Custom"><a href="#" onclick="clovertize_add(clovertize_custom.plugin_url);return false;">';
        echo '<img src="' . $URL .'" border="0" alt="Clovertize"/></a></div></div>';
        } else {
		echo '<div class="clovertize_banner" style="width: 468px; height: 60px"><a href="#" onclick="clovertize_add(clovertize_custom.plugin_url);return false;"><img src="';
        echo WP_PLUGIN_URL . '/clovertize/images/banner.png';
		echo '" border="0" alt="Clovertize"/></a></div></div>';
    }
   echo $after_widget;
}

}
function clovertize_init() {
	if(is_active_widget('','','clovertize_plugin')){
		wp_enqueue_script( 'clovertize', WP_PLUGIN_URL . '/clovertize/clovertize.js');
		$clovertize_custom = array( 'plugin_url' => WP_PLUGIN_URL . '/clovertize' );
		wp_localize_script( 'clovertize', 'clovertize_custom', $clovertize_custom );
	}
}

// register widget
add_action('init', 'clovertize_init');
add_action('widgets_init', create_function('', 'return register_widget("clovertize_plugin");'));
?>