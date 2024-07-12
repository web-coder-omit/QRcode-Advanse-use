<?php
/**
*Plugin Name: Advance-qr-code
*Plugin URI: https://alfanet.bd.org
*Description:This is the plugin which will be advance function then previous.
*Version: 1.2
*Author: Md. Omit Hasan
*Author URI: https://google.com
*License: GPLv2 or Later
*Text Domain: aqrc
*Domain Path:/langurages/
*/

function aqrc_load_textdomain(){
    load_plugin_textdomain( 'aqrc',false,dirname(__FILE__)."/languages");
};
add_action("plugins_loaded","aqrc_load_textdomain");

function aqrc_function($content){
     $aqrc_post_link = get_permalink();
     
    $aqrc_title = 'out put of the fuction';
    $height = get_option( 'aqrcs_height');
    $width = get_option( 'aqrcs_width');
    $height = $height ? $height:10;
    $width = $width ? $width:10;
        // $h = 900;
        // $w = 900;
     $aqrc_dimantion= apply_filters( 'aqrc_dimantions', "{$width}x{$height}");
    // echo $aqrc_dimantion;
  $aqrc_src = sprintf('https://api.qrserver.com/v1/create-qr-code/?size=%s&ecc=L&qzone=1&data=%s',$aqrc_dimantion,$aqrc_post_link);
    // $aqrc_src = sprintf('https://api.qrserver.com/v1/create-qr-code/?size=%sx%s&ecc=L&qzone=1&data=%s',$w,$h,$aqrc_post_link);
    $content .= sprintf("<img src='%s'>",$aqrc_src);
    return $content;
}
add_filter( 'the_content', 'aqrc_function');

function aqrc_settings_init(){

    add_settings_section( 'aqrc_section', __('Post to QR code','aqrc'),'aqrc_callback','general');

    add_settings_field( 'aqrc_height', __('QR code Height','aqrc'),'aqrc_display_height','general','aqrc_section');
      add_settings_field( 'aqrc_width', __('QR code Width','aqrc'),'aqrc_display_width','general','aqrc_section');
    
    register_setting('general','aqrc_height');
    register_setting('general','aqrc_width');

}

function aqrc_callback(){
    echo "<p>".__('Settings for post to qr plugin','aqrc')."</p>";
}


function aqrc_display_height(){
    $height = get_option( 'aqrc_height');
    printf("<input type= 'text' id='%s' name='%s' value='%s'/>",'aqrc_height','aqrc_height',$height);
};
function aqrc_display_width(){
    $width = get_option( 'aqrc_width');
    printf("<input type= 'text' id='%s' name='%s' value='%s'/>",'aqrc_width','aqrc_width',$width);
}

add_action("admin_init",'aqrc_settings_init');








?>
