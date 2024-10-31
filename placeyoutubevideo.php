<?php
/**
 * @package placeyoutubevideo
 * @version 1.0.2
 */
/*
Plugin Name: Place Youtube Video
Plugin URI: http://hardik.me/blog/index.php/2011/01/18/wordpress-place-youtube-video/
Description: Simple YouTube Video Plugin to show YouTube Videos in widgets area.
Author: <a href="http://hardik.me">Hardik</a>
Version: 1.0.2
Author URL: http://hardik.me/blog
*/


define("placeyoutubevideo_TITLE","Golden Globes 2011 - Ricky Gervais Opening Monologue");
define("placeyoutubevideo_URL_DEFAULT","http://www.youtube.com/watch?v=BvHXzP2SpLA");

function placeyoutubevideo_widget_Init(){
  register_widget('placeyoutubevideoWidget');
}
	
add_action("widgets_init", "placeyoutubevideo_widget_Init");


	
class placeyoutubevideoWidget extends WP_Widget {
     function placeyoutubevideoWidget() {
       //Widget code
	   parent::WP_Widget(false,$name="Place Youtube Video");
     }

     function widget($args, $instance) {
       //Widget output
	   
	   
	    $options = $instance;
		$vidurl = "http://www.youtube.com/v/".$this->getYouTubeURL($options['placeyoutubevideo_widget_url']);
		//$output.= '<b>'.$options['placeyoutubevideo_widget_title'].':</b>';	
		
		extract( $args );
        $title = apply_filters('widget_title', $instance['placeyoutubevideo_widget_title']);
		
		$placeyoutubevideo_widget_icvid = htmlspecialchars($options['placeyoutubevideo_widget_icvid'], ENT_QUOTES);
		$placeyoutubevideo_widget_pinhd = htmlspecialchars($options['placeyoutubevideo_widget_pinhd'], ENT_QUOTES);
		$placeyoutubevideo_widget_plcol = htmlspecialchars($options['placeyoutubevideo_widget_plcol'], ENT_QUOTES);
		$placeyoutubevideo_widget_plcol2 = htmlspecialchars($options['placeyoutubevideo_widget_plcol2'], ENT_QUOTES);
		$placeyoutubevideo_widget_pem = htmlspecialchars($options['placeyoutubevideo_widget_pem'], ENT_QUOTES);
		$placeyoutubevideo_widget_plsizeh = htmlspecialchars($options['placeyoutubevideo_widget_plsizeh'], ENT_QUOTES);
		$placeyoutubevideo_widget_plsizew = htmlspecialchars($options['placeyoutubevideo_widget_plsizew'], ENT_QUOTES);
		$placeyoutubevideo_widget_autoplay = htmlspecialchars($options['placeyoutubevideo_widget_autoplay'], ENT_QUOTES);
		
		$extraoptions = "";
		if($placeyoutubevideo_widget_autoplay==1){
			$extraoptions.='&amp;autoplay=1';
		}
		if($placeyoutubevideo_widget_pinhd==1){
			$extraoptions.='&amp;hd=1';
		}
		if($placeyoutubevideo_widget_plcol!=''){
			$extraoptions.='&amp;color1=0x'.$placeyoutubevideo_widget_plcol;
		}
		if($placeyoutubevideo_widget_plcol2!=''){
			$extraoptions.='&amp;color2=0x'.$placeyoutubevideo_widget_plcol2;
		}
		
		//echo '<pre>';
		//print_r($options);
		//echo '</pre>';
		
		
		$output.= "<div><object width='$placeyoutubevideo_widget_plsizew' height='$placeyoutubevideo_widget_plsizeh'><param name='movie' value='".$vidurl."?fs=1&amp;hl=en_US'></param><param name='allowFullScreen' value='true'><param name='autoplay' value='1'></param><param name='allowscriptaccess' value='always'></param><embed src='".$vidurl."?fs=1&amp;hl=en_US$extraoptions' type='application/x-shockwave-flash' allowscriptaccess='always' allowfullscreen='true' autoplay='1' width='$placeyoutubevideo_widget_plsizew' height='$placeyoutubevideo_widget_plsizeh'></embed></object></div><span style='display:none;'><a href='http://hardik.me/blog/'>php developer india</a></span>";
		
		extract($args);	
		echo $before_widget; 
		echo $before_title . $title . $after_title;
		echo $output; 
		echo $after_widget;
     }

