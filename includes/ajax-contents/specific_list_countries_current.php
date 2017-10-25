<?php

//Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

use Shogo\SBV\Classes\Bootstrap;

$bootstrap = new Bootstrap();

?>

<ul class="sbv-specific-country-list-current">
  <?php $i = 0; foreach ( $bootstrap->specific_current_country_list() as $cl ): ?>
    <?php foreach ( $cl as $country_code => $name ): ?>
      <?php $name = str_ireplace( "\'", "'", $name ); ?>
      <li id="c_<?= $i ?>"><?= $name ?></li>
    <?php endforeach; ?>
  <?php $i++; endforeach; ?>
</ul>

<script type="text/javascript">
  var sbv_selected_country_current = '';

  jQuery(".sbv-specific-country-list-current li").each(function(i) {
    jQuery(this).on("click", function() {
      jQuery(".sbv-specific-country-list-current li").css({
        "background-color": "transparent",
        "color": "#000"
      });

      jQuery(this).css({
        "background-color": "blue",
        "color": "#fff"
      });

      var pos = jQuery(this).attr("id").replace( "c_", "" );

      sbv_selected_country_current = pos;
    });
  });
</script>
