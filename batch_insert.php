<?php
/*

DEBUT
je parcours le tableau des étudiants, pour chaque étudiant $currentEtudiant,
	j'écris une requête "SELECT" qui me retourne l'id d'un étudiant ayant l'email de l'étudiant $currentEtudiant
	j'exécute ma requête
	
	si j'ai au moins un résultat
		alors j'affiche "étudiant existant"
	sinon
		j'écris une requête (préparée) d'insertion dans la table, avec les valeurs de $currentEtudiant
		j'exécute la requête
		j'affiche "étudiant inséré en DB"
	fin du "si"	
fin de la boucle de parcours
FIN



On veut insérer la liste complète des étudiants de la session 2 dans la table student.
On dispose de certaines informations dans le tableau se trouvant dans students_session2.php.
Cependant, des étudiants sont déjà renseignés dans la table student. Il ne faut donc ajouter que les étudiants n'y figurant pas.
Pour savoir si un étudiant est déjà dans la table, on se basera sur le champ "email".
D'ailleurs, pour plus de sécurité, on va ajouter un attribut d'unicité sur ce champ, dans la table student.

Copiez ces 2 fichiers dans un répertoire batch de votre projet Toto, puis éditez ce fichier pour effectuer les insertions en DB.
*/
require 'inc/db.php';
require 'students_session2.php';

$sql ='
	SELECT stu_email
	FROM student
';
$pdoStatement=$pdo->query($sql);

print_r($studentsList);

if ($pdoStatement===false) {

	print_r($pdo->errorInfo());
}
else if ($pdoStatement->rowCount() > 0) {
	
	$userMail=$pdoStatement->fetchAll();
	print_r($userMail);

foreach ($studentsList as $key => $value) {

	if(in_array ( $studentsList['email'] , $userMail)){
		echo $studentsList[$key]['name'].' n\'a pas été ajouté car email déjà existante ou non valide<br/>';
	}else{
		$sqlIns='
		INSERT INTO student(ses_id, stu_name, stu_firstname, stu_birthdate, stu_email, stu_sex, stu_with_experience, stu_is_leader)
		VALUES (:session, :name, :firstname, :birthdate, :email, :sexe, :with_experience, :is_leader)
	';

	$pdoStatement = $pdo->prepare($sqlIns);
	foreach ($studentsList as $key => $value) :
		// Je récupère tous les champs du formulaires
		$pdoStatement->bindValue(':session', 2, PDO::PARAM_INT);
		$pdoStatement->bindValue(':name', $studentsList[$key]['name']);
		$pdoStatement->bindValue(':firstname', $studentsList[$key]['firstname']);
		$pdoStatement->bindValue(':birthdate', $studentsList[$key]['birthdate']);
		$pdoStatement->bindValue(':email', $studentsList[$key]['email']);
		$pdoStatement->bindValue(':sexe', $studentsList[$key]['sex']);
		$pdoStatement->bindValue(':with_experience', $studentsList[$key]['with_experience'], PDO::PARAM_INT);
		$pdoStatement->bindValue(':is_leader', $studentsList[$key]['is_leader'], PDO::PARAM_INT);


		if ($pdoStatement->execute()===false) {
			print_r($pdo->errorInfo());
			echo $studentsList[$key]['name'].' n\'a pas été ajouté car email déjà existante ou non valide<br/>';
		}
		else if ($pdoStatement->rowCount() > 0) {
			echo $studentsList[$key]['name'].'envoyé!<br/>';
			print_r($pdoStatement);
		}
	endforeach;

	}
}
	
}



// A vous de jouer ^^