<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $technicianIdError = null;
        $dateRecdError = null;
        $dateToReturnError = null;

         
        // keep track post values
        $technicianId = $_POST['technicianId'];
        $dateRecd = $_POST['dateRecd'];
        $dateToReturn = $_POST['dateToReturn'];
         
        // validate input
        $valid = true;
         
        if (empty($technicianId)) {
            $technicianIdError = 'Please enter technician ID';
            $valid = false;
        }
         
        if (empty($dateRecd)) {
            $dateRecdError = 'Please enter a valid date YYYY-MM-DD';
            $valid = false;
        }
        if (empty($dateToReturn)) {
            $dateToReturnError = 'Please enter a valid date YYYY-MM-DD';
            $valid = false;
        }

         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Repairs (technicianId,dateRecd,dateToReturn) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($technicianId,$dateRecd,$dateToReturn));
            Database::disconnect();
            header("Location: indexrepairs.php");
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
                        <h3>Create Repair</h3>
                    </div>
             
                    <form class="form-horizontal" action="createrepairs.php" method="post">
                      <div class="control-group <?php echo !empty($technicianIdError)?'error':'';?>">
                        <label class="control-label">Technician ID</label>
                        <div class="controls">
                            <input name="technicianId" type="text"  placeholder="technician id" value="<?php echo !empty($technicianId)?$technicianId:'';?>">
                            <?php if (!empty($technicianIdError)): ?>
                                <span class="help-inline"><?php echo $technicianIdError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($dateRecdError)?'error':'';?>">
                        <label class="control-label">Date Received</label>
                        <div class="controls">
                            <input name="dateRecd" type="text" placeholder="YYYY-MM-DD" value="<?php echo !empty($dateRecd)?$dateRecd:'';?>">
                            <?php if (!empty($dateRecdError)): ?>
                                <span class="help-inline"><?php echo $dateRecdError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($dateToReturnError)?'error':'';?>">
                        <label class="control-label">Date To Return</label>
                        <div class="controls">
                            <input name="dateToReturn" type="text"  placeholder="YYYY-MM-DD" value="<?php echo !empty($dateToReturn)?$dateToReturn:'';?>">
                            <?php if (!empty($dateToReturnError)): ?>
                                <span class="help-inline"><?php echo $dateToReturnError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create Repair</button>
                          <a class="btn" href="indexrepairs.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>