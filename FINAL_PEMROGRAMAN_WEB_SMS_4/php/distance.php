<?php
function getDistance($from, $to) {
    $distances = [
        'Makassar' => ['Manado' => 1100, 'Palu' => 600, 'Kendari' => 500, 'Gorontalo' => 1000, 'Mamuju' => 400],
        'Manado'   => ['Makassar' => 1100, 'Palu' => 700, 'Kendari' => 1200, 'Gorontalo' => 300, 'Mamuju' => 1000],
        'Palu'     => ['Makassar' => 600, 'Manado' => 700, 'Kendari' => 500, 'Gorontalo' => 600, 'Mamuju' => 300],
        'Kendari'  => ['Makassar' => 500, 'Manado' => 1200, 'Palu' => 500, 'Gorontalo' => 1100, 'Mamuju' => 800],
        'Gorontalo'=> ['Makassar' => 1000, 'Manado' => 300, 'Palu' => 600, 'Kendari' => 1100, 'Mamuju' => 900],
        'Mamuju'   => ['Makassar' => 400, 'Manado' => 1000, 'Palu' => 300, 'Kendari' => 800, 'Gorontalo' => 900]
    ];

    return $distances[$from][$to] ?? 0;
}

function calculatePrice($from, $to) {
    $distance = getDistance($from, $to);
    $rate = 450; 
    return $distance * $rate;
}

?>
