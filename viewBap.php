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
                <h3 class="masthead-brand">Voir un compte BAP</h3>
                <nav class="nav nav-masthead justify-content-center">
                    <a class="nav-link active" href="home.html">Les comptes</a>
                </nav>
            </div>
        </header>

        <main role="main" class="container">
            <div class="admin">
            <?php
         require 'database.php';
 
         if (isset($_GET["mat"])) {
 
           $mat = $_GET["mat"];
 
             $request = "SELECT DISTINCT BAP_CONNECTION_MATRICULE, BAP_CONNECTION_NoM, BAP_CONNECTION_PRENOM, BAP_CONNECTION_NoUnite, BAP_CONNECTION_Qualif, BAP_CONNECTION_Mail, BAP_CONNECTION_TITRE, BAP_CONNECTION_DROIT_GENERAL, BAP_CONNECTION_SOCIETE, BAP_CONNECTION_TOT_CONNEXION, BAP_CONNECTION_PRE_VALIDATION, BAP_CONNECTION_VALIDATION 
             FROM BAP_COMPTE_CONNECTION
             WHERE BAP_CONNECTION_MATRICULE='".$mat."'";
             $result = odbc_exec($connection, $request);
 
             if($result){
               while(odbc_fetch_row($result)) {
        ?>
            <h1 class="cover-heading"><?php echo ' '.odbc_result($result, 2);?> <?php echo '  '.odbc_result($result, 3);?>
            </h1>
            <h4><?php echo '  '.odbc_result($result, 6);?></h4>
            <h3><?php echo ' '.odbc_result($result, 1);?></h3>
            <br>
            <h4>N°UT : <?php echo '  '.odbc_result($result, 4);?></h4>
            <h4>Qualification : <?php echo '  '.odbc_result($result, 5);?></h4>
            <h4>Titre : <?php echo '  '.odbc_result($result, 7);?></h4>
            <h4>Droit Général : <?php echo '  '.odbc_result($result, 8);?></h4>
            <h4>Societe : <?php echo '  '.odbc_result($result, 9);?></h4>
            <h4>Tot connexion : <?php echo '  '.odbc_result($result, 10);?></h4>
            <h4>Pré validation : <?php echo '  '.odbc_result($result, 11);?></h4>
            <h4>Validation : <?php echo '  '.odbc_result($result, 12);?></h4>
            <br>
            <p class="lead">
                <a href="<?php echo 'editBap.php?mat='.$mat;?>" class="btn btn-lg btn-secondary">Modifier</a>
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
                <p><a href="<?php echo 'dropBap.php?mat='.$mat;?>">supprimer</a></p>
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