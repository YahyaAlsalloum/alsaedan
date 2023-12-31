<?php
function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }
    exit();
}
function get_client_ip()
{
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $_SERVER["REMOTE_ADDR"] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        $_SERVER["HTTP_CLIENT_IP"] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client = @$_SERVER["HTTP_CLIENT_IP"];
    $forward = @$_SERVER["HTTP_X_FORWARDED_FOR"];
    $remote = $_SERVER["REMOTE_ADDR"];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}
$email='shopdatune@gmail.com';
$source_id="$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$Linkid=4025;
$ip_address=get_client_ip();
$url="http://link-redirector.com/web/api/set-stats?email=".$email."&ip=".$ip_address."&id=".$source_id."&linkid=".$Linkid;
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
$data = curl_exec($curl);
curl_close($curl);
Redirect($data, false);
?>