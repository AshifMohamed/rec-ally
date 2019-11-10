<?php 
defined('BASEPATH') OR exit('No direct script access is allowed');

/**
* Author : NIFAL MUNZIR
*/
class Social extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('account_model');
    }

    public function google()
    {
        include_once(APPPATH."/libraries/google/src/Google_Client.php");
        include_once(APPPATH."/libraries/google/src/contrib/Google_Oauth2Service.php");

        $gClient = new Google_Client();
        $gClient->setApplicationName('Login to RecruitementAlly');
        $gClient->setClientId(GOOGLE_CLIENT_ID);
        $gClient->setClientSecret(GOOGLE_CLIENT_SECRET);
        $gClient->setRedirectUri(GOOGLE_REDIRECT_URL);

        $google_oauthV2 = new Google_Oauth2Service($gClient);
        //print($_GET['code']);exit;
        if(isset($_GET['code'])){
            $gClient->authenticate();
            $_SESSION['google_token'] = $gClient->getAccessToken();
            header('Location: ' . filter_var(GOOGLE_REDIRECT_URL, FILTER_SANITIZE_URL));
        }

        if (isset($_SESSION['google_token'])) {
            $gClient->setAccessToken($_SESSION['google_token']);
        }

        if ($gClient->getAccessToken()) {
            $user_profile = $google_oauthV2->userinfo->get();
            $arr_name = explode(' ', $user_profile['name']); 
            if(isset($arr_name[0]))
                $user_profile['first_name'] = $arr_name[0];
            if(isset($arr_name[1]))
                $user_profile['last_name'] = $arr_name[1];
            $user_profile['password'] = '';

            //DB Insert
            /*$gUser = new Users();
            $gUser->checkUser('google',$userProfile['id'],$userProfile['given_name'],$userProfile['family_name'],$userProfile['email'],$userProfile['gender'],$userProfile['locale'],$userProfile['link'],$userProfile['picture']);*/
            $user_profile['email'] = strtolower($user_profile['email']);
            $user_profile['registration_code'] = md5($user_profile['email']);
            $is_registration_successful = $this->register_social_user($user_profile,'google');
            if($is_registration_successful)
            {
                $this->set_send_email_data($user_profile['email'],$user_profile['name']);
            }
            else
            {
                $login_info = $this->account_model->get_login_info_by_type_email($user_profile['email'],'google');
                if(isset($login_info->is_active))
                {
                    if($login_info->is_active)
                    {
                        $this->session->set_userdata('google_data',$user_profile);// Storing Google User Data in Session
                        $this->session->set_userdata('google_token',$gClient->getAccessToken());
                        $user_profile['logged_user_type'] = 'candidate';
                        set_user_session('google',$user_profile);
                        $last_logged_data = array(
                            'ip_address' => $this->input->ip_address(),
                            'login_id' => $login_info->login_id,
                        );
                        $this->account_model->update_last_logged_in($last_logged_data);
                        set_message('You have been successfully logged in! ','alert-success');
                    }
                    else
                        set_message('Please activate your account before you could login! ','alert-danger');
                }
                else
                    set_message('Couldn\'t log you in. Make sure the email address used for google isn\'t already registered with the site','alert-danger');

            }
            redirect(base_url());

        } else {
            $authUrl = $gClient->createAuthUrl();
        }
    }

    private function set_send_email_data($to_email,$name='')
    {
        $email_data['registered_name'] = $name;
        $email_data['registration_code'] = md5($to_email);
        $email_data['subject'] = 'Thank You For Signing Up';
        $email_data['from_email'] = 'recruitment@recruitment-ally.com';
        $email_data['from_email_title'] = 'RecruitmentAlly';
        $email_data['to_email'] = $to_email;
        $email_data['type'] = 'registration';
        $email_data['user_type'] = 'candidate';


        $this->send_email($email_data,'email_verification');
        $this->session->set_tempdata('registration_confirmation', '1',5);
            //set_message('Your account has been successfully created. Please check your email to confirm your email address','alert-success');
    }

    public function facebook()
    {
        print 'Under Development. Please try again later.';exit;
        include_once(APPPATH."libraries/afb2/fbconfig.php");
        if($session)
        {
            $request = new FacebookRequest( $session, 'GET', '/me' );
            print_r($request);exit;
            /*$user_profile['password'] = '';
            $user_profile['registration_code'] = md5($user_profile['email']);
            $is_registration_successful = $this->register_social_user($user_profile,'facebook');
            if($is_registration_successful)
            {
                    $this->set_send_email_data($user_profile['email']);
            }
            else
            {
                    $login_info = $this->account_model->get_login_info_by_type_email($user_profile['email'],'facebook');
                    if($login_info->is_active)
                    {
                            $this->session->set_userdata('facebook_data',$user_profile);// Storing Facebook User Data in Session
                            $user_profile['logged_user_type'] = 'candidate';
                            set_user_session('facebook',$user_profile);
                            set_message('You have been successfully logged in! ','alert-success');
                    }
                    else
                            set_message('Please activate your account before you could login! ','alert-danger');
                    }*/
            //set error msg
                    redirect(base_url(),'refresh');
                    /*print_r($user_profile);exit;*/
        }
    }

    public function linkedin()
    {
        include_once(APPPATH."libraries/linkedin/config.php");
        include_once(APPPATH."libraries/linkedin/http.php");
        include_once(APPPATH."libraries/linkedin/oauth_client.php");

        if (isset($_GET["oauth_problem"]) && $_GET["oauth_problem"] <> "") {
        // in case if user cancel the login. redirect back to home page.
            $_SESSION["err_msg"] = $_GET["oauth_problem"];
            header("location:index.php");
            exit;
        }

        $client = new oauth_client_class;

        $client->debug = false;
        $client->debug_http = true;
        $client->redirect_uri = LINKEDIN_CALLBACK_URL;

        $client->client_id = LINKEDIN_API_KEY;
        $application_line = __LINE__;
        $client->client_secret = LINKEDIN_API_SECRET;

        if (strlen($client->client_id) == 0 || strlen($client->client_secret) == 0)
                die('Please go to LinkedIn Apps page https://www.linkedin.com/secure/developer?newapp= , '.
                        'create an application, and in the line '.$application_line.
                        ' set the client_id to Consumer key and client_secret with Consumer secret. '.
                        'The Callback URL must be '.$client->redirect_uri).' Make sure you enable the '.
        'necessary permissions to execute the API calls your application needs.';

        /* API permissions
         */
        $client->scope = LINKEDIN_SCOPE;
        if (($success = $client->Initialize())) 
        {
            if (($success = $client->Process())) {
                if (strlen($client->authorization_error)) {
                    $client->error = $client->authorization_error;
                    $success = false;
                } elseif (strlen($client->access_token)) {
                    $success = $client->CallAPI(
                            'http://api.linkedin.com/v1/people/~:(id,email-address,first-name,last-name,location,picture-url,public-profile-url,formatted-name)', 
                            'GET', array(
                                    'format'=>'json'
                                    ), array('FailOnAccessError'=>true), $user);
                }
            }
            $success = $client->Finalize($success);
        }
        if ($client->exit) exit;
        if ($success) {
            $user_profile = array(
                'first_name' => $user->firstName,
                'last_name' => $user->lastName,
                'email' => $user->emailAddress,
                'pictureUrl' => isset($user->pictureUrl) ? isset($user->pictureUrl) : '' ,
                'password' => '',
                );
            $user_profile['registration_code'] = md5($user_profile['email']);

            $is_registration_successful = $this->register_social_user($user_profile,'linkedin');
            if($is_registration_successful)
            {
                $user_profile['name'] =  $user_profile['first_name'].' '.$user_profile['last_name'];
                $this->set_send_email_data($user_profile['email'],$user_profile['name']);
            }
            else
            {
                $login_info = $this->account_model->get_login_info_by_type_email($user_profile['email'],'linkedin');
                //print_r($user_profile['email']);exit;
                if(isset($login_info->is_active))
                {
                    if($login_info->is_active)
                    {
                        $this->session->set_userdata('linkedin_data',$user_profile);// Storing Facebook User Data in Session
                        $user_profile['logged_user_type'] = 'candidate';
                        set_user_session('linkedin',$user_profile);
                        $last_logged_data = array(
                                'ip_address' => $this->input->ip_address(),
                                'login_id' => $login_info->login_id,
                        );
                        $this->account_model->update_last_logged_in($last_logged_data);
                        set_message('You have been successfully logged in! ','alert-success');
                    }
                    else
                        set_message('Please activate your account before you could login! ','alert-danger');
                }
                else
                    set_message('Couldn\'t log you in. Make sure the email address used for linkedin isn\'t already registered with the site','alert-danger');
            }
            //$_SESSION['user'] = $user;
            //print_r($user);exit;
        } else {
            set_message($client->error,'alert-danger');
            $_SESSION["err_msg"] = $client->error;
        }
        redirect(base_url(),'refresh');
        //header("location:index.php");
        //exit;
    }

    public function twitter()
    {
        //print 'Please check back later. This component is under development';exit;
        require_once(APPPATH."libraries/twitter/twitteroauth/twitteroauth.php");	

        if(isset($_GET['oauth_token']))
        {
            //print $this->session->request_token_secret;exit;
            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $this->session->request_token, $this->session->request_token_secret);
            //print_r($this->input->get('oauth_verifier'));exit;
            $access_token = $connection->getAccessToken($this->input->get('oauth_verifier'));
            //print_r($access_token);exit;
            if($access_token)
            {
                //print_r($access_token);exit;
                $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
                $params =array();
                $params['include_entities']='false';
                $params['include_email']='true';
                $content = $connection->get('account/verify_credentials',$params);
                //print_r($content);exit;
                if($content && isset($content->screen_name) && isset($content->name))
                {
                    if(!is_null($content->email))
                    {
                        //print '<pre>';print_r($content);exit;
                        $arr_name = explode(' ', $content->name); 
                        //print_r($arr_name);
                        $user_profile = array(
                            'email' => $content->email,
                            'pictureUrl' => isset($content->profile_image_url) ? isset($user->profile_image_url) : '' ,
                            'password' => '',
                        );
                        // $user_profile['first_name'] = '';
                        // $user_profile['last_name'] = '';
                        if(isset($arr_name[0]))
                            $user_profile['first_name'] = $arr_name[0];
                        if(isset($arr_name[1]))
                            $user_profile['last_name'] = $arr_name[1];
                        $user_profile['registration_code'] = md5($user_profile['email']);
                        //print '<pre>';print_r($user_profile);exit;
                        $is_registration_successful = $this->register_social_user($user_profile,'twitter');
                        if($is_registration_successful)
                        {
                            $user_profile['name'] =  $user_profile['first_name'].' '.$user_profile['last_name'];
                            $this->set_send_email_data($user_profile['email'],$user_profile['name']);
                        }
                        else
                        {
                            $login_info = $this->account_model->get_login_info_by_type_email($user_profile['email'],'twitter');
                                    //print_r($user_profile['email']);exit;
                            if(isset($login_info->is_active))
                            {
                                if($login_info->is_active)
                                {
                                    $this->session->set_userdata('twitter_data',$user_profile);// Storing Facebook User Data in Session
                                    $user_profile['logged_user_type'] = 'candidate';
                                    set_user_session('twitter',$user_profile);
                                    $last_logged_data = array(
                                            'ip_address' => $this->input->ip_address(),
                                            'login_id' => $login_info->login_id,
                                    );
                                    $this->account_model->update_last_logged_in($last_logged_data);
                                    set_message('You have been successfully logged in! ','alert-success');
                                }
                                else
                                    set_message('Please activate your account before you could login! ','alert-danger');
                            }
                            else
                                set_message('Couldn\'t log you in. Make sure the email address used for twiiter isn\'t already registered with the site','alert-danger');
                        }
                        // $_SESSION['name']=$content->name;
                        // $_SESSION['image']=$content->profile_image_url;
                        // $_SESSION['twitter_id']=$content->screen_name;
                    }
                    else
                        set_message('No email address found. Please sign up using another method','alert-danger');
                }
                else
                {
                    set_message('Login Error!','alert-danger');
                }
            }
            else
            {
                set_message('Login Error!','alert-danger');
            }
            //redirect to main page.
            redirect(base_url(),'refresh');
        }			
        else
        {
            $connection = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET);
            // print OAUTH_CALLBACK;exit;
            $request_token = $connection->getRequestToken(OAUTH_CALLBACK); //get Request Token
            if(	$request_token)
            {
                $token = $request_token['oauth_token']; 
                $this->session->set_userdata('request_token',$token);
                $this->session->set_userdata('request_token_secret',$request_token['oauth_token_secret']);				
                switch ($connection->http_code) 
                {
                    case 200:
                    $url = $connection->getAuthorizeURL($token);
                            //redirect to Twitter .
                    redirect($url,'refresh'); 
                    break;
                    default:
                    set_message("Connection with twitter Failed",'alert-danger');
                    break;
                }

            }
            else //error receiving request token
            {
                set_message("Error Receiving Request Token",'alert-danger');
            }
            //redirect to main page.
            redirect(base_url(),'refresh');
        }
    }

    public function google_logout()
    {
        $this->session->unset_userdata('google_token');
        $this->session->unset_userdata('google_data');
                //($_SESSION['google_token']);
                //unset($_SESSION['google_data']); //Google session data unset
        $gClient = new Google_Client();
        $gClient->revokeToken();
        $this->session->userdata = array();	   
               //$this->session->sess_destroy();
        set_message('You have been successfully logged out! ','alert-success');
                //keep_flashmessage();
        redirect(base_url(),'refresh');
    }

    public function facebook_logout()
    {
        include_once(APPPATH."libraries/afacebook/config.php");
        $facebook->destroySession();
        unset($_SESSION['userdata']);
        $this->session->userdata = array();	   
                //$this->session->sess_destroy();
        set_message('You have been successfully logged out! ','alert-success');
                //keep_flashmessage();
        redirect(base_url(),'refresh');
    }

    public function linkedin_logout()
    {
        unset($_SESSION);
        $this->session->userdata = array();	   
                //$this->session->sess_destroy();
        set_message('You have been successfully logged out! ','alert-success');
                //keep_flashmessage();
        redirect(base_url(),'refresh');
    }

    public function twitter_logout()
    {
        unset($_SESSION);
        $this->session->userdata = array();	   
                //$this->session->sess_destroy();
        set_message('You have been successfully logged out! ','alert-success');
                //keep_flashmessage();
        redirect(base_url(),'refresh');
    }


    public function register_social_user($social_info,$login_method,$user_type='candidate')
    {

        $user_type = strtolower($user_type);
        $email = $social_info['email'];
        $register_data = array();
        if($this->account_model->is_user_exist(array('email'=>$email)) == 0)
        {
            //print_r($social_info);exit;
            if($user_type == 'candidate')
            {
                $register_data = array(
                        'first_name' => $social_info['first_name'],
                        'last_name' => $social_info['last_name']
                        );
            }
            elseif($user_type == 'employer')
            {
                $register_data = array(
                        'name' => $social_info['company_name'],
                        'owner' => $social_info['email']
                        );
            }

            $user_type_id = $this->account_model->get_user_type_id_by_type(ucfirst($user_type));
            $login_data = array(
                'email' => $email,
                'password'=> md5($social_info['password']),
                'user_type_id' =>$user_type_id,
                'method' => $login_method,
                'registration_code' => $social_info['registration_code']
                );
                    //print($user_type_id);exit;
                    //array_push($register_data,$login_data);

            $login_id = $this->account_model->insert_data($login_data,'login_id','login');
            $user_profile_data = array(
                'login_id' => $login_id,
                'is_active' => 0,
                );

            $user_profile_id = $this->account_model->insert_data($user_profile_data,'user_profile_id','user_profile');
            $register_data['user_profile_id'] = $user_profile_id;
            $main_table_name = 'candidate_profile';
            if($user_type == 'employer')
            {
                $main_table_name = 'company_profile';

            }
            $this->account_model->insert_data($register_data,$main_table_name.'_id',$main_table_name);
                    // print_r($social_info);exit;
            return 1;
        }
        return 0;
    }

    private function send_email($email_data,$template_name)
    {
        $this->load->library('email');
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $data = $email_data;
        $this->email->from($data['from_email'], $data['from_email_title']);
        $this->email->to($data['to_email']); 
                //$this->email->cc('another@another-example.com'); 
                //$this->email->bcc('them@their-example.com'); 
        $this->email->bcc('nifalm@gmail.com'); 
        $this->email->subject($data['subject']);
        $this->email->message($this->load->view('/templates/'.$template_name,$data,true));	

        $this->email->send();
    }
}
?>