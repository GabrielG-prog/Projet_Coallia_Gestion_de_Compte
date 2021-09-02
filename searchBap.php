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
                        <th>BAP</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                require 'database.php';

                if(isset($_POST['unite'])) {

                    $unite = $_POST['unite'];
    
                    $sql = "SELECT BAP_CONNECTION_MATRICULE, BAP_CONNECTION_NoM, BAP_CONNECTION_PRENOM, BAP_CONNECTION_Mail 
                    FROM BAP_COMPTE_CONNECTION
                    WHERE BAP_CONNECTION_NoUnite ='".$unite."'";
                    $result = odbc_exec($connection, $sql);

                    if(!$result) {
                        echo'<p>Erreur SQL</p>';
                    } else {
                        echo'<p>'.$unite.'</p>';
                        while( odbc_fetch_row($result) ) {
                            echo '<tr>';
                            echo '<td>'.odbc_result($result, 1).'</td>';
                            echo '<td>'.odbc_result($result, 2).'</td>';
                            echo '<td>'.odbc_result($result, 3).'</td>';
                            echo '<td>'.odbc_result($result, 4).'</td>';
                            echo '<td class="table-success"><a href="viewBap.php?mat='.odbc_result($result, 1).'"><span data-feather="check"></span></a></td>';
                            echo '</tr>';
                        }
                    }
                }

                if(isset($_POST['qualif'])) {

                    $qualif = $_POST['qualif'];

                    $sql = "SELECT BAP_CONNECTION_MATRICULE, BAP_CONNECTION_NoM, BAP_CONNECTION_PRENOM, BAP_CONNECTION_Mail 
                    FROM BAP_COMPTE_CONNECTION
                    WHERE BAP_CONNECTION_Qualif ='".$qualif."'";
                    $result = odbc_exec($connection, $sql);

                    if(!$result) {
                        echo'<p>Erreur SQL</p>';
                    } else {
                        while( odbc_fetch_row($result) ) {
                            echo '<tr>';
                            echo '<td>'.odbc_result($result, 1).'</td>';
                            echo '<td>'.odbc_result($result, 2).'</td>';
                            echo '<td>'.odbc_result($result, 3).'</td>';
                            echo '<td>'.odbc_result($result, 4).'</td>';
                            echo '<td class="table-success"><a href="viewBap.php?mat='.odbc_result($result, 1).'"><span data-feather="check"></span></a></td>';
                            echo '</tr>';
                        }
                    }
                }

                if(isset($_POST['droitG'])) {

                    $droitG = $_POST['droitG'];
    
                    $sql = "SELECT BAP_CONNECTION_MATRICULE, BAP_CONNECTION_NoM, BAP_CONNECTION_PRENOM, BAP_CONNECTION_Mail 
                    FROM BAP_COMPTE_CONNECTION
                    WHERE BAP_CONNECTION_DROIT_GENERAL ='".$droitG."'";
                    $result = odbc_exec($connection, $sql);

                    if(!$result) {
                        echo'erreur SQL';
                    } else {
                        while( odbc_fetch_row($result) ) {
                            echo '<tr>';
                            echo '<td>'.odbc_result($result, 1).'</td>';
                            echo '<td>'.odbc_result($result, 2).'</td>';
                            echo '<td>'.odbc_result($result, 3).'</td>';
                            echo '<td>'.odbc_result($result, 4).'</td>';
                            echo '<td class="table-success"><a href="viewBap.php?mat='.odbc_result($result, 1).'"><span data-feather="check"></span></a></td>';
                            echo '</tr>';
                        }
                    }
                }

                if(isset($_POST['totcO'])) {

                    $totcO = $_POST['totcO'];
    
                    $sql = "SELECT BAP_CONNECTION_MATRICULE, BAP_CONNECTION_NoM, BAP_CONNECTION_PRENOM, BAP_CONNECTION_Mail 
                    FROM BAP_COMPTE_CONNECTION
                    WHERE BAP_CONNECTION_TOT_CONNEXION ='".$totcO."'";
                    $result = odbc_exec($connection, $sql);

                    if(!$result) {
                        echo'erreur SQL';
                    } else {
                        while( odbc_fetch_row($result) ) {
                            echo '<tr>';
                            echo '<td>'.odbc_result($result, 1).'</td>';
                            echo '<td>'.odbc_result($result, 2).'</td>';
                            echo '<td>'.odbc_result($result, 3).'</td>';
                            echo '<td>'.odbc_result($result, 4).'</td>';
                            echo '<td class="table-success"><a href="viewBap.php?mat='.odbc_result($result, 1).'"><span data-feather="check"></span></a></td>';
                            echo '</tr>';
                        }
                    }
                }

                if(isset($_POST['preValide'])) {

                    $preValide = $_POST['preValide'];
    
                    $sql = "SELECT BAP_CONNECTION_MATRICULE, BAP_CONNECTION_NoM, BAP_CONNECTION_PRENOM, BAP_CONNECTION_Mail 
                    FROM BAP_COMPTE_CONNECTION
                    WHERE BAP_CONNECTION_PRE_VALIDATION ='".$preValide."'";
                    $result = odbc_exec($connection, $sql);

                    if(!$result) {
                        echo'erreur SQL';
                    } else {
                        while( odbc_fetch_row($result) ) {
                            echo '<tr>';
                            echo '<td>'.odbc_result($result, 1).'</td>';
                            echo '<td>'.odbc_result($result, 2).'</td>';
                            echo '<td>'.odbc_result($result, 3).'</td>';
                            echo '<td>'.odbc_result($result, 4).'</td>';
                            echo '<td class="table-success"><a href="viewBap.php?mat='.odbc_result($result, 1).'"><span data-feather="check"></span></a></td>';
                            echo '</tr>';
                        }
                    }
                }

                if(isset($_POST['validation'])) {

                    $validation = $_POST['validation'];
    
                    $sql = "SELECT BAP_CONNECTION_MATRICULE, BAP_CONNECTION_NoM, BAP_CONNECTION_PRENOM, BAP_CONNECTION_Mail 
                    FROM BAP_COMPTE_CONNECTION
                    WHERE BAP_CONNECTION_VALIDATION ='".$validation."'";
                    $result = odbc_exec($connection, $sql);

                    if(!$result) {
                        echo'erreur SQL';
                    } else {
                        while( odbc_fetch_row($result) ) {
                            echo '<tr>';
                            echo '<td>'.odbc_result($result, 1).'</td>';
                            echo '<td>'.odbc_result($result, 2).'</td>';
                            echo '<td>'.odbc_result($result, 3).'</td>';
                            echo '<td>'.odbc_result($result, 4).'</td>';
                            echo '<td class="table-success"><a href="viewBap.php?mat='.odbc_result($result, 1).'"><span data-feather="check"></span></a></td>';
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