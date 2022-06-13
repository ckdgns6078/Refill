<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>googlemap v3 </title>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3W0KeDu0QmoK67JmnQFN5EGEXFysinSU&callback=myMap"></script>
</head>




<SCRIPT LANGUAGE="JavaScript">
<!--

var jsonLocation = 'csvjson.json';

$.getJSON(jsonLocation, function(data){
	$each(data, function(I, item){
		console.log(item.name);
	});
});
 




var contentArray = [];
var iConArray = [];
var markers = [];
var iterator = 0;
var markerArray = [];
var map;
 
// infowindow contents 배열
 contentArray[0] = "Kay";
 contentArray[1] = "uhoons blog";
 contentArray[2] = "blog.uhoon.co.kr";
 contentArray[3] = "blog.uhoon.co.kr ";
 contentArray[4] = "blog.uhoon.co.kr";
 contentArray[5] = "blog.goodkiss.co.kr";
 contentArray[6] = "GG";
 contentArray[7] = "blog.goodkiss.co.kr";
 contentArray[8] = "II";
 contentArray[9] = "blog.goodkiss.co.kr";
 
// marker icon 배열
 iConArray[0] = "http://maps.google.com/mapfiles/ms/micons/yellow-dot.png";
 iConArray[1] = "http://maps.google.com/mapfiles/ms/micons/yellow-dot.png";
 iConArray[2] = "http://maps.google.com/mapfiles/ms/micons/yellow-dot.png";
 iConArray[3] = "http://maps.google.com/mapfiles/ms/micons/yellow-dot.png";
 iConArray[4] = "http://maps.google.com/mapfiles/ms/micons/yellow-dot.png";
 iConArray[5] = "http://maps.google.com/mapfiles/ms/micons/yellow-dot.png";
 iConArray[6] = "http://maps.google.com/mapfiles/ms/micons/yellow-dot.png";
 iConArray[7] = "http://maps.google.com/mapfiles/ms/micons/yellow-dot.png";
 iConArray[8] = "http://maps.google.com/mapfiles/ms/micons/yellow-dot.png";
 iConArray[9] = "http://maps.google.com/mapfiles/ms/micons/yellow-dot.png";


markerArray[0] = new google.maps.LatLng( 37.5112348,127.0980274);
markerArray[1] = new google.maps.LatLng(40.45038,-3.69803);
markerArray[2] = new google.maps.LatLng(40.45848,-3.69477);
markerArray[3] = new google.maps.LatLng(40.40672,-3.68327);
markerArray[4] = new google.maps.LatLng(40.43672,-3.62093);
markerArray[5] = new google.maps.LatLng(40.46725,-3.67443);
markerArray[6] = new google.maps.LatLng(40.43794,-3.67228);
markerArray[7] = new google.maps.LatLng(40.46212,-3.69166);
markerArray[8] = new google.maps.LatLng(40.41926,-3.70445);
markerArray[9] = new google.maps.LatLng(40.42533,-3.6844);
 
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
