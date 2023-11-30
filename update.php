<?php
include 'db.php'; // Include your database connection

if(isset($_POST['submit'])) {
    // Assuming you have sanitized the input data for security

    $id = $_GET['id']; // Retrieve the 'id' from the URL parameter

    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // Update query with prepared statement
    $sql = "UPDATE data_table SET name=?, contact=?, email=?, address=? WHERE id=?";
    // echo $sql; 
    // Prepare the update statement
$stmt = $conn->prepare("UPDATE data_table SET name=?, contact=?, email=?, address=? WHERE id=?");

if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Bind parameters to the prepared statement
$stmt->bind_param("ssssi", $name, $contact, $email, $address, $id);

// Execute the statement
if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        // echo "Record updated successfully";
        header("location: index.php");
    } else {
        echo "No rows were updated";
    }
} else {
    echo "Error updating record: " . $stmt->error;
}

// Close the statement
$stmt->close();
}

// Retrieve existing data for the specific ID to populate the form fields for editing
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM data_table WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
   
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Retrieve values from the fetched row
        $name = $row['name'];
        $contact = $row['contact'];
        $email = $row['email'];
        $address = $row['address'];

        // Display form to edit data
        // Create your HTML form with input fields pre-filled with retrieved values
        // Use the retrieved values in the value attribute of input fields
?>
        <!-- HTML form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Update Employee Data</title>
</head>
<body>
<div class="container mt-4">
        <form action="" method="post">
      <div class="form-group">
        <h2>Update Employee Data</h2>
        <label for="name">Name:</label><span class="text-danger">*</span>
        <input type="text" class="form-control" id="name" value="<?php echo $name; ?>" name="name" placeholder="Enter your name" autoComplete="off">
        <span class="text-danger mt-1">
            <?php
                if(isset($error['name'])){
                    echo $error['name'];
                }
            ?>
        </span>
      </div>
      <div class="form-group">
        <label for="contact">Contact:</label><span class="text-danger">*</span>
        <input type="tel" class="form-control" id="contact" value="<?php echo $contact; ?>" name="contact" placeholder="Enter contact number" autoComplete="off">
        <span class="text-danger mt-1">
            <?php
                if(isset($error['contact'])){
                    echo $error['contact'];
                }
            ?>
        </span>
      </div>
      <div class="form-group">
        <label for="email">Email:</label><span class="text-danger">*</span>
        <input type="email" class="form-control" id="email" value="<?Php echo $email; ?>" name="email" placeholder="Enter email" autoComplete="off">
        <span class="text-danger mt-1">
            <?php
                if(isset($error['email'])){
                    echo $error['email'];
                }
            ?>
        </span>
      </div>
      <div class="form-group">
        <label for="address">Address:</label><span class="text-danger">*</span>
        <input class="form-control" id="address" value="<?php echo $address; ?>" placeholder="Enter address" name="address" rows="3" autoComplete="off">
        <span class="text-danger mt-1">
            <?php
                if(isset($error['address'])){
                    echo $error['address'];
                }
            ?>
        </span>
      </div>
      <input type="submit" class="btn btn-primary mt-3" name="submit" value="Submit Querry">
    </form>
        
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
<?php
    } else {
        echo "No records found";
    }
    $stmt->close();
}
?>
