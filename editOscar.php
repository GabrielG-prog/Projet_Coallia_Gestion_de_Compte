<?php
        require 'database.php';

        $mat='';
        if(isset($_GET["mat"])) {

          $mat = $_GET["mat"];

            $service = '';
            $fonction = '';
            $dut = '';
            $region = '';

          if(!empty($_POST)) {
            $service = $_POST['service'];
            $fonction = $_POST['fonction'];
            $dut = $_POST['dut'];
            $region = $_POST['region'];

            if($service == 'READ      ' OR $service == 'CDG       '){
              $sql = "UPDATE OSCAR.dbo.Compte 
              SET Cpte_Service = ?, Cpte_Fonction = ?, Cpte_DUT = ?, Cpte_Region = ? 
              WHERE Cpte_Matricule = ?";
              $params = array($service, $fonction, null, null, $mat);
              $stmt = sqlsrv_query( $conn, $sql, $params);

              if( $stmt === false ) {
                  die( print_r( sqlsrv_errors(), true));
              } else {
                header("Location: home.php");
              }
            }

            if($service == 'DR        '){
              $sql = "UPDATE OSCAR.dbo.Compte 
              SET Cpte_Service = ?, Cpte_Fonction = ?, Cpte_DUT = ?, Cpte_Region = ? 
              WHERE Cpte_Matricule = ?";
              $params = array($service, $fonction, $dut, null, $mat);
              $stmt = sqlsrv_query( $conn, $sql, $params);

              if( $stmt === false ) {
                  die( print_r( sqlsrv_errors(), true));
              } else {
                header("Location: home.php");
              }
            }

            if($service == 'DUT       '){
              $sql = "UPDATE OSCAR.dbo.Compte 
              SET Cpte_Service = ?, Cpte_Fonction = ?, Cpte_DUT = ?, Cpte_Region = ? 
              WHERE Cpte_Matricule = ?";
              $params = array($service, $fonction, $dut, $region, $mat);
              $stmt = sqlsrv_query( $conn, $sql, $params);

              if( $stmt === false ) {
                  die( print_r( sqlsrv_errors(), true));
              } else {
                header("Location: home.php");
              }
            }

          } else {

            $sql = "SELECT DISTINCT Cpte_Matricule, Cpte_Nom, Cpte_Prenom, Cpte_Email, Cpte_Service, Cpte_Fonction, REPLACE (Cpte_DUT, ' ', '' ) AS CpteDUT, REPLACE (Cpte_Region, ' ', '' ) AS CpteRegion
                FROM OSCAR.dbo.Compte
                WHERE Cpte_Matricule = ?";
            $params = array($mat);
            $stmt = sqlsrv_query( $conn, $sql, $params);

            if( $stmt === false ) {
                die( print_r( sqlsrv_errors(), true));
            } else {
                
                while( $item = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                    $nom = $item['Cpte_Nom'];
                    $prenom = $item['Cpte_Prenom'];
                    $email = $item['Cpte_Email'];
                    $service = $item['Cpte_Service'];
                    $fonction = $item['Cpte_Fonction'];
                    $dut = $item['CpteDUT'];
                    $region = $item['CpteRegion'];
                }
            }
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
  <link href="formStyle.css" rel="stylesheet">
</head>

<body class="bg-light">

  <div class="container">
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="./images/coallia-squarelogo-1408465071664.png" alt="" width="72"
        height="72">
      <h2>GUCCI</h2>
    </div>

    <div class="row">
      <div class="col">
        <h4 class="mb-3">Modifier un compte OSCAR</h4>
        <form action="<?php echo 'editOscar.php?mat='.$mat;?>" method="post">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">Nom</label>
              <input type="text" class="form-control" value="<?php echo $nom;?>" disabled>
            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Prenom</label>
              <input type="text" class="form-control" value="<?php echo $prenom;?>" disabled>
            </div>
          </div>

          <div class="mb-3">
            <label for="username">Email</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">@</span>
              </div>
              <input type="text" class="form-control" value="<?php echo $email;?>" disabled>
            </div>
          </div>

          <div class="mb-3">
            <label for="email">Matricule</label>
            <input type="text" class="form-control" value="<?php echo $mat;?>" disabled>
          </div>

          <div class="row">
            <div class="col">
              <label for="country">Service</label>
              <select class="custom-select d-block w-100" name="service" id="service">
                <?php
                          $sql = "SELECT DISTINCT Srv_Code, Srv_Libelle
                          FROM OSCAR.dbo.Services";
                          $stmt = sqlsrv_query( $conn, $sql);
                
                          if( $stmt === false ) {
                            die( print_r( sqlsrv_errors(), true));
                          } else {
                            while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                              if($service == $row['Srv_Code']) {
                                echo '<option value="'.$row['Srv_Code'].'" selected>'.$row['Srv_Code'].'  '.$row['Srv_Libelle'].'</option>';
                              }else {
                                echo '<option value=""></option>';
                                echo '<option value="'.$row['Srv_Code'].'">'.$row['Srv_Code'].'  '.$row['Srv_Libelle'].'</option>';
                              }
                            }
                          }
                        ?>
              </select>
            </div>
            <div class="col">
              <label for="state">Fonction</label>
              <select class="custom-select d-block w-100" name="fonction" id="fonction">
                <?php
                          $sql1 = "SELECT DISTINCT ADP_SAL_QUAL_TEXT
                          FROM SI_RH.dbo.Salaries_ADP_Imp_Jour
                          WHERE ADP_SAL_QUAL_TEXT is not null";
                          $stmt1 = sqlsrv_query( $conn, $sql1);
                
                          if( $stmt1 === false ) {
                            die( print_r( sqlsrv_errors(), true));
                          } else {
                            while( $row1 = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) {
                              if($row1['ADP_SAL_QUAL_TEXT'] == $fonction) {
                                echo '<option value="'.$row1['ADP_SAL_QUAL_TEXT'].'" selected>'.$row1['ADP_SAL_QUAL_TEXT'].'</option>';
                              } else {
                                echo '<option value=""></option>';
                                echo '<option value="'.$row1['ADP_SAL_QUAL_TEXT'].'">'.$row1['ADP_SAL_QUAL_TEXT'].'</option>';
                              }
                            }
                          }
                        ?>
              </select>
            </div>
            <div class="col">
              <label for="country">DUT</label>
              <select class="custom-select d-block w-100" name="dut" id="dut">
                <?php
                          $sql2 = "SELECT DISTINCT CodeUt, UtLib  
                          FROM OSCAR.dbo.Ut";
                          $stmt2 = sqlsrv_query( $conn, $sql2);
                
                          if( $stmt2 === false ) {
                            die( print_r( sqlsrv_errors(), true));
                          } else {
                            while( $row = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC) ) {
                              if($dut == $row['CodeUt']) {
                                echo '<option value="'.$row['CodeUt'].'" selected>'.$row['CodeUt'].'  '.$row['UtLib'].'</option>';
                              } else {
                                echo '<option value=""></option>';
                                echo '<option value="'.$row['CodeUt'].'">'.$row['CodeUt'].'  '.$row['UtLib'].'</option>';
                              }
                              
                            }
                          }
                        ?>
              </select>
            </div>
            <div class="col">
              <label for="state">Region</label>
              <select class="custom-select d-block w-100" name="region" id="region">
                <?php
                          $sql3 = "SELECT DISTINCT CodeRegion , RegionLib  
                          FROM OSCAR.dbo.Regions";
                          $stmt3 = sqlsrv_query( $conn, $sql3);
                
                          if( $stmt3 === false ) {
                            die( print_r( sqlsrv_errors(), true));
                          } else {
                            while( $row = sqlsrv_fetch_array( $stmt3, SQLSRV_FETCH_ASSOC) ) {
                              if($region == $row['CodeRegion']) {
                                echo '<option value="'.$row['CodeRegion'].'" selected>'.$row['CodeRegion'].'  '.$row['RegionLib'].'</option>';
                              }else {
                                echo '<option value=""></option>';
                                echo '<option value="'.$row['CodeRegion'].'">'.$row['CodeRegion'].'  '.$row['RegionLib'].'</option>';
                              }
                              
                            }
                          }
                        ?>
              </select>
            </div>
          </div>
          <hr class="mb-4">
          <input class="btn btn-primary btn-lg btn-block" type="submit" value="Modifier">
        </form>
        <?php

          }else {
            echo'erreur URL';
          }  
          ?>
      </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">&copy; 2020-2021 GUCCI</p>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="home.php">Comptes</a></li>
        <li class="list-inline-item"><a href="viewOscar;php">Voir un compte OSCAR</a></li>
        <li class="list-inline-item"><a href="index.html">Quitter</a></li>
      </ul>
    </footer>
  </div>

  <script src="script.js"></script>

  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script>
    window.jQuery || document.write('<script src="./assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
  <script src="./assets/js/vendor/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
  <script src="./assets/js/vendor/holder.min.js"></script>
</body>

</html>