<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$databases = DB::select('SHOW DATABASES');
foreach ($databases as $db) {
    $dbname = $db->Database;
    if (in_array($dbname, ['information_schema', 'performance_schema', 'mysql', 'phpmyadmin'])) continue;
    try {
        $tables = DB::select("SHOW TABLES FROM `$dbname` LIKE '%boutique%'");
        if (!empty($tables)) {
            echo "Database: $dbname\n";
            foreach ($tables as $table) {
                $tableName = array_values((array)$table)[0];
                $count = DB::table("$dbname.$tableName")->count();
                echo "  - Table: $tableName ($count rows)\n";
            }
        }
    } catch (Exception $e) {
        echo "Error checking $dbname: " . $e->getMessage() . "\n";
    }
}
