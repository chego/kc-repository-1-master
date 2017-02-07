<?php

if ( get_theme_mod( 'disable_sidebar_singular', 0 ) == 1 ) {
	return true;
}

// JSON-LD for Wordpress Home Articles and Author Pages written by Pete Wailes and Richard Baxter
// function get_post_data() { global $post; return $post; }
// stuff for any page 
$ldWPside["@context"] = "http://schema.org/";

$ldWPside["@type"] = "WPSideBar";
$ldWPside["@id"] = get_site_url() . "/#masthead";
$ldWPside["mainEntityOfPage"] = array( "@type"=> "WebPage", "@id" => get_site_url() );