// Initialize the platform object:
var platform = new H.service.Platform({
  apikey: "lSwjTR9RzFA5C2M-gvJ099Nyq9Hejy_HFvyoR_4GDNo",
});

// Obtain the default map types from the platform object
var maptypes = platform.createDefaultLayers();

// Instantiate (and display) a map object:
var map = new H.Map(
  document.getElementById("mapContainer"),
  maptypes.vector.normal.map,
  {
    zoom: 14,
    center: { lat: 50.92906, lng: 5.39559 },
  }
);
var mapEvents = new H.mapevents.MapEvents(map);
map.addLayer(maptypes.vector.normal.traffic);
var behavior = new H.mapevents.Behavior(mapEvents);

var ui = H.ui.UI.createDefault(map, maptypes);

var group = new H.map.Group();

$.getJSON("../../../api/leden.php", (data) => {
  $.each(data, (i, lid) => {
    var url = `https://geocode.search.hereapi.com/v1/geocode?q=${lid.adres} ${lid.postcode} ${lid.gemeente}&apiKey=lSwjTR9RzFA5C2M-gvJ099Nyq9Hejy_HFvyoR_4GDNo`;
    $.get(url, (mapData) => {
      var position = mapData.items[0].position;

      var marker = new H.map.Marker(position);

      group.addObject(marker);

      marker.addEventListener("tap", function (evt) {
        // Log 'tap' and 'mouse' events:
        console.log(evt.type, evt.currentPointer.type);
        var marker = evt.target;

        // Create an info bubble object at a specific geographic location:
        var bubble = new H.ui.InfoBubble(marker.getGeometry(), {
          content: `${lid.voornaam} ${lid.achternaam}`,
        });

        // Add info bubble to the UI:
        ui.addBubble(bubble);
      });

      map.addObject(group);
    });
  });
});

// for (let i = 0; i < ucllCampi.length; i++) {
//   var url =
//     "https://geocode.search.hereapi.com/v1/geocode?q=" +
//     ucllCampi[i].adres +
//     "&apiKey=lSwjTR9RzFA5C2M-gvJ099Nyq9Hejy_HFvyoR_4GDNo";
//   $.get(url)
//     .done(function (data) {
//       // success callback
//       var position = data.items[0].position;
//       console.log(position);
//       // Create a marker using the previously instantiated icon:
//       console.log(i);
//       var marker = new H.map.Marker(position, {
//         icon: icon,
//         data: ucllCampi[i].naam,
//       });

//       // add marker to the group
//       group.addObject(marker);

//       // Add event listener:
//       marker.addEventListener("tap", function (evt) {
//         // Log 'tap' and 'mouse' events:
//         console.log(evt.type, evt.currentPointer.type);
//         var marker = evt.target;

//         // Create an info bubble object at a specific geographic location:
//         var bubble = new H.ui.InfoBubble(marker.getGeometry(), {
//           content: "<b>" + marker.getData() + "</b>",
//         });

//         // Add info bubble to the UI:
//         ui.addBubble(bubble);
//       });

//       // get geo bounding box for the group and set it to the map
//       map.getViewModel().setLookAtData({
//         bounds: group.getBoundingBox(),
//       });

//       map.addObject(group);
//     })
//     .fail(function (jqXHR, textStatus, errorThrown) {
//       // error callback
//       alert("Request failed: " + textStatus + ": " + errorThrown);
//     });
// }
