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

                if(isset($_POST['cFonction'])){
                    
                    $cFonction = $_POST['cFonction'];
                    $grpAcheteur = 'AAA';

                    if(isset($_POST['$grpAcheteur'])){
                        $grpAcheteur = $_POST['grpAcheteur'];
                    } 

                    $request = "INSERT INTO Compte_SAP (Matricule, Login_SAP, MotdepasseSAP, CFonction, GrpAcheteur, Email, Nom, Prenom, Fonction_U, Telephone, C_SITE, C_Ut, Date_Last_Mail, Nbres_connexions, Dte_last_connexion )  
                    VALUES ('$mat', 'userigloo1', 'sapigloo', '$cFonction', '$grpAcheteur', '$email', '$nom', '$prenom', 'test', 'test', 'test', 'test', '20200101', 0, '20200101')";
                    $result = odbc_exec($connection1, $request);

                    if($result) {
                        header("Location: home.php");
                    } else {
                        echo 'Erreur INSERT';
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
                <h4 class="mb-3">Ajouter un compte Igloo</h4>
                <form action="<?php echo 'addIgloo.php?mat='.$mat;?>" method="post">
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
                            <label for="inputEmail4">Fonction</label>
                            <select class="form-control" name="cFonction">
                                <?php
                            $request2 = "SELECT DISTINCT CFonction
                            FROM Compte_SAP";
                            $result2 = odbc_exec($connection1, $request2);
                            $cfonctionTable = [];
                
                            if($result2){
                              while(odbc_fetch_row($result2)) {
                                $cfonctionTable[] = odbc_result($result2, 1);
                              }
                            }
                            echo '<option value="">Choisir un Titre</option>'; 
                           foreach ($cfonctionTable as $row) {
                              echo '<option value="'.$row.'">'.$row. '</option>';    
                           }
                        ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="email">Groupe acheteur</label>
                            <input type="text" class="form-control" name="grpAcheteur">
                        </div>
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