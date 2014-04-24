<?php
$dbh = new PDO('mysql:host=localhost;dbname=camelfind', 'root', '');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dir = "C:\wamp\www\OpenData\json_with_cutaddress\\";
$var = opendir($dir);
while ($content = readdir($var))
{
	if ($content[0] != '.' && $content!="json_to_base.php")
	{
		$raw = file_get_contents($dir.$content);
		$json = json_decode($raw, true);
		foreach ($json as $key) {
			if(isset($key['fields']['type_d_equipement']))
				$desc = $key['fields']['type_d_equipement'];
			if (isset($key['fields']['ap_num']))
				$address = $key['fields']["ap_num"];
			if (isset($key['fields']["ap_voie"]))
				$address .= " ".$key['fields']["ap_voie"];
			if (isset($key['fields']["ap_cp"]))
				$address .= " ".$key['fields']["ap_cp"];
			if (isset($key['fields']["wgs84"]))
			{
				$lat = $key['fields']["wgs84"][0];
				$long = $key['fields']["wgs84"][1];
			}
			$req = $dbh->prepare('INSERT INTO places (category_id, address, k, a, description) VALUES (:a, :address, :lat, :lon, :description)');
			$req->execute(array(
				'a' => 4,
				'address' => $address,
				'lat' => $lat,
				'lon' => $long,
				'description' => $desc,
				));
			echo "Insert effectue";

		}
	}
}
?>