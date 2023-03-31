<script type="text/javascript">
    function initMap() {
        const myLatLng = {
            lat: {{ $post->latitude }},
            lng: {{ $post->longitude }}
        };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 5,
            center: myLatLng,
        });

        new google.maps.Marker({
            position: myLatLng,
            map,
            title: "Scotland Cottages Map",
        });
    }

    window.initMap = initMap;
</script>

<script type="text/javascript"
    src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap"></script>

