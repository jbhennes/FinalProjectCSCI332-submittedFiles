<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['repairId'])) {
        $id = $_REQUEST['repairId'];
    }
     
    if ( null==$id ) {
        header("Location: indexrepairs.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM Repairs where repairId = ?";
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
                        <label class="control-label">Repair Id</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['repairId'];?>
                            </label>
                        </div>
                      </div> 
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Technician ID</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['technicianId'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Date Received</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['dateRecd'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Date To Return</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['dateToReturn'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Total Price</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['totalPrice'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="indexrepairs.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>