<?php

//Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

?>

<div class="sbv-stats-container">
  <h1>Statistics</h1>
  <?php include_once( SBV . '/includes/pages/nav.php' ); ?>
  <?php
    if ( $_GET['page'] == 'sbv_statistics' && ! $_GET['p'] ) {
      include_once( SBV . '/includes/pages/stats.php' );
    } elseif ( $_GET['page'] == 'sbv_statistics' && $_GET['p'] == 'ip-blocked' ) {
      include_once( SBV . '/includes/pages/ip-blocked.php' );
    } elseif ( $_GET['page'] == 'sbv_statistics' && $_GET['p'] == 'clear-stats' ) {
      include_once( SBV . '/includes/pages/clear-stats.php' );
    }
  ?>
</div>
