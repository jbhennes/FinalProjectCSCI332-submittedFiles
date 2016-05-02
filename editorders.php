<?php
    require 'database.php';
 
    $orderId = null;
    if ( !empty($_GET['orderId'])) {
        $orderId = $_REQUEST['orderId'];
    }
     
    if ( $orderId == null ) {
        header("Location: indexorders.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $patronIdError = null;
        $orderDateError = null;
        $totalError = null;
        $priceTypeIdError = null;
         
        // keep track post values
        $orderId = $_POST['orderId'];
        $patronId = $_POST['patronId'];
        $orderDate = $_POST['orderDate'];
        $total = $_POST['total'];
        $priceTypeId = $_POST['priceTypeId'];
        
        // validate input
        $valid = true;
        if (empty($patronId)) {
            $patronIdError = 'Please enter Patron Id';
            $valid = false;
        }
        
        $valid = true;
        if (empty($orderDate)) {
            $instructorIdError = 'Please enter date';
            $valid = false;
        }
         
        if (empty($total)) {
            $totalError = 'Please enter total';
            $valid = false;
        }
         
        if (empty($priceTypeId)) {
            $priceTypeIdError = 'Please enter Price Type';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE Orders set patronId = ?, orderDate = ?, total =?, priceTypeId = ? WHERE orderId = ?";
            $query = $pdo->prepare($sql);
            $query->execute(array($patronId,$orderDate,$total,$priceTypeId,$orderId));
            Database::disconnect();
            header("Location: indexorders.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM Orders where orderId = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($orderId));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $patronId = $data['patronId'];
        $orderDate = $data['orderDate'];
        $total = $data['total'];
        $priceTypeId = $data['priceTypeId'];
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
                        <h3>Update Order</h3>
                    </div>
             
                    <form class="form-horizontal" action="editorders.php?orderId=<?php echo $orderId?>" method="post">
                    <input type="hidden" name="orderId" value="<?php echo $orderId;?>"/>
                      <div class="control-group <?php echo !empty($patronIdError)?'error':'';?>">
                        <label class="control-label">Patron ID</label>
                        <div class="controls">
                            <input name="patronId" type="text"  placeholder="Patron ID" value="<?php echo !empty($patronId)?$patronId:'';?>">
                            <?php if (!empty($patronIdError)): ?>
                                <span class="help-inline"><?php echo $patronIdError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($orderDateError)?'error':'';?>">
                        <label class="control-label">Order Date</label>
                        <div class="controls">
                            <input name="orderDate" type="date"  placeholder="YYYY-MM-DD" value="<?php echo !empty($orderDate)?$orderDate:'';?>">
                            <?php if (!empty($orderDateError)): ?>
                                <span class="help-inline"><?php echo $orderDateError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($totalError)?'error':'';?>">
                        <label class="control-label">Date</label>
                        <div class="controls">
                            <input name="total" type="text" placeholder="0.00" value="<?php echo !empty($total)?$total:'';?>">
                            <?php if (!empty($totalError)): ?>
                                <span class="help-inline"><?php echo $totalError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($timeError)?'error':'';?>">
                        <label class="control-label">Price Type</label>
                        <div class="controls">
                            <input name="priceTypeId" type="radio" checked="true" value="Repair"> &mdash; <strong>Repair</strong></br>
                            <input name="priceTypeId" type="radio" value="Lesson"> &mdash; <strong>Lesson</strong></br>
                            <input name="priceTypeId" type="radio" value="Product"> &mdash; <strong>Product</strong></br>
                            <?php if (!empty($priceTypeIdError)): ?>
                                <span class="help-inline"><?php echo $priceTypeIdError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="indexorders.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>    