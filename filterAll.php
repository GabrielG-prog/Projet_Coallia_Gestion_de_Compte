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
    <main role="main" class="container">
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
                    </tr>
                </thead>
                <tbody>
                <?php

require 'database.php';

$sql = "SELECT SI_RH.ADP_SAL_MAT, SI_RH.ADP_SAL_NOM, SI_RH.ADP_SAL_PRENOM, SI_RH.ADP_SAL_MAIL_COALLIA, OSCAR.Cpte_Matricule, GRAAL.Matricule 
FROM SI_RH.dbo.Salaries_ADP_Imp_Jour AS SI_RH 
LEFT JOIN OSCAR.dbo.Compte AS OSCAR ON SI_RH.ADP_SAL_MAT = OSCAR.Cpte_Matricule
LEFT JOIN GRAAL.dbo.Compte AS GRAAL ON SI_RH.ADP_SAL_MAT = GRAAL.Matricule
ORDER BY SI_RH.ADP_SAL_MAT";
    
$stmt = sqlsrv_query( $conn, $sql);

if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
} else {

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

        foreach($dataHfsql as $mat) {
            if($row["ADP_SAL_MAT"] == $mat) {
                $isBAP = true;
                $matBAP = $mat;
            }
        }

        $isIGLOO = false;
        $matIGLOO = '';

        foreach($dataHfsql1 as $mat1) {
          if($row["ADP_SAL_MAT"] == $mat1) {
              $isIGLOO = true;
              $matIGLOO = $mat1;
          }
      }

        if($row["Cpte_Matricule"] && $row["Matricule"] && $isBAP && $isIGLOO) {
            echo '<tr>';
            echo '<td>'.$row["ADP_SAL_MAT"].'</td>';
            echo '<td>'.$row["ADP_SAL_NOM"].'</td>';
            echo '<td>'.$row["ADP_SAL_PRENOM"].'</td>';
            echo '<td>'.$row["ADP_SAL_MAIL_COALLIA"].'</td>';
            echo '<td class="table-success"><a href="viewOscar.php?mat='.$row['Cpte_Matricule'].'"><span data-feather="user-check"></span></a></td>';
            echo '<td class="table-success"><a href="viewGraal.php?mat='.$row['Matricule'].'"><span data-feather="user-check"></span></a></td>';
            echo '<td class="table-success"><a href="viewBap.php?mat='.$matBAP.'"><span data-feather="user-check"></span></a></td>';
            echo '<td class="table-success"><a href="viewIgloo.php?mat='.$matIGLOO.'"><span data-feather="user-check"></span></a></td>';
            echo '</tr>';
        }
    }
}
?> 
                </tbody>
            </table>
        </div>
    </main>
    <br>
    <?php include("footer.php"); ?>
</body>

</html>