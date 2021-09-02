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
            <h1 class="display-4">Les comptes OSCAR</h1>
            <hr>
            <form action="searchOscar.php" method="post">
                <div class="row">
                    <div class="col">
                        <label for="country">Service</label>
                        <select class="form-control" name="service">
                        <?php
                        require 'database.php';
                          $sql1 = "SELECT DISTINCT Cpte_Service
                          FROM OSCAR.dbo.Compte
                          WHERE Cpte_Service IS NOT NULL";
                          $stmt1 = sqlsrv_query( $conn, $sql1);
                
                          if( $stmt1 === false ) {
                            die( print_r( sqlsrv_errors(), true));
                          } else {
                            echo '<option value=""></option>'; 
                            while( $row1 = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) {
                              echo '<option value="'.$row1['Cpte_Service'].'">'.$row1['Cpte_Service'].'</option>';
                            }
                          }
                        ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="state">Fonction</label>
                        <select class="form-control" name="fonction">
                        <?php
                          $sql2 = "SELECT DISTINCT Cpte_Fonction
                          FROM OSCAR.dbo.Compte
                          WHERE Cpte_Fonction is not null";
                          $stmt2 = sqlsrv_query( $conn, $sql2);
                
                          if( $stmt2 === false ) {
                            die( print_r( sqlsrv_errors(), true));
                          } else {
                            echo '<option value=""></option>';
                            while( $row2 = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC) ) {
                              echo '<option value="'.$row2['Cpte_Fonction'].'">'.$row2['Cpte_Fonction'].'</option>';
                            }
                          }
                        ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="country">DUT</label>
                        <select class="form-control" name="dut">
                            <?php
                          $sql3 = "SELECT DISTINCT Cpte_DUT 
                          FROM OSCAR.dbo.Compte
                          WHERE Cpte_DUT IS NOT NULL";
                          $stmt3 = sqlsrv_query( $conn, $sql3);
                
                          if( $stmt3 === false ) {
                            die( print_r( sqlsrv_errors(), true));
                          } else {
                            while( $row3 = sqlsrv_fetch_array( $stmt3, SQLSRV_FETCH_ASSOC) ) {
                              echo '<option value="'.$row3['Cpte_DUT'].'">'.$row3['Cpte_DUT'].'</option>';
                            }
                          }
                        ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="state">Region</label>
                        <select class="form-control" name="region">
                            <?php
                          $sql4 = "SELECT DISTINCT Cpte_Region
                          FROM OSCAR.dbo.Compte
                          WHERE Cpte_Region IS NOT NULL";
                          $stmt4 = sqlsrv_query( $conn, $sql4);
                
                          if( $stmt4 === false ) {
                            die( print_r( sqlsrv_errors(), true));
                          } else {
                            while( $row4 = sqlsrv_fetch_array( $stmt4, SQLSRV_FETCH_ASSOC) ) {
                              echo '<option value="'.$row4['Cpte_Region'].'">'.$row4['Cpte_Region'].'</option>';
                            }
                          }
                        ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <input class="btn btn-primary" type="submit" value="rechercher" name="search">
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col">
                    <form action="filterOscar.php" method="post" >
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
    
    
    $sql5 = "SELECT OSCAR.Cpte_Matricule, OSCAR.Cpte_Nom, OSCAR.Cpte_Prenom, OSCAR.Cpte_Email 
    FROM OSCAR.dbo.Compte AS OSCAR";
    $stmt5 = sqlsrv_query( $conn, $sql5);

    if( $stmt5 === false ) {
    die( print_r( sqlsrv_errors(), true));
    } else {

        $excel .=  "Matricule\Nom\Prenom\Email\n";

        while( $row5 = sqlsrv_fetch_array( $stmt5, SQLSRV_FETCH_ASSOC) ) {
            $excel .= "$row5[Cpte_Matricule]\t$row5[Cpte_Nom]\trow5[Cpte_Prenom]\t$row5[Cpte_Email]\tn";
            echo '<tr>';
            echo '<td>'.$row5["Cpte_Matricule"].'</td>';
            echo '<td>'.$row5["Cpte_Nom"].'</td>';
            echo '<td>'.$row5["Cpte_Prenom"].'</td>';
            echo '<td>'.$row5["Cpte_Email"].'</td>';
            echo '<td class="table-success"><a href="viewOscar.php?mat='.$row5['Cpte_Matricule'].'"><span data-feather="check"></span></a></td>';
            echo '</tr>';
        }
    }

  ?>
                </tbody>
            </table>
        </div>
    </main>
    <br>
    <?php include("footer.php"); ?>
</body>

</html>