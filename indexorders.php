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
                <h2>Orders</h2>
            </div>
            <div class="row">

                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Order ID</th>
                          <th>Patron ID</th>
                          <th>Order Date</th>
                          <th>Total</th>
                          <th>Price Type</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM Orders ORDER BY orderId';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['orderId'] . '</td>';
                                echo '<td>'. $row['patronId'] . '</td>';
                                echo '<td>'. $row['orderDate'] . '</td>';
                                echo '<td>$'. $row['total'] . '</td>';
                                echo '<td>'. $row['priceTypeId'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn" href="readorders.php?orderId='.$row['orderId'].'">View</a>';
                                echo ' ';
                                echo '<a class="btn btn-info" href="editorders.php?orderId='.$row['orderId'].'">Edit</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="deleteorders.php?orderId='.$row['orderId'].'">Delete</a>';
                                echo '</td>';
                       }
                       Database::disconnect();
                      ?>
                      </tbody>
                </table>
                <p>
                    <a href="createorders.php" class="btn btn-success">Create Order</a>
                </p>
        </div>
    </div> <!-- /container -->
  </body>
</html>