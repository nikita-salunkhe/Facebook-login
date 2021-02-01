
<!DOCTYPE html>
<html>
<head>
  <title>project</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
</head>
<body class="navbarResponsive">

  <header class="navbarResponsive">
    <!--navigation bar-->
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
      <a  class="photo" class="navbar-brand" href="#">
      <img src="logo1.jpg" height="40" width="100" alt="logo">
      </a>
      <h5 style="color:white;"><b>get_info</b></h5>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
  </div>
</nav>
</div>
</header>
<div class="modal-dialog text-center">
  <div class="main-section">
    <div class="modal-content">
        <div class="modal-body">
<?php
require ('facebook/autoload.php');
session_start();

$fb = new \Facebook\Facebook([
  'app_id' => '669740176882685',
  'app_secret' => '39088731e22f27f53e1e690cfe4ddcc4',
  'default_graph_version' => 'v2.10',
]);
if(empty($access_token))
{
  echo "<div class="."hello".">"."<center><h3><a href= '{$fb->getRedirectLoginHelper()->getLoginUrl("http://localhost/task1/first.php")}'>Login with facebook</a></h3></center>"."</div>";
  echo "</br>";
}
$access_token= $fb->getRedirectLoginHelper()->getAccessToken();
if(isset($access_token)){

  try{
    $responseUser=$fb->get('me?fields=id,name,birthday,gender,location,age_range,hometown,first_name,last_name',$access_token);
    //birthday,gender,location,age_range,hometown,first_name,last_name
    $responseImage=$fb->get('/me/picture?redirect=false&width=250&height=250',$access_token);
    $fb_user=$responseUser->getGraphUser();
    $fb_img=$responseImage->getGraphUser();


echo $fb_user->getField("id");
echo "<br>";
echo $fb_user->getField("name");
echo "<br>";
echo $fb_user->getField("gender");
echo "<br>";
echo $fb_user->getField("location");
echo "<br>";
echo $fb_user->getField("hometown");

echo "<br>";
echo $fb_user->getField("birthday");


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
</div>
</div>
</div>
</div>
</body>

</html>
