<?php

/*
On veut insérer la liste complète des étudiants de la session 2 dans la table student.
On dispose de certaines informations dans le tableau se trouvant dans students_session2.php.
Cependant, des étudiants sont déjà renseignés dans la table student. Il ne faut donc ajouter que les étudiants n'y figurant pas.
Pour savoir si un étudiant est déjà dans la table, on se basera sur le champ "email".
D'ailleurs, pour plus de sécurité, on va ajouter un attribut d'unicité sur ce champ, dans la table student.

Copiez ces 2 fichiers dans un répertoire batch de votre projet Toto, puis éditez ce fichier pour effectuer les insertions en DB.
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
*/
require 'inc/db.php';
require 'students_session2.php';

// A vous de jouer ^^

foreach ($studentsList as $key => $currentEtudiant) {

	$sqlSel =
	'
		SELECT
			stu_id
		FROM
			student
		WHERE
			stu_email = :stuMail'

	;

	$pdoStatement = $pdo->prepare($sqlSel);

	$pdoStatement->bindValue(':stuMail',$currentEtudiant['email']);

	$pdoStatement->execute();

	if ($pdoStatement->rowCount() > 0) {

		echo 'L\' etudiant(e) '.$currentEtudiant['name'].' existe !<br/>';
	}

	else{

		$sqlIns =
		'
			INSERT INTO

				student
				(
					stu_name,
					stu_firstname,
					stu_birthdate,
					stu_email,
					stu_sex,
					stu_with_experience,
					stu_is_leader

				)
				VALUES
				(
					:name,
					:firstname,
					:birthdate,
					:email,
					:sex,
					:with_experience,
					:is_leader
				)

		';

		$pdoStatement = $pdo->prepare($sqlIns);

		foreach ($currentEtudiant as $keyTwo => $valueTwo) {

			$pdoStatement->bindvalue(':'.$keyTwo, $valueTwo);
		}

		if($pdoStatement->execute() === false){

			print_r($pdo->errorInfo());
		}

		else if ($pdoStatement->rowCount() > 0){

			echo 'Etudiant ajouté à la base de données !';

		}
	}
}




