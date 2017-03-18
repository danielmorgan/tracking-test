import geojsonTidy from '@mapbox/geojson-tidy';
import axios from 'axios';
const geocoderUrl = `https://api.mapbox.com/matching/v4/mapbox.driving.json?access_token=${window.mapbox.key}`;


// Get route data
const fixture = require('./fixtures/hiking-with-elevation');


// Remove elevation data, the geocoder API doesn't like it
const fixtureWithoutElevation = removeElevationFromCoordinates(fixture);


// Pre-process
const fixtureTidied = geojsonTidy.tidy(fixtureWithoutElevation, {
    minimumDistance: 10, // Minimum distance between points in metres
    minimumTime: 5,      // Minimum time interval between points in seconds
    maximumPoints: 100   // Maximum points in a feature (100 point limit on Map Matching geocoder step)
});


// Send requests to geocoder
const geocodeRequests = [];
for (const feature of fixtureTidied.features) {
    geocodeRequests.push(axios.post(geocoderUrl, feature));
}


// Get all geocoder responses and draw them on the map
axios.all(geocodeRequests).then(responses => {
    const geojson = geocoderResponsesToGeojson(responses);
    window.map.addLayer(lineLayer(fixtureWithoutElevation, '#ffff00', 6));
    window.map.addLayer(lineLayer(geojson, '#ff0000', 2));

    console.log('fixture                ', fixture);
    console.log('fixtureWithoutElevation', fixtureWithoutElevation);
    console.log('geocoderInput          ', fixtureTidied);
    console.log('geocoderOutput         ', geojson);
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

function geocoderResponsesToGeojson(responses, confidenceThreshold = 0.9) {
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
