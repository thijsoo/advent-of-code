<?php

require 'vendor/autoload.php';
$day = $argv[1];
$challange = (int) $argv[2];

$cname = "Thijsvanderheijden\Adventofcode\Day{$day}\Challenge";
$d1 = new $cname();

if($challange === 1) {
	$d1->solveFirst();
}else{
	$d1->solveSecond();
}