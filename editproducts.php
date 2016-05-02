<?php
    require 'database.php';
 
    $productId = null;
    if ( !empty($_GET['productId'])) {
        $productId = $_REQUEST['productId'];
    }
     
    if ( $productId == null ) {
        header("Location: indexproducts.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $priceError = null;
        $amountInStockError = null;
        $descriptionError = null;

         
        // keep track post values
        $price = $_POST['price'];
        $amountInStock = $_POST['amountInStock'];
        $description = $_POST['description'];

        // validate input
        $valid = true;
         
        if (empty($price)) {
            $priceError = 'Please enter valid price';
            $valid = false;
        }
         
        if (empty($amountInStock)) {
            $amountInStockError = 'Please enter a valid amount';
            $valid = false;
        }
        if (empty($description)) {
            $descriptionError = 'Please enter a product name';
            $valid = false;
        }
         
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE Products set price = ?, amountInStock = ?, description =? WHERE productId = ?";
            $query = $pdo->prepare($sql);
            $query->execute(array($price,$amountInStock,$description,$productId));
            Database::disconnect();
            header("Location: indexproducts.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM Products where productId = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($productId));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $price = $data['price'];
        $amountInStock = $data['amountInStock'];
        $description = $data['description'];
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
                        <h3>Edit Product</h3>
                    </div>
             
                    <form class="form-horizontal" action="editproducts.php?productId=<?php echo $productId?>" method="post">
                    <input type="hidden" name="productId" value="<?php echo $productId;?>"/>
                      <div class="control-group <?php echo !empty($priceError)?'error':'';?>">
                        <label class="control-label">Price</label>
                        <div class="controls">
                            <input name="price" type="text"  placeholder="0.00" value="<?php echo !empty($price)?$price:'';?>">
                            <?php if (!empty($priceError)): ?>
                                <span class="help-inline"><?php echo $priceError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($amountInStockError)?'error':'';?>">
                        <label class="control-label">Amount In Stock</label>
                        <div class="controls">
                            <input name="amountInStock" type="text"  placeholder="enter amount in stock..." value="<?php echo !empty($amountInStock)?$amountInStock:'';?>">
                            <?php if (!empty($amountInStockError)): ?>
                                <span class="help-inline"><?php echo $amountInStockError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($descriptionError)?'error':'';?>">
                        <label class="control-label">Description</label>
                        <div class="controls">
                            <input name="description" type="text" placeholder="enter description" value="<?php echo !empty($description)?$description:'';?>">
                            <?php if (!empty($descriptionError)): ?>
                                <span class="help-inline"><?php echo $descriptionError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="indexproducts.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>    