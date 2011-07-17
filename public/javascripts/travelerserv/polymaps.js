var po = org.polymaps;

var map = po.map()
        .container(document.getElementById("map").appendChild(po.svg("svg")))
        .add(po.interact())
        .add(po.hash());

map.add(po.image()
        .url(po.url("http://{S}tile.cloudmade.com"
        + "/7edf224d2b714c238a8ed621091d63bc"
        + "/998/256/{Z}/{X}/{Y}.png")
        .hosts(["a.", "b.", "c.", ""])));

map.add(po.compass()
        .pan("none"));

// http://raphaeljs.com/icons/
var icons = (function(po) {
  return {
    marker: function() {
      var path = po.svg("path");
      path.setAttribute("transform", "translate(-16,-28)");
      path.setAttribute("d", "M24.778,21.419 19.276,15.917 24.777,10.415 21.949,7.585 16.447,13.087 10.945,7.585 8.117,10.415 13.618,15.917 8.116,21.419 10.946,24.248 16.447,18.746 21.948,24.248");
      return path;
    }
  };
})(org.polymaps);
