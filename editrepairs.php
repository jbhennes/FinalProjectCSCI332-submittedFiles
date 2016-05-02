<?php
    require 'database.php';
 
    $repairId = null;
    if ( !empty($_GET['repairId'])) {
        $repairId = $_REQUEST['repairId'];
    }
     
    if ( $repairId == null ) {
        header("Location: indexrepairs.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $technicianIdError = null;
        $dateRecdError = null;
        $dateToReturnError = null;

         
        // keep track post values
        $repairId = $_POST['repairId'];
        $technicianId = $_POST['technicianId'];
        $dateRecd = $_POST['dateRecd'];
        $dateToReturn = $_POST['dateToReturn'];
        
        // validate input
        $valid = true;
        if (empty($technicianId)) {
            $technicianIdError = 'Please enter Technician Id';
            $valid = false;
        }
        
        $valid = true;
        if (empty($dateRecd)) {
            $dateRecdError = 'Please enter date';
            $valid = false;
        }
         
        if (empty($dateToReturn)) {
            $dateToReturnError = 'Please enter date';
            $valid = false;
        }
         
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE Repairs set technicianId = ?, dateRecd = ?, dateToReturn =? WHERE repairId = ?";
            $query = $pdo->prepare($sql);
            $query->execute(array($technicianId,$dateRecd,$dateToReturn,$repairId));
            Database::disconnect();
            header("Location: indexrepairs.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM Repairs where repairId = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($repairId));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $technicianId = $data['technicianId'];
        $dateRecd = $data['dateRecd'];
        $dateToReturn = $data['dateToReturn'];
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
                        <h3>Edit Repair</h3>
                    </div>
             
                    <form class="form-horizontal" action="editrepairs.php?repairId=<?php echo $repairId?>" method="post">
                    <input type="hidden" name="repairId" value="<?php echo $repairId;?>"/>
                      <div class="control-group <?php echo !empty($technicianIdError)?'error':'';?>">
                        <label class="control-label">Technician ID</label>
                        <div class="controls">
                            <input name="technicianId" type="text"  placeholder="Technician ID" value="<?php echo !empty($technicianId)?$technicianId:'';?>">
                            <?php if (!empty($technicianIdError)): ?>
                                <span class="help-inline"><?php echo $technicianIdError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($dateRecdError)?'error':'';?>">
                        <label class="control-label">Date Received</label>
                        <div class="controls">
                            <input name="dateRecd" type="date"  placeholder="YYYY-MM-DD" value="<?php echo !empty($dateRecd)?$dateRecd:'';?>">
                            <?php if (!empty($dateRecdError)): ?>
                                <span class="help-inline"><?php echo $dateRecdError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($dateToReturnError)?'error':'';?>">
                        <label class="control-label">Date To Return</label>
                        <div class="controls">
                            <input name="dateToReturn" type="text" placeholder="YYYY-MM-DD" value="<?php echo !empty($dateToReturn)?$dateToReturn:'';?>">
                            <?php if (!empty($dateToReturnError)): ?>
                                <span class="help-inline"><?php echo $dateToReturnError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="indexrepairs.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>    