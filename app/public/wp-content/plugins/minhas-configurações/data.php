<?php
global $wpdb;

$result = $wpdb->get_results("SELECT wp_users ORDER BY ID ASC");
print_r($result);
echo $result;