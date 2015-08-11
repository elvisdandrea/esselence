function GMaps(){}

GMaps.prototype = {
    init : function(a, b, c, d){
        var latlng = new google.maps.LatLng(b, c);
        var myOptions = {
            zoom: d,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        GMaps.map = new google.maps.Map(document.getElementById(a), myOptions);
    },
    
    init_beta : function(a){
        var myOptions = {
            zoom: a.zoom,
            center: new google.maps.LatLng(a.lat, a.lng),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        GMaps.map = new google.maps.Map(document.getElementById(a.id), myOptions);
    },
    
    add_point : function(a, b, c, d, e)
    {
        var contentTitle = ''
        var contentString = false;
        
        if(c != undefined && d != undefined && e != undefined){
            contentString = '<div class="infowindow_gmaps"><h2>' + c + '</h2><br/><p>' + d + '<br/>Telefone: ' + e + '</p></div>';
            contentTitle = c + ' - ' + d;
        }
        
        var latlng = new google.maps.LatLng(a, b);
        var marker = new google.maps.Marker({
            position: latlng, 
            map: GMaps.map,           
            title:contentTitle
        });
        
        if(contentString){
            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(GMaps.map,marker);
            });
        }
        
        
    },
    
    add_point_beta : function(a)
    {
        if(a.tipo != undefined){
            switch(a.tipo){
                case 'move_drop':
                    var marker = new google.maps.Marker({
                        map: GMaps.map,
                        position: GMaps.map.getCenter()
                    });
        
                    marker.setDraggable(true);
                    google.maps.event.addListener(marker, 'dragend', function() {
                        var l = marker.getPosition();
                        var tipo = (a.save_tipo != undefined ? a.save_tipo : 'text')
                        
                        if(a.save_id.attr('id') != undefined){
                            switch(tipo){
                                default:
                                    a.save_id.val(l.lat() + ',' + l.lng());
                                    break;
                            }
                        }
                    });
                    break;
            }
        }
        
    },
    
    add_circle : function(a, b){
        var latlng = new google.maps.LatLng(a, b);
        var circle = new google.maps.Circle({
            map: GMaps.map,
            radius: 800, // 800 metros 
            center: latlng
        });
    }
}

var GMaps = new GMaps();
