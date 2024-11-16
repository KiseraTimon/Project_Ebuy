<?php
// MPESA API KEYS
$consumerKey = 'KqWmHyVyyLJ4Hcf6vh4RDBJrxoipJmw3J2svt2GW0E1obxkA';
$consumerSecret = 'bYokkglmyKQhMZR0VAwH73eEpzGg4nmL5iSHxhKncNJbw4l2V2YnI7KyJ5AQkt2R';

// ACCESS TOKEN URL
$access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
$payment_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$credentials = base64_encode($consumerKey.':'.$consumerSecret);
$headers = ['Content-Type:application/json; charset=utf-8'];
$curl = curl_init($access_token_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);   
curl_setopt($curl, CURLOPT_HEADER, FALSE);  
curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);  
$result = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$result = json_decode($result);
$access_token = $result->access_token;
curl_close($curl);
?>
