<?php

//Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

use Shogo\SBV\Classes\Bootstrap;

$bootstrap = new Bootstrap();

$options = $bootstrap->get_ops();

$options = json_decode( $options, true );

$redirect_page = $options['sbv_options']['page_redirect'];

$p_name = '';

foreach ( $redirect_page as $post_name => $post_title ) {
  $p_name .= $post_name;
}

?>

<?php foreach ( $bootstrap->list_pages() as $page ): ?>
  <?php if ( $p_name == $page->post_name ): ?>
    <option value="<?= $page->post_name ?>||<?= $page->post_title ?>" selected><?= $page->post_title ?></option>
  <?php else: ?>
    <option value="<?= $page->post_name ?>||<?= $page->post_title ?>"><?= $page->post_title ?></option>
  <?php endif; ?>
<?php endforeach; ?>
