<?php
/* 
Plugin Name: AMP extensions
Plugin URI: https://www.estentor.es
Description: Extensions of the AMP plugin
Version: 1.1
Author: Esténtor Social Media Marketing
Author URI: https://www.estentor.es
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.txt
Text Domain: esmm-amp-extensions

AMP extensions is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
any later version.
 
AMP extensions is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with AMP extensions. If not, see http://www.gnu.org/licenses/gpl-3.0.txt.
*/

define( 'AMP__EXT__DIR__', dirname( __FILE__ ) );

require_once( AMP__EXT__DIR__ . '/includes/admin-panel.php' );
require_once( AMP__EXT__DIR__ . '/includes/general.php' );
require_once( AMP__EXT__DIR__ . '/includes/custom-code.php' );
require_once( AMP__EXT__DIR__ . '/includes/related-post.php' );


// function esmm_amp_activate() {
// }

// register_activation_hook( __FILE__, 'esmm_amp_activate' );


function esmm_amp_deactivate() {

  flush_rewrite_rules();
}

register_deactivation_hook( __FILE__, 'esmm_amp_deactivate' );


function esmm_amp_init() {

  load_plugin_textdomain( 'esmm-amp-extensions', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

add_action( 'plugins_loaded', 'esmm_amp_init' );


function esmm_amp_is_amp_activated() {

  $blog_plugins = get_option( 'active_plugins', array() );
  $site_plugins = get_site_option( 'active_sitewide_plugins', array() );

  if( ! defined('AMP__FILE__') ) {
    return false;
  }
      
  $amp_basename = plugin_basename( AMP__FILE__ );

  if( ( in_array( $amp_basename, $blog_plugins ) || isset( $site_plugins[$amp_basename] ) ) && version_compare( AMP__VERSION, '0.4.2', '>=' )) {
    return true;
  } else {
    return false;
  }
}