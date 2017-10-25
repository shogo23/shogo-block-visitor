<?php

  //Exit if accessed directly.
  if ( ! defined( 'ABSPATH' ) ) {
    exit;
  }

  use Shogo\SBV\Classes\Stats;

  $stats = new Stats();
?>

<?php if ( $stats->get_counts() > 0 ): ?>
  <div class="sbv-clear-stats-contents">
    <h3>Clear Statistics</h3>
    <div class="sbv-clear-stats-btn">Clear Stats Now</div>
    <div class="sbv-clear-stats-flash"></div>
  </div>

  <script type="text/javascript">
    jQuery(".sbv-clear-stats-btn").on("click", function() {
      var c = confirm( "Are you sure you want to clear statistics?" );

      if ( c ) {
        var data = {
          "action": "sbv",
          "operation": "clear_stats"
        };

        jQuery.post(ajaxurl, data, function() {
          jQuery(".sbv-clear-stats-flash").html("Statistics has been cleared.");
        });
      }
    });
  </script>
<?php else: ?>
  <div class="sbv-clear-stats-contents">
    There are not Statistics at this time.
  </div>
<?php endif; ?>
