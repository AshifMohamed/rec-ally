<?php
include_once("afacebook.php"); //include facebook SDK
######### Facebook API Configuration ##########
$fb_appId = FB_APP_ID; //Facebook App ID
$fb_appSecret = FB_APP_SECRET; // Facebook App Secret
$fb_homeurl = FB_HOME_URL;  //return to home
$fbPermissions = FB_PERMISSION;  //Required facebook permissions

//Call Facebook API
$app_data = array(
	'appId'  => $fb_appId,
	 'secret' => $fb_appSecret
);
$facebook = new Facebook($app_data);
$fbuser = $facebook->getUser();
//$this->session->set_userdata($fbuser);
?> 