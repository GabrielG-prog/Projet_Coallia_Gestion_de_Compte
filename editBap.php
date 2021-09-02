<?php
        require 'database.php';

        $mat='';
        if(isset($_GET["mat"])) {

          $mat = $_GET["mat"];

            $unite = ''; 
            $qualif = ''; 
            $droitG = ''; 
            $droitValide = '';
            $droitConsulte = '';
            $societe = ''; 
            $totcO = 0; 
            $preValide = 0; 
            $validation = 0;

          if(!empty($_POST)) {
                    $unite = $_POST['unite']; 
                    $qualif = $_POST['qualif'];
                    $droitG = count($_POST['droitG']) == 1 ? $_POST['droitG'][0] : implode('æ', $_POST['droitG']); 
                    $droitValide = $_POST['droitValide'];
                    $droitConsulte = $_POST['droitConsulte'];
                    $societe = $_POST['societe']; 
                    $totcO = $_POST['totcO']; 
                    $preValide = (isset($_POST['preValide'])) ? 1 : 0; 
                    $validation = (isset($_POST['validation'])) ? 1 : 0;

            $request = "UPDATE BAP_COMPTE_CONNECTION 
            SET BAP_CONNECTION_NoUnite ='".$unite."', BAP_CONNECTION_Qualif ='".$qualif."', BAP_CONNECTION_DROIT_GENERAL ='".$droitG."', 
            BAP_CONNECTION_DROIT_VALIDER ='".$droitValide."', BAP_CONNECTION_DROIT_CONSULTER ='".$droitConsulte."', BAP_CONNECTION_SOCIETE ='".$societe."', 
            BAP_CONNECTION_TOT_CONNEXION ='".$totcO."', BAP_CONNECTION_PRE_VALIDATION ='".$preValide."', BAP_CONNECTION_VALIDATION ='".$validation."'
            WHERE BAP_CONNECTION_MATRICULE ='".$mat."' ";
             $result = odbc_exec($connection, $request);

             if($result) {
              echo "<script>alert(\"Compte modifié\")</script>";
                header("Location: home.php");
             } else {
                 echo 'Erreur INSERT';
             }

          } else {

            $request1 = "SELECT DISTINCT BAP_CONNECTION_MATRICULE, BAP_CONNECTION_Nom, BAP_CONNECTION_PRENOM, BAP_CONNECTION_NoUnite, 
            trim(BAP_CONNECTION_Qualif), BAP_CONNECTION_Mail, trim(BAP_CONNECTION_DROIT_GENERAL), BAP_CONNECTION_DROIT_VALIDER, BAP_CONNECTION_DROIT_CONSULTER, 
            BAP_CONNECTION_SOCIETE, BAP_CONNECTION_TOT_CONNEXION, BAP_CONNECTION_PRE_VALIDATION, BAP_CONNECTION_VALIDATION 
            FROM BAP_COMPTE_CONNECTION
            WHERE BAP_CONNECTION_MATRICULE='".$mat."'";
            $result1 = odbc_exec($connection, $request1);

            if($result1){
              while(odbc_fetch_row($result1)) {
                $nom = odbc_result($result1, 2);
                $prenom = odbc_result($result1, 3);
                $unite = odbc_result($result1, 4); 
                $qualif = odbc_result($result1,5);
                $email = odbc_result($result1, 6);
                $droitG = odbc_result($result1, 7); 
                $droitValide =odbc_result($result1, 8);
                $droitConsulte = odbc_result($result1, 9);
                $societe = odbc_result($result1, 10); 
                $totcO = odbc_result($result1, 11); 
                $preValide = odbc_result($result1, 12); 
                $validation = odbc_result($result1, 13);
              }
            } else {
                echo'Erreur SQL';
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
                <h4 class="mb-3">Modifier un compte BAP</h4>
                <form action="<?php echo 'editBap.php?mat='.$mat;?>" method="post">
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
                        <input type="number" class="form-control" name="totcO" value="<?php echo $totcO;?>">
                    </div>
                    <div class="mb-3">
                        <label for="email">Societe</label>
                        <input type="number" class="form-control" name="societe" value="<?php echo $societe;?>">
                    </div>
                    <hr class="mb-4">
                    <div class="row">
                        <div class="col">
                            <label for="country">N°UT</label>
                            <select class="custom-select d-block w-100" name="unite">
                                <?php
                          $sql = "SELECT DISTINCT UT, NomUT
                          FROM Structures_AFTAM.dbo.S_UT 
                          WHERE UT is not null";
                          $stmt = sqlsrv_query( $conn, $sql);
                
                          if( $stmt === false ) {
                            die( print_r( sqlsrv_errors(), true));
                          } else {
                            while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                              if($unite == $row['UT']) {
                                echo '<option value="'.$row['UT'].'" selected>'.$row['UT'].' - '.$row['NomUT'].'</option>';
                              } else {
                                echo '<option value="'.$row['UT'].'">'.$row['UT'].' - '.$row['NomUT'].'</option>';
                              }
                            }
                          }
                        ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="country">Qualification</label>
                            <select class="custom-select d-block w-100" name="qualif">
                                <?php
                          $sql1 = "SELECT DISTINCT REPLACE (ADP_SAL_QUAL_CODE, ' ', '' ) AS QUAL_CODE, ADP_SAL_QUAL_TEXT
                          FROM SI_RH.dbo.Salaries_ADP_Imp_Jour
                          WHERE ADP_SAL_QUAL_CODE is not null";
                          $stmt1 = sqlsrv_query( $conn, $sql1);
                          
                          if( $stmt1 === false ) {
                            die( print_r( sqlsrv_errors(), true));
                          } else {
                            while( $row1 = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) {

                              if($row1['QUAL_CODE'] == $qualif) {
                                echo '<option value="'.$row1['QUAL_CODE'].'" selected>'.$row1['QUAL_CODE'].' - '.$row1['ADP_SAL_QUAL_TEXT'].'</option>';
                              } else {
                                echo '<option value="'.$row1['QUAL_CODE'].'">'.$row1['QUAL_CODE'].' - '.$row1['ADP_SAL_QUAL_TEXT'].'</option>';
                              }
                            }
                          }
                        ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="state">Droit Général</label>
                            <select multiple class="custom-select d-block w-100" name="droitG[]">
                                <?php
                                $request2 = "SELECT DISTINCT trim(AFF_CODE)
                                FROM AFFECTATION
                                WHERE AFF_CODE is not null";
                                $result2 = odbc_exec($connection, $request2);

                                if($result2) {
                                $affTable = [];
                                while(odbc_fetch_row($result2)) {
                                    $affTable[] = odbc_result($result2, 1);
                                }

                                foreach($affTable as $aff) {
                                    if($droitG == $aff) {
                                    echo '<option value="'.$aff.'" selected>'.$aff.'</option>';
                                    } else {
                                    echo '<option value="'.$aff.'">'.$aff.'</option>';
                                    }
                                }  
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <div class="custom-control custom-checkbox">
                        <?php
                        if(!$preValide) {
                        echo'<input type="checkbox" class="custom-control-input" name="preValide">';
                        }else {
                        echo '<input type="checkbox" class="custom-control-input" name="preValide" checked>';
                        }
                        ?>
                        <label class="custom-control-label" for="same-address">Pré validation</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <?php
                    if(!$validation) {
                    echo'<input type="checkbox" class="custom-control-input" name="validation">';
                    }else {
                    echo '<input type="checkbox" class="custom-control-input" name="validation" checked>';
                    }
                    ?>
                        <label class="custom-control-label" for="save-info">Validation</label>
                    </div>
                    <hr class="mb-4">
                    <input class="btn btn-primary btn-lg btn-block" type="submit" value="Modifier">
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