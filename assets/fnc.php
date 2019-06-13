<?php

	function showMarcature($array){
		//preso array di marcature, le adatta per la visualizzazione nella textarea
		$string = null;
		foreach ($array as $mar){
			$string .= substr($mar, 0, 16).PHP_EOL;
		}
		$string = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $string);
		return substr($string, 0, strlen($string)-1);
	}

?>