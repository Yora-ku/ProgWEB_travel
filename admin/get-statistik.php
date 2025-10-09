<?php
require_once 'config/connect.php';

$date = $_GET['date'] ?? date('Y-m-d');

// --- Data per jam ---
$q1 = mysqli_query($conn, "
    SELECT HOUR(created_at) AS jam, COUNT(*) AS total
    FROM booking
    WHERE DATE(created_at) = '$date'
    GROUP BY HOUR(created_at)
");
$jamLabels = [];
$jamValues = [];
while ($r = mysqli_fetch_assoc($q1)) {
    $jamLabels[] = sprintf('%02d.00', $r['jam']);
    $jamValues[] = $r['total'];
}

// --- Data per hari (1 minggu terakhir) ---
$q2 = mysqli_query($conn, "
    SELECT DATE(created_at) AS tgl, COUNT(*) AS total
    FROM booking
    WHERE created_at >= DATE_SUB('$date', INTERVAL 6 DAY)
    GROUP BY DATE(created_at)
");
$hariLabels = [];
$hariValues = [];
while ($r = mysqli_fetch_assoc($q2)) {
    $hariLabels[] = date('D', strtotime($r['tgl']));
    $hariValues[] = $r['total'];
}

echo json_encode([
    'jam' => ['labels' => $jamLabels, 'values' => $jamValues],
    'hari' => ['labels' => $hariLabels, 'values' => $hariValues]
]);
?>