     function update($new_instance, $old_instance) {
       //Save widget options
		$instance = $old_instance;
		$instance['placeyoutubevideo_widget_title'] = strip_tags($new_instance['placeyoutubevideo_widget_title']);
		$instance['placeyoutubevideo_widget_url'] = strip_tags($new_instance['placeyoutubevideo_widget_url']);
		$instance['placeyoutubevideo_widget_RSS_count_items'] = strip_tags($new_instance['placeyoutubevideo_widget_RSS_count_items']);
		
		$instance['placeyoutubevideo_widget_pem'] = strip_tags($new_instance['placeyoutubevideo_widget_pem']);
		$instance['placeyoutubevideo_widget_icvid'] = strip_tags($new_instance['placeyoutubevideo_widget_icvid']);
		$instance['placeyoutubevideo_widget_pinhd'] = strip_tags($new_instance['placeyoutubevideo_widget_pinhd']);
		$instance['placeyoutubevideo_widget_plcol'] = strip_tags($new_instance['placeyoutubevideo_widget_plcol']);
		$instance['placeyoutubevideo_widget_plcol2'] = strip_tags($new_instance['placeyoutubevideo_widget_plcol2']);
		$instance['placeyoutubevideo_widget_plsizew'] = strip_tags($new_instance['placeyoutubevideo_widget_plsizew']);
		$instance['placeyoutubevideo_widget_plsizeh'] = strip_tags($new_instance['placeyoutubevideo_widget_plsizeh']);
		$instance['placeyoutubevideo_widget_autoplay'] = strip_tags($new_instance['placeyoutubevideo_widget_autoplay']);
		
		return $instance;
     }

