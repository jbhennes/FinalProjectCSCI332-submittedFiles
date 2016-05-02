<?php
    require 'database.php';
    $orderId = 0;
     
    if ( !empty($_GET['orderId'])) {
        $orderId = $_REQUEST['orderId'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $orderId = $_POST['orderId'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM Orders WHERE orderId = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($orderId));
        Database::disconnect();
        header("Location: indexorders.php");
         
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
                        <h3>Delete an Order</h3>
                    </div>
                     
                    <form class="form-horizontal" action="deleteorders.php" method="post">
                      <input type="hidden" name="orderId" value="<?php echo $orderId;?>"/>
                      <p class="alert alert-error">Are you sure to delete Order <?php echo $orderId;?> ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="indexorders.php">No</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>