<?php

  //Exit if accessed directly.
  if ( ! defined( 'ABSPATH' ) ) {
    exit;
  }

  use Shogo\SBV\Classes\Stats;

  $stats = new Stats();
?>

<?php if ( $stats->get_counts() > 0 ): ?>

  <div class="sbv-ips-block-container">
    <table>
      <thead>
        <tr>
          <th>IP Address</th>
          <th>Hostname</th>
          <th>City</th>
          <th>Region</th>
          <th>Country</th>
          <th>ISP Provider</th>
          <th>Location</th>
          <th>Block Count</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach( $stats->get_ips_blocked() as $ip ): ?>
          <tr>
            <td><?= $ip->ip ?></td>
            <td><?= $stats->get_hostname( $ip->ip ) ?></td>
            <td><?= $stats->get_city( $ip->ip ) ?></td>
            <td><?= $stats->get_region( $ip->ip ) ?></td>
            <td><?= $stats->country_name( $stats->get_country_code( $ip->ip ) ) ?></td>
            <td><?= $stats->get_isp_provider( $ip->ip ) ?></td>
            <td>
              <a target="_blank" href="https://www.google.com/maps/@<?php echo $stats->get_location( $ip->ip ) ?>,11z?hl=fil">Click Here To View Map</a>
            </td>
            <td><?= $stats->count_ips( $ip->ip ) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <div class="sbv-ips-block-container-mobile">
    <ul class="sbv-ips-block-ul">
      <?php foreach( $stats->get_ips_blocked() as $ip ): ?>
        <li>
          <ul>
            <li>IP Address: <?= $ip->ip ?></li>
            <li>Hostname: <?= $stats->get_hostname( $ip->ip ) ?></li>
            <li>City: <?= $stats->get_city( $ip->ip ) ?></li>
            <li>Region: <?= $stats->get_region( $ip->ip ) ?></li>
            <li>Country: <?= $stats->country_name( $stats->get_country_code( $ip->ip ) ) ?></li>
            <li>ISP Provider: <?= $stats->get_isp_provider( $ip->ip ) ?></li>
            <li>
              <a target="_blank" href="https://www.google.com/maps/@<?php echo $stats->get_location( $ip->ip ) ?>,11z?hl=fil">Click Here To View Map</a>
            </li>
            <li>Block Count: <?= $stats->count_ips( $ip->ip ) ?></li>
          </ul>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php else: ?>
  There are no data at this time.
<?php endif; ?>
