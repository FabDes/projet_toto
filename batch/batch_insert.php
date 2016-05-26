<?php
require '../inc/db.php';
require 'students_session2.php';
/*
$sql = '
	SELECT stu_email
	FROM student
'
$pdoStatement = $pdo->query($sql);

if(empty($pdoStatement)){
	$name = isset($_POST['name']) ? $_POST['name'] : '';
	$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
	$email = isset($_POST['email']) ? $_POST['email'] : '';
	$birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : '';
	$sex = isset($_POST['sex']) ? intval($_POST['sex']) : 0;
	$with_experience = isset($_POST['with_experience']) ? intval($_POST['with_experience']) : 0;
	$is_leader = isset($_POST['is_leader']) ? intval($_POST['is_leader']) : 0;
}
*/

$sql = '
	INSERT INTO  student(
	stu_name,
	stu_firstname,
	stu_email,
	stu_birthdate,
	stu_sex,
	stu_with_expereince,
	stu_is_leader,
	)

	VALUES (
	:name,
	:firstname,
	:birthdate,
	:email,
	:sex,
	:with_experience,
	:is_leader
	)
'

$pdoStatement = $pdo->prepare($sql);
$pdoStatement -> bindValue(':name', $name);
$pdoStatement -> bindValue(':firstname', $firstname);
$pdoStatement -> bindValue(':email', $email);
$pdoStatement -> bindValue(':birthdate', $birthdate);
$pdoStatement -> bindValue(':sex', $sex);
$pdoStatement -> bindValue(':with_experience', $with_experience);
$pdoStatement -> bindValue(':is_leader', $is_leader);

if ($pdoStatement -> execute() === false) {
	// J'affiche le tableau de debug de PDO
	print_r($pdo->errorInfo());
	}
	else if ($pdoStatement->rowCount() > 0) {
	echo "insere dans db";
	//print_r($resList);
	}
}
/*
On veut insérer la liste complète des étudiants de la session 2 dans la table student.
On dispose de certaines informations dans le tableau se trouvant dans students_session2.php.
Cependant, des étudiants sont déjà renseignés dans la table student. Il ne faut donc ajouter que les étudiants n'y figurant pas.
Pour savoir si un étudiant est déjà dans la table, on se basera sur le champ "email".
D'ailleurs, pour plus de sécurité, on va ajouter un attribut d'unicité sur ce champ, dans la table student.

Copiez ces 2 fichiers dans un répertoire batch de votre projet Toto, puis éditez ce fichier pour effectuer les insertions en DB.
*/



// A vous de jouer ^^