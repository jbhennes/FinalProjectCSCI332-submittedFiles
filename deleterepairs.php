<?php
    require 'database.php';
    $repairId = 0;
     
    if ( !empty($_GET['repairId'])) {
        $repairId = $_REQUEST['repairId'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $repairId = $_POST['repairId'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM Repairs  WHERE repairId = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($repairId));
        Database::disconnect();
        header("Location: indexrepairs.php");
         
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
                        <h3>Delete a Repair</h3>
                    </div>
                     
                    <form class="form-horizontal" action="deleterepairs.php" method="post">
                      <input type="hidden" name="repairId" value="<?php echo $repairId;?>"/>
                      <p class="alert alert-error">Are you sure you want to delete Repair <?php echo $repairId;?> ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="indexrepairs.php">No</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>