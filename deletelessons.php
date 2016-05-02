<?php
    require 'database.php';
    $lessonId = 0;
     
    if ( !empty($_GET['lessonId'])) {
        $lessonId = $_REQUEST['lessonId'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $lessonId = $_POST['lessonId'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM Lessons WHERE lessonId = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($lessonId));
        Database::disconnect();
        header("Location: indexlessons.php");
         
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
                        <h3>Delete a Lesson</h3>
                    </div>
                     
                    <form class="form-horizontal" action="deletelessons.php" method="post">
                      <input type="hidden" name="lessonId" value="<?php echo $lessonId;?>"/>
                      <p class="alert alert-error">Are you sure to delete Lesson <?php echo $lessonId;?> ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="indexlessons.php">No</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>