<?php
    require 'database.php';
 
    $instructorId = null;
    if ( !empty($_GET['instructorId'])) {
        $instructorId = $_REQUEST['instructorId'];
    }
     
    if ( $instructorId == null ) {
        header("Location: indexinstructors.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $addressError = null;
        $emailError = null;
         
        // keep track post values
        $name = $_POST['instructorName'];
        $address = $_POST['instructorAddress'];
        $email = $_POST['instructorEmail'];
        $instructorId = $_POST['instructorId'];
        
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
            $sql = "UPDATE Instructors set instructorName = ?, instructorAddress = ?, instructorEmail =? WHERE instructorId = ?";
            $query = $pdo->prepare($sql);
            $query->execute(array($name,$address,$email,$instructorId));
            Database::disconnect();
            header("Location: indexinstructors.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM Instructors where instructorId = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($instructorId));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name = $data['instructorName'];
        $address = $data['instructorAddress'];
        $email = $data['instructorEmail'];
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
             
                    <form class="form-horizontal" action="editinstructors.php?instructorId=<?php echo $instructorId?>" method="post">
                    <input type="hidden" name="instructorId" value="<?php echo $instructorId;?>"/>
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="instructorName" type="text"  placeholder="New Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($addressError)?'error':'';?>">
                        <label class="control-label">Address</label>
                        <div class="controls">
                            <input name="instructorAddress" type="text" placeholder="New Address" value="<?php echo !empty($address)?$address:'';?>">
                            <?php if (!empty($addressError)): ?>
                                <span class="help-inline"><?php echo $addressError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input name="instructorEmail" type="text"  placeholder="New Email" value="<?php echo !empty($email)?$email:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="indexinstructors.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>    