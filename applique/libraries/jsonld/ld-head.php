<?php
// function get_post_data() { global $post; return $post; }
// stuff for any page 
$ldWPhead["@context"] = "http://schema.org/";
$ldWPhead["@type"] = "WPHeader";
$ldWPhead["@id"] = get_permalink() . "/#masthead";