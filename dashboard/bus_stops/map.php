<?php
$Title = 'Dashboard | Bus Stops'; 
include("../../config/all_config.php"); 
include("../../lib/all_lib.php"); 
check_auth_redirect_if_not();
include("../../partials/dashboard_header.php"); 

?>

<div id="map"></div>
<script>

async function init_map(){
    document.querySelector(".content").style.padding= '0';

    var map = L.map('map').setView([10.298808506231664, 76.33147237183417], 11);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);
    let res = await fetch('/api/bus_stops.php');
    let busStops = await res.json(); 

    busStops.forEach(stop => {
        L.marker([stop.loc_lat, stop.loc_long])
        .bindPopup(stop.address)
        .addTo(map);
    });

}
init_map();
</script>
