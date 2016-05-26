<?php
//je cree PDO
require 'inc/db.php';
//print_r($_GET);

if(!empty($_GET['search'])){
	$research=($_GET['search']);
}

//ici est le code de la recherche
$etudiantListe = array(); //variable a remplir

$nbPerPage = 5;
$currentOffset = 0;
$currentPage = 1;

$sql = '
		SELECT stu_id, stu_name, stu_firstname, cou_name, cit_name, mar_name, stu_email, stu_birthdate AS birthdate
		FROM student
		LEFT OUTER JOIN country ON country.cou_id = student.cou_id
		LEFT OUTER JOIN city ON city.cit_id = student.cit_id
		LEFT OUTER JOIN marital_status ON marital_status.mar_id = student.mar_id
		WHERE stu_name LIKE :research
		OR stu_id LIKE :research
		OR stu_firstname LIKE :research
		OR cou_name LIKE :research
		OR cit_name LIKE :research
		OR mar_name LIKE :research
		OR stu_email LIKE :research
		OR stu_birthdate LIKE :research
	';

$pdoStatement = $pdo->prepare($sql);
$pdoStatement->bindValue(':research', "%$research%");

	// Si erreur
	if ($pdoStatement->execute() === false) {
		print_r($pdo->errorInfo());
	}
	else if ($pdoStatement->rowCount() > 0) {
		$etudiantListe = $pdoStatement->fetchAll();
		//print_r($etudiantListe);
	}



require 'inc/header.php';
require 'inc/list_view.php';
require 'inc/footer.php';