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
                <h2>Lessons</h2>
            </div>
            <div class="row">
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Lesson ID</th>
                          <th>Patron ID</th>
                          <th>Instructor ID</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM Lessons ORDER BY lessonId';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['lessonId'] . '</td>';
                                echo '<td>'. $row['patronId'] . '</td>';
                                echo '<td>'. $row['instructorId'] . '</td>';
                                echo '<td>'. $row['date'] . '</td>';
                                echo '<td>'. $row['time'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn" href="readlessons.php?lessonId='.$row['lessonId'].'">View</a>';
                                echo ' ';
                                echo '<a class="btn btn-info" href="editlessons.php?lessonId='.$row['lessonId'].'">Edit</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="deletelessons.php?lessonId='.$row['lessonId'].'">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                       }
                       Database::disconnect();
                      ?>
                      </tbody>
                </table>
                <p>
                    <a href="createlessons.php" class="btn btn-success">Create Lesson</a>
                </p>
        </div>
    </div> <!-- /container -->
  </body>
</html>