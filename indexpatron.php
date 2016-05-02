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
                <h2>Patrons</h2>
            </div>
            <div class="row">
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Patron ID</th>
                          <th>Patron Name</th>
                          <th>Patron Address</th>
                          <th>Patron  Email</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM Patron ORDER BY patronId DESC';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td><a href="patronorderhistory.php?patronId='.$row['patronId'].'&patronName='.$row['patronName'].'">'. $row['patronId'] . '</a></td>';
                                echo '<td>'. $row['patronName'] . '</td>';
                                echo '<td>'. $row['patronAddress'] . '</td>';
                                echo '<td>'. $row['patronEmail'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn" href="readpatron.php?patronId='.$row['patronId'].'">View</a>';
                                echo ' ';
                                echo '<a class="btn btn-info" href="editpatron.php?patronId='.$row['patronId'].'">Edit</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="deletepatron.php?patronId='.$row['patronId'].'">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                       }
                       Database::disconnect();
                      ?>
                      </tbody>
                </table>
                <p>
                    <a href="createpatron.php" class="btn btn-success">Create Patron</a>
                </p>
        </div>
    </div> <!-- /container -->
  </body>
</html>