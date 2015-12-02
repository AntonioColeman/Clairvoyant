<?php

function vc_vc_grid_item_form_field( $settings, $value ) {
	//require_once vc_path_dir( 'PARAMS_DIR', 'vc_grid_item/editor/class-vc-grid-item-editor.php' );
	//require_once vc_path_dir( 'PARAMS_DIR', 'vc_grid_item/class-vc-grid-item.php' );
	$output = '<div data-vc-grid-element="container">'
	          . '<select data-vc-grid-element="value" type="hidden" name="' . $settings['param_name']
	          . '" class="wpb_vc_param_value wpb-select '
	          . $settings['param_name'] . ' ' . $settings['type'] . '_field" '
	          . '>';
	$vc_grid_item_templates = Vc_Grid_Item::predefinedTemplates();
	if ( is_array( $vc_grid_item_templates ) ) {
		foreach ( $vc_grid_item_templates as $key => $data ) {
			$output .= '<option data-vc-link="'
			           . esc_url( admin_url( 'post-new.php?post_type=vc_grid_item&vc_gitem_template=' . $key ) )
			           . '" value="' . $key . '"'
			           . ( $key === $value ? ' selected="true"' : '' )
			           . '>' . esc_html( $data['name'] ) . '</option>';
		}
	}

	$grid_item_posts = get_posts( array(
		'posts_per_page' => '-1',
		'orderby' => 'post_title',
		'post_type' => Vc_Grid_Item_Editor::postType()
	) );
	foreach ( $grid_item_posts as $post ) {
		$output .= '<option  data-vc-link="' . esc_url( get_edit_post_link( $post->ID ) ) . '"value="' . $post->ID . '"'
		           . ( (string) $post->ID === $value ? ' selected="true"' : '' )
		           . '>' . esc_html( $post->post_title ) . '</option>';
	}
	$output .= '</select></div>';

	return $output;
}

function vc_load_vc_grid_item_param() {
	/*vc_add_shortcode_param(
		'vc_grid_item',
		'vc_vc_grid_item_form_field',
		vc_asset_url( 'js/params/vc_grid_item/param.js' )
	);*/
}

//add_action( 'vc_load_default_params', 'vc_load_vc_grid_item_param' );
function vc_gitem_post_data_get_link_target_frontend_editor( $target ) {
	return ' target="_blank"';
}

function vc_gitem_create_link( $atts, $default_class = '', $title = '' ) {
	$link = '';
	$target = '';
	$title_attr = '';
	$css_class = 'vc_gitem-link' . ( strlen( $default_class ) > 0 ? ' ' . $default_class : '' );
	if ( isset( $atts['link'] ) ) {
		if ( 'custom' === $atts['link'] && ! empty( $atts['url'] ) ) {
			$link = vc_build_link( $atts['url'] );
			if ( strlen( $link['target'] ) ) {
				$target = ' target="' . esc_attr( $link['target'] ) . '"';
			}
			if ( strlen( $link['title'] ) ) {
				$title = $link['title'];
			}
			$link = 'a href="' . esc_attr( $link['url'] ) . '" class="' . esc_attr( $css_class ) . '"';
		} elseif ( 'post_link' === $atts['link'] ) {
			$link = 'a href="{{ post_link_url }}" class="' . esc_attr( $css_class ) . '"';
			if ( ! strlen( $title ) ) {
				$title = '{{ post_title }}';
			}
		} elseif ( 'image' === $atts['link'] ) {
			$link = 'a{{ post_image_url_href }} class="' . esc_attr( $css_class ) . '"';
		} elseif ( 'image_lightbox' === $atts['link'] ) {
			$link = 'a{{ post_image_url_attr_prettyphoto:' . $css_class . ' }}';
		}
	}
	if ( strlen( $title ) > 0 ) {
		$title_attr = ' title="' . esc_attr( $title ) . '"';
	}

	return apply_filters( 'vc_gitem_post_data_get_link_link', $link, $atts, $css_class )
	       . apply_filters( 'vc_gitem_post_data_get_link_target', $target, $atts )
	       . apply_filters( 'vc_gitem_post_data_get_link_title', $title_attr, $atts );
}

function vc_gitem_create_link_real( $atts, $post, $default_class = '', $title = '' ) {
	$link = '';
	$target = '';
	$title_attr = '';
	if ( isset( $atts['link'] ) ) {
		$link_css_class = 'vc_gitem-link' . ( strlen( $default_class ) > 0 ? ' ' . $default_class : '' );
		if ( 'custom' === $atts['link'] && ! empty( $atts['url'] ) ) {
			$link = vc_build_link( $atts['url'] );
			if ( strlen( $link['target'] ) ) {
				$target = ' target="' . esc_attr( $link['target'] ) . '"';
			}
			if ( strlen( $link['title'] ) ) {
				$title = $link['title'];
			}
			$link = 'a href="' . esc_attr( $link['url'] ) . '" class="' . esc_attr( $link_css_class ) . '"';
		} elseif ( 'post_link' === $atts['link'] ) {
			$link = 'a href="' . get_permalink( $post->ID ) . '" class="' . esc_attr( $link_css_class ) . '"';
			if ( ! strlen( $title ) ) {
				$title = the_title( '', '', false );
			}
		} elseif ( 'image' === $atts['link'] ) {
			$href_link = vc_gitem_template_attribute_post_image_url( '', array( 'post' => $post, 'data' => '' ) );
			$link = 'a href="' . $href_link . '" class="' . esc_attr( $link_css_class ) . '"';
		} elseif ( 'image_lightbox' === $atts['link'] ) {
			$link = 'a' . vc_gitem_template_attribute_post_image_url_attr_prettyphoto( '', array(
					'post' => $post,
					'data' => $link_css_class
				) );
		}
	}
	if ( strlen( $title ) > 0 ) {
		$title_attr = ' title="' . esc_attr( $title ) . '"';
	}

	return apply_filters( 'vc_gitem_post_data_get_link_real_link', $link, $atts, $post, $link_css_class )
	       . apply_filters( 'vc_gitem_post_data_get_link_real_target', $target, $atts, $post )
	       . apply_filters( 'vc_gitem_post_data_get_link_real_title', $title_attr, $atts );
}

function vc_gitem_post_data_get_link_link_frontend_editor( $link ) {
	return empty( $link ) ? 'a' : $link;
}

if ( vc_is_page_editable() ) {
	add_filter( 'vc_gitem_post_data_get_link_link', 'vc_gitem_post_data_get_link_link_frontend_editor' );
	add_filter( 'vc_gitem_post_data_get_link_real_link', 'vc_gitem_post_data_get_link_link_frontend_editor' );
	add_filter( 'vc_gitem_post_data_get_link_target', 'vc_gitem_post_data_get_link_target_frontend_editor' );
	add_filter( 'vc_gitem_post_data_get_link_real_target', 'vc_gitem_post_data_get_link_target_frontend_editor' );
}