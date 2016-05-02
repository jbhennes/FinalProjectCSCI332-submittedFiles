<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $patronIdError = null;
        $instructorIdError = null;
        $timeError = null;
        $dateError = null;
         
        // keep track post values
        $patronId = $_POST['patronId'];
        $instructorId = $_POST['instructorId'];
        $date = $_POST['date'];
        $time = $_POST['time'];
         
        // validate input
        $valid = true;
         
        if (empty($patronId)) {
            $patronIdError = 'Please enter patron id';
            $valid = false;
        }
         
        if (empty($instructorId)) {
            $instructorIdError = 'Please enter instructor id';
            $valid = false;
        }
        if (empty($date)) {
            $dateError = 'Please enter date YYYY-MM-DD';
            $valid = false;
        }
        if (empty($time)) {
            $timeError = 'Please enter time';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Lessons (patronId,instructorId,date,time) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($patronId,$instructorId,$date,$time));
            Database::disconnect();
            header("Location: indexlessons.php");
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
                        <h3>Create a Lesson</h3>
                    </div>
             
                    <form class="form-horizontal" action="createlessons.php" method="post">
                      <div class="control-group <?php echo !empty($patronIdError)?'error':'';?>">
                        <label class="control-label">Patron ID</label>
                        <div class="controls">
                            <input name="patronId" type="text"  placeholder="Patron Id" value="<?php echo !empty($patronId)?$patronId:'';?>">
                            <?php if (!empty($patronIdError)): ?>
                                <span class="help-inline"><?php echo $patronIdError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($instructorIdError)?'error':'';?>">
                        <label class="control-label">Instructor ID</label>
                        <div class="controls">
                            <input name="instructorId" type="text" placeholder="Instructor Id" value="<?php echo !empty($instructorId)?$instructorId:'';?>">
                            <?php if (!empty($instructorIdError)): ?>
                                <span class="help-inline"><?php echo $instructorIdError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($dateError)?'error':'';?>">
                        <label class="control-label">Date</label>
                        <div class="controls">
                            <input name="date" type="text"  placeholder="YYYY-MM-DD" value="<?php echo !empty($date)?$date:'';?>">
                            <?php if (!empty($dateError)): ?>
                                <span class="help-inline"><?php echo $dateError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($timeError)?'error':'';?>">
                        <label class="control-label">Time</label>
                        <div class="controls">
                            <input name="time" type="text"  placeholder="00:00" value="<?php echo !empty($time)?$time:'';?>">
                            <?php if (!empty($timeError)): ?>
                                <span class="help-inline"><?php echo $timeError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create Lesson</button>
                          <a class="btn" href="indexlessons.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>