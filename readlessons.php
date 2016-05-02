<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['lessonId'])) {
        $id = $_REQUEST['lessonId'];
    }
     
    if ( null==$id ) {
        header("Location: indexlessons.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM Lessons where lessonId = ?";
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
                        <label class="control-label">Lesson Id</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['lessonId'];?>
                            </label>
                        </div>
                      </div> 
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Patron Id</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['patronId'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Instructor ID</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['instructorId'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Date</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['date'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Time</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['time'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="indexlessons.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>