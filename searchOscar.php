<?php

$excel = "";

if(isset($_POST['csv'])){
            header("Content-type: application/vnd.ms-excel");
            header("Content-disposition: attachment; filename=./csvOscar.xls");

            print $excel;
            exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./images/coallia-squarelogo-1408465071664.png">

    <title>GUCCI</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <?php include("navbar.php"); ?>
    <main role="main" class="container">
        <div class="jumbotron">
            <h1 class="display-4">Vos recherches</h1>
            <hr>
            <div class="row">
                <div class="col">
                <form action="searchOscar.php" method="post">
                        <input class="btn btn-light" type="submit" value="Exporter" name="csv">
                    </form>
                </div>
            </div>
        </div>
        <div class="table-responsive admin">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Matricule</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>OSCAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                require 'database.php';

  if(isset($_POST['service']) and $_POST['service'] != '') {
    $service = $_POST['service'];  
    $sql = "SELECT OSCAR.Cpte_Matricule, OSCAR.Cpte_Nom, OSCAR.Cpte_Prenom, OSCAR.Cpte_Email 
    FROM OSCAR.dbo.Compte AS OSCAR
    WHERE OSCAR.Cpte_Service = ?";
    $params = array($service);
    $stmt = sqlsrv_query( $conn, $sql, $params);

    if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
    } else {
        
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            echo '<tr>';
            echo '<td>'.$row["Cpte_Matricule"].'</td>';
            echo '<td>'.$row["Cpte_Nom"].'</td>';
            echo '<td>'.$row["Cpte_Prenom"].'</td>';
            echo '<td>'.$row["Cpte_Email"].'</td>';
            echo '<td class="table-success"><a href="viewOscar.php?mat='.$row['Cpte_Matricule'].'"><span data-feather="check"></span></a></td>';
            echo '</tr>';
        }
    }
  }

  if(isset($_POST['fonction']) and $_POST['fonction'] != '') {
    $fonction = $_POST['fonction']; 
    $sql = "SELECT OSCAR.Cpte_Matricule, OSCAR.Cpte_Nom, OSCAR.Cpte_Prenom, OSCAR.Cpte_Email 
    FROM OSCAR.dbo.Compte AS OSCAR
    WHERE OSCAR.Cpte_Fonction = ?";
    $params = array($fonction);
    $stmt = sqlsrv_query( $conn, $sql, $params);
  
    if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
    } else {
      
      while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
          echo '<tr>';
          echo '<td>'.$row["Cpte_Matricule"].'</td>';
          echo '<td>'.$row["Cpte_Nom"].'</td>';
          echo '<td>'.$row["Cpte_Prenom"].'</td>';
          echo '<td>'.$row["Cpte_Email"].'</td>';
          echo '<td class="table-success"><a href="viewOscar.php?mat='.$row['Cpte_Matricule'].'"><span data-feather="check"></span></a></td>';
          echo '</tr>';
      }
    } 
  }

  if(isset($_POST['dut']) and $_POST['dut'] != '') {
    $dut = $_POST['dut']; 
    $sql = "SELECT OSCAR.Cpte_Matricule, OSCAR.Cpte_Nom, OSCAR.Cpte_Prenom, OSCAR.Cpte_Email 
    FROM OSCAR.dbo.Compte AS OSCAR
    WHERE OSCAR.Cpte_DUT = ?";
    $params = array($dut);
    $stmt = sqlsrv_query( $conn, $sql, $params);
  
    if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
    } else {
      
      while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
          echo '<tr>';
          echo '<td>'.$row["Cpte_Matricule"].'</td>';
          echo '<td>'.$row["Cpte_Nom"].'</td>';
          echo '<td>'.$row["Cpte_Prenom"].'</td>';
          echo '<td>'.$row["Cpte_Email"].'</td>';
          echo '<td class="table-success"><a href="viewOscar.php?mat='.$row['Cpte_Matricule'].'"><span data-feather="check"></span></a></td>';
          echo '</tr>';
      }
    } 
  }

  if(isset($_POST['region']) and $_POST['region'] != '') {
    $region = $_POST['region'];
    $sql = "SELECT OSCAR.Cpte_Matricule, OSCAR.Cpte_Nom, OSCAR.Cpte_Prenom, OSCAR.Cpte_Email 
    FROM OSCAR.dbo.Compte AS OSCAR
    WHERE OSCAR.Cpte_Region = ?";
    $params = array($region);
    $stmt = sqlsrv_query( $conn, $sql, $params);
  
    if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
    } else {
        $excel .=  "Matricule\Nom\Prenom\Email\n";
      while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $excel .= "$row[Cpte_Matricule]\t$row[Cpte_Nom]\trow[Cpte_Prenom]\t$row[Cpte_Email]\tn";
          echo '<tr>';
          echo '<td>'.$row["Cpte_Matricule"].'</td>';
          echo '<td>'.$row["Cpte_Nom"].'</td>';
          echo '<td>'.$row["Cpte_Prenom"].'</td>';
          echo '<td>'.$row["Cpte_Email"].'</td>';
          echo '<td class="table-success"><a href="viewOscar.php?mat='.$row['Cpte_Matricule'].'"><span data-feather="check"></span></a></td>';
          echo '</tr>';
      }
    } 
  }

  ?>
                </tbody>
            </table>
        </div>
    </main>
    <?php include("footer.php"); ?>
</body>

</html>