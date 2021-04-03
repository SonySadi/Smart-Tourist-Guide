// <?php

// session_start();
// include('./../connection.php');

// $id = $_SESSION['id'];
// $likes = $_SESSION['ulike'];
// $city = $_SESSION['ucity'];
// $str = "";
// $_SESSION['ival'] = 1;
// $lat_long = "";

// for ($i = 1; $i < $_SESSION['index']; $i++) {
// 	//$lat_long=$lat_long+$_SESSION['lat'][$_SESSION['ival']]." ".$_SESSION['lng'][$_SESSION['ival']]."<br>";
// 	if ($i == $_SESSION['index'] - 1) {
// 		$lat_long .= $_SESSION['lat'][$_SESSION['ival']] . ',' . $_SESSION['lng'][$_SESSION['ival']];
// 	} else {
// 		$lat_long .= $_SESSION['lat'][$_SESSION['ival']] . ',' . $_SESSION['lng'][$_SESSION['ival']] . ',';
// 	}
// 	$_SESSION['ival'] = $_SESSION['ival'] + 1;
// }

// $str = "";
// $venues = ",";
// for ($i = 0; $i < strlen($likes) - 1; $i++) {
// 	if ($likes[$i] == ",") {
// 		$venues .= $_SESSION[$str] . ",";
// 		$str = "";
// 	} else {
// 		$str .= $likes[$i];
// 	}
// }

// $venues .= $_SESSION[$str];
// $str = "";

// $_SESSION['ival'] = 1;

// ?>

// function initMap() {
//     // Map options
//     var options = {
//         zoom: 12,
//         center: {
//             lat: 40.355048,
//             lng: -79.835499,
//         },
//     };

//     function calcDistance(p1, p2) {
//         return (
//             new google.maps.geometry.spherical.computeDistanceBetween(p1, p2) /
//             1000
//         ).toFixed(2);
//     }

//     // New map
//     var map = new google.maps.Map(document.getElementById("map"), options);
//     var directionsService = new google.maps.DirectionsService();
//     var directionsDisplay = new google.maps.DirectionsRenderer();
//     directionsDisplay.setMap(map);
//     var request = {
//         travelMode: google.maps.TravelMode.DRIVING,
//         optimizeWaypoints: true,
//         waypoints: [],
//     };

//     // Listen for click on map
//     google.maps.event.addListener(map, "click", function (event) {
//         // Add marker
//         addMarker({
//             coords: event.latLng,
//         });
//     });

//     // var noOfMarker = <?php echo $_SESSION['index'] - 1; ?>;
//     var noOfMarker;
//     // Array of markers
//     var markers = [
//         {
//             coords: {
//                 lat: 25.492,
//                 lng: 81.8639,
//             },
//         },
//     ];

//     var my_lat = "<?php echo $_SESSION['mylng']; ?>";
//     markers[0].coords.lat = parseFloat(my_lat);
//     var my_lng = "<?php echo $_SESSION['mylng']; ?>";
//     markers[0].coords.lng = parseFloat(my_lng);

//     var l_name = "<?php echo $venues; ?>";
//     var cs = "<?php echo $lat_long ?>";
//     var ay = cs.split(",");
//     var loc_name = l_name.split(",");

//     var l = ay.length - 1;
//     var distance = new Array(l + 1);
//     for (var i = 0; i < ay.length; i = i + 2) {
//         //coords = new Object();
//         lat = ay[i];
//         lng = ay[i + 1];
//         lng = parseFloat(lng);
//         lat = parseFloat(lat);
//         temp = {
//             coords: {
//                 lat,
//                 lng,
//             },
//         };
//         markers.push(temp);
//     }

//     //calculates distance between two points in km's
//     var ct = 1;
//     var mn = 2000000;
//     for (var j = 1; j < markers.length; j++) {
//         var p1 = new google.maps.LatLng(
//             markers[0].coords.lat,
//             markers[0].coords.lng
//         );
//         var p2 = new google.maps.LatLng(
//             markers[j].coords.lat,
//             markers[j].coords.lng
//         );
//         distance[ct] = calcDistance(p1, p2);
//         if (mn > parseFloat(distance[ct])) {
//             mn = distance[ct];
//         }
//         ct++;
//     }
//     console.log("min distance=" + mn);

//     for (var i = 1; i < ct; i++) {
//         var k = parseFloat(distance[i]);
//         var lat1 = markers[i].coords.lat;
//         var lng1 = markers[i].coords.lng;
//         var name_loc = loc_name[i];

//         var j = i - 1;

//         while (j >= 1 && parseFloat(distance[j]) > k) {
//             markers[j + 1].coords.lat = markers[j].coords.lat;
//             markers[j + 1].coords.lng = markers[j].coords.lng;
//             distance[j + 1] = distance[j];
//             loc_name[j + 1] = loc_name[j];
//             j--;
//         }

//         markers[j + 1].coords.lat = lat1;
//         markers[j + 1].coords.lng = lng1;
//         distance[j + 1] = k;
//         loc_name[j + 1] = name_loc;
//     }

//     for (i = 1; i < markers.length; i++) {
//         btn = document.createElement("div");
//         btn.innerHTML =
//             loc_name[i] + " &nbsp &nbsp &nbsp Distance:" + distance[i];
//         //		btn.setAttribute("class","btnsize");
//         btn.setAttribute("id", "btn" + i);
//         btn.setAttribute("class", "class=btn btn-default btn-sm btn-block");
//         btn.setAttribute("onclick", "#");
//         document.getElementById("ven").appendChild(btn);
//     }

//     var i;
//     // Loop through markers
//     for (i = 0; i < markers.length; i++) {
//         // Add marker
//         addMarker(markers[i]);
//     }

//     // Add Marker Function
//     function addMarker(props) {
//         var marker = new google.maps.Marker({
//             position: props.coords,
//             map: map,
//             icon: props.iconImage,
//         });

//         // Check for customicon
//         if (props.iconImage) {
//             // Set icon image
//             marker.setIcon(props.iconImage);
//         }

//         // Check content
//         if (props.content) {
//             var infoWindow = new google.maps.InfoWindow({
//                 content: props.content,
//             });

//             marker.addListener("click", function () {
//                 infoWindow.open(map, marker);
//             });
//         }
//         if (i === 0) {
//             request.origin = props.coords;
//         } else if (i === markers.length - 1) {
//             request.destination = props.coords;
//         } else {
//             if (props.coords) {
//                 request.waypoints.push({
//                     location: props.coords,
//                     stopover: true,
//                 });
//             }
//         }
//         //End of Add Marker Function
//     }
//     directionsService.route(request, function (response, status) {
//         if (status == "OK") {
//             directionsDisplay.setDirections(response);
//         }
//     });
// }
