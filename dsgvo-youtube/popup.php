<?php
add_action( 'wp_head', 'dsgvogdpryoutube' );

function dsgvogdpryoutube() {
	
				function youtubesecure_shortcode( $atts, $content = null ) {
    			//set default attributes and values
    			$values = shortcode_atts( array(
        			'url'   	=> '#',
        			'target'	=> '_self',
					'images'	=> '#',
					'alt'		=> '#',
					'width'		=> '#',
					'height'	=> '#',
    			), $atts );
					
					$array = explode("=",$values['url']);
					//$youtubecode = ($array[1]);
					$youtubecode = isset($array[1]) ? esc_attr($array[1]) : '';

					$images = $values['images'];
					//$alt = $values['alt'];
					$alt = esc_attr( $values['alt'] );

					//$width = $values['width'];
					//$height = $values['height'];
					
					$width = (ctype_digit($values['width'])) ? esc_attr(intval($values['width'])) : '';
					$height = (ctype_digit($values['height'])) ? esc_attr(intval($values['height'])) : '';



					$images = preg_replace('/\sonerror=([^\s>]+)/i', '', $images);
					$images = esc_url($images);

					if ($images =='#'){
					
						$thumbnail = '<div class="dsgvoyoutube"><a data-fancybox href="'. esc_attr($values['url']) .'" "><img src="https://img.youtube.com/vi/'.$youtubecode.'/0.jpg"></a></div>';
					}
					else
					{
					
						if ($alt == '#'){
							// esc_attr problem
							//$thumbnail = "<div class='dsgvoyoutube'><a data-fancybox href='esc_attr($values[url])' data-width='$width' data-height='$height'><img src='$images'></a></div>";
							$thumbnail = "<div class='dsgvoyoutube'><a data-fancybox href='" . esc_attr($values['url']) . "' data-width='$width' data-height='$height'><img src='$images'></a></div>";
						}
						else
						{
							// esc_attr problem
							//$thumbnail = "<div class='dsgvoyoutube'><a data-fancybox href='esc_attr($values[url])' data-width='$width' data-height='$height'><img src='$images' alt='$alt'></a></div>";
							$thumbnail = "<div class='dsgvoyoutube'><a data-fancybox href='" . esc_attr($values['url']) . "' data-width='$width' data-height='$height'><img src='$images' alt='$alt'></a></div>";
						}
						
					}
					return $thumbnail;
 			
}
add_shortcode( 'dsgvo-youtube', 'youtubesecure_shortcode' );
	
}
?>