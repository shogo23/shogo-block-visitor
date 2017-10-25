<?php

//Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

function SBV_install() {

  global $wpdb;

  //Plugin's Plugin Options.
  $option['sbv_options'] = [
    'ban_all' => [
      'enabled' => 0,
      'exception' => [
        'ip' => '',
        'country' => ''
      ]
    ],

    'ban_some' => [
      'enabled' => 0,
      'banned' => [
        'ip' => '',
        'country' => ''
      ]
    ],
    'page_redirect' => '',
    'bots' => 1
  ];

  /*
  * Create Plugin's Databse Table.
  */
  //DB Prefix.
  $prefix = $wpdb->prefix;

  //Database table name.
  $table = $prefix . 'sbv_statistics';

  //Charset Coallate.
  $charset_collate = $wpdb->get_charset_collate();

  //Sql Command Creating Table.
  $sql = "CREATE TABLE $table (
    id bigint(100) NOT NULL AUTO_INCREMENT,
    ip varchar(255) DEFAULT '' NOT NULL,
    hostname varchar(255) DEFAULT '' NOT NULL,
    city varchar(255) DEFAULT '' NOT NULL,
    region varchar(255) DEFAULT '' NOT NULL,
    country varchar(255) DEFAULT '' NOT NULL,
    loc varchar(255) DEFAULT '' NOT NULL,
    org varchar(255) DEFAULT '' NOT NULL,
    date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
    UNIQUE KEY id (id)
  ) $charset_collate;";

  //Require wp upgrade.php to hook dbDelta Method.
  require_once( ABSPATH.'wp-admin/includes/upgrade.php' );

  //Excecute DB Table Creation.
  dbDelta( $sql );

  //Database Table Version.
  add_option( 'SBV_db_statistics', '1.0' );

  //Encode to JSON.
  $option = json_encode( $option );

  //Create WP option for this plugin.
  add_option( 'SBV_Option', $option, 'yes' );
}
