<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $patronIdError = null;
        $orderDateError = null;
        $totalError = null;
        $priceTypeError = null;
         
        // keep track post values
        $patronId = $_POST['patronId'];
        $orderDate = $_POST['orderDate'];
        $total = $_POST['total'];
        $priceType = $_POST['priceTypeId'];
         
        // validate input
        $valid = true;
         
        if (empty($patronId)) {
            $patronIdError = 'Please enter patron id';
            $valid = false;
        }
         
        if (empty($orderDate)) {
            $orderDateError = 'Please enter date';
            $valid = false;
        }
        if (empty($total)) {
            $totalError = 'Please enter total';
            $valid = false;
        }
        if (empty($priceType)) {
            $priceTypeError = 'Please enter price Type';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Orders (patronId,orderDate,total,priceTypeId) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($patronId,$orderDate,$total,$priceType));
            Database::disconnect();
            header("Location: indexorders.php");
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
                        <h3>Create an Order</h3>
                    </div>
             
                    <form class="form-horizontal" action="createorders.php" method="post">
                      <div class="control-group <?php echo !empty($patronIdError)?'error':'';?>">
                        <label class="control-label">Patron ID</label>
                        <div class="controls">
                            <input name="patronId" type="text"  placeholder="PatronId" value="<?php echo !empty($patronId)?$patronId:'';?>">
                            <?php if (!empty($patronIdError)): ?>
                                <span class="help-inline"><?php echo $patronIdError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($orderDateError)?'error':'';?>">
                        <label class="control-label">Order Date</label>
                        <div class="controls">
                            <input name="orderDate" type="date" max="2016-12-31" min="2000-01-01" value="<?php echo !empty($orderDate)?$orderDate:'';?>">
                            <?php if (!empty($orderDateError)): ?>
                                <span class="help-inline"><?php echo $orderDateError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($totalError)?'error':'';?>">
                        <label class="control-label">Total</label>
                        <div class="controls">
                            <input name="total" type="text"  placeholder="0.00" value="<?php echo !empty($total)?$total:'';?>">
                            <?php if (!empty($totalError)): ?>
                                <span class="help-inline"><?php echo $totalError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($priceTypeError)?'error':'';?>">
                        <label class="control-label">Price Type</label>
                        <div class="controls">
                            <input name="priceTypeId" type="radio" checked="true" value="Repair"> &mdash; <strong>Repair</strong></br>
                            <input name="priceTypeId" type="radio" value="Lesson"> &mdash; <strong>Lesson</strong></br>
                            <input name="priceTypeId" type="radio" value="Product"> &mdash; <strong>Product</strong></br>
                            <?php if (!empty($priceTypeError)): ?>
                                <span class="help-inline"><?php echo $priceTypeError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create Order</button>
                          <a class="btn" href="indexorders.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>