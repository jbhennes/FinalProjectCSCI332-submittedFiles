<?php
    require 'database.php';
    $instructorId = 0;
     
    if ( !empty($_GET['instructorId'])) {
        $instructorId = $_REQUEST['instructorId'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $instructorId = $_POST['instructorId'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM Instructors WHERE instructorId = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($instructorId));
        Database::disconnect();
        header("Location: indexinstructors.php");
         
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
                        <h3>Delete an Instructor</h3>
                    </div>
                     
                    <form class="form-horizontal" action="deleteinstructors.php" method="post">
                      <input type="hidden" name="instructorId" value="<?php echo $instructorId;?>"/>
                      <p class="alert alert-error">Are you sure you wan to to delete Instructor <?php echo $instructorId;?> ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="indexinstructors.php">No</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>