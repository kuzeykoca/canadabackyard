<?php

$databases = [];

$settings['hash_salt'] = 'aHEt6heSFxy5NRA3Y1I9YMFZ0KkHnsVVigMnOguFhNQ-qJROGpkBl4ctA7AT5QDm2JluiVeYGw';

$settings['update_free_access'] = FALSE;

$settings['container_yamls'][] = $app_root . '/' . $site_path . '/services.yml';

$settings['file_scan_ignore_directories'] = [
  'node_modules',
  'bower_components',
];

$settings['trusted_host_patterns'] = [
  '^americanfoody\.com$',
  '^.+\.americanfoody\.com$',
  '^localhost'
];

$settings['entity_update_batch_size'] = 50;

$settings['entity_update_backup'] = TRUE;

$settings['state_cache'] = TRUE;

$settings['migrate_node_migrate_type_classic'] = FALSE;

$databases['default']['default'] = [
  'database' => 'canadabackyard',
  'username' => 'flottlink',
  'password' => '11111111',
  'host' => 'localhost',
  'port' => '3306',
  'driver' => 'mysql',
  'prefix' => '',
  'collation' => 'utf8mb4_general_ci',
];


$databases['default']['default'] = array (
  'database' => 'canadabackyard',
  'username' => 'flottlink',
  'password' => '11111111',
  'prefix' => '',
  'host' => 'localhost',
  'port' => '3306',
  'isolation_level' => 'READ COMMITTED',
  'driver' => 'mysql',
  'namespace' => 'Drupal\\mysql\\Driver\\Database\\mysql',
  'autoload' => 'core/modules/mysql/src/Driver/Database/mysql/',
);
$settings['config_sync_directory'] = 'sites/default/files/config_ZWlGXInUm6XCO_x5AtURZwbTvqTSos8HRuhUVgn2Tw_cM67m7jbICEf3aSzkyg7xQSRYrAmhIg/sync';
