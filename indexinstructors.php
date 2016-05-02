<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
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
                <h2>Instructors</h2>
            </div>
            <div class="row">
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Instructor ID</th>
                          <th>Instructor Name</th>
                          <th>Instructor Address</th>
                          <th>Instructor  Email</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM Instructors ORDER BY instructorId';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['instructorId'] . '</td>';
                                echo '<td>'. $row['instructorName'] . '</td>';
                                echo '<td>'. $row['instructorAddress'] . '</td>';
                                echo '<td>'. $row['instructorEmail'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn" href="readinstructors.php?instructorId='.$row['instructorId'].'">View</a>';
                                echo ' ';
                                echo '<a class="btn btn-info" href="editinstructors.php?instructorId='.$row['instructorId'].'">Edit</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="deleteinstructors.php?instructorId='.$row['instructorId'].'">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                       }
                       Database::disconnect();
                      ?>
                      </tbody>
                </table>
                <p>
                    <a href="createinstructors.php" class="btn btn-success">Create Instructor</a>
                </p>
        </div>
    </div> <!-- /container -->
  </body>
</html>