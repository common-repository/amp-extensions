<?php
// ****************************************************************************
// Embebemos el código de posts relacionados 
// ****************************************************************************

if ( !function_exists('esmm_amp_add_related') ) :

function esmm_amp_add_related( $content ) {

	if ( is_amp_endpoint() && is_single() ) {

		global $post;

		$orig_post = $post;

		$tags = wp_get_post_tags($post->ID);

		if ($tags) {
      $tag_ids = array();
      foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
		}
		else {
			$tag_ids = array();
		}

		$categories = get_the_category($post->ID);

		if ($categories) {
      $categories_ids = array();
      foreach($categories as $individual_category) $categories_ids[] = $individual_category->term_id;
		}
		else {
			$categories_ids = array();
		}

		$relatedCondition = 'tag';

		if ( $relatedCondition == "tag"){
			
			$args = array (

				'order'                  => 'Desc',
				'orderby'                => 'Date',
				'showposts' 			 => '3',
				'post__not_in'			 => array ($post->ID),
				'post_status'            => 'publish',
				'tag__in' 			 => $tag_ids,

			);

		}
		
	  $my_query = new wp_query( $args );

		$bloqueRelacionados = '<section class="articulosRelacionados">';
		
		if($my_query->have_posts()){

			$bloqueRelacionados .= '<h2>' . __('Related posts','esmm-amp-extensions') . '</h2>';
		}
		
	  $bloqueRelacionados .= '<ul>';

	  while( $my_query->have_posts() ) {

	    $my_query->the_post();
	    $ampthumb = get_the_post_thumbnail_url();
			$ampthumbalt = get_the_title(); 
			$ampdate = get_the_date();

			$bloqueRelacionados .= '<li>';

			if ( $ampthumb != "") {
				$bloqueRelacionados .= '<amp-img src="'. $ampthumb .'" alt="'. $ampthumbalt .'" height="51" width="75"></amp-img>';
			}

	    $bloqueRelacionados .= '<a href="'. get_the_permalink() . '" class="title">'.get_the_title().'</a>';
	    $bloqueRelacionados .= '</li>';
	  }

	  $bloqueRelacionados .= '</ul>';

	  $post = $orig_post;
	  wp_reset_query();

		$bloqueRelacionados .= '</section>';

	}
	else {
		// Si no hacemos nada
		$bloqueRelacionados = "";
	}

	return  $content.$bloqueRelacionados;
}

endif;

if ( esmm_amp_is_amp_activated() )  {
	add_filter( 'the_content', 'esmm_amp_add_related', 20);
}


// ****************************************************************************
// CSS necesario 
// ****************************************************************************

if ( !function_exists('esmm_amp_related_css') ) :

function esmm_amp_related_css( $amp_template ) {

	if ( is_amp_endpoint() ){
?>

section.articulosRelacionados{
	margin-top: 60px;
	margin-bottom: 25px;
  display: block;
}

section.articulosRelacionados h2{
	display: block;
	margin-bottom: 14px;
	color: #4a4a4a;
  font-size: 14px;
  line-height: 17px;
  margin: 0;
}

section.articulosRelacionados ul{
	list-style: none;
	padding: 0;
	display: block;
	margin: 0 auto;
	max-width: calc(840px - 32px);
	padding-top: 1.25em;
  padding-bottom: 1.25em;
	position: relative;
}

section.articulosRelacionados li{
	height: 80px;
  border-bottom: 1px solid #d8d8d8;
  margin-bottom: 10px;
  display: list-item;
  text-align: -webkit-match-parent;
}

section.articulosRelacionados amp-img {
	float: left;
  background-color: #ccc;
  width: 75px;
  height: 51px;
  overflow: hidden;
  display: inline-block;
  position: relative;
}

section.articulosRelacionados .title {
	float: left;
  width: 190px;
  margin: 0 0 0 15px;
  color: #000;
  text-decoration: none;
  cursor: auto;
  font-size: 13px;
  line-height: 1.5;
}
<?php
  }
}

endif;

if ( esmm_amp_is_amp_activated() ) {
	add_action( 'amp_post_template_css', 'esmm_amp_related_css' );
}