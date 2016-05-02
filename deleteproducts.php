<?php
    require 'database.php';
    $productId = 0;
     
    if ( !empty($_GET['productId'])) {
        $productId = $_REQUEST['productId'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $productId = $_POST['productId'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM Products WHERE productId = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($productId));
        Database::disconnect();
        header("Location: indexproducts.php");
         
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
                        <h3>Delete a Product</h3>
                    </div>
                     
                    <form class="form-horizontal" action="deleteproducts.php" method="post">
                      <input type="hidden" name="productId" value="<?php echo $productId;?>"/>
                      <p class="alert alert-error">Are you sure to delete Product <?php echo $productId;?> ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="indexproducts.php">No</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>