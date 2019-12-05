<!DOCTYPE html>
<html>
<head>
	<title>GamifiR</title>
</head>
<body>

<?php

/**
 * @Author: OMAO
 * @Date:   2018-10-27 11:29:23
 * @Last Modified by:   OMAO
 * @Last Modified time: 2018-10-29 22:04:35
 */

chdir('src');

include 'utils/file.php';
include 'objects/Progress.php';

$data = deserializeJson("data/data.json");

$progressList = constructProgressList($data->progressList);

echo "<h1>GamifiR</h1>";
echo "<h2>Statut</h2>";
echo "mes points : " . $data->profil->points . "<br />";

echo "ma progression : <br />";
printProgressList($data->progressList, $data->taskList);

echo "<h2>technique</h2>";

echo "<h3>taches</h3>";
printValueList($data->taskList);

echo "<h3>recompenses</h3>";
printValueList($data->rewardList);

echo "<h3>progression</h3>";
printValueList($progressList);

updateProgressList($data->progressList);

echo "<br />";

serializeJson($data, "data/data.json");

function constructProgressList($progressList) {
	$progressListFinal = Array();
	foreach ($progressList as $key => $value) {
		$progress = new Progress;
		$progress->taskId = $value->taskId;
		$progress->amount = $value->amount;
		$progress->lastModificationDate = $value->lastUpdate->date;
		array_push($progressListFinal, $progress);
	}
	return $progressListFinal;
}

function updateProgressList($progressList) {
	foreach ($progressList as $index => $progress) {
		$progress->lastUpdate = new DateTime('now');
	}
}

function printProgressList($progressList, $taskList) {
	echo "<ul>";
	foreach ($progressList as $index => $progress) {
		$task = null;
		$i = 0;

		while(!isset($task) || isset($taskList[$i]))
		{
			if ($taskList[$i]->id == $progress->taskId)
			{
				$task = $taskList[$i];
			}
			$i++;
		}
		echo "<li> $task->title = $progress->amount </li>";
	}
	echo "</ul>";
}

function printValueList($valueList) {
	foreach ($valueList as $i => $item) {
		echo "<ul> <li> [$i] </li>";
		echo "<ul>";
		foreach ($item as $itemKey => $itemValue) {
			echo "<li>$itemKey = $itemValue</li>";
		}
		echo "</ul></ul>";
	}
}




?>

</body>
</html>