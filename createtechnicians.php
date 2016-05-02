<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $addressError = null;
        $phoneError = null;
         
        // keep track post values
        $name = $_POST['technicianName'];
        $address = $_POST['technicianAddress'];
        $phone = $_POST['technicianPhone'];
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
         
        if (empty($phone)) {
            $emailError = 'Please enter 9 digit Phone number';
            $valid = false;
        }
         
        if (empty($address)) {
            $mobileError = 'Please enter Address';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Technicians (technicianName,technicianAddress,technicianPhone) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$address,$phone));
            Database::disconnect();
            header("Location: indextechnicians.php");
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
                        <h3>Create a Technician</h3>
                    </div>
             
                    <form class="form-horizontal" action="createtechnicians.php" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="technicianName" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($addressError)?'error':'';?>">
                        <label class="control-label">Address</label>
                        <div class="controls">
                            <input name="technicianAddress" type="text" placeholder="Address" value="<?php echo !empty($address)?$address:'';?>">
                            <?php if (!empty($addressError)): ?>
                                <span class="help-inline"><?php echo $addressError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($phoneError)?'error':'';?>">
                        <label class="control-label">Phone</label>
                        <div class="controls">
                            <input name="technicianPhone" type="text"  placeholder="123456789" value="<?php echo !empty($phone)?$phone:'';?>">
                            <?php if (!empty($phoneError)): ?>
                                <span class="help-inline"><?php echo $phoneError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create Technician</button>
                          <a class="btn" href="indextechnicians.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>