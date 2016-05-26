<?php

//inclut automatiquement tous les package de composer
require_once __DIR__.'/vendor/autoload.php';

use Whatsma\ZodiacSign;

$calculator = new ZodiacSign\Calculator();


try {
  $zodiacSign = $calculator->calculate($zodiacSign);
  //echo $zodiacSign . "\n";
} catch (ZodiacSign\InvalidDayException $e) {
  echo "ERROR: Invalid Day";
} catch (ZodiacSign\InvalidMonthException $e) {
  echo "ERROR: Invalid Month";
}

$traductionFR = array(
	'capricorn' => 'capricorne');
	'aquarius' => 'verseau');
	'pisces' => 'poisson');
	'aries' => 'bélier');
	'taurus' => 'taureau');
	'gemini' => 'gemeau');
	'cancer' => 'cancer');
	'leo' => 'lion');
	'virgo' => 'vierge');
	'libra' => 'balance');
	'scorpio' => 'scorpion');
	'sagittarius' => 'sagitaire');

echo $traductionFR[$zodiacSign].'<br/>';