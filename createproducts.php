<?php
     
    require 'database.php';
 
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
            $desriptionError = 'Please enter a product name';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Products (price,amountInStock,description) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($price,$amountInStock,$description,));
            Database::disconnect();
            header("Location: indexproducts.php");
        }
    }
?>
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
                        <h3>Create Product</h3>
                    </div>
             
                    <form class="form-horizontal" action="createproducts.php" method="post">
                      <div class="control-group <?php echo !empty($priceError)?'error':'';?>">
                        <label class="control-label">Price</label>
                        <div class="controls">
                            <input name="price" type="text"  placeholder="00.00" value="<?php echo !empty($price)?$price:'';?>">
                            <?php if (!empty($priceError)): ?>
                                <span class="help-inline"><?php echo $priceError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($amountInStockError)?'error':'';?>">
                        <label class="control-label">Amount In Stock</label>
                        <div class="controls">
                            <input name="amountInStock" type="text" placeholder="enter amount" value="<?php echo !empty($amountInStock)?$amountInStock:'';?>">
                            <?php if (!empty($amountInStockError)): ?>
                                <span class="help-inline"><?php echo $amountInStockError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($descriptionError)?'error':'';?>">
                        <label class="control-label">Product Name</label>
                        <div class="controls">
                            <input name="description" type="text"  placeholder="enter name" value="<?php echo !empty($description)?$description:'';?>">
                            <?php if (!empty($descriptionError)): ?>
                                <span class="help-inline"><?php echo $descriptionError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create Product</button>
                          <a class="btn" href="indexproducts.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>