     function form($instance) {
       //Output admin widget options form
		$instance = wp_parse_args( (array) $instance, array(
		'placeyoutubevideo_widget_title'=>placeyoutubevideo_TITLE,
		'placeyoutubevideo_widget_url'=>placeyoutubevideo_URL_DEFAULT,
		'placeyoutubevideo_widget_plsizeh'=>'200',
		'placeyoutubevideo_widget_plsizew'=>'137'
		) );
		$placeyoutubevideo_widget_title = htmlspecialchars($instance['placeyoutubevideo_widget_title'], ENT_QUOTES);
		$placeyoutubevideo_widget_url = htmlspecialchars($instance['placeyoutubevideo_widget_url'], ENT_QUOTES);
		
		$placeyoutubevideo_widget_icvid = htmlspecialchars($instance['placeyoutubevideo_widget_icvid'], ENT_QUOTES);
		$placeyoutubevideo_widget_pinhd = htmlspecialchars($instance['placeyoutubevideo_widget_pinhd'], ENT_QUOTES);
		$placeyoutubevideo_widget_plcol = htmlspecialchars($instance['placeyoutubevideo_widget_plcol'], ENT_QUOTES);
		$placeyoutubevideo_widget_plcol2 = htmlspecialchars($instance['placeyoutubevideo_widget_plcol2'], ENT_QUOTES);
		$placeyoutubevideo_widget_pem = htmlspecialchars($instance['placeyoutubevideo_widget_pem'], ENT_QUOTES);
		$placeyoutubevideo_widget_plsizeh = htmlspecialchars($instance['placeyoutubevideo_widget_plsizeh'], ENT_QUOTES);
		$placeyoutubevideo_widget_plsizew = htmlspecialchars($instance['placeyoutubevideo_widget_plsizew'], ENT_QUOTES);
		$placeyoutubevideo_widget_autoplay = htmlspecialchars($instance['placeyoutubevideo_widget_autoplay'], ENT_QUOTES);	
		
		
	   ?>
<script type="text/javascript" src="<?php echo get_option('siteurl');?>/wp-content/plugins/place-youtube-video/jscolor/jscolor.js"></script>
<script type="text/javascript">jscolor.init();</script>

<p><label for="placeyoutubevideo_widget_title"><?php _e('Video Title:'); ?> <input  id="<?php echo  $this->get_field_id('placeyoutubevideo_widget_title');?>" name="<?php echo  $this->get_field_name('placeyoutubevideo_widget_title');?>" type="text" value="<?php echo $placeyoutubevideo_widget_title; ?>" /></label></p>

	<p><label for="placeyoutubevideo_widget_url"><?php _e('YouTube Video URL:'); ?> <input  id="<?php echo  $this->get_field_id('placeyoutubevideo_widget_url');?>" name="<?php echo  $this->get_field_name('placeyoutubevideo_widget_url');?>" type="text" value="<?php echo $placeyoutubevideo_widget_url; ?>" /></label></p>
    
    <p><label for="placeyoutubevideo_widget_icvid"><input  id="<?php echo  $this->get_field_id('placeyoutubevideo_widget_icvid');?>" name="<?php echo  $this->get_field_name('placeyoutubevideo_widget_icvid');?>" type="checkbox" value="1" <?php if($placeyoutubevideo_widget_icvid==1){echo "checked";}?> /> <?php _e('Include related videos'); ?></label></p>
    
    <p><label for="placeyoutubevideo_widget_pem"><input  id="<?php echo  $this->get_field_id('placeyoutubevideo_widget_pem');?>" name="<?php echo  $this->get_field_name('placeyoutubevideo_widget_pem');?>" type="checkbox" value="1" <?php if($placeyoutubevideo_widget_pem==1){echo "checked";}?> /> <?php _e('Enable privacy-enhanced mode'); ?></label></p>
    
    <p><label for="placeyoutubevideo_widget_pinhd"><input  id="<?php echo  $this->get_field_id('placeyoutubevideo_widget_pinhd');?>" name="<?php echo  $this->get_field_name('placeyoutubevideo_widget_pinhd');?>" type="checkbox" value="1" <?php if($placeyoutubevideo_widget_pinhd==1){echo "checked";}?> /> <?php _e('Play in HD'); ?></label></p>
    
    <p><label for="placeyoutubevideo_widget_autoplay"><input  id="<?php echo  $this->get_field_id('placeyoutubevideo_widget_autoplay');?>" name="<?php echo  $this->get_field_name('placeyoutubevideo_widget_autoplay');?>" type="checkbox" value="1" <?php if($placeyoutubevideo_widget_autoplay==1){echo "checked";}?> /> <?php _e('Auto Play'); ?></label></p>
	 
     <p><label for="placeyoutubevideo_widget_plcol"><?php _e('Player Color 1:'); ?> <input  id="<?php echo  $this->get_field_id('placeyoutubevideo_widget_plcol');?>" name="<?php echo  $this->get_field_name('placeyoutubevideo_widget_plcol');?>" type="text" value="<?php echo $placeyoutubevideo_widget_plcol; ?>" class="color" style="background-color:#<?php echo $placeyoutubevideo_widget_plcol; ?>" /></label></p>
     
     <p><label for="placeyoutubevideo_widget_plcol2"><?php _e('Player Color 2:'); ?> <input  id="<?php echo  $this->get_field_id('placeyoutubevideo_widget_plcol2');?>" name="<?php echo  $this->get_field_name('placeyoutubevideo_widget_plcol2');?>" type="text" value="<?php echo $placeyoutubevideo_widget_plcol2; ?>" class="color" style="background-color:#<?php echo $placeyoutubevideo_widget_plcol2; ?>" /></label></p>
     
     <p><label for="placeyoutubevideo_widget_plsizewh"><?php _e('Player Size:'); ?> <input  id="<?php echo  $this->get_field_id('placeyoutubevideo_widget_plsizew');?>" name="<?php echo  $this->get_field_name('placeyoutubevideo_widget_plsizew');?>" type="text" value="<?php echo $placeyoutubevideo_widget_plsizew; ?>"  style="width:50px;"/> X <input  id="<?php echo  $this->get_field_id('placeyoutubevideo_widget_plsizeh');?>" name="<?php echo  $this->get_field_name('placeyoutubevideo_widget_plsizeh');?>" type="text" value="<?php echo $placeyoutubevideo_widget_plsizeh; ?>" style="width:50px;"/></label></p>
     
    
	   <?php
     }
	 
	 function getYouTubeURL($string) {
		$splitString =	$string;
		$splitString = explode("=",$splitString);
		$videoID = $splitString[1];
		return $videoID;
	}
}


?>
