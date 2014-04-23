<script type="text/javascript">
    function codeAddress($address) {
  //var address = "27 bis rue fromagere";
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
        var position =  position: results[0].geometry.location;
       console.log("a");
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}
</script>