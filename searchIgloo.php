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
                        <th>IGLOO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                require 'database.php';

                if(isset($_POST['cFonction'])) {

                    $cFonction = $_POST['cFonction'];
    
                    $sql = "SELECT Matricule, Nom, Prenom, Email
                    FROM Compte_SAP
                    WHERE CFonction ='".$cFonction."'";
                    $result = odbc_exec($connection1, $sql);

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