<h3>Session Esch sur Alzette</h3>
<ul>
<?php foreach ($sessionList as $key => $value): ?> 
	<li>
		<a href="list.php?ses_id=<?=$value['ses_id'] ?>"> du<?=$value['ses_opening']?> au <?=$value['ses_ending']?>
		</a>
	</li>
<?php endforeach;?>
</ul>

<h3>Nombre d'étudiants par ville</h3>
<table>
	<thead>
		<tr>
			<td>Ville</td>
			<td>Nbre etudiants</td>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($etudiantsParVille as $key => $value): ?> 
		<tr>
			<td><?=$value['cit_name']?></td>
			<td><?=$value['stu_nbr']?></td>
		</tr>
	<?php endforeach;?>
	</tbody>
</table>

