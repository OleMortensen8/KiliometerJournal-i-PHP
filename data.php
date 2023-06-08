<?php
// Database connection parameters
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'Kiliometer_liste';

try {
    // Create a new database connection
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch chart data from the last three months
    $query = "SELECT DATE_FORMAT(dato, '%M') AS dato, SUM(samledeKmTal) AS samledeKmTal
    FROM Kiliometer_liste.Kiliometer_liste kl
    WHERE dato > DATE_SUB(NOW(), INTERVAL 3 MONTH)
    GROUP BY DATE_FORMAT(dato, '%Y-%m')
    ORDER BY dato ASC";

    // Prepare and execute the query
    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Fetch the data
    $data = array();
    $labels = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $labels[] = $row['dato'];
        $data[] = $row['samledeKmTal'];
    }

    // Prepare data for chart.js
    $chart_data = array(
        'labels' => $labels,
        'data' => $data
    );

    // Output the data as JSON
    header('Content-Type: application/json');
    echo json_encode($chart_data);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
