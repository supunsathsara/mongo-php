# Setting up MongoDB with PHP

This guide will walk you through the process of setting up MongoDB with PHP on a WAMP server environment.

## Step 1: Download MongoDB PHP Driver

1. Visit the [MongoDB PHP Driver releases page](https://github.com/mongodb/mongo-php-driver/releases/).
2. Download the appropriate version of the MongoDB PHP Driver that matches your PHP version and architecture.
3. Make sure to download the correct version that matches your PHP version (e.g., PHP 7.4, PHP 8.0) and architecture (e.g., x86, x64).
4. Extract the downloaded files to a location on your computer.

## Step 2: Install MongoDB PHP Driver

1. Navigate to your WAMP server installation directory.
2. Locate the PHP extensions directory inside `bin -> php -> php<version>` (usually named `ext`).
3. Copy the downloaded MongoDB PHP driver files (`.dll` files on Windows) into the PHP extensions directory.
4. Click on the WAMP server icon in the system tray and select "PHP" -> "php.ini" to open the `php.ini` file.
5. Add the following line to the `php.ini` file to enable the MongoDB PHP extension:
```
extension=mongodb
```
6. Save the `php.ini` file and restart your WAMP server.

## Step 3: Verify MongoDB PHP Driver Installation

1. Click on the WAMP server icon in the system tray and select "PHP" -> "pShow PHP Loaded Extensions" to open the PHP extensions list.
2. Look for the `mongodb` extension in the list to verify that the MongoDB PHP driver has been successfully installed.

## Step 4: Test MongoDB PHP Driver

1. Create a new PHP file in your WAMP server's `www` directory (e.g., `test-mongodb.php`).
2. Add the following code to the PHP file to test the MongoDB PHP driver:
```php
<?php
// Create a new MongoDB client
$mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// List all databases
$databases = $mongo->executeCommand("admin", new MongoDB\Driver\Command(["listDatabases" => 1]));
foreach ($databases as $database) {
    var_dump($database);
}
?>
```

3. Open the PHP file in your web browser (e.g., `http://localhost/test-mongodb.php`) to test the MongoDB PHP driver.

If you see a list of databases printed on the screen, the MongoDB PHP driver has been successfully installed and configured with your WAMP server environment.

## Conclusion

By following these steps, you should now have MongoDB set up and running with PHP on your WAMP server environment. You can now start developing PHP applications that interact with MongoDB databases.