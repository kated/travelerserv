var allMaps = {};

function addPathToMap(map, pathArrayOfLngLat, polylineOpts) {
  polylineOpts = polylineOpts || {};
  var lngLats = _.map(pathArrayOfLngLat, function(lngAndLat) {
    return new google.maps.LatLng(lngAndLat[1], lngAndLat[0]);
  });

  var path = new google.maps.Polyline($.extend({
    path: lngLats,
    strokeOpacity: 0.5,
    strokeWeight: 2
  }, polylineOpts));
  console.log(map, path)
  path.setMap(map);
  map.__allPointsAdded__ = map.__allPointsAdded__ || [];
  map.__allPointsAdded__ = map.__allPointsAdded__.concat(lngLats);
  return path;
}

function fitMapToBounds(map) {
  if(!map.__allPointsAdded__ || map.__allPointsAdded__.length == 0) return;
  var lats = _.map(map.__allPointsAdded__, function(pt) { return pt.lat() })
  var lngs = _.map(map.__allPointsAdded__, function(pt) { return pt.lng() })
  var minLat = _.min(lats);
  var maxLat = _.max(lats);
  var minLng = _.min(lngs);
  var maxLng = _.max(lngs);
  var swCorner = new google.maps.LatLng(minLat, minLng);
  var neCorner = new google.maps.LatLng(maxLat, maxLng);
  var bounds = new google.maps.LatLngBounds(swCorner, neCorner);
  map.fitBounds(bounds);
  return bounds;
}
