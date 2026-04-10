// Initialisation de la carte
var map = L.map('map').setView([14.5, -14.5], 7); // centre Sénégal

L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OSM</a> &copy; CartoDB'
}).addTo(map);

// Charger les régions via l'API
fetch('api/regions.php')
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            console.error(data.error);
            return;
        }
        L.geoJSON(data, {
            style: {
                color: '#3388ff',
                weight: 2,
                fillOpacity: 0.3
            },
            onEachFeature: function(feature, layer) {
                var props = feature.properties;
                layer.bindPopup(`<b>${props.nom}</b><br>Superficie: ${props.superficie} ha`);
            }
        }).addTo(map);
    })
    .catch(err => console.error('Erreur:', err));