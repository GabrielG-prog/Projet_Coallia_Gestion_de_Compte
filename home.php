<?php

  require 'database.php';

  // On détermine sur quelle page on se trouve
  if(isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPage = (int) strip_tags($_GET['page']);
  }
  else {
    $currentPage = 1;
  }

  // On détermine le nombre total de salarié
  $sqlcount = "SELECT COUNT (*) AS nb_salarie FROM SI_RH.dbo.Salaries_ADP_Imp_Jour";
  $stmtCount = sqlsrv_query( $conn,  $sqlcount );
  $rowCount = sqlsrv_fetch_array( $stmtCount, SQLSRV_FETCH_ASSOC);
  $nbSalarie = (int) $rowCount['nb_salarie'];
  
  // On détermine le nombre d'articles par page
  $perPage = 250;

  // On calcule le nombre de pages total
  $nbPage = ceil($nbSalarie / $perPage);
  
  sqlsrv_free_stmt( $stmtCount);
  // Mise en place de la pagination
  
  /*$pageCalc = ($currentPage-1)*$perPage;*/
  $pageCalc = ($currentPage * $perPage) - $perPage;

  $sql = "SELECT SI_RH.ADP_SAL_MAT, SI_RH.ADP_SAL_NOM, SI_RH.ADP_SAL_PRENOM, SI_RH.ADP_SAL_MAIL_COALLIA, OSCAR.Cpte_Matricule, GRAAL.Matricule 
  FROM SI_RH.dbo.Salaries_ADP_Imp_Jour AS SI_RH 
  LEFT JOIN OSCAR.dbo.Compte AS OSCAR ON SI_RH.ADP_SAL_MAT = OSCAR.Cpte_Matricule
  LEFT JOIN GRAAL.dbo.Compte AS GRAAL ON SI_RH.ADP_SAL_MAT = GRAAL.Matricule
  WHERE SI_RH.ADP_SAL_SORTIE_DTE IS NULL
  ORDER BY SI_RH.ADP_SAL_MAT 
  OFFSET ? ROWS
  FETCH NEXT ? ROWS ONLY";

  $params = array($pageCalc, $perPage);
    
  $stmt = sqlsrv_query( $conn, $sql, $params );
  
  if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
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
  <main role="main" class="container-fluid">
    <div class="jumbotron">
      <div class="row">
        <div class="col">
          <div class="text-center">
            <img src="./images/COALLIA-270x180.jpg" class="rounded" alt="logo">
          </div>
        </div>
        <div class="col">
          <h1 class="display-4">GUCCI</h1>
          <p class="lead">Gestion des comptes des applications de Coallia.</p>
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
            <th>OSCAR</th>
            <th>GRAAL</th>
            <th>BAP</th>
            <th>IGLOO</th>
            <th>AD</th>
            <th>Click</th>
            <th>SAP</th>
            <th>SALSA</th>
            <th>ORA</th>
          </tr>
        </thead>
        <tbody>
          <?php
              $request = "SELECT BAP_CONNECTION_MATRICULE FROM BAP_COMPTE_CONNECTION";
              $result = odbc_exec($connection, $request);
              $dataHfsql = [];

              while(odbc_fetch_row($result)) {
                $dataHfsql[] = odbc_result($result, 1);
              }

              $request1 = "SELECT Matricule FROM Compte_SAP";
              $result1 = odbc_exec($connection1, $request1);
              $dataHfsql1 = [];

              while(odbc_fetch_row($result1)) {
                $dataHfsql1[] = odbc_result($result1, 1);
              }
            
              while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $isBAP = false;
                $matBAP = '';
                $isIGLOO = false;
                $matIGLOO = '';

                echo '<tr>';
                echo '<td>'.$row["ADP_SAL_MAT"].'</td>';
                echo '<td>'.$row["ADP_SAL_NOM"].'</td>';
                echo '<td>'.$row["ADP_SAL_PRENOM"].'</td>';
                echo '<td>'.$row["ADP_SAL_MAIL_COALLIA"].'</td>';
  
                if($row["Cpte_Matricule"]) {
                  echo '<td class="table-success"><a href="viewOscar.php?mat='.$row['Cpte_Matricule'].'"><span data-feather="user-check"></span></a></td>';
                } else {
                  echo '<td class="table-danger"><a href="addOscar.php?mat='.$row['ADP_SAL_MAT'].'"><span data-feather="user-x"></span></a></td>';
                }

                if($row["Matricule"]) {
                  echo '<td class="table-success"><a href="viewGraal.php?mat='.$row['Matricule'].'"><span data-feather="user-check"></span></a></td>';
                } else {
                  echo '<td class="table-danger"><a href="addGraal.php?mat='.$row['ADP_SAL_MAT'].'"><span data-feather="user-x"></span></a></td>';
                }

                foreach($dataHfsql as $mat) {
                  if($row["ADP_SAL_MAT"] == $mat) {
                    $isBAP = true;
                    $matBAP = $mat;
                  }
                }

                if($isBAP) {
                  echo '<td class="table-success"><a href="viewBap.php?mat='.$matBAP.'"><span data-feather="user-check"></span></a></td>';
                } else {
                  echo '<td class="table-danger"><a href="addBap.php?mat='.$row['ADP_SAL_MAT'].'"><span data-feather="user-x"></span></a></td>';
                }

                foreach($dataHfsql1 as $mat) {
                  if($row["ADP_SAL_MAT"] == $mat) {
                    $isIGLOO = true;
                    $matIGLOO = $mat;
                  }
                }

                if($isIGLOO) {
                  echo '<td class="table-success"><a href="viewIgloo.php?mat='.$matIGLOO.'"><span data-feather="user-check"></span></a></td>';
                } else {
                  echo '<td class="table-danger"><a href="addIgloo.php?mat='.$row['ADP_SAL_MAT'].'"><span data-feather="user-x"></span></a></td>';
                }
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</tr>';
              }
            ?>
        </tbody>
      </table>
    </div>
    <br>
    <nav>
      <ul class="pagination justify-content-center">
        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
          <a href="./?page=<?= $currentPage - 1 ?>" class="page-link pag">
            <</a> </li> <?php for($page = 1; $page <= $nbPage; $page++): ?> <li
              class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
              <a href="?page=<?= $page ?>" class="page-link pag"><?= $page ?></a>
        </li>
        <?php endfor ?>
        <li class="page-item <?= ($currentPage == $nbPage) ? "disabled" : "" ?>">
          <a href="?page=<?= $currentPage + 1 ?>" class="page-link pag">></a>
        </li>
      </ul>
    </nav>
  </main>
  <br>
  <?php include("footer.php"); ?>
</body>

</html>