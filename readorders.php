<?php
    require 'database.php';
    $orderId = null;
    if ( !empty($_GET['orderId'])) {
        $orderId = $_REQUEST['orderId'];
    }
     
    if ( null==$orderId ) {
        header("Location: indexorders.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM Patron p INNER JOIN (SELECT * FROM Orders where orderId = ?) q ON p.patronId = q.patronId";
        $q = $pdo->prepare($sql);
        $q->execute(array($orderId));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>View Order</h3>
                    </div>
                    
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Order Id</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['orderId'];?>
                            </label>
                        </div>
                      </div> 
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Patron Id</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['patronId'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Patron Name</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['patronName'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Order Date</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['orderDate'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Total</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['total'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Price Type</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['priceTypeId'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="indexorders.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>