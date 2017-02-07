<?php
// JSON-LD for Wordpress Home Articles and Author Pages written by Pete Wailes and Richard Baxter
function get_post_data() { global $post; return $post; } 
// stuff for any page 
$payload["@context"] = "http://schema.org/";
$payload["@type"] = "CreativeWork";
// this has all the data of the post/page etc 
$post_data = get_post_data(); // stuff for any page, if it exists 
$category = get_the_category(); // stuff for specific pages 
$blog_title = get_bloginfo( 'name' );
if ( is_single() ) { 
	// this gets the data for the user who wrote that particular item 
	$author_data = get_userdata($post_data->post_author); 
	$post_url = get_permalink(); 
	$post_thumb = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); 
	$postThumbmetawidth = wp_get_attachment_metadata(get_post_thumbnail_id(get_the_ID()), 'true');
	$forPublisherLogo = get_theme_mod( 'df_logo', get_template_directory_uri() . '/assets/images/main-logo.png' );

	$payload["@type"] = "NewsArticle";
	$payload["mainEntityOfPage"] = array( "@type"=> "WebPage", "@id" => get_site_url() );
	$payload["url"] = $post_url; 
	$payload["author"] = array( "@type" => "Person", "name" => $author_data->display_name, ); 
	$payload["headline"] = $post_data->post_title; 
	$payload["datePublished"] = $post_data->post_date;
	$payload["dateModified"] = $post_data->post_modified_gmt;
	$payload["image"] = array( "@type" => "ImageObject", "url" => $post_thumb, "width" => $postThumbmetawidth['width'], "height" => $postThumbmetawidth['height']);
	$payload["ArticleSection"] = $category[0]->cat_name; 
	$payload["Publisher"] = array( "@type" => "Organization", "name" => $blog_title, "logo" => array("@type" => "ImageObject", "url" => $forPublisherLogo, "width" => 600, "height" => 60 ) );
} // we do all this separately so we keep the right things for organization together 
if ( is_front_page() ) { 
	$payload["@type"] = "Organization"; 
	$payload["name"] = "Builtvisible"; 
	$payload["logo"] = "http://builtvisible.com/wp-content/uploads/2014/05/BUILTVISIBLE-Badge-Logo-512x602-medium.png"; 
	$payload["url"] = "http://builtvisible.com/"; 
	$payload["sameAs"] = array( "https://twitter.com/builtvisible", "https://www.facebook.com/builtvisible", "https://www.linkedin.com/company/builtvisible", "https://plus.google.com/+SEOgadget/" ); 
	$payload["contactPoint"] = array( array( "@type" => "ContactPoint", "telephone" => "+44 20 7148 0453", "email" => "hello@builtvisible.com", "contactType" => "sales" ) );
}
if ( is_author() ) {
	// this gets the data for the user who wrote that particular item 
	$author_data = get_userdata($post_data->post_author); 
	// some of you may not have all of these data points in your user profiles - delete as appropriate 
	// fetch twitter from author meta and concatenate with full twitter URL 
	$twitter_url = " https://twitter.com/"; 
	$twitterHandle = get_the_author_meta('twitter'); 
	$twitterHandleURL = $twitter_url . $twitterHandle; 
	$websiteHandle = get_the_author_meta('url'); 
	$facebookHandle = get_the_author_meta('facebook'); 
	$gplusHandle = get_the_author_meta('googleplus'); 
	$linkedinHandle = get_the_author_meta('linkedin'); 
	$slideshareHandle = get_the_author_meta('slideshare'); 
	$payload["@type"] = "Person"; 
	$payload["name"] = $author_data->display_name; 
	$payload["email"] = $author_data->user_email; 
	$payload["sameAs"] = array( $twitterHandleURL, $websiteHandle, $facebookHandle, $gplusHandle, $linkedinHandle, $slideshareHandle );
} 
?>