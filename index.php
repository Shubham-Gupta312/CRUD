<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>CRUD Operations</title>
</head>
<body>
    <div class="m-4">
    <h3 class="m-4">EMPLOYEE DATA</h3>
    <a  href="create.php">
      <button type="button" class="btn btn-primary m-4">Add Data</button></a>
<br>
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">S.no</th>
      <th scope="col">Name</th>
      <th scope="col">Contact No.</th>
      <th scope="col">Email-ID</th>
      <th scope="col">Address</th>
      <th scope="col">Created At</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
include 'db.php';
        // READING ROWS FROM DATABSE TABLE
        $sql = "SELECT * FROM data_table";
        $result = $conn->query($sql);

        if(!$result){
            die("INVALID QUERRY: " . $conn->error);
        }
        else{
            while($row = $result->fetch_assoc()){
              $id = $row['id'];
                echo "
                <tr>
                    <th scope='row'>$id</th>
                    <td>{$row['name']}</td>
                    <td>{$row['contact']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['address']}</td>
                    <td>{$row['created_at']}</td>
                    <td>
                    <td>
                    <a href='update.php?id=$id><button type='button' class='btn btn-primary'>Update</button></a>
                    <a  href='delete.php?id=$id'><button type='button' class='btn btn-danger'>Delete</button></a>
                    </td>
              </tr>";
            }
        }

    ?>    
  </tbody>
</table>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>