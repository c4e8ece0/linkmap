<?php

// --------------------------------------------------------------------------
// Get one link from linkmap-file with 100-bytes columns
// --------------------------------------------------------------------------

function get_linkmap_item100($str = '', $path = '') {
	$path = $path ? $path : 'linkmap';
	$fh   = fopen($path, 'rb');
	$res  = '';

	if(!$str) {
		$str = $_SERVER['REQUEST_URI'];
	}

	if($fh) {
		$n = intval(fgets($fh)) - 1;
		$s = 1234567;
		for($i=0; $i<strlen($str); $i++) {
			$s+= ord($str[$i])*($i*$i*$i+1)/6;
		}
		srand($s);
		$n = rand(0, $n);

		if(!fseek($fh, (100 + $n*200), SEEK_SET)) {
			$t = fgets($fh);
			fclose($fh);
			list($a, $u) = explode("\t", $t);
			$res = '<a href="' . trim($u) . '" target="_blank">' . trim($a) . '</a>';
		}
	}
	srand(microtime(true) * 1000);

	if(!$res) {
		$res = '&times;';
	}

	return $res;
}

?>