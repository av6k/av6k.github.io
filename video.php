<?php
error_reporting(0);
define("FILENAME", substr($_SERVER['PHP_SELF'], strripos($_SERVER['PHP_SELF'], "/") + 1));
function Httpdata($url, $headers = false, $data = false, $proxy = false, $header = 0, $time = 10, $gzip = 'gzip') {
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
if (!$headers) {
$headers = array(
'Referer: ' . $url,
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.87 Safari/537.36'
);
}
if (substr($url, 0, 6) == 'https:') {
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
} 
if ($data) {
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
} 
if ($proxy) {
list($hos, $pro) = explode(":", $proxy);
curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_PROXY, $hos);
curl_setopt($ch, CURLOPT_PROXYPORT, $pro);
curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
} 
curl_setopt($ch, CURLOPT_HEADER, $header);
curl_setopt($ch, CURLOPT_NOBODY, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $time);
curl_setopt($ch, CURLOPT_TIMEOUT, $time);
curl_setopt($ch, CURLOPT_ENCODING, $gzip);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$content = curl_exec($ch);
curl_close($ch);
return $content;
}
function baseh_ecode($str) {
$new = base64_encode(convert_uuencode($str));
$src = array("_a", "_b", "_c");
$dist = array("/", "+", "=");
$old = str_replace($dist, $src, $new);
return $old;
} 
function baseh_decode($str) {
$src = array("_a", "_b", "_c");
$dist = array("/", "+", "=");
$old = str_replace($src, $dist, $str);
$new = convert_uudecode(base64_decode($old));
return $new;
} 
$aaa = '';
$tts = '';
$aaa = $_GET['url'];
$tts = $_GET['file'];
if($tts){
$headerss = array(
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
'Origin: https://159i.com/',
'Host: 159i.com',
'Referer: https://159i.com/video/32907.html',
);
$tts = baseh_decode($tts);
if (substr($tts, 0, 5) == 'http:' || substr($tts, 0, 6) == 'https:') {
$data =  Httpdata($tts,$headerss);
if($data){
header('Content-type: video/mp2t');
echo $data;exit;
}
}
}
else if($aaa){
header('Content-type: application/vnd.apple.mpegurl');
header ('Content-Disposition: attachment;filename="'.time().'.m3u8"');
if (strstr($aaa, 'www.forma') || strstr($aaa, 'www.foxmaxka')) {
$pac = explode("/",$aaa);
$uuk = $pac[0].'//'.$pac[2];
$headers = array(
'Referer: https://www.up647.pw/index.php/vod/play/id/'.rand(1,100000).'/sid/1/nid/1.html',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.87 Safari/537.36'
);
$data = Httpdata($aaa,$headers);
$marr = explode("\n", $data);
$i = 0;
while ($i < count($marr)) {
if (substr($marr[$i],0,6) == "/ppvod") {
$yts = str_replace("\r", "", $marr[$i]);
$xts = $uuk . $yts;
$data = str_replace($yts, $xts, $data);
}
$i++;
}
if($data){
echo $data;
}
}
else if( strstr($aaa,'vvv.aaaf.info') || strstr($aaa,'cdnedge.live') ){
$pac = substr($aaa, 0, strrpos($aaa, "/"));
$data = Httpdata($aaa);
$marr = explode("\n", $data);
$i = 0;
while ($i < count($marr)) {
if (substr($marr[$i], -3) == ".ts" || stripos($marr[$i], '.ts?')) {
$yts = str_replace("\r", "", $marr[$i]);
$xts = FILENAME."?file=".baseh_ecode($pac.'/'.$yts);
$data = str_replace($yts, $xts, $data);
}
$i++;
}
if($data){
echo $data;
}
}
else{
echo '#EXTM3U
#EXT-X-STREAM-INF:PROGRAM-ID=1,BANDWIDTH=500000
'.$aaa.'
';
}
}
