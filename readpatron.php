<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['patronId'])) {
        $id = $_REQUEST['patronId'];
    }
     
    if ( null==$id ) {
        header("Location: indexpatron.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM Patron where patronId = ?";
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
                        <label class="control-label">Patron Id</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['patronId'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Patron Name</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['patronName'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Patron Address</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['patronAddress'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Patron Email</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['patronEmail'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="indexpatron.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>