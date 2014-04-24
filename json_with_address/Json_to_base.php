<?php
$dbh = new PDO('mysql:host=localhost;dbname=test', 'root', '');
//$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dir = "C:\wamp\www\OpenData\json_with_address\\";
$var = opendir($dir);
$i = 0;
$a = 0;
while ($content = readdir($var))
{
	if ($content[0] != '.' && $content != "Json_to_base.php")
	{
		$raw = file_get_contents($dir.$content);
		$json = json_decode($raw, true);
		for ($i = 0; isset($json[$i]); $i++){
			if (isset($json[$i]['fields']['adresse'])){
				$address = $json[$i]['fields']['adresse'];
				echo $address."\n";
			}
			if (isset($json[$i]['fields']['adresse_complete'])){
				$address = $json[$i]['fields']['adresse_complete'];
				echo $address."\n";
			}
			if (isset($json[$i]['fields']['wgs84'][0]) && isset($json[$i]['fields']['wgs84'][1])){
				$lat = $json[$i]['fields']['wgs84'][0];
				$lon = $json[$i]['fields']['wgs84'][1];
				echo $lat."-".$lon."\n";
			};
			if (isset($json[$i]['fields']['coordinates'][0]) && isset($json[$i]['fields']['coordinates'][1])){
				$lat = $json[$i]['fields']['coordinates'][0];
				$lon = $json[$i]['fields']['coordinates'][1];
				echo $lat."-".$lon."\n";
			};
			if (isset($json[$i]['fields']['geo_coordinates'][0]) && isset($json[$i]['fields']['geo_coordinates'][1])){
				$lat = $json[$i]['fields']['geo_coordinates'][0];
				$lon = $json[$i]['fields']['geo_coordinates'][1];
				echo $lat."-".$lon."\n";
			};
			if(isset($json[$i]['fields']['description'])){
				$description = $json[$i]['fields']['description'];
				echo $description."\n";
			}
			if(isset($json[$i]['datasetid'])){
				$description = $json[$i]['datasetid'];
				echo $description."\n";
			}
			if (isset($json[$i]['fields']['type_etablissement'])){
				$description = $json[$i]['fields']['type_etablissement'];
				echo $description."\n";
			}
			$req = $dbh->prepare('INSERT INTO place (category_id, address, lat, lon, description) VALUES (:a, :address, :lat, :lon, :description)');
			$req->execute(array(
				'a' => $a,
				'address' => $address,
				'lat' => $lat,
				'lon' => $lon,
				'description' => $description,
				));

		}
		$a++;
	}
	
}

?>
