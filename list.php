<?php
//je cree PDO
require 'inc/db.php';
//recuperer le ses id via get
if (!empty($_GET['ses_id'])) {
	$sessionID = $_GET['ses_id'];

	//print_r($_GET);

	$nbPerPage = 5;
	$currentOffset = 0;
	$currentPage = 1;

	if(array_key_exists('page', $_GET)){
		$currentPage = intval($_GET['page']);
		$currentOffset = ($currentPage-1) * $nbPerPage;
	}

	$sql = '
		SELECT stu_id, stu_name, stu_firstname, cou_name, cit_name, mar_name, stu_email, stu_birthdate AS birthdate
		FROM student
		LEFT OUTER JOIN country ON country.cou_id = student.cou_id
		LEFT OUTER JOIN city ON city.cit_id = student.cit_id
		LEFT OUTER JOIN marital_status ON marital_status.mar_id = student.mar_id
		WHERE ses_id = :session
		LIMIT :offset,:nbPerPage
	';
	$pdoStatement = $pdo->prepare($sql);
	//je donne la valeur de la requete
	$pdoStatement->bindValue(':session', $sessionID, PDO::PARAM_INT);
	$pdoStatement->bindValue(':nbPerPage', $nbPerPage, PDO::PARAM_INT);
	$pdoStatement->bindValue(':offset', $currentOffset, PDO::PARAM_INT);

	// Si erreur
	if ($pdoStatement->execute() === false) {
		print_r($pdo->errorInfo());
	}
	else if ($pdoStatement->rowCount() > 0) {
		$etudiantListe = $pdoStatement->fetchAll();
	}
}
require 'inc/header.php';
require 'inc/list_view.php';
require 'inc/footer.php';
?>