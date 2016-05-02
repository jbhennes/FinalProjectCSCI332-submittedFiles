<?php
    require 'database.php';
    $patronId = 0;
    $patronName = "";
     
    if ( !empty($_GET['patronId'])) {
        $patronId = $_REQUEST['patronId'];
    }
     
    if ( !empty($_GET['patronName'])) {
        // keep track post values
        $patronName = $_REQUEST['patronName'];
        }

?>

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
                <h2>Patron Order History</h2> 
                <h4>ID: <?php echo $patronId;?></h4>
                <h4>Name: <?php echo $patronName;?></h4>
            </div>
            <div class="row">
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Order ID</th>
                          <th>Order Date</th>
                          <th>Total</th>
                          <th>Price Type</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       $sum;
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM patronOrderHistory WHERE patronId = ' . $_GET['patronId'];
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['orderId'] . '</td>';
                                echo '<td>'. $row['orderDate'] . '</td>';
                                echo '<td>$'. $row['total'] . '</td>';
                                $sum = $sum + $row['total'];
                                echo '<td>'. $row['priceTypeId'] . '</td>';
                                echo '</td>';
                                echo '</tr>';
                       }
                       Database::disconnect();
                      ?>
                      </tbody>
                </table>
                </div>
                <div class="row">
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Total Amount Spent</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      echo '<tr>';
                      echo '<td>$' . $sum . '</td>';
                      echo '</td>';                      
                      ?>
                      </tbody>
                </table>
                </div>
                <p>
                    <a href="indexpatron.php" class="btn">Back</a>
                </p>
    </div> <!-- /container -->
  </body>
</html>