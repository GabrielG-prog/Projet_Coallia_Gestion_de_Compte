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
                    <form action="searchGraal.php" method="post">
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
                        <th>GRAAL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                require 'database.php';

                if(isset($_POST['noUt'])) {

                    $noUt = $_POST['noUt'];
    
                    $sql = "SELECT GRAAL.Matricule, GRAAL.Nom, GRAAL.Prenom, GRAAL.Email
                    FROM GRAAL.dbo.Compte AS GRAAL
                    WHERE GRAAL.NoUt = ?";
                    $params1 = array($noUt);
                    $stmt = sqlsrv_query( $conn, $sql, $params1);
    
                    if( $stmt === false ) {
                    die( print_r( sqlsrv_errors(), true));
                    } else {
                        $excel .=  "Matricule\Nom\Prenom\Email\n";
                        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                            $excel .= "$row[Matricule]\t$row[Nom]\trow[Prenom]\t$row[Email]\tn";
                            echo '<tr>';
                            echo '<td>'.$row["Matricule"].'</td>';
                            echo '<td>'.$row["Nom"].'</td>';
                            echo '<td>'.$row["Prenom"].'</td>';
                            echo '<td>'.$row["Email"].'</td>';
                            echo '<td class="table-success"><a href="viewGraal.php?mat='.$row['Matricule'].'"><span data-feather="check"></span></a></td>';
                            echo '</tr>';
                        }
                    }
                }

                if(isset($_POST['role'])) {

                    $role = $_POST['role'];
    
                    $sql = "SELECT GRAAL.Matricule, GRAAL.Nom, GRAAL.Prenom, GRAAL.Email
                    FROM GRAAL.dbo.Compte AS GRAAL
                    WHERE GRAAL.Role = ?";
                    $params1 = array($role);
                    $stmt = sqlsrv_query( $conn, $sql, $params1);
    
                    if( $stmt === false ) {
                    die( print_r( sqlsrv_errors(), true));
                    } else {
                        $excel .=  "Matricule\Nom\Prenom\Email\n";
                        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                            $excel .= "$row[Matricule]\t$row[Nom]\t$row[Prenom]\t$row[Email]\tn";
                            echo '<tr>';
                            echo '<td>'.$row["Matricule"].'</td>';
                            echo '<td>'.$row["Nom"].'</td>';
                            echo '<td>'.$row["Prenom"].'</td>';
                            echo '<td>'.$row["Email"].'</td>';
                            echo '<td class="table-success"><a href="viewGraal.php?mat='.$row['Matricule'].'"><span data-feather="check"></span></a></td>';
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