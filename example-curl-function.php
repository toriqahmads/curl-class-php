<?php
require_once("class.php");

$curl = new curl();

$settings = array("url" => "https://detik.com",
                  "url_ref" => "https://google.com",
                  "useragent" => "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:36.0) Gecko/20100101 Firefox/36.0",
                  "follow_location" => true,
                  "return_transfer" => true,
                  "header" => true,
                  "http_builder" => array("host" => "detik.com",
                                          "connection" => "keep-alive"),
                  "custom_req" => array("type" => "GET"));
$curl->settings($settings);
$response = $curl->curl();

print_r($response);

?>
