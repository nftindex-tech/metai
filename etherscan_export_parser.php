#!/usr/bin/php
<?php
error_reporting(0);
$f = "etherscan.export.csv";
$a = file_get_contents($f);
$a = trim($a);
$mas =  explode("\n",$a);
unset($mas[0]);
foreach($mas as $v2)
{
	$t = explode("\",\"",$v2);
	//print_r($t);
	$from = $t[3];
	$amount = $t[5];
	$amount = str_replace(",","",$amount);
	$o[$from] += $amount;
	$all+= $amount;
}

arsort($o);
//print_r($o);
print "ALL: $all\n";

foreach($o as $w=>$s)
{
	unset($o2);
	$p = $s/$all;
	$p *= 100;
	$o2 .= $w."\t";
	$o2 .= $p."\t";
	$o2 .= $s."\t";
	$l[] = $o2;
}
$txt = implode("\n",$l);
$f = "metai.seed.txt";
file_put_contents($f,$txt);
?>