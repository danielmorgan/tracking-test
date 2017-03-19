import geojsonTidy from '@mapbox/geojson-tidy';
import axios from 'axios';
const geocoderUrl = `https://api.mapbox.com/matching/v4/mapbox.driving.json?access_token=${window.mapbox.key}`;


// Get route data
const fixture = window.fixture;


// Remove elevation data, the geocoder API doesn't like it
const fixtureWithoutElevation = removeElevationFromCoordinates(fixture);
window.map.addLayer(lineLayer(fixtureWithoutElevation, '#ffff00', 6));


// Pre-process
const fixtureTidied = geojsonTidy.tidy(fixtureWithoutElevation, {
    minimumDistance: 10, // Minimum distance between points in metres
    minimumTime: 5,      // Minimum time interval between points in seconds
    maximumPoints: 2     // Maximum points in a feature (100 point limit on Map Matching geocoder step)
});


// Send requests to geocoder
const geocoderRequests = fixtureTidied.features.map(f => axios.post(geocoderUrl, f));


console.log('fixture                ', fixture);
console.log('fixtureWithoutElevation', fixtureWithoutElevation);
console.log('geocoderInput          ', fixtureTidied);


// Get all geocoder responses and draw them on the map
axios.all(geocoderRequests).then(responses => {
    let i = 0;

    function draw() {
        const geojson = geocoderResponsesToGeojson([responses[i++]]);
        console.log('geocoderOutput         ', geojson);
        window.map.addLayer(lineLayer(geojson, '#ff0000', 3));

        setTimeout(draw, 500);
    }

    draw();
});




/**
 * Utility functions
 */

function removeElevationFromCoordinates(geojson) {
    const cleanFeatureCollection = [];
    for (const feature of geojson.features) {
        cleanFeatureCollection.push({
            'type': 'Feature',
            'properties': {},
            'geometry': {
                'type': 'LineString',
                'coordinates': feature.geometry.coordinates.map(c => [c[0], c[1]])
            }
        });
    }
    return {
        'type': 'FeatureCollection',
        'features': cleanFeatureCollection
    };
}

function geocoderResponsesToGeojson(responses, confidenceThreshold = 0) {
    const features = [].concat(...responses.map(r => r.data.features));
    const filtered = features.filter(f => f.properties.confidence > confidenceThreshold);
    return {
        'type': 'FeatureCollection',
        'features': filtered
    };
}

function lineLayer(geojson, color = '#ffff00', width = 3) {
    return {
        'id': String((new Date).getTime()),
        'type': 'line',
        'layout': {
            'line-join': 'round',
            'line-cap': 'round',
        },
        'paint': {
            'line-color': color,
            'line-width': width,
            'line-opacity': 0.5
        },
        'source': {
            'type': 'geojson',
            'data': geojson
        }
    };
}
