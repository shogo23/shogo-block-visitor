<?php

//Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

function SBV_uninstall() {

  global $wpdb;

  //Delete Plugin's Option from wp_options Table.
  delete_option( 'SBV_Option' );

  //DB Prefix.
  $prefix = $wpdb->prefix;

  //Database table name.
  $table = $prefix . 'sbv_statistics';

  //Drop Database Table.
  $wpdb->query( "DROP TABLE " . $table );
}
