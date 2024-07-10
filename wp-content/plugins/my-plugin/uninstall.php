<?php
// if uninstall.php is not called by WordPress, die
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
  header('Location: /customeplugin');
  die('');
}

global $wpdb, $table_prefix;


$wp_emp = $table_prefix. 'emp';

$q = "DROP TABLE `$wp_emp`;";
$wpdb->query($q);

?>