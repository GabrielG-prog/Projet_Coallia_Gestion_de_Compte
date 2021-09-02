<?php
include ('./database.php');
        
$select = $pdo->prepare('
SELECT *
FROM clients_gites
');

$select->setFetchMode(PDO::FETCH_ASSOC);
$select->execute();

$newReservations = $select->fetchAll();

$excel = "";
$excel .=  "Id\tNom\tPrénom\tAdresse\tCode postal\tVille\tPays\tMail\tTéléphone\n";

foreach($newReservations as $row) {
    $excel .= "$row[id_client]\t$row[nom_client]\t$row[prenom_client]\t$row[adresse_client]\t$row[cp_client]\t$row[ville_client]\t$row[pays_client]\t$row[mail_client]\t$row[tel_client]\n";
}

header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=csvOscar.xls");

print $excel;
exit;

?>