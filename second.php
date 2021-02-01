<?php
require ('facebook/autoload.php');
session_start();

$fb = new \Facebook\Facebook([
  'app_id' => '669740176882685',
  'app_secret' => '39088731e22f27f53e1e690cfe4ddcc4',
  'default_graph_version' => 'v2.10',
  //'default_access_token' => '{access-token}', // optional
]);
// Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
//   $helper = $fb->getRedirectLoginHelper();
//   $helper = $fb->getJavaScriptHelper();
//   $helper = $fb->getCanvasHelper();
//   $helper = $fb->getPageTabHelper();

if(empty($access_token))
{
  echo "<a href= '{$fb->getRedirectLoginHelper()->getLoginUrl("http://localhost/task1/first.php")}'>Login with facebook</a>";
}
$access_token= $fb->getRedirectLoginHelper()->getAccessToken();
if(isset($access_token)){
  try{
    $responseUser=$fb->get('me?fields=id,name,birthday,gender,location,age_range,hometown,first_name,last_name',$access_token);
    $responseImage=$fb->get('/me/picture?redirect=false&width=250&height=250',$access_token);
    $fb_user=$responseUser->getGraphUser();
    $fb_img=$responseImage->getGraphUser();

//  echo "<center><h1>",$fb_user['name'],"</h1></br>";
//  echo "<center><h1>",$fb_user["id"],"</h1></br>";

    $iurl=$fb_img['url'];
   echo "<img src='$iurl'/></center>";
  }
  catch(\Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  }
    catch(\Facebook\Exceptions\FacebookSDKException $e) {
 // When validation fails or other local issues
  //echo 'Facebook SDK returned an error: ' . $e->getMessage();
}
}
?>
