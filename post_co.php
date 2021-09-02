<?php

if (isset($_POST['inputEmail']) && isset($_POST['inputPassword'])) {

    //require 'php/database.php';

    $login = $_POST['inputEmail'];
    $mdp = $_POST['inputPassword'];

    /*$requete = "SELECT gucci_utilisateur_email, gucci_utilisateur_mdp FROM GUCCI.dbo.gucci_utilisateur WHERE gucci_utilisateur_email= ? AND gucci_utilisateur_mdp= ?";
    $params = array($login, $mdp);
    $stmt = sqlsrv_query( $conn, $sql, $params );
    
    if( $stmt === false) {
        die( print_r( sqlsrv_errors(), true) );
    } else {
        session_start();
        $_SESSION['inputEmail'] = $login;
        $_SESSION['inputPassword'] = $mdp;
            
        header("Location: php/accounts.php");
    }*/

    if($login === 'test.test@coallia.org' && $mdp === 'aaa') {
        header("Location: home.php");
    }else {
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
    <link href="viewStyle.css" rel="stylesheet">
</head>

<body class="text-center">

    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
            <div class="inner">
                <h3 class="masthead-brand">Voir un compte OSCAR</h3>
                <nav class="nav nav-masthead justify-content-center">
                    <a class="nav-link active" href="home.html">Retour</a>
                </nav>
            </div>
        </header>

        <main role="main" class="inner cover">

            <h1 class="cover-heading">Erreur</h1>
            <h3>Email et/ou mot de passe non valide</h3>
            <p class="lead">
                <a href="index.html" class="btn btn-lg btn-secondary">Retour</a>
            </p>
        </main>

        <footer class="mastfoot mt-auto">
            <div class="inner">
                <p>Cover <a href="https://getbootstrap.com/">Bootstrap</a>.</p>
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
<?php    
    }
} 
?>