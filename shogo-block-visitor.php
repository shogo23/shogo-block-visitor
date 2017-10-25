<?php

/*
* Plugin Name: Shogo's Block Visitor
* Description: A plugin that block visitors such as IP Addresses or block countries that you don't want you do visit.
* Author: Victor Caviteno
* Author URI : http://www.facebook.com/gervic23
* Plugin URI: http://www.github.com/shogo23
* Version: 1.0
* Tested up to: 4.8
*/

//Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

//Plugin Location Path.
define( 'SBV', plugin_dir_path( __FILE__ ) );


/****************
* Include Files.
*****************/

//Include Installation File.
include_once( SBV . '/install.php' );

//Include Uninstall File.
include( SBV . '/uninstall.php' );

//Include Bootstrap Class.
include_once( SBV . '/classes/bootstrap.php' );

//Include UsersInfo Class.
include_once( SBV . '/classes/usersinfo.php' );

//Include Stats Class.
include_once( SBV . '/classes/stats.php' );

//Include Actions Class.
include_once( SBV . '/classes/actions.php' );

//Include Ajax File.
include_once( SBV . '/includes/ajax.php' );

//Initiate Activation Hook to install Plugin's Options.
register_activation_hook( __FILE__, 'SBV_install' );

//Initiate Deactivation hook to uninstall Plugin's Options.
register_deactivation_hook( __FILE__, 'SBV_uninstall' );

use Shogo\SBV\Classes\Bootstrap;

//Initiate Bootrap Class.
$sbv = new Bootstrap();

//Initiate Plugin.
$sbv->init();
