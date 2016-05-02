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
                <h2>Repairs</h2>
            </div>
            <div class="row">
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Repair ID</th>
                          <th>Technician ID</th>
                          <th>Date Received</th>
                          <th>Return Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM Repairs ORDER BY repairId';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['repairId'] . '</td>';
                                echo '<td>'. $row['technicianId'] . '</td>';
                                echo '<td>'. $row['dateRecd'] . '</td>';
                                echo '<td>'. $row['dateToReturn'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn" href="readrepairs.php?repairId='.$row['repairId'].'">View</a>';
                                echo ' ';
                                echo '<a class="btn btn-info" href="editrepairs.php?repairId='.$row['repairId'].'">Edit</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="deleterepairs.php?repairId='.$row['repairId'].'">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                       }
                       Database::disconnect();
                      ?>
                      </tbody>
                </table>
                <p>
                    <a href="createrepairs.php" class="btn btn-success">Create Repair</a>
                </p>
        </div>
    </div> <!-- /container -->
  </body>
</html>