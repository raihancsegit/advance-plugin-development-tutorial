<?php 
  get_header(); // to include wordpress header

  
  // adding shortcode to the page
  // used to render content of shortcode
  do_shortcode("[render-my-content]");
 
  get_footer(); // to include wordpress footer
?>