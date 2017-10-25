<?php

//Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

use Shogo\SBV\Classes\Bootstrap;

$bootsrap = new Bootstrap();

?>

<ul class="sbv-excemption-countries-list-current">
  <?php $i = 0; foreach ( $bootstrap->exception_countries_list_current() as $countries ): ?>
    <?php foreach ( $countries as $code => $name ): ?>
      <li id="e_<?= $i ?>"><?= $name ?></li>
    <?php endforeach; ?>
  <?php $i++; endforeach; ?>
</ul>

<script type="text/javascript">
  var excempt_country_selected = "";

  jQuery(".sbv-excemption-countries-list-current li").each(function() {
    jQuery(this).on("click", function() {
      jQuery(".sbv-excemption-countries-list-current li").css({
        "background-color": "transparent",
        "color": "#000"
      });

      jQuery(this).css({
        "background-color": "blue",
        "color": "#fff"
      });

      var pos = jQuery(this).attr("id").replace( "e_", "" );

      excempt_country_selected = pos;
    });
  });
</script>
