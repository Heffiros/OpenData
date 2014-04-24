<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript">
 var geocoder;
     geocoder = new google.maps.Geocoder();
    function codeAddress(address, content) {
  //var address = "27 bis rue fromagere";
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
        var position = results[0].geometry.location;
       console.log("array('address' => \"" + address + '", "k" => ' + position['k'] + ", 'A' => " + position['A'] + '", "lieux" => '+ content + "),");
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}

<?php
$dir = "C:\wamp\www\OpenData\OpenData\\";
$var = opendir($dir);
while ($content = readdir($var))
{
	if ($content[0] != '.')
	{
		$raw = file_get_contents($dir.$content);
		$json = json_decode($raw, true);
		for ($i = 0; isset($json[$i]); $i++){
			$place = ($json[$i]['datasetid']);
			if (isset($json[$i]['fields']['adresse']))
				$address = ($json[$i]['fields']['adresse']);
			else if (isset($json[$i]['fields']['adresse_complete']))
				$address = ($json[$i]['fields']['adresse_complete']);
			else if (isset($json[$i]['fields']['adresse_complete_poi_approchant']))
				$address = ($json[$i]['fields']['adresse_complete_poi_approchant']);
			?>
				codeAddress(<?php echo json_encode($address).",".json_encode($content) ?>);
			<?php
			}
	}
}

?>
</script>