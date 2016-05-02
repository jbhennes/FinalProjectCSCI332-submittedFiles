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
                <h2>Products</h2>
            </div>
            <div class="row">
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Product ID</th>
                          <th>Price</th>
                          <th>Amount In Stock</th>
                          <th>Description</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM Products ORDER BY productId';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['productId'] . '</td>';
                                echo '<td>$'. $row['price'] . '</td>';
                                echo '<td>'. $row['amountInStock'] . '</td>';
                                echo '<td>'. $row['description'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn" href="readproducts.php?productId='.$row['productId'].'">View</a>';
                                echo ' ';
                                echo '<a class="btn btn-info" href="editproducts.php?productId='.$row['productId'].'">Edit</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="deleteproducts.php?productId='.$row['productId'].'">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                       }
                       Database::disconnect();
                      ?>
                      </tbody>
                </table>
                <p>
                    <a href="createproducts.php" class="btn btn-success">Create Product</a>
                </p>
        </div>
    </div> <!-- /container -->
  </body>
</html>