<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>googlemap v3 </title>
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3W0KeDu0QmoK67JmnQFN5EGEXFysinSU&callback=myMap"></script>
</head>

<SCRIPT LANGUAGE="JavaScript">
<!--

var jsonLocation = './csvjson.json';
var LinkArray = [];	

var contentArray = [];
var iConArray = [];
var markers = [];
var iterator = 0;
var markerArray = [];
var map;
 
// 기본 for 변수 버전 (백단 PHP 응용)
<?php
$json_string = file_get_contents("csvjson.json");
$R = json_decode($json_string, true);
$x = 0;
foreach ($R as $row) {

echo '  contentArray['.$x.'] = "<a href=\"'.$row[Link].'\"  target=\"_blank\">'.$row[Name].'</a>";
	';
echo '  iConArray['.$x.'] = "http://maps.google.com/mapfiles/ms/micons/yellow-dot.png";
	';
echo '  markerArray['.$x.'] = new google.maps.LatLng( '.$row[Latitude].','.$row[Longitude].');
	';
	$x++;
}
?>


// javascript 버전
$.getJSON(jsonLocation, function(data){
	$.each(data, function(I, item){
		contentArray[I] = item.Name;
		LinkArray[I] = item.Link;
		iConArray[I] = "http://maps.google.com/mapfiles/ms/micons/yellow-dot.png";
		markerArray[I] = new google.maps.LatLng( item.Latitude , item.Longitude );
	});
});


function initialize() {
    var mapOptions = {
        zoom: 10,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: new google.maps.LatLng(37.5240220, 126.9265940)
    };
 
    map = new google.maps.Map(document.getElementById('map'),mapOptions); 
    for (var i = 0; i < markerArray.length; i++) {
        addMarker();
    }
}
 
 
// 마커 추가
function addMarker() {
     var marker = new google.maps.Marker({
        position: markerArray[iterator],
        map: map,
        draggable: false,
        icon: iConArray[iterator]
    });
    markers.push(marker);
     var infowindow = new google.maps.InfoWindow({
      content: contentArray[iterator]
    });
 
    google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map,marker);
    });
    iterator++;
}
 
google.maps.event.addDomListener(window, 'load', initialize);
//-->
</SCRIPT>
<body>
<div id="map" style="width:760px;height:400px;margin-top:20px;"></div>
</body>
</html>
