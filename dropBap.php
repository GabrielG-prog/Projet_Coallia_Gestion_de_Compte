<?php
    require 'database.php';
 
    if(!empty($_GET['mat'])) {
        $mat= $_GET['mat'];
    }

    if (!empty($_POST)) {
        $mat = $_POST['mat'];
               
        $sql = "DELETE FROM BAP_COMPTE_CONNECTION WHERE BAP_CONNECTION_MATRICULE='".$mat."'";
        $result = odbc_exec($connection, $sql);

        if($result) {
            header("Location: home.php");
        } else {
            echo 'Erreur SQL';
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
  <link rel="icon" href="../images/coallia-squarelogo-1408465071664.png">

  <title>GUCCI</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="styles.css" rel="stylesheet">
</head>

<body>
<?php include("navbar.php"); ?>

  <div class="container-fluid">
    <div class="row">
      
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">Supprimer un compte BAP</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
              <button class="btn btn-sm btn-outline-secondary">Partager</button>
              <button class="btn btn-sm btn-outline-secondary">Exporter</button>
            </div>
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
              <span data-feather="calendar"></span>
              Date
            </button>
          </div>
        </div>
        <br>
        <br>
        <form class="form" action="dropBap.php" method="post">
                <input type="hidden" name="mat" value="<?php echo $mat;?>"/>
                <p class="alert alert-warning">Etes vous sur de vouloir supprimer ?</p>
                <div class="form-actions">
                    <button type="submit" class="btn btn-outline-success">Oui</button>
                    <a class="btn btn-outline-danger" href="<?php echo 'viewBap.php?mat='.$mat;?>">Non</a>
                </div>
            </form>
      </main>
    </div>
  </div>
  
  <!-- Bootstrap core JavaScript -->

  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>

  <!-- Icons -->
  <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
  <script>
    feather.replace()
  </script>

</body>

</html>


           
 