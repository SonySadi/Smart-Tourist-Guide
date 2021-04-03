<?php include_once('./show_schedule_session.php') ?>

let marker1, marker2;
let poly, geodesicPoly;

// function initMap() {
//     const map = new google.maps.Map(document.getElementById("map"), {
//         zoom: 4,
//         center: {
//             lat: 34,
//             lng: -40.605,
//         },
//     });
//     map.controls[google.maps.ControlPosition.TOP_CENTER].push(
//         document.getElementById("info")
//     );
//     marker1 = new google.maps.Marker({
//         map,
//         draggable: true,
//         position: {
//             lat: 40.714,
//             lng: -74.006,
//         },
//     });
//     marker2 = new google.maps.Marker({
//         map,
//         draggable: true,
//         position: {
//             lat: 48.857,
//             lng: 2.352,
//         },
//     });
//     const bounds = new google.maps.LatLngBounds(
//         marker1.getPosition(),
//         marker2.getPosition()
//     );
//     map.fitBounds(bounds);
//     google.maps.event.addListener(marker1, "position_changed", update);
//     google.maps.event.addListener(marker2, "position_changed", update);
//     poly = new google.maps.Polyline({
//         strokeColor: "#FF0000",
//         strokeOpacity: 1.0,
//         strokeWeight: 3,
//         map: map,
//     });
//     geodesicPoly = new google.maps.Polyline({
//         strokeColor: "#CC0099",
//         strokeOpacity: 1.0,
//         strokeWeight: 3,
//         geodesic: true,
//         map: map,
//     });
//     // update();
// }

function distanceLatLng(lat1, lon1, lat2, lon2, unit = "M") {
    if (lat1 == lat2 && lon1 == lon2) {
        return 0;
    } else {
        var radlat1 = (Math.PI * lat1) / 180;
        var radlat2 = (Math.PI * lat2) / 180;
        var theta = lon1 - lon2;
        var radtheta = (Math.PI * theta) / 180;
        var dist =
            Math.sin(radlat1) * Math.sin(radlat2) +
            Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
        if (dist > 1) {
            dist = 1;
        }
        dist = Math.acos(dist);
        dist = (dist * 180) / Math.PI;
        dist = dist * 60 * 1.1515;
        // where: 'M' is miles (default)
        // 'K' is kilometers
        // 'N' is nautical miles
        if (unit == "K") {
            dist = dist * 1.609344;
        }
        if (unit == "N") {
            dist = dist * 0.8684;
        }
        return dist;
    }
}

// Add Marker Function
function addMarker(map, props, i, markers) {
    var marker = new google.maps.Marker({
        position: props.coords,
        map: map,
        icon: props.iconImage,
    });

    // Check for customicon
    if (props.iconImage) {
        // Set icon image
        marker.setIcon(props.iconImage);
    }

    // Check content
    if (props.content) {
        var infoWindow = new google.maps.InfoWindow({
            content: props.content,
        });

        marker.addListener("click", function () {
            infoWindow.open(map, marker);
        });
    }
    //End of Add Marker Function
}

function createMarkerArry() {
    // Array of markers
    var my_lat = "<?php echo $_SESSION['mylat']; ?>";
    var my_lng = "<?php echo $_SESSION['mylng']; ?>";
    var markers = [{ coords: { lat: Number(my_lat), lng: Number(my_lng) } }];

    var cs = "<?php echo $lat_long; ?>";
    var ay = cs.split(",");
    for (var i = 0; i < ay.length / 2; i++) {
        lat = ay[i];
        lng = ay[i + 1];
        lng = Number(lng);
        lat = Number(lat);
        temp = {
            coords: {
                lat,
                lng,
            },
        };
        markers.push(temp);
    }
    return markers;
}

function addVenues() {
    //calculates distance between two points in km's

    var mn = 2000000;
    let distance = [mn];
    let markers = createMarkerArry();
    for (var j = 1; j < markers.length; j++) {
        distance.push(
            distanceLatLng(
                markers[0].coords.lat,
                markers[0].coords.lng,
                markers[j].coords.lat,
                markers[j].coords.lng,
                "K"
            )
        );
    }
    var l_name = "<?php echo $venues; ?>";
    var loc_name = l_name.split(",");
    loc_name.shift();
    for (i = 1; i < markers.length; i++) {
        btn = document.createElement("div");
        btn.innerHTML =
            loc_name[i - 1] + " &nbsp &nbsp &nbsp Distance:" + distance[i];
        btn.setAttribute("id", "btn" + i);
        btn.setAttribute("class", "class=btn btn-default btn-sm btn-block");
        btn.setAttribute("onclick", "#");
        document.getElementById("ven").appendChild(btn);
    }
}

function initMap() {
    var my_lat = "<?php echo $_SESSION['mylat']; ?>";
    var my_lng = "<?php echo $_SESSION['mylng']; ?>";

    // New map
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 12,
        center: {
            lat: Number(my_lat),
            lng: Number(my_lng),
        },
    });
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(
        document.getElementById("info")
    );

    let markers = createMarkerArry(); 
    for (let i = 0; i < markers.length; i++) {
        const marker = markers[i];
let marker1= new google.maps.Marker({
            map,
            draggable: true,
            position: {
                lat: marker.coords.lat,
                lng: marker.coords.lng,
            },
        });
        // google.maps.event.addListener(marker1, "position_changed");
    }
    let marker0= new google.maps.Marker({
        map,
        draggable: true,
        position: {
            lat: markers[0].coords.lat,
            lng: markers[0].coords.lng,
        },
    });
    // const bounds = new google.maps.LatLngBounds(marker0.getPosition(),marker1.getPosition());
    // map.fitBounds(bounds);

    poly = new google.maps.Polyline({
        strokeColor: "#FF0000",
        strokeOpacity: 1.0,
        strokeWeight: 3,
        map: map,
    });
    geodesicPoly = new google.maps.Polyline({
        strokeColor: "#CC0099",
        strokeOpacity: 1.0,
        strokeWeight: 3,
        geodesic: true,
        map: map,
    });
    addVenues();
}
