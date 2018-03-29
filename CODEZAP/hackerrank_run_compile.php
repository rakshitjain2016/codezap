<?php
//Endpoints Of Hackerearth API
function run($hackerearth,$config){
	// Get cURL resource
	$curl = curl_init();
	// Seting some options
	curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://api.hackerrank.com/checker/submission.json',
    CURLOPT_POST => 1,
    CURLOPT_CAINFO => 'cacert.pem',
    CURLOPT_SSL_VERIFYPEER => 'true',
    CURLOPT_ENCODING => 'UTF-8',
    CURLOPT_POSTFIELDS => array(
        				'api_key' => $hackerearth['client_secret'],
                        'time_limit' => $hackerearth['time_limit']||$config['time'],
        				'memory_limit' => $hackerearth['memory_limit']||$config['memory'],
        				'source' => $config['source'],
        				'testcases' => $config['input'],
        				'wait' => true,
        				'format' => 'json',
                        'lang' => $config['language']
    )
	));
	// Send the request & returning response 
	return json_decode(curl_exec($curl), true);
}
?>