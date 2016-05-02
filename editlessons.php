<?php
    require 'database.php';
 
    $lessonId = null;
    if ( !empty($_GET['lessonId'])) {
        $lessonId = $_REQUEST['lessonId'];
    }
     
    if ( $lessonId == null ) {
        header("Location: indexlessons.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $patronIdError = null;
        $instructorIdError = null;
        $dateError = null;
        $timeError = null;
         
        // keep track post values
        $patronId = $_POST['patronId'];
        $instructorId = $_POST['instructorId'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $lessonId = $_POST['lessonId'];
        
        // validate input
        $valid = true;
        if (empty($patronId)) {
            $patronIdError = 'Please enter Name';
            $valid = false;
        }
        
        $valid = true;
        if (empty($instructorId)) {
            $instructorIdError = 'Please enter Name';
            $valid = false;
        }
         
        if (empty($date)) {
            $dateError = 'Please enter Address';
            $valid = false;
        }
         
        if (empty($time)) {
            $timeError = 'Please enter Email';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE Lessons set patronId = ?, instructorId = ?, date =?, time = ? WHERE lessonId = ?";
            $query = $pdo->prepare($sql);
            $query->execute(array($patronId,$instructorId,$date,$time,$lessonId));
            Database::disconnect();
            header("Location: indexlessons.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM Lessons where lessonId = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($lessonId));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $patronId = $data['patronId'];
        $instructorId = $data['instructorId'];
        $date = $data['date'];
        $time = $data['time'];
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
                        <h3>Update Lesson</h3>
                    </div>
             
                    <form class="form-horizontal" action="editlessons.php?lessonId=<?php echo $lessonId?>" method="post">
                    <input type="hidden" name="lessonId" value="<?php echo $lessonId;?>"/>
                      <div class="control-group <?php echo !empty($patronIdError)?'error':'';?>">
                        <label class="control-label">Patron ID</label>
                        <div class="controls">
                            <input name="patronId" type="text"  placeholder="Patron ID" value="<?php echo !empty($patronId)?$patronId:'';?>">
                            <?php if (!empty($patronIdError)): ?>
                                <span class="help-inline"><?php echo $patronIdError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($instructorIdError)?'error':'';?>">
                        <label class="control-label">Inst ID</label>
                        <div class="controls">
                            <input name="instructorId" type="text"  placeholder="Instructor ID" value="<?php echo !empty($instructorId)?$instructorId:'';?>">
                            <?php if (!empty($instructorIdError)): ?>
                                <span class="help-inline"><?php echo $instructorIdError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($dateError)?'error':'';?>">
                        <label class="control-label">Date</label>
                        <div class="controls">
                            <input name="date" type="date" placeholder="YYYY-MM-DD" value="<?php echo !empty($date)?$date:'';?>">
                            <?php if (!empty($dateError)): ?>
                                <span class="help-inline"><?php echo $dateError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($timeError)?'error':'';?>">
                        <label class="control-label">Time</label>
                        <div class="controls">
                            <input name="time" type="time"  placeholder="time" value="<?php echo !empty($time)?$time:'';?>">
                            <?php if (!empty($timeError)): ?>
                                <span class="help-inline"><?php echo $timeError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="indexlessons.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>    