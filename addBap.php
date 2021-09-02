<?php
          require 'database.php';

          if (isset($_GET["mat"])) {

            $mat = $_GET["mat"];

            $sqlSirh = "SELECT SI_RH.ADP_SAL_NOM, SI_RH.ADP_SAL_PRENOM, SI_RH.ADP_SAL_MAIL_COALLIA 
            FROM SI_RH.dbo.Salaries_ADP_Imp_Jour AS SI_RH
            WHERE SI_RH.ADP_SAL_MAT = ?";
            $paramSirh = array($mat);
            $stmtSirh = sqlsrv_query( $conn, $sqlSirh, $paramSirh);

            $nom='';
            $prenom='';
            $email='';
  
            if( $stmtSirh === false ) {
              die( print_r( sqlsrv_errors(), true));
            } else {
              while( $row = sqlsrv_fetch_array( $stmtSirh, SQLSRV_FETCH_ASSOC) ) {
                $nom = $row['ADP_SAL_NOM'];
                $prenom = $row['ADP_SAL_PRENOM'];
                $email = $row['ADP_SAL_MAIL_COALLIA'];
              }

                if(!empty($_POST['unite']) && !empty($_POST['qualif']) && !empty($_POST['titre']) && !empty($_POST['droitG']) && isset($_POST['totCo'])){
            
                    $unite = $_POST['unite']; 
                    $qualif = $_POST['qualif'];
                    $titre = $_POST['titre']; 
                    $droitG = count($_POST['droitG']) == 1 ? $_POST['droitG'][0] : implode('æ', $_POST['droitG']);
                    $totcO = $_POST['totCo']; 
                    $preValide = (isset($_POST['preValide'])) ? 1 : 0; 
                    $validation = (isset($_POST['validation'])) ? 1 : 0;

                    $request = "INSERT INTO BAP_COMPTE_CONNECTION (BAP_CONNECTION_MATRICULE, BAP_CONNECTION_DTE_LAST_CONN, BAP_CONNECTION_HR_LAST_CONN, BAP_CONNECTION_Nom, BAP_CONNECTION_PRENOM, BAP_CONNECTION_NoUnite, 
                    BAP_CONNECTION_Qualif, BAP_CONNECTION_Mail, BAP_CONNECTION_Passeword, BAP_CONNECTION_TITRE, BAP_CONNECTION_DROIT_GENERAL, BAP_CONNECTION_DROIT_VALIDER, BAP_CONNECTION_DROIT_CONSULTER, 
                    BAP_CONNECTION_SOCIETE, BAP_CONNECTION_COMMENTAIRES, BAP_CONNECTION_TOT_CONNEXION, BAP_CONNECTION_PRE_VALIDATION, BAP_CONNECTION_VALIDATION)  
                    VALUES ('$mat', '20200101', '1556', '$nom', '$prenom', '$unite', '$qualif', 'testEmail', '1725456010', '$titre', '$droitG', ' ', ' ', '0010', ' ', '$totcO', '$preValide', '$validation')";
                    $result = odbc_exec($connection, $request);

                    if($result) {
                        header("Location: home.php");
                    } else {
                      header("Location: filterAll.php");
                    }
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
                <h4 class="mb-3">Ajouter un compte BAP</h4>
                <form action="<?php echo 'addBap.php?mat='.$mat;?>" method="post">
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

                    <div class="mb-3">
                        <label for="email">Tot connexion</label>
                        <input type="number" class="form-control" name="totCo">
                    </div>
                    <hr class="mb-4">
                    <div class="row">
                        <div class="col">
                            <label for="country">N°UT</label>
                            <select class="custom-select d-block w-100" name="unite">
                                <?php
                          $sql = "SELECT DISTINCT CodeUt, UtLib  
                          FROM OSCAR.dbo.Ut";
                          $stmt = sqlsrv_query( $conn, $sql);
                
                          if( $stmt === false ) {
                            die( print_r( sqlsrv_errors(), true));
                          } else {
                            echo '<option value="">Choisir un UT</option>';  
                            while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                              echo '<option value="'.$row['CodeUt'].'">'.$row['CodeUt'].'  '.$row['UtLib'].'</option>';
                            }
                          }
                        ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="country">Qualification</label>
                            <select class="custom-select d-block w-100" name="qualif">
                                <?php
                          $sql1 = "SELECT DISTINCT ADP_SAL_QUAL_CODE, ADP_SAL_QUAL_TEXT
                          FROM SI_RH.dbo.Salaries_ADP_Imp_Jour
                          WHERE ADP_SAL_QUAL_CODE is not null
                          AND ADP_SAL_QUAL_TEXT is not null";
                          $stmt1 = sqlsrv_query( $conn, $sql1);
                
                          if( $stmt1 === false ) {
                            die( print_r( sqlsrv_errors(), true));
                          } else {
                            echo '<option value="">Choisir une qualification</option>';  
                            while( $row = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) {
                              echo '<option value="'.$row['ADP_SAL_QUAL_CODE'].'">'.$row['ADP_SAL_QUAL_CODE'].' - '.$row['ADP_SAL_QUAL_TEXT'].'</option>';
                            }
                          }
                        ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="state">Droit Général</label>
                            <select multiple class="custom-select d-block w-100" name="droitG[]">
                                <?php

                    $request1 = "SELECT DISTINCT AFF_CODE, AFF_LIBELLE
                    FROM AFFECTATION";
                    $result = odbc_exec($connection, $request1);
                    $affTable = [];
                    echo '<option value="">Choisir les droits généraux</option>';  
                    while(odbc_fetch_row($result)) {
                      echo '<option value="'.odbc_result($result, 1).'">'.odbc_result($result, 1).' - '.odbc_result($result, 2).'</option>';
                    }  
                    ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="state">Titre</label>
                            <select class="custom-select d-block w-100" name="titre">
                                <?php
                          $sql2 = "SELECT DISTINCT ADP_SAL_CIVILITE
                          FROM SI_RH.dbo.Salaries_ADP_Imp_Jour";
                          $stmt2 = sqlsrv_query( $conn, $sql2);
                
                          if( $stmt2 === false ) {
                            die( print_r( sqlsrv_errors(), true));
                          } else {
                            echo '<option value="">Choisir un Titre</option>';  
                            while( $row = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC) ) {
                              echo '<option value="'.$row['ADP_SAL_CIVILITE'].'">'.$row['ADP_SAL_CIVILITE'].'</option>';
                            }
                          }
                        ?>
                            </select>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="preValide">
                        <label class="custom-control-label" for="same-address">Pré validation</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="validation">
                        <label class="custom-control-label" for="save-info">Validation</label>
                    </div>
                    <hr class="mb-4">
                    <input class="btn btn-primary btn-lg btn-block" type="submit" value="Ajouter">
                </form>
            </div>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; 2020-2021 GUCCI</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="home.php">Comptes</a></li>
                <li class="list-inline-item"><a href="index.html">Quitter</a></li>
            </ul>
        </footer>
    </div>

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