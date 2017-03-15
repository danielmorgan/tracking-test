import mapboxgl from 'mapbox-gl/dist/mapbox-gl';
import turf from 'turf';

mapboxgl.accessToken = window.mapbox.key;
const points = window.points.map(p => [Number(p.lon), Number(p.lat)]);

const map = new mapboxgl.Map({
    container: 'map',
    center: points[19],
    zoom: 13,
    style: 'mapbox://styles/morgan345/cj0a1fues00b92rny9c27800q'
});

const line = {
    "type": "Feature",
    "properties": {},
    "geometry": {
        "type": "LineString",
        "coordinates": points,
    }
};

const curvedLine = turf.bezier(line);

const geoJson = {
    "id": "route",
    "type": "line",
    "source": {
        "type": "geojson",
        "data": curvedLine
    },
    "layout": {
        "line-join": "round",
        "line-cap": "round"
    },
    "paint": {
        "line-color": "#ff3654",
        "line-width": 3
    }
};

map.on('load', function() {
    map.addLayer(geoJson);
});
