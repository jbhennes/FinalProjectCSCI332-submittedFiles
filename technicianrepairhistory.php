<?php
    require 'database.php';
    $technicianId = 0;
    $technicianName = "";
     
    if ( !empty($_GET['technicianId'])) {
        $technicianId = $_REQUEST['technicianId'];
    }
     
    if ( !empty($_GET['technicianName'])) {
        // keep track post values
        $technicianName = $_REQUEST['technicianName'];
        }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
   <div class="container">
   </br>
            <div class="row">
                <h2>Technician Repair History</h2> 
                <h4>ID: <?php echo $technicianId;?></h4>
                <h4>Name: <?php echo $technicianName;?></h4>
            </div>
            <div class="row">
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Repair ID</th>
                          <th>Date Received</th>
                          <th>Date To Return</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       $pdo = Database::connect();
                       $sql = "SELECT *, COUNT(technicianId) FROM technicianRepairHistory WHERE technicianId = " . $_GET['technicianId'] . " ORDER BY repairId ASC";
                       $grandTotal = $data['COUNT(technicianId)'];
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['repairId'] . '</td>';
                                echo '<td>'. $row['dateRecd'] . '</td>';
                                echo '<td>$'. $row['dateToReturn'] . '</td>';
                                echo '</td>';
                                echo '</tr>';
                                echo '</tbody>';
                                /*echo '</table>';
                                
                                echo '<div class="row">';
                                echo '<table class="table table-striped table-bordered">';
                                echo '<thead>';
                                echo '<tr>';
        			echo '<th>Total Number Of Repairs <?php echo $grandTotal;?></th>';
        			echo '</tr>';
        			echo '</thead>';
        			echo '<tbody>';
        			echo '<tr>';
        			echo '<td>';
        			echo $grandTotal .' Repairs';
        			echo '</td>';
        			echo '</tr>';*/
                       }
                      ?>
                      </tbody>
                </table>
               
        </div>
        <div class="row">
        	<p>
                    <a href="indextechnicians.php" class="btn">Back</a>
                </p>

    </div> <!-- /container -->
  </body>
</html>