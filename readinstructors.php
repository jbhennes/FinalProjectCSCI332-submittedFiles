<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['instructorId'])) {
        $id = $_REQUEST['instructorId'];
    }
     
    if ( null==$id ) {
        header("Location: indexinstructors.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM Instructors where instructorId = ?";
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
                        <label class="control-label">Instructor Id</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['instructorId'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Instructor Name</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['instructorName'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Instructor Address</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['instructorAddress'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Instructor Email</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['instructorEmail'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="indexinstructors.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>