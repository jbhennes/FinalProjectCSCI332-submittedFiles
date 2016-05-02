<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['productId'])) {
        $id = $_REQUEST['productId'];
    }
     
    if ( null==$id ) {
        header("Location: indexproducts.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM Products where productId = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
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
                        <h3>Read an Order</h3>
                    </div>
                    
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Product Id</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['productId'];?>
                            </label>
                        </div>
                      </div> 
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Price</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['price'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Amount In Stock</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['amountInStock'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['description'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Repair ID</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Repairs_repairId'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="indexproducts.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>