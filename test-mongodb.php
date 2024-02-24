<?php
// Create a new MongoDB client
$mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// List all databases
$databases = $mongo->executeCommand("admin", new MongoDB\Driver\Command(["listDatabases" => 1]));
foreach ($databases as $database) {
    var_dump($database);
}
?>