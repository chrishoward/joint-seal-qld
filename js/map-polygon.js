// This function draws a polygon over the Google map on the services.html page.
function initMap() {
  var map = new google.maps.Map(document.getElementById('js-map'), {
    zoom: 8,
    center: { lat: -27.397139, lng: 152.783694 },
    mapTypeId: 'roadmap'
  });

  // Define the LatLng coordinates for the polygon's path.
  var serviceAreaCoords = [
    { lat: -26.3980, lng: 153.0930 },
    { lat: -27.56433, lng: 151.953987 },
    { lat: -28.178666, lng: 153.537001 },
  ];

  // Construct the polygon.
  var serviceArea = new google.maps.Polygon({
    paths: serviceAreaCoords,
    strokeColor: '#077EBE',
    strokeOpacity: 0.5,
    strokeWeight: 2,
    fillColor: '#077EBE',
    fillOpacity: 0.3
  });

  serviceArea.setMap(map);
}
