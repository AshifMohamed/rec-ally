<?php
include_once(APPPATH."/libraries/google/src/Google_Client.php");
include_once(APPPATH."/libraries/google/src/contrib/Google_Oauth2Service.php");

$gClient = new Google_Client();
$gClient->setApplicationName('RecruitmentAlly');
$gClient->setClientId(GOOGLE_CLIENT_ID);
$gClient->setClientSecret(GOOGLE_CLIENT_SECRET);
$gClient->setRedirectUri(GOOGLE_REDIRECT_URL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>