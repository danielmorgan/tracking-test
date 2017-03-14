import mapboxgl from 'mapbox-gl/dist/mapbox-gl';

mapboxgl.accessToken = window.mapbox.key;

const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/morgan345/cj0a1fues00b92rny9c27800q'
});
