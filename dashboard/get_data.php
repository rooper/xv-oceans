<?php
//$url = "http://169.254.63.189";
//$url = "http://localhost/xv/info.html";
$url = $_GET['source'];
//echo contents of 169.254.63.189 - module 1
if (isSiteAvailable($url))
{
	echo file_get_contents($url);
}

function isSiteAvailable($url)
   {
           //check, if a valid url is provided
           if(!filter_var($url, FILTER_VALIDATE_URL))
           {
                   return 'URL provided wasn\'t valid';
           }
 
           //make the connection with curl
           $cl = curl_init($url);
           curl_setopt($cl,CURLOPT_CONNECTTIMEOUT,10);
           curl_setopt($cl,CURLOPT_HEADER,true);
           curl_setopt($cl,CURLOPT_NOBODY,true);
           curl_setopt($cl,CURLOPT_RETURNTRANSFER,true);
 
           //get response
           $response = curl_exec($cl);
 
           curl_close($cl);
 
           if ($response) return 'Site seems to be up and running!';
 
           return 'Oops nothing found, the site is either offline or the domain doesn\'t exist';
   }

?>