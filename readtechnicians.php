<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['technicianId'])) {
        $id = $_REQUEST['technicianId'];
    }
     
    if ( null==$id ) {
        header("Location: indextechnicians.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM Technicians where technicianId = ?";
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
                        <h3>Read a Customer</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Technician Id</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['technicianId'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Technician Name</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['technicianName'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Technician Address</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['technicianAddress'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Technician Phone</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['technicianPhone'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="indextechnicians.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>