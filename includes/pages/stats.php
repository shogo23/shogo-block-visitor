<?php

  //Exit if accessed directly.
  if ( ! defined( 'ABSPATH' ) ) {
    exit;
  }

  use Shogo\SBV\Classes\Stats;

  $stats = new Stats();
?>

<?php if ( $stats->get_counts() > 0 ): ?>
  <div class="sbv-stats-stats-container">
    <table>
      <thead>
        <tr>
          <th>Country Code</th>
          <th>Statistic</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ( $stats->get_distinct() as $stat ): ?>
          <tr>
            <td><span title="<?= $stats->country_name( $stat->country ) ?>" style="cursor: pointer;"><?= $stat->country; ?></span></td>
            <td>
              <div style="background-color: cyan; width: <?= $stats->get_percent( $stat->country ) ?>%; text-align: center;"><?= $stats->get_percent( $stat->country ) ?>%</div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php else: ?>
  <div class="sbv-stats-stats-container">
    There are no Statistics at this time.
  </div>
<?php endif; ?>
