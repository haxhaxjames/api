<?php

echo "<a target = '_blank' href='https://github.com/haxhaxjames/api.git'>GitHub repo</a><br><br>";

main();

function main () {

    $apiCall = 'https://api.covid19api.com/summary';
	$json_string = curl_get_contents($apiCall);
	$obj = json_decode($json_string);
    
    $death_arr= Array();
    $country_arr= Array();
    foreach ($obj->Countries as $i){
        array_push($death_arr,$i->TotalDeaths);
        array_push($country_arr,$i->Country);

    }

    array_multisort($death_arr, SORT_DESC, $country_arr);
    //print_r($death_arr);

    echo "<table>";

    echo "<tr>";
    echo "<th>Country Name</th>";
    echo "<th>Number of Deaths</th>";
    echo "</tr>";

    for ($i = 0;$i<10; $i++){

        echo "<tr>";
        echo "<td>" . $country_arr[$i] . "</td>";
        echo "<td>" . $death_arr[$i] . "</td>";
        echo "</tr>";

    };
    echo "</table>";

};



function curl_get_contents($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
};



?>
