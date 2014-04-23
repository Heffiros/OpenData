<?php 

$dir = "C:\wamp\www\camelfind/OpenData/";
$var = opendir($dir);
while ($content = readdir($var))
{
	if ($content[0] != '.')
	{
		echo $content;
		$raw = file_get_contents($dir.$content);
		$json = json_decode($raw, true);
		for ($i = 0; isset($json[$i]); $i++){
			echo ($json[$i]['datasetid']);
			if (isset($json[$i]['fields']['adresse']))
				echo ($json[$i]['fields']['adresse']);
			else if (isset($json[$i]['fields']['adresse_complete']))
				echo ($json[$i]['fields']['adresse_complete']);
			else if (isset($json[$i]['fields']['adresse_complete_poi_approchant']))
			echo ($json[$i]['fields']['adresse_complete_poi_approchant']);
			echo "  <br>";
		}
	}
}


?>