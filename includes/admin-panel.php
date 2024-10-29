<?php
// ****************************************************************************
// Gestión del panel de administración
// ****************************************************************************

require_once( AMP__EXT__DIR__ . '/includes/titan-framework/titan-framework-embedder.php' );

function esmm_amp_read_option($id){

  $titan = TitanFramework::getInstance( 'esmm-amp' );

  return $titan->getOption($id);

}

function esmm_amp_error_noamp() {

  $urlAMP = admin_url('plugin-install.php?tab=search&type=term&s=amp');
  $txtAMP = sprintf(__('In order to get <strong>AMP extensions PREMIUM</strong> running, you have to install and activate the <a href="%s">Automattic\'s AMP plugin</a>.','esmm-amp-extensions'), $urlAMP);

?>
<div class="error notice">
  <p><?php echo $txtAMP; ?></p>
</div>
<?php
}

function esmm_amp_create_options() {

  if ( esmm_amp_is_amp_activated() ) {
  }
  else {
    add_action( 'admin_notices', 'esmm_amp_error_noamp' );
  }

  $txtDescription = "";

  $titan = TitanFramework::getInstance( 'esmm-amp' );

  $panel = $titan->createAdminPanel( array(
    'name' => __('AMP Extensions','esmm-amp-extensions'),
    'id' => 'esmm-amp-extensions',
    'title' => __('AMP Extensions Settings','esmm-amp-extensions'),
    'parent' => 'options-general.php',
    'desc' => $txtDescription
  ) );


  // Pestañas


  $helpLicenseTab = $panel->createTab( array(
    'name' => __('AMP extensions PRO','esmm-amp-extensions'),
  ) );
  $generalTab = $panel->createTab( array(
    'name' => __('General','esmm-amp-extensions'),
  ) );
  $codeTab = $panel->createTab( array(
    'name' => __('Custom CSS','esmm-amp-extensions'),
  ) );


  // Google Analytics

  $generalTab->createOption( array(
    'type' => 'heading',
    'name' => __('Google Analytics','esmm-amp-extensions'),
    'desc' => ''
  ) );
  $generalTab->createOption( array(
    'name' => __('Tracking ID','esmm-amp-extensions'),
    'id' => 'analytics_tracking_id',
    'type' => 'text',
    'desc' => __('UA-XXXXX-Y','esmm-amp-extensions')
  ) );

  // Schema Metadata

  $generalTab->createOption( array(
    'type' => 'heading',
    'name' => __('Schema Metadata','esmm-amp-extensions'),
    'desc' => __('AMP Project recommends that AMP HTML documents are marked up with schema.org/CreativeWork or any of its more specific types such as schema.org/NewsArticle or schema.org/BlogPosting','esmm-amp-extensions')
  ) );
  $generalTab->createOption( array(
    'name' => __('Schema','esmm-amp-extensions'),
    'id' => 'schema_metadata',
    'type' => 'select',
    'options' => array(
      'Article' => 'Article',
      'NewsArticle' => 'NewsArticle',
      'BlogPosting' => 'BlogPosting',
      'CreativeWork' => 'CreativeWork',
      'Video' => 'Video'
    ),
    'desc' => ''
  ) );


  // Custom CSS

  $codeTab->createOption( array(
    'type' => 'heading',
    'name' => __('Custom CSS','esmm-amp-extensions'),
    'desc' => __('','esmm-amp-extensions')
  ) );
  $codeTab->createOption( array(
    'name' => __('CSS Code','esmm-amp-extensions'),
    'id' => 'css_code',
    'type' => 'code',
    'desc' => '',
    'theme' => 'chaos',
    'lang' => 'css',
    'height' => 300
  ) );



  $urlImagenBanner = plugins_url( 'assets/ampbanner.png', dirname(__FILE__) );
  $urlImagenChart = plugins_url( 'assets/chart', dirname(__FILE__) );
  $urlProduct = "https://plusendo.com/producto/amp-extensions-pro/";

  $txtFeatures = __('The AMP extensions PRO clients will also be able to:','esmm-amp-extensions');
  $txtFeature1 = __('<strong>Related posts fully configurable:</strong> number of posts shown, relationship, order and location.','esmm-amp-extensions');
  $txtFeature2 = __('<strong>Adsense:</strong> top, bottom and inline ads.','esmm-amp-extensions');
  $txtFeature3 = __('<strong>Social Share:</strong> Facebook, Twitter, Google+, LinkedIn, Stumble Upon, Pinterest, Whatsapp and Telegram.','esmm-amp-extensions');
  $txtFeature4 = __('More <strong>new features</strong> we are preparing.','esmm-amp-extensions');

  $lblAnalytics = __('Tracking Google Analytics','esmm-amp-extensions');
  $lblSchema = __('Schema Metadata','esmm-amp-extensions');
  $lblCustomCode = __('Custom CSS Code','esmm-amp-extensions');
  $lblRelated = __('Related posts','esmm-amp-extensions');
  $lblAdsense = __('Google Adsense','esmm-amp-extensions');
  $lblShare = __('Social Share','esmm-amp-extensions');

  $txtRelated = __('3 fixed, by tag','esmm-amp-extensions');
  $txtRelatedPRO = __('Fully configurable','esmm-amp-extensions');

  $txtCTO = __('Get more info about AMP extensions PRO','esmm-amp-extensions');

  $codigoPromo = <<<EOT
<style>
#ampprofeatures {
  list-style: disc;
}

