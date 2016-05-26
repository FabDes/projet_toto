<?php
//je cree PDO
require 'inc/db.php';
//recuperer le ses id via get
if (!empty($_GET['stu_id'])) {
	$studentID = $_GET['stu_id'];


//print_r($_GET);

$sql = '
	SELECT stu_id, stu_name, stu_firstname, cou_name, cit_name, mar_name, stu_email, stu_birthdate AS birthdate, stu_sex, stu_with_experience, stu_is_leader
	FROM student
	LEFT OUTER JOIN country ON country.cou_id = student.cou_id
	LEFT OUTER JOIN city ON city.cit_id = student.cit_id
	LEFT OUTER JOIN marital_status ON marital_status.mar_id = student.mar_id
	WHERE stu_id = :students
';
$pdoStatement = $pdo->prepare($sql);
//je donne la valeur de la requete
$pdoStatement->bindValue(':students', $studentID, PDO::PARAM_INT);

// Si erreur
if ($pdoStatement->execute() === false) {
	print_r($pdo->errorInfo());
}
else if ($pdoStatement->rowCount() > 0) {
	$etudiantInfo = $pdoStatement->fetchAll();
}


}



//////////signe zodiac/////////////////////
require_once __DIR__.'/vendor/autoload.php';

use Whatsma\ZodiacSign;

$calculator = new ZodiacSign\Calculator();

$maDateFromDb = $etudiantInfo[0]['birthdate'];

$jour = intval($maDateFromDb[8].$maDateFromDb[9]);
$mois = intval($maDateFromDb[5].$maDateFromDb[6]);


try {
  $zodiacSign = $calculator->calculate($jour,$mois);
  //echo $zodiacSign . "\n";
} catch (ZodiacSign\InvalidDayException $e) {
  echo "ERROR: Invalid Day";
} catch (ZodiacSign\InvalidMonthException $e) {
  echo "ERROR: Invalid Month";
}

$traductionFR = array(
	'capricorn' => 'capricorne',
	'aquarius' => 'verseau',
	'pisces' => 'poisson',
	'aries' => 'bélier',
	'taurus' => 'taureau',
	'gemini' => 'gemeau',
	'cancer' => 'cancer',
	'leo' => 'lion',
	'virgo' => 'vierge',
	'libra' => 'balance',
	'scorpio' => 'scorpion',
	'sagittarius' => 'sagitaire');

require 'inc/header.php';
require 'inc/student_view.php';
require 'inc/footer.php';
?>