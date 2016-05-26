<h3>Informations étudiants</h3>

<?php foreach ($etudiantInfo as $currentEtudiant) : ?>
	<ul>
		<li>Le nom est : <span class="content"> <?= $currentEtudiant['stu_name'] ?></span></li>
		<li>Le prénom est : <span class="content"><?= $currentEtudiant['stu_firstname'] ?></span></li>
		<li>Le statut marital est : <?= $currentEtudiant['mar_name'] ?></li>
		<li>La ville de résidence est : <?= $currentEtudiant['cit_name'] ?></li>
		<li>La nationalité est : <?= $currentEtudiant['cou_name'] ?></li>
		<li>Le sexe est : <?= $currentEtudiant['stu_sex'] ?></li>
		<li>La date de naissance est : <?= $currentEtudiant['birthdate'] ?></li>
		<li>L'adresse email est : <?= $currentEtudiant['stu_email'] ?></li>
		<li>L'etudiant a de l'experience en codage : <?= $currentEtudiant['stu_with_experience'] ?></li>
		<li>L'etudiant est un leader : <?= $currentEtudiant['stu_is_leader'] ?></li>
		<li>Son signe zodiacal est : <?= $traductionFR[$zodiacSign] ?></li>
	</ul>
<?php endforeach; ?>






	