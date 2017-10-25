<?php

//Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

use Shogo\SBV\Classes\Bootstrap;

$bootstrap = new Bootstrap();

$options = $bootstrap->get_ops();

$options = json_decode( $options, true );

$ips = $options['sbv_options']['ban_some']['banned']['ip'];

?>

<ul class="sbv-specific-ip-list-current">
  <?php $i = 0; foreach ( $ips as $ip ): ?>
    <li id="d_<?= $i; ?>"><?= $ip ?> <span title="Delete <?= $ip ?>" class="sbv-ip-btn-remove">x</span></li>
  <?php $i++; endforeach; ?>
</ul>

<script type="text/javascript">
  jQuery(".sbv-specific-ip-list-current li").each(function( i ) {
    var i = i + 1;

    jQuery(".sbv-specific-ip-list-current li:nth-child(" + i + ") .sbv-ip-btn-remove").on("click", function() {
      var id = jQuery(".sbv-specific-ip-list-current li:nth-child(" + i + ")").attr("id");
      var pos = id.replace("d_", "");

      var data = {
        "action": "sbv",
        "operation": "delete_specific_ip_current",
        "pos": pos
      };

      jQuery.post(ajaxurl, data, function(r) {
        sbv_specific_block_ip_current();
      });
    });
  });
</script>
