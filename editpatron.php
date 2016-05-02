<?php
    require 'database.php';
 
    $patronId = null;
    if ( !empty($_GET['patronId'])) {
        $patronId = $_REQUEST['patronId'];
    }
     
    if ( $patronId == null ) {
        header("Location: indexpatron.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $addressError = null;
        $emailError = null;
         
        // keep track post values
        $name = $_POST['patronName'];
        $address = $_POST['patronAddress'];
        $email = $_POST['patronEmail'];
        $patronId = $_POST['patronId'];
        
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
         
        if (empty($email)) {
            $emailError = 'Please enter Email';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE Patron set patronName = ?, patronAddress = ?, patronEmail =? WHERE patronId = ?";
            $query = $pdo->prepare($sql);
            $query->execute(array($name,$address,$email,$patronId));
            Database::disconnect();
            header("Location: indexpatron.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM Patron where patronId = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($patronId));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name = $data['patronName'];
        $address = $data['patronAddress'];
        $email = $data['patronEmail'];
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
             
                    <form class="form-horizontal" action="editpatron.php?patronId=<?php echo $patronId?>" method="post">
                    <input type="hidden" name="patronId" value="<?php echo $patronId;?>"/>
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="patronName" type="text"  placeholder="New Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($addressError)?'error':'';?>">
                        <label class="control-label">Address</label>
                        <div class="controls">
                            <input name="patronAddress" type="text" placeholder="New Address" value="<?php echo !empty($address)?$address:'';?>">
                            <?php if (!empty($addressError)): ?>
                                <span class="help-inline"><?php echo $addressError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input name="patronEmail" type="text"  placeholder="New Email" value="<?php echo !empty($email)?$email:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="indexpatron.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>    