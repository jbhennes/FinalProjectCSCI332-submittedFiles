<?php
    require 'database.php';
    $technicianId = 0;
     
    if ( !empty($_GET['technicianId'])) {
        $technicianId = $_REQUEST['technicianId'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $technicianId = $_POST['technicianId'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM Technicians WHERE technicianId = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($technicianId));
        Database::disconnect();
        header("Location: indextechnicians.php");
         
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
                        <h3>Delete a Technician</h3>
                    </div>
                     
                    <form class="form-horizontal" action="deletetechnicians.php" method="post">
                      <input type="hidden" name="technicianId" value="<?php echo $technicianId;?>"/>
                      <p class="alert alert-error">Are you sure you want to delete Technician <?php echo $technicianId?> ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="indextechnicians.php">No</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>