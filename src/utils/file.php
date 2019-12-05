<?php

/**
 * @Author: OMAO
 * @Date:   2018-10-27 11:33:52
 * @Last Modified by:   OMAO
 * @Last Modified time: 2018-10-28 13:54:12
 */


function deserializeJson($fileName) {
	$content = file_get_contents($fileName, FILE_USE_INCLUDE_PATH);
	return json_decode($content);
}

function serializeJson($object, $fileName) {
	$handle = fopen($fileName, "w");
	$json = json_encode($object);
	fwrite($handle, $json);
}

?>