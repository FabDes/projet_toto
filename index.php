<?php

//connection DB
$dsn = 'mysql:dbname=webforce3;host=localhost; charset=utf8';
$pdo = new PDO($dsn, 'root', 'wf3');

//requete
$sql = '
SELECT ses_opening, ses_ending, ses_id
FROM session
';
$pdoStatement = $pdo->query($sql);

//si error
if ($pdoStatement===false) {
	print_r($pdo->errorInfo());
}else{
	//je recupere les donnees
	$sessionList = $pdoStatement->fetchAll();
	echo '<pre>';
	//print_r($sessionList);
	echo '</pre>';
}

$etudiantsParVille = array();

$sql = '
	SELECT COUNT(stu_id) AS stu_nbr,
	  city.cit_name
	FROM
	  student
	INNER JOIN
	  city ON city.cit_id = student.cit_id
	  
	GROUP BY cit_name
	';

$pdoStatement = $pdo->query($sql);

	// Si erreur
if ($pdoStatement->execute() === false) {
	print_r($pdo->errorInfo());
}
else if ($pdoStatement->rowCount() > 0) {
	$etudiantsParVille = $pdoStatement->fetchAll();
	//print_r($etudiantsParVille);
}

//affiche page
require 'inc/header.php';
require 'inc/index_view.php';
require 'inc/footer.php';
