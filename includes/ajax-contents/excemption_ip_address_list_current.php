<?php

//Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

use Shogo\SBV\Classes\Bootstrap;

$bootstrap = new Bootstrap();

$options = $bootstrap->get_ops();

$options = json_decode( $options, true );

$ips = $options['sbv_options']['ban_all']['exception']['ip'];

?>

<ul class="sbv-excemtion-ip-list">
  <?php $i = 0; foreach ( $ips as $ip ): ?>
    <li id="f_<?= $i ?>"><?= $ip ?><span title="Delete <?= $ip ?>" class="sbv-excemption-ip-remove">x</span></li>
  <?php $i++; endforeach; ?>
</ul>

<script type="text/javascript">
  var ip_excemption_selected = "";

  jQuery(".sbv-excemtion-ip-list li").each(function( i ) {
    i = i + 1;

    jQuery(this).on("click", function() {
      jQuery(".sbv-excemtion-ip-list li").css({
        "background-color": "transparent",
        "color": "#000"
      });

      jQuery(this).css({
        "background-color": "blue",
        "color": "#fff"
      });
    });

    jQuery(".sbv-excemtion-ip-list li:nth-child(" + i + ") .sbv-excemption-ip-remove").on("click", function() {
      var id = jQuery(".sbv-excemtion-ip-list li:nth-child(" + i + ") ").attr("id").replace("f_", "");
      var data = {
        "action": "sbv",
        "operation": "remove_excempted_ip_address",
        "pos": id
      };

      jQuery.post(ajaxurl, data, function() {
        sbv_excemption_ip_list_current();
      });
    })
  });
</script>
