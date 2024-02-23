<?php

// Manager Class
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// Query Class (removed the query condition)
$query = new MongoDB\Driver\Query([]);

// Output of the executeQuery will be object of MongoDB\Driver\Cursor class
$cursor = $manager->executeQuery('NIBM.customers', $query); // Assuming 'NIBM' is the database and 'customers' is the collection

// Convert cursor to Array
$documents = $cursor->toArray();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    
    // Create new document object
    $document = new stdClass();
    $document->name = $name;
    $document->email = $email;
    $document->age = $age;
    
    // Insert document into MongoDB collection
    $bulkWrite = new MongoDB\Driver\BulkWrite();
    $bulkWrite->insert($document);
    $manager->executeBulkWrite('NIBM.customers', $bulkWrite);
    
    // Redirect to the same page to refresh the records
    header("Location: {$_SERVER['PHP_SELF']}");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Records</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Customer Records</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($documents as $document): ?>
            <tr>
                <td><?php echo $document->_id->__toString(); ?></td>
                <td><?php echo $document->name; ?></td>
                <td><?php echo $document->email; ?></td>
                <td><?php echo $document->age; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h2>Add New Customer</h2>

<form method="post">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br>
    <label for="age">Age:</label><br>
    <input type="number" id="age" name="age" required><br><br>
    <input type="submit" value="Submit">
</form>

</body>
</html>
