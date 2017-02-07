<?php
// function get_post_data() { global $post; return $post; }
// stuff for any page 
$ldWPfoot["@context"] = "http://schema.org/";

$ldWPfoot["@type"] = "WPFooter";
$ldWPfoot["@id"] = get_permalink() . "/#footer-colophon";
$ldWPfoot["mainEntityOfPage"] = array( "@type"=> "WebPage", "@id" => get_site_url() );