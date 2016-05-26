<?php
require "inc/db.php";
// Gestion du POST
$errorList = array();
// Si le formulaire a été soumis
if (!empty($_POST)) {

	$name = isset($_POST['studentName']) ? $_POST['studentName'] : '';
	$firstname = isset($_POST['studentFirstname']) ? $_POST['studentFirstname'] : '';
	$email = isset($_POST['studentEmail']) ? $_POST['studentEmail'] : '';
	$birthdate = isset($_POST['studentBirhtdate']) ? $_POST['studentBirhtdate'] : '';
	$cityID = isset($_POST['cit_id']) ? intval($_POST['cit_id']) : 0;
	$countryID = isset($_POST['cou_id']) ? intval($_POST['cou_id']) : 0;
	$maritalID = isset($_POST['mar_id']) ? intval($_POST['mar_id']) : 0;
	$sessionID = isset($_POST['ses_id']) ? intval($_POST['ses_id']) : 0;

	if (empty($name)) {
		$errorList[] = 'Le nom est vide';
	}
	if (empty($firstname)) {
		$errorList[] = 'Le prénom est vide';
	}
	if (empty($email)) {
		$errorList[] = 'L\'email est vide';
	}
	else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$errorList[] = 'L\'email est incorrect';
	}
	if (empty($birthdate)) {
		$errorList[] = 'La date de naissance est vide';
	}
	if (empty($cityID)) {
		$errorList[] = 'La ville est manquante';
	}
	if (empty($countryID)) {
		$errorList[] = 'La nationalité est manquante';
	}
	if (empty($maritalID)) {
		$errorList[] = 'Le statut marital est manquant';
	}

	if (empty($sessionID)) {
		$errorList[] = 'La session est manquante';
	}

	if (empty($errorList)) {
		$sql = "INSERT INTO student (stu_name, stu_firstname, stu_email, stu_birthdate, cit_id, cou_id, mar_id, ses_id)
	VALUES (:name, :firstname, :email, :birthdate, :cityID, :countryID, :maritalID, :sessionID )";

	$pdoStatement = $pdo->prepare($sql);
	$pdoStatement -> bindValue(':name', $name);
	$pdoStatement -> bindValue(':firstname', $firstname);
	$pdoStatement -> bindValue(':email', $email);
	$pdoStatement -> bindValue(':birthdate', $birthdate);
	$pdoStatement -> bindValue(':cityID', $cityID);
	$pdoStatement -> bindValue(':countryID', $countryID);
	$pdoStatement -> bindValue(':maritalID', $maritalID);
	$pdoStatement -> bindValue(':sessionID', $sessionID);
	
	if ($pdoStatement -> execute() === false) {
	// J'affiche le tableau de debug de PDO
	print_r($pdo->errorInfo());
	}
	else if ($pdoStatement->rowCount() > 0) {
	echo "insere dans db";
	//print_r($resList);
	}
}


	else{
		print_r($errorList);
	}
	// Sinon, afficher le contenu du tableau $errorList dans view.php
}




$etudiantListe = array();
$citiesList = array(
	1 => 'Luxembourg',
	2 => 'Longwy',
	3 => 'Esch-sur Alzette',
	4 => 'Verdun',
	5 => 'Arlon',
	6 => 'Leudelange',
	7 => 'Pissange',
	8 => 'Metz',
	9 => 'Bruxelles',
	10 => 'Rodange',
	11 => 'Pétange',
);
$countriesList = array(
	1 => 'France',
	2 => 'Luxembourg',
	3 => 'Belgique',
	4 => 'Chine',
	6 => 'Allemagne',
);
$maritalStatusList = array(
	1 => 'Célibataire',
	2 => 'Marié(e)',
	3 => 'Divorcé(e)',
	4 => 'Veuf/veuve',
);

$sessionList = array(
	1=> '1',
	2=> '2',
	3=> '3',
);




$dsn = 'mysql:dbname=webforce3; host=localhost;charset=utf8';
$pdo = new PDO($dsn, 'root', 'wf3');


$sql = '
	SELECT stu_id, stu_name, stu_firstname, cou_name, cit_name, mar_name, stu_email, stu_birthdate AS birthdate
FROM student
LEFT OUTER JOIN country ON country.cou_id = student.cou_id
LEFT OUTER JOIN city ON city.cit_id = student.cit_id
LEFT OUTER JOIN marital_status ON marital_status.mar_id = student.mar_id
';

$pdoStatement = $pdo->query($sql);
if ($pdoStatement === false) {
	print_r($pdo->errorInfo());
}
else if ($pdoStatement->rowCount() > 0) {
	$etudiantListe = $pdoStatement-> fetchAll();
}



require 'inc/header.php';
require 'inc/add_view.php';
require 'inc/footer.php';
?>
