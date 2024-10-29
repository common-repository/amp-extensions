<?php
// ****************************************************************************
// Incrusta código CSS personalizado 
// ****************************************************************************

if ( !function_exists('esmm_amp_css') ) :

function esmm_amp_css( $amp_template ) {

  if ( is_amp_endpoint() ){
    echo esmm_amp_read_option('css_code');
  }

}

endif;

if ( esmm_amp_is_amp_activated() ) {
  add_action( 'amp_post_template_css', 'esmm_amp_css' );
}