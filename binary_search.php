<?php

// $fp = fopen("file.txt", "w");
// $str = '';
// for ($i=1; $i<100;$i++)
// 	$str .= "ключ$i\\tзначение$i\\x0A";

// fwrite($fp, $str);
// fclose($fp);

function binarySearch($filename, $search_key) 
{
	if (!file_exists($filename))
		throw new Exception("File not found");

	$filter_var = filter_var($search_key, FILTER_SANITIZE_NUMBER_INT);
	if (!strlen($filter_var))
		throw new Exception("Invalid key for search entered");

	$search = "ключ".$filter_var;
	set_time_limit(1);

	$file = fopen($filename, "r");
	while (!feof($file)) 
	{
		$line_in_file = fgets($file);
		$array = explode('\x0A', $line_in_file);
		array_pop($array);
		foreach($array as $key => $value) 
			$array_explode[] = explode('\t', $value);	
	}
	$start = 0;
	$end = count($array_explode) - 1;

	while ($start <= $end) 
	{
		$middle = floor(($start + $end) / 2);
		$strnatcmp  = strnatcmp($array_explode[$middle][0],$search);

		if ($strnatcmp > 0)
			$end = $middle - 1;
		else if ($strnatcmp < 0) 
			$start = $middle + 1;
		else 
			return $array_explode[$middle][1];
	}
	return "undefined";
}