<?php
    require 'database.php';
 
    $technicianId = null;
    if ( !empty($_GET['technicianId'])) {
        $technicianId = $_REQUEST['technicianId'];
    }
     
    if ( $technicianId == null ) {
        header("Location: indextechnicians.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $addressError = null;
        $phoneError = null;
         
        // keep track post values
        $name = $_POST['technicianName'];
        $address = $_POST['technicianAddress'];
        $phone = $_POST['technicianPhone'];
        $technicianId = $_POST['technicianId'];
        
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
         
        if (empty($address)) {
            $addressError = 'Please enter Address';
            $valid = false;
        }
         
        if (empty($phone)) {
            $phoneError = 'Please enter phone number';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE Technicians set technicianName = ?, technicianAddress = ?, technicianPhone =? WHERE technicianId = ?";
            $query = $pdo->prepare($sql);
            $query->execute(array($name,$address,$phone,$technicianId));
            Database::disconnect();
            header("Location: indextechnicians.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM Technicians where technicianId = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($technicianId));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name = $data['technicianName'];
        $address = $data['technicianAddress'];
        $phone = $data['technicianPhone'];
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
                        <h3>Update a Customer</h3>
                    </div>
             
                    <form class="form-horizontal" action="edittechnicians.php?technicianId=<?php echo $technicianId?>" method="post">
                    <input type="hidden" name="technicianId" value="<?php echo $technicianId;?>"/>
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="technicianName" type="text"  placeholder="New Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($addressError)?'error':'';?>">
                        <label class="control-label">Address</label>
                        <div class="controls">
                            <input name="technicianAddress" type="text" placeholder="New Address" value="<?php echo !empty($address)?$address:'';?>">
                            <?php if (!empty($addressError)): ?>
                                <span class="help-inline"><?php echo $addressError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($phoneError)?'error':'';?>">
                        <label class="control-label">Phone</label>
                        <div class="controls">
                            <input name="technicianPhone" type="text"  placeholder="New Phone" value="<?php echo !empty($phone)?$phone:'';?>">
                            <?php if (!empty($phoneError)): ?>
                                <span class="help-inline"><?php echo $phoneError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="indextechnicians.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>    