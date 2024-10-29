<?php
// ****************************************************************************
// Asocia Schema Metadata 
// ****************************************************************************

if ( !function_exists('esmm_amp_json_newsarticle_metadata') ) :

function esmm_amp_json_newsarticle_metadata( $metadata, $post ) {

  if ( is_amp_endpoint() ) {

    $elMetadata = esmm_amp_read_option('schema_metadata');
    $metadata['@type'] = $elMetadata;

    return $metadata;
  }
  else {
    return "";
  }
}

endif;

if ( esmm_amp_is_amp_activated() ) {
  add_filter( 'amp_post_template_metadata', 'esmm_amp_json_newsarticle_metadata', 10, 2 );
}


// ****************************************************************************
// Embebemos el código de tracking de Google Analytics 
// ****************************************************************************

if ( !function_exists('esmm_amp_add_google_analytics') ) :

function esmm_amp_add_google_analytics( $analytics ) {
  
  $trackingGoogleAnalytics = esmm_amp_read_option('analytics_tracking_id');

  if ( $trackingGoogleAnalytics != ""){

    if ( ! is_array( $analytics ) ) {
      $analytics = array();
    }

    $analytics['esmm-googleanalytics'] = array(
      'type' => 'googleanalytics',
      'attributes' => array(
      ),
      'config_data' => array(
        'vars' => array(
          'account' => $trackingGoogleAnalytics
        ),
        'triggers' => array(
          'trackPageview' => array(
            'on' => 'visible',
            'request' => 'pageview',
          ),
        ),
      ),
    );
  }
  else {
    $analytics = null;
  }

  return $analytics;
}

endif;

if ( esmm_amp_is_amp_activated() ) {
  add_filter( 'amp_post_template_analytics', 'esmm_amp_add_google_analytics' );
}
