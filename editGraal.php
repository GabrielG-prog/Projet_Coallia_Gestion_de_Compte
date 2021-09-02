<?php
        require 'database.php';

        $mat='';
        if(isset($_GET["mat"])) {

          $mat = $_GET["mat"];

          $noUt = 0;
          $role = '';

          if(!empty($_POST)) {

            $noUt = $_POST['noUt'];
            $role = $_POST['role'];

            $sql = "UPDATE GRAAL.dbo.Compte 
            SET NoUt = ?, GRAAL.dbo.Compte.Role = ? 
            WHERE Matricule = ?";
            $params = array($noUt, $role, $mat);
            $stmt = sqlsrv_query( $conn, $sql, $params);

            if( $stmt === false ) {
                die( print_r( sqlsrv_errors(), true));
            } else {
              echo "<script>alert(\"Compte modifié\")</script>";
              header("Location: home.php");
            }

          } else {

            $sql1 = "SELECT GRAAL.Nom, GRAAL.Prenom, GRAAL.Email, GRAAL.NoUt, GRAAL.Role
            FROM GRAAL.dbo.Compte AS GRAAL
            WHERE GRAAL.Matricule = ?";
            $params1 = array($mat);
            $stmt1 = sqlsrv_query( $conn, $sql1, $params1);

            if( $stmt1 === false ) {
                die( print_r( sqlsrv_errors(), true));
            } else {
                
                while( $item = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) {
                    $nom = $item['Nom'];
                    $prenom = $item['Prenom'];
                    $email = $item['Email'];
                    $noUt = $item['NoUt'];
                    $role = $item['Role'];
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
                <h4 class="mb-3">Modifier un compte GRAAL</h4>
                <form action="<?php echo 'editGraal.php?mat='.$mat;?>" method="post">
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
                            <label for="country">N°UT</label>
                            <select class="custom-select d-block w-100" name="noUt">
                                <?php
                          $sql2 = "SELECT DISTINCT CodeUt, UtLib  
                          FROM OSCAR.dbo.Ut";
                          $stmt2 = sqlsrv_query( $conn, $sql2);
                
                          if( $stmt2 === false ) {
                            die( print_r( sqlsrv_errors(), true));
                          } else {
                            while( $row2 = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC) ) {
                              if($noUt == $row2['CodeUt']){
                                echo '<option selected="selected" value="'.$row2['CodeUt'].'">'.$row2['CodeUt'].' - '.$row2['UtLib'].'</option>';
                              }else {
                                echo '<option value=""></option>';  
                                echo '<option value="'.$row2['CodeUt'].'">'.$row2['CodeUt'].' - '.$row2['UtLib'].'</option>';
                              }
                            }
                          }
                        ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="state">Rôle</label>
                            <select class="custom-select d-block w-100" name="role">
                                <?php
                          $sql3 = "SELECT DISTINCT [RL_ROLE]
                          FROM [GRAAL].[dbo].[Role]";
                          $stmt3 = sqlsrv_query($conn, $sql3);
                          if( $stmt3 === false ) {
                            die( print_r( sqlsrv_errors(), true));
                          } else {
                            while( $row3 = sqlsrv_fetch_array( $stmt3, SQLSRV_FETCH_ASSOC) ) {
                              if($role == $row3['RL_ROLE']) {
                                echo '<option selected="selected" value="'.$row3['RL_ROLE'].'">'.$row3['RL_ROLE'].'</option>';
                                echo'a';
                              }else{
                                echo '<option value=""></option>';  
                                echo '<option value="'.$row3['RL_ROLE'].'">'.$row3['RL_ROLE'].'</option>';
                                echo'b';
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