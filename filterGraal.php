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
            <h1 class="display-4">Les comptes GRAAL</h1>
            <hr>
            <form action="searchGraal.php" method="post">
                <div class="row">
                    <div class="col">
                        <label for="country">N°UT</label>
                        <select class="form-control" name="noUt">
                            <?php

                          require 'database.php';

                          $sql2 = "SELECT DISTINCT GRAAL.dbo.Compte.NoUt
                          FROM GRAAL.dbo.Compte
                          WHERE GRAAL.dbo.Compte.NoUt IS NOT NULL";
                          $stmt2 = sqlsrv_query( $conn, $sql2);
                
                          if( $stmt2 === false ) {
                            die( print_r( sqlsrv_errors(), true));
                          } else {
                            echo '<option value=""></option>'; 
                            while( $row2 = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC) ) {
                          
                              echo '<option value="'.$row2['NoUt'].'">'.$row2['NoUt'].'</option>';
                              
                            }
                          }
                        ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="state">Rôle</label>
                        <select class="form-control" name="role">
                            <?php

                          $sql3 = "SELECT DISTINCT GRAAL.dbo.Compte.Role
                          FROM GRAAL.dbo.Compte
                          WHERE GRAAL.dbo.Compte.Role IS NOT NULL";
                          $stmt3 = sqlsrv_query( $conn, $sql3);
                
                          if( $stmt3 === false ) {
                            die( print_r( sqlsrv_errors(), true));
                          } else {
                            echo '<option value=""></option>';
                            while( $row3 = sqlsrv_fetch_array( $stmt3, SQLSRV_FETCH_ASSOC) ) {
                          
                              echo '<option value="'.$row3['Role'].'">'.$row3['Role'].'</option>';
                              
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
                    <form action="filterGraal.php" method="post">
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
    
    
    $sql4 = "SELECT GRAAL.Matricule, GRAAL.Nom, GRAAL.Prenom, GRAAL.Email
                FROM GRAAL.dbo.Compte AS GRAAL";
                $stmt4 = sqlsrv_query( $conn, $sql4);

                if( $stmt4 === false ) {
                die( print_r( sqlsrv_errors(), true));
                } else {
                    $excel .=  "Matricule\Nom\Prenom\Email\n";
                    while( $row4 = sqlsrv_fetch_array( $stmt4, SQLSRV_FETCH_ASSOC) ) {
                        $excel .= "$row4[Matricule]\t$row4[Nom]\trow4[Prenom]\t$row4[Email]\tn";
                        echo '<tr>';
                        echo '<td>'.$row4["Matricule"].'</td>';
                        echo '<td>'.$row4["Nom"].'</td>';
                        echo '<td>'.$row4["Prenom"].'</td>';
                        echo '<td>'.$row4["Email"].'</td>';
                        echo '<td class="table-success"><a href="viewGraal.php?mat='.$row4['Matricule'].'"><span data-feather="check"></span></a></td>';
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