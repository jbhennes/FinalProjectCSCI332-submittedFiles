<?php
    require 'database.php';
    $patronId = 0;
     
    if ( !empty($_GET['patronId'])) {
        $patronId = $_REQUEST['patronId'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $patronId = $_POST['patronId'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM Patron WHERE patronId = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($patronId));
        Database::disconnect();
        header("Location: indexpatron.php");
         
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
                        <h3>Delete a Patron</h3>
                    </div>
                     
                    <form class="form-horizontal" action="deletepatron.php" method="post">
                      <input type="hidden" name="patronId" value="<?php echo $patronId;?>"/>
                      <p class="alert alert-error">Are you sure you want to delete Patron <?php echo $patronId;?> ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="indexpatron.php">No</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>