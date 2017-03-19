const mapboxgl = window.mapboxgl;
mapboxgl.accessToken = window.mapbox.key;

window.map = new mapboxgl.Map({
    container: 'map',
    center: window.fixture.features[0].geometry.coordinates[0],
    zoom: 11.4,
    style: 'mapbox://styles/mapbox/streets-v9'
});

window.map.on('load', () => {
    require('./geocoder-test');
});
