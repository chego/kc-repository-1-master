<?php
// JSON-LD for Wordpress Home Articles and Author Pages written by Pete Wailes and Richard Baxter
function get_post_data() { global $post; return $post; } 
// stuff for any page 
$ldnewsArtc["@context"] = "http://schema.org/";
// this has all the data of the post/page etc 
$post_data = get_post_data(); // stuff for any page, if it exists 
$category = get_the_category(); // stuff for specific pages 
$blog_title = get_bloginfo( 'name' );
if ( is_single() ) { 
	// this gets the data for the user who wrote that particular item 
	$author_data = get_userdata($post_data->post_author); 
	$post_url = get_permalink(); 
	$post_thumb = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
	$postThumbmetasize = wp_get_attachment_metadata(get_post_thumbnail_id(get_the_ID()), 'true');
	$forPublisherLogo = get_theme_mod( 'df_logo', get_template_directory_uri() . '/assets/images/main-logo.png' );

	if ( has_post_thumbnail( get_the_ID() ) ) {
		$postThumbmetawidth = $postThumbmetasize['width'];
		$postThumbmetaheight = $postThumbmetasize['height'];
	} else {
		$postThumbmetawidth = '';
		$postThumbmetaheight = '';	
	}

	$ldnewsArtc["@type"] = "NewsArticle";
	$ldnewsArtc["mainEntityOfPage"] = array( "@type"=> "WebPage", "@id" => get_site_url() );
	$ldnewsArtc["url"] = $post_url; 
	$ldnewsArtc["author"] = array( "@type" => "Person", "name" => $author_data->display_name, ); 
	$ldnewsArtc["headline"] = $post_data->post_title; 
	$ldnewsArtc["datePublished"] = $post_data->post_date;
	$ldnewsArtc["dateModified"] = $post_data->post_modified_gmt;
	$ldnewsArtc["image"] = array( "@type" => "ImageObject", "url" => $post_thumb, "width" => $postThumbmetawidth, "height" => $postThumbmetaheight);
	$ldnewsArtc["ArticleSection"] = $category[0]->cat_name; 
	$ldnewsArtc["Publisher"] = array( "@type" => "Organization", "name" => $blog_title, "logo" => array("@type" => "ImageObject", "url" => $forPublisherLogo, "width" => 600, "height" => 60 ) );
} // we do all this separately so we keep the right things for organization together 