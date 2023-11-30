<?php
include 'db.php';
    $name = $contact = $email = $address = null;
    if(isset($_POST['submit'])){
        if(empty($_POST['name'])){
            $error['name'] = "Please fill the Name";
        }
        else{
            $name = $_POST['name'];
        }
        if(empty($_POST['contact'])){
            $error['contact'] = "Please fill the Contact detail";
        }
        else{
            $contact = $_POST['contact'];
        }
        if(empty($_POST['email'])){
            $error['email'] = "Please fill the Email detail";
        }
        else{
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format <br>";
            }
            $email = $_POST['email'];
        }
        if(empty($_POST['address'])){
            $error['address'] = "Please fill the Address detail";
        }
        else{
            $address = $_POST['address'];
        }
    }
    if(empty($_POST['submit'])){
        $sql = "INSERT INTO data_table (name, contact, email, address) VALUES ('$name', '$contact', '$email', '$address')";
        $result = mysqli_query($conn ,$sql);
    
        if(!$result){
            $errorMessage = "Invalid Querry: " . $conn->error;
        }
  
        header("Location: index.php");
        exit;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Create Employee</title>
</head>
<body>
<div class="container mt-4">
    <form action="create.php" method="post">
      <div class="form-group">
        <h2>ADD New Data</h2>
        <label for="name">Name:</label><span class="text-danger">*</span>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" autoComplete="off">
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
        <input type="tel" class="form-control" id="contact" name="contact" placeholder="Enter contact number" autoComplete="off">
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
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" autoComplete="off">
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
        <textarea class="form-control" id="address" placeholder="Enter address" name="address" rows="3" autoComplete="off"></textarea>
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