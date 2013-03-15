$(function(){
    $('.lang').click(function(){
        $('form').attr('action', $(this).attr('href'));
        $(this).attr('href', '#');
        $('form').submit();
    });
    $('.marker').click(function(){
    	//alert(map.center + " i " + map.zoom);
    	$('#center').attr('value', map.center);
    	$('#zoom').attr('value', map.zoom);
        $('form').attr('action', $(this).attr('id')).submit();
    });
});
var sliki=new Array(7);
sliki[0] = '../img/marker/pistol.png';
sliki[1] = '../img/marker/boks.png';
sliki[2] = '../img/marker/kradec.png';
sliki[3] = '../img/marker/dokumenti.png';
sliki[4] = '../img/marker/droga.png';
sliki[5] = '../img/marker/kola.png';
sliki[6] = '../img/marker/drugo.png';

function prijavi_greska(nastan_id){
	var from_query_string = window.location.search.substring(window.location.search.indexOf('?') + 1);
    window.location.href="data.php?nastan_id=" + nastan_id + "&" + from_query_string;
}

function marker_map(data){
    var query_string = window.location.search;
    var index_l = query_string.indexOf('l');
    var lang = query_string.substring(index_l+2,index_l + 4);
    var report_error;
    report_error = "Пријави грешка";
    if (lang == 'mk'){
        report_error = "Пријави грешка";
    }
    else if(lang == 'en'){
        report_error = "Report Error";
    }
    else if (lang == 'sq'){
        report_error = "Пријави грешка";
    }
    //alert(data);
    var json = eval('(' + data + ')');
    
    var minZoomLevel = 8;
    var c = $('#center').attr('value');
    var z = $('#zoom').attr('value');    
    c = c.substring(1, c.length-1);
    var n = c.split(',');
    var myOptions = {
    		center: new google.maps.LatLng(n[0], n[1]),
    		zoom: parseFloat(z),
	        mapTypeId: google.maps.MapTypeId.ROADMAP
	    };
	map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);

    // Bounds for Macedonia
    var strictBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(40.1, 20.1),
        new google.maps.LatLng(42.8, 23.6)
        );
    // Listen for the dragend event
    google.maps.event.addListener(map, 'dragend', function() {
        if (strictBounds.contains(map.getCenter())) return;
        // We're out of bounds - Move the map back within the bounds
        var c = map.getCenter(),
        x = c.lng(),
        y = c.lat(),
        maxX = strictBounds.getNorthEast().lng(),
        maxY = strictBounds.getNorthEast().lat(),
        minX = strictBounds.getSouthWest().lng(),
        minY = strictBounds.getSouthWest().lat();
        if (x < minX) x = minX;
        if (x > maxX) x = maxX;
        if (y < minY) y = minY;
        if (y > maxY) y = maxY;
        map.setCenter(new google.maps.LatLng(y, x));
    });
    // Limit the zoom level
    google.maps.event.addListener(map, 'zoom_changed', function() {
        if (map.getZoom() < minZoomLevel) map.setZoom(minZoomLevel);
    });
    //limit map
    
    var oms = new OverlappingMarkerSpiderfier(map);
    var iw = new google.maps.InfoWindow();
    oms.addListener('click', function(marker) {      
    	marker.infowindow.close();
    	iw.close();
        iw.setContent(
            '<div>' + marker.get('opis') + '</div><br />'+
            "<button style='float:right;' onclick='prijavi_greska(" + marker.get('id') + ")'>" + report_error + "</button>"
            );
        marker.infowindow = iw;
        marker.infowindow.open(map, marker);
    });
    oms.addListener('spiderfy', function(markers) {  
    	iw.close();
    	 for(var i = 0; i < markers.length; i ++) {
             if(markers[i].infowindow != null)
            	 markers[i].infowindow.close();
           }
    });

    var markers = [];
    var count = json.length;
    for(i=0; i<count; i++){
        var marker = new google.maps.Marker({
            map: map,
            //title: json[i].opis,
            position: new google.maps.LatLng(json[i].lat, json[i].lng),
            icon: sliki[json[i].slika]
        });
        marker.set('opis', json[i].opis);
        marker.set('id', json[i].id);
        
        google.maps.event.addListener(marker, 'click', (function(marker, i) {   
        	return function() {
        	if(marker.infowindow != null)
        		marker.infowindow.close();
        	marker.infowindow = new google.maps.InfoWindow({content: '<div>' + marker.get('opis') + '</div><br />'+
                "<button style='float:right;' onclick='prijavi_greska(" + marker.get('id') + ")'>" + report_error + "</button>"});
        	marker.infowindow.open(map, marker);
        	}
          })(marker, i));    
        
        markers.push(marker);
        oms.addMarker(marker);
    }
    
    var options = {
        maxZoom : 13
    };
    var markerCluster = new MarkerClusterer(map, markers, options);    
    return markers;
}

function heat_map(data){
    var json = eval('(' + data + ')');
    var pointarray, heatmap;
    var points = [];
    var count = json.length;
    for(i=0; i<count; i++){
        points.push(new google.maps.LatLng(json[i].lat, json[i].lng));
    }
    var minZoomLevel = 8;
    var c = $('#center').attr('value');
    var z = $('#zoom').attr('value');    
    c = c.substring(1, c.length-1);
    var n = c.split(',');
    var myOptions = {
    		center: new google.maps.LatLng(n[0], n[1]),
    		zoom: parseFloat(z),
	        mapTypeId: google.maps.MapTypeId.ROADMAP
	    };
	map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);

    // Bounds for Macedonia
    var strictBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(40.1, 20.1),
        new google.maps.LatLng(42.8, 23.6)
        );
    // Listen for the dragend event
    google.maps.event.addListener(map, 'dragend', function() {
        if (strictBounds.contains(map.getCenter())) return;
        // We're out of bounds - Move the map back within the bounds
        var c = map.getCenter(),
        x = c.lng(),
        y = c.lat(),
        maxX = strictBounds.getNorthEast().lng(),
        maxY = strictBounds.getNorthEast().lat(),
        minX = strictBounds.getSouthWest().lng(),
        minY = strictBounds.getSouthWest().lat();
        if (x < minX) x = minX;
        if (x > maxX) x = maxX;
        if (y < minY) y = minY;
        if (y > maxY) y = maxY;
        map.setCenter(new google.maps.LatLng(y, x));
    });
    // Limit the zoom level
    google.maps.event.addListener(map, 'zoom_changed', function() {
        if (map.getZoom() < minZoomLevel) map.setZoom(minZoomLevel);
    });
    //limit map

    pointarray = new google.maps.MVCArray(points);

    heatmap = new google.maps.visualization.HeatmapLayer({
        data: pointarray,
        radius: 30
    });
    heatmap.setMap(map);
    return count;
}


