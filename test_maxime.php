foreach ($json as $key) {
				$place = ($key['datasetid']);
				foreach ($key['fields'] as $key2) {
					if (isset($key2['adresse']))
						echo $adress = ($key2['adresse']);
					else if (isset($key2['adresse_complete']))
						echo $adress = ($key2['adresse_complete']);
					else if (isset($key2['adresse_complete_poi_approchant']))
						echo $adress = ($key2['adresse_complete_poi_approchant']);
				}
			}