#ampprofeatures li {
  margin-left: 35px;
}

#btnCTA{
  margin-top: 20px;
  padding-top: 10px;
  padding-bottom: 10px;
  padding-left: 20px;
  padding-right: 20px;
  height: 50px;
  font-size: large;
}

/* START COMPARISON TABLE STYLES */
#comparetable {/*width: 100%; */table-layout: fixed; text-align: center; margin: 2.5em 0; border-collapse: collapse; }
#comparetable tr {background: transparent!important;}
#comparetable td,
#comparetable th {padding: 10px; text-align: center;width: 230px;}
#comparetable td.rowTitle {text-align: left;}
.blank 
{
  background: none!important; 
  border: none!important;
}
.clean th 
{
  background-color: #dfdfdf; 
  font-size: 18px; 
  color: #585858; 
  text-align: center; 
  font-weight: 400; 
  text-shadow: 0 1px 0 #e0ecf7; 
  border: 1px solid #bbbbbb;
}
.clean td 
{
  background-color: #f0f1f1; 
  border: 1px solid #c8d6e2;
}
.clean td.rowTitle 
{
  font-size: 18px; 
  font-weight: 400;
}
/* END COMPARISON TABLE STYLES */
</style>
<script type="text/javascript">
    jQuery(function(){

      jQuery("input#btnCTA").on("click", function(){

        var win = window.open('$urlProduct', '_blank');
        if (win) {
            //Browser has allowed it to be opened
            win.focus();
        } else {
            //Browser has blocked it
            alert('Please allow popups for this website');
        }

      });

      jQuery("input#btnRefresh").on("click", function(){

        location.reload();
      });
    });
  </script>
<a href="$urlProduct" title="AMP extensions PRO"><img src="$urlImagenBanner" alt="AMP extensions PRO" /></a>
<br /><br />
<h3><strong>$txtFeatures</strong></h3>

<ul id="ampprofeatures">
<li>$txtFeature1</li>
<li>$txtFeature2</li>
<li>$txtFeature3</li>
<li>$txtFeature4</li>
</ul>

<div id="ampchart">
  <table id="comparetable" class="clean">
    <tr>
      <td class="blank"> </td>
      <th>AMP Extensions</th>
      <th>AMP Extensions PRO</th>
    </tr>
    <tr>
      <td class="rowTitle">$lblAnalytics</td>    
            
      <td><img src='$urlImagenChart/addCheck.png' alt='icon' /></td>
      <td><img src='$urlImagenChart/addCheck.png' alt='icon' /></td>
    </tr>
    <tr>
      <td class="rowTitle">$lblSchema</td>    

      <td><img src='$urlImagenChart/addCheck.png' alt='icon' /></td>
      <td><img src='$urlImagenChart/addCheck.png' alt='icon' /></td>
    </tr>
    <tr>
      <td class="rowTitle">$lblCustomCode</td>    

      <td><img src='$urlImagenChart/addCheck.png' alt='icon' /></td>
      <td><img src='$urlImagenChart/addCheck.png' alt='icon' /></td>
    </tr>
    <tr>
      <td class="rowTitle">$lblRelated</td>    

      <td>$txtRelated</td>
      <td>$txtRelatedPRO</td>
    </tr>
    <tr>
      <td class="rowTitle">$lblAdsense</td>    

      <td><img src='$urlImagenChart/addRedX.png' alt='icon' /></td>
      <td><img src='$urlImagenChart/addCheck.png' alt='icon' /></td>
    </tr>
    <tr>
      <td class="rowTitle">$lblShare</td>    

      <td><img src='$urlImagenChart/addRedX.png' alt='icon' /></td>
      <td><img src='$urlImagenChart/addCheck.png' alt='icon' /></td>
    </tr>
                   
  </table>
</div>


<input type="button" id="btnCTA" value="$txtCTO" class="button button-primary">
EOT;

  $helpLicenseTab->createOption( array(
    'type' => 'custom',
    'custom' => $codigoPromo
  ) );


  if ( ($_GET['tab'] != 'amp-extensions-pro') && ($_GET['tab'] != '') ) {
    // Buttons
    
    $panel->createOption( array(
      'type' => 'save',
      'save' => __('Save','esmm-amp-extensions'),
      'use_reset' => false
    ) );
  }
}

add_action( 'tf_create_options', 'esmm_amp_create_options' );