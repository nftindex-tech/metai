#!/usr/bin/php
<?php
error_reporting(0);
$f = "etherscan.export.csv";
$a = file_get_contents($f);
$a = trim($a);
$mas =  explode("\n",$a);
unset($mas[0]);
//UniswapV3Pool change for sender 6 ETH
$change1["0x11b815efb8f581194ae79006d24e0d814b7697f6"] = "0x93df35071b3bc1b6d16d5f5f20fbb2be9d50fe67";

foreach($mas as $v2)
{
	$t = explode("\",\"",$v2);
	//print_r($t);
	$from = $t[3];
	$amount = $t[5];
	$amount = str_replace(",","",$amount);
	if(isset($change1[$from]))
	{
		//print "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!\n";
		$from = $change1[$from];
	}
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