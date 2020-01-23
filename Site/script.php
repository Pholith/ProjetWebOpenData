<script>
    // CODE JAVASCRIPT DE LA PAGE
    var mymap = L.map('mapid').setView([48.845, 2.3752], 13);
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 15,
        id: 'mapbox.streets',
        accessToken: 'pk.eyJ1IjoicGhvbGl0aCIsImEiOiJjazM2MWljNDUxMWtyM2JueXNxOWo1MGF0In0.8eR0bt3PfFACQDq2CELQPA'
    }).addTo(mymap);

    <?php echo $jsToWrite; ?>
</script>