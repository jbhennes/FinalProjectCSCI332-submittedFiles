<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
       </br>
       <div class="row">
   <nav>
  	<a class="btn btn-primary" href="indexpatron.php">Patrons</a>
  	<a class="btn btn-primary" href="indexorders.php">Orders</a>
  	<a class="btn btn-primary" href="indexlessons.php">Lessons</a>
  	<a class="btn btn-primary" href="indexproducts.php">Products</a>
  	<a class="btn btn-primary" href="indexrepairs.php">Repairs</a>
  	<a class="btn btn-primary" href="indexinstructors.php">Instructors</a>
  	<a class="btn btn-primary" href="indextechnicians.php">Technicians</a>
  </nav>
  </br>
  </div>
            <div class="row">
                <h2>Technicians</h2>
            </div>
            <div class="row">
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Technician ID</th>
                          <th>Technician Name</th>
                          <th>Technician Address</th>
                          <th>Technician Phone</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM Technicians ORDER BY technicianId';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td><a href="technicianrepairhistory.php?technicianId='.$row['technicianId'].'&technicianName='.$row['technicianName'].'">'. $row['technicianId'] . '</a></td>';
                                echo '<td>'. $row['technicianName'] . '</td>';
                                echo '<td>'. $row['technicianAddress'] . '</td>';
                                echo '<td>'. $row['technicianPhone'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn" href="readtechnicians.php?technicianId='.$row['technicianId'].'">View</a>';
                                echo ' ';
                                echo '<a class="btn btn-info" href="edittechnicians.php?technicianId='.$row['technicianId'].'">Edit</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="deletetechnicians.php?technicianId='.$row['technicianId'].'">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                       }
                       Database::disconnect();
                      ?>
                      </tbody>
                </table>
                <p>
                    <a href="createtechnicians.php" class="btn btn-success">Create Technician</a>
                </p>
        </div>
    </div> <!-- /container -->
  </body>
</html>