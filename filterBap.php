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
            <h1 class="display-4">Les comptes BAP</h1>
            <hr>
            <form action="searchBap.php" method="post">
                <div class="row">
                    <div class="col">
                        <label for="country">N° UT</label>
                        <select class="form-control" name="unite">
                            <?php
                          require 'database.php';

                          $request2 = "SELECT DISTINCT BAP_CONNECTION_NoUnite
                          FROM BAP_COMPTE_CONNECTION
                          WHERE BAP_CONNECTION_NoUnite is not null";
                          $result2 = odbc_exec($connection, $request2);
                          $dataTable2 = [];
                      
                          if($result2){
                              while(odbc_fetch_row($result2)) {
                                  $dataTable2[] = odbc_result($result2, 1);
                              }
                          }
                          echo '<option value=""></option>';
                          foreach ($dataTable2 as $row2) {  
                            echo '<option value="'.$row2.'">'.$row2. '</option>';
                          }
                        ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="inputPassword4">Qualification</label>
                        <select class="form-control" name="qualif">
                            <?php

                          $request3 = "SELECT DISTINCT BAP_CONNECTION_Qualif
                          FROM BAP_COMPTE_CONNECTION
                          WHERE BAP_CONNECTION_Qualif is not null";
                          $result3 = odbc_exec($connection, $request3);
                          $dataTable3 = [];
                      
                          if($result3){
                              while(odbc_fetch_row($result3)) {
                                  $dataTable3[] = odbc_result($result3, 1);
                              }
                          }
                          echo '<option value=""></option>';
                          foreach ($dataTable3 as $row3) {  
                            echo '<option value="'.$row3.'">'.$row3. '</option>';
                          }
                        ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="state">Droit Général</label>
                        <select class="form-control" name="droitG">
                            <?php

                          $request5 = "SELECT DISTINCT BAP_CONNECTION_DROIT_GENERAL
                          FROM BAP_COMPTE_CONNECTION
                          WHERE BAP_CONNECTION_DROIT_GENERAL is not null";
                          $result5 = odbc_exec($connection, $request5);
                          $dataTable5 = [];
                      
                          if($result5){
                              while(odbc_fetch_row($result5)) {
                                  $dataTable5[] = odbc_result($result5, 1);
                              }
                          }
                          echo '<option value=""></option>';
                          foreach ($dataTable5 as $row5) {  
                            echo '<option value="'.$row5.'">'.$row5. '</option>';
                          }
                        ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="country">Tot connexion</label>
                        <select class="form-control" name="totcO">
                            <?php

                          $request6 = "SELECT DISTINCT BAP_CONNECTION_TOT_CONNEXION
                          FROM BAP_COMPTE_CONNECTION
                          WHERE BAP_CONNECTION_TOT_CONNEXION is not null";
                          $result6 = odbc_exec($connection, $request6);
                          $dataTable6 = [];
                      
                          if($result6){
                              while(odbc_fetch_row($result6)) {
                                  $dataTable6[] = odbc_result($result6, 1);
                              }
                          }
                          echo '<option value=""></option>';
                          foreach ($dataTable6 as $row6) {  
                            echo '<option value="'.$row6.'">'.$row6.'</option>';
                          }
                        ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="state">Pré validation</label>
                        <select class="form-control" name="preValide">
                            <?php

                          $request7 = "SELECT DISTINCT BAP_CONNECTION_PRE_VALIDATION
                          FROM BAP_COMPTE_CONNECTION
                          WHERE BAP_CONNECTION_PRE_VALIDATION is not null";
                          $result7 = odbc_exec($connection, $request7);
                          $dataTable7 = [];
                      
                          if($result7){
                              while(odbc_fetch_row($result7)) {
                                  $dataTable7[] = odbc_result($result7, 1);
                              }
                          }
                          echo '<option value=""></option>';
                          foreach ($dataTable7 as $row7) {  
                            echo '<option value="'.$row7.'">'.$row7.'</option>';
                          }
                        ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="state">Validation</label>
                        <select class="form-control" name="validation">
                            <?php

                          $request8 = "SELECT DISTINCT BAP_CONNECTION_VALIDATION
                          FROM BAP_COMPTE_CONNECTION
                          WHERE BAP_CONNECTION_VALIDATION is not null";
                          $result8 = odbc_exec($connection, $request8);
                          $dataTable8 = [];
                      
                          if($result8){
                              while(odbc_fetch_row($result8)) {
                                  $dataTable8[] = odbc_result($result8, 1);
                              }
                          }
                          echo '<option value=""></option>';
                          foreach ($dataTable8 as $row8) {  
                            echo '<option value="'.$row8.'">'.$row8. '</option>';
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
                    <form action="filterBap.php" method="post">
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
    
    
    $sql1 = "SELECT BAP_CONNECTION_MATRICULE, BAP_CONNECTION_NoM, BAP_CONNECTION_PRENOM, BAP_CONNECTION_Mail 
                FROM BAP_COMPTE_CONNECTION";
                $result1 = odbc_exec($connection, $sql1);

                if(!$result1) {
                    echo'erreur SQL';
                } else {
                    $excel .=  "Matricule\Nom\Prenom\Email\n";
                    while( odbc_fetch_row($result1) ) {
                        $excel .= "odbc_result($result1, 1)\todbc_result($result1, 2)\todbc_result($result1, 3)\todbc_result($result1, 4)\tn";
                        echo '<tr>';
                        echo '<td>'.odbc_result($result1, 1).'</td>';
                        echo '<td>'.odbc_result($result1, 2).'</td>';
                        echo '<td>'.odbc_result($result1, 3).'</td>';
                        echo '<td>'.odbc_result($result1, 4).'</td>';
                        echo '<td class="table-success"><a href="viewBap.php?mat='.odbc_result($result1, 1).'"><span data-feather="check"></span></a></td>';
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