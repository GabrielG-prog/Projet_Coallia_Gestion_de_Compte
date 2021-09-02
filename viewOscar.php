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
    <link href="viewStyle.css" rel="stylesheet">
</head>

<body class="text-center">

    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
            <div class="inner">
                <h3 class="masthead-brand">Voir un compte GRAAL</h3>
                <nav class="nav nav-masthead justify-content-center">
                    <a class="nav-link active" href="home.html">Les comptes</a>
                </nav>
            </div>
        </header>

        <main role="main" class="container">
            <div class="admin">
            <?php
        require 'database.php';

        $mat='';
        if(isset($_GET["mat"])) {

          $mat = $_GET["mat"];

          $sql = "SELECT OSCAR.Cpte_Matricule, OSCAR.Cpte_Nom, OSCAR.Cpte_Prenom, OSCAR.Cpte_Email, OSCAR.Cpte_Service, OSCAR.Cpte_Fonction, OSCAR.Cpte_DUT, OSCAR.Cpte_Region 
            FROM OSCAR.dbo.Compte AS OSCAR
            WHERE OSCAR.Cpte_Matricule = ?";
          $params = array($mat);
          $stmt = sqlsrv_query( $conn, $sql, $params);

          if( $stmt === false ) {
            die( print_r( sqlsrv_errors(), true));
          } else {
            while( $item = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        ?>
            <h1 class="cover-heading"><?php echo ' '.$item['Cpte_Nom'];?> <?php echo '  '.$item['Cpte_Prenom'];?>
            </h1>
            <h4><?php echo '  '.$item['Cpte_Email'];?></h4>
            <h3><?php echo ' '.$item['Cpte_Matricule'];?></h3>
            <br>
            <h4>Service : <?php echo '  '.$item['Cpte_Service'];?></h4>
            <h4>Fonction : <?php echo '  '.$item['Cpte_Fonction'];?></h4>
            <h4>UT : <?php echo '  '.$item['Cpte_DUT'];?></h4>
            <h4>Region : <?php echo '  '.$item['Cpte_Region'];?></h4>
            <br>
            <p class="lead">
                <a href="<?php echo 'editOscar.php?mat='.$mat;?>" class="btn btn-lg btn-secondary">Modifier</a>
            </p>
            <?php
            }
          }
        }
        ?>
        </div>
        </main>

        <footer class="mastfoot mt-auto">
            <div class="inner">
                <p><a href="<?php echo 'dropOscar.php?mat='.$mat;?>">Supprimer</a></p>
            </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>