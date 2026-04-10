<?php
header('Content-Type: application/json');
require_once 'config.php';

try {
    $sql = "SELECT id, nomreg, superfice_, ST_AsGeoJSON(geom) AS geojson FROM region_sn";
    $stmt = $pdo->query($sql);
    $features = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $geometry = json_decode($row['geojson'], true);
        $features[] = [
            'type' => 'Feature',
            'geometry' => $geometry,
            'properties' => [
                'id' => $row['id'],
                'nom' => $row['nomreg'],
                'superficie' => $row['superfice_']   // attention au nom exact
            ]
        ];
    }
    $geojson = ['type' => 'FeatureCollection', 'features' => $features];
    echo json_encode($geojson);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>