<?php

  //Exit if accesssed directly
  if ( ! defined( 'ABSPATH' ) ) {
  	exit;
  }
?>

<nav class="sbv-stats-nav">
  <ul>
    <li><a <?= ! $_GET['p'] ? 'class="sbv-nav-selected"' : ''; ?> href="<?= get_site_url().'/wp-admin/admin.php?page=sbv_statistics' ?>">Stats</a></li>
    <li><a <?= $_GET['p'] == 'ip-blocked' ? 'class="sbv-nav-selected"' : ''; ?>  href="<?= get_site_url().'/wp-admin/admin.php?page=sbv_statistics&p=ip-blocked' ?>">IP Address Blocked</a></li>
    <li><a <?= $_GET['p'] == 'clear-stats' ? 'class="sbv-nav-selected"' : ''; ?> href="<?= get_site_url().'/wp-admin/admin.php?page=sbv_statistics&p=clear-stats' ?>">Clear Stats</a></li>
  </ul>
</nav>

<nav class="sbv-stats-nav-mobile">
  <select>
    <option value="<?= get_site_url().'/wp-admin/admin.php?page=sbv_statistics' ?>" <?= ! $_GET['p'] ? 'selected="selected"' : ''; ?>>Stats</option>
    <option value="<?= get_site_url().'/wp-admin/admin.php?page=sbv_statistics&p=ip-blocked' ?>" <?= $_GET['p'] == 'ip-blocked' ? 'selected="selected"' : ''; ?>>IP Address Blocked</option>
    <option value="<?= get_site_url().'/wp-admin/admin.php?page=sbv_statistics&p=clear-stats' ?>" <?= $_GET['p'] == 'clear-stats' ? 'selected="selected"' : ''; ?>>Clear Stats</option>
  </select>
</nav>

<script type="text/javascript">
  jQuery(".sbv-stats-nav-mobile select").on("change", function() {
    location = jQuery(this).val();
  });
</script>
