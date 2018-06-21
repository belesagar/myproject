//== Class definition
var GoogleMapsDemo = function() {

    //== Private functions
    var demo8 = function() {
        var map = new GMaps({
            div: '#m_gmap_8',
            lat: 19.0732748,
            lng: 72.8422967,
            draggable : true
        });

        var handleAction = function() {
            var text = $.trim($('#m_gmap_8_address').val());
            GMaps.geocode({
                address: text,
                callback: function(results, status) {
                    if (status == 'OK') {
                        var latlng = results[0].geometry.location;
                        map.setCenter(latlng.lat(), latlng.lng());
                        map.addMarker({
                            lat: latlng.lat(),
                            lng: latlng.lng()
                        });
                        mApp.scrollTo($('#m_gmap_8'));
                        mApp.setOptions({draggable : true});
                    }
                }
            });
        }

        $('#m_gmap_8_btn').click(function(e) {
            e.preventDefault();
            handleAction();
        });

        $("#m_gmap_8_address").keypress(function(e) {
            var keycode = (e.keyCode ? e.keyCode : e.which);
            if (keycode == '13') {
                e.preventDefault();
                handleAction();
            }
        });
    }

    return {
        // public functions
        init: function() {
            // default charts           
            demo8();
        }
    };
}();

jQuery(document).ready(function() {
    GoogleMapsDemo.init();
});