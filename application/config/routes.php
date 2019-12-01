<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

/* FrontEnd Pages*/
$route['default_controller']                                    = "Cms";
$route['login']                                                 = "Cms/login";
$route['about']                                                 = "Cms/about";
$route['recruitment_outsourcing']                               = "Cms/recruitment_outsourcing";
$route['recruitment_portal']                                    = "Cms/recruitment_portal";
$route['recruitment_consultancy']                               = "Cms/recruitment_consultancy";
$route['contact']                                               = "Cms/contact";
$route['submit_contact_us']                                     = "Cms/submit_contact_us";
$route['terms_conditions']                                      = "Cms/terms_conditions";
$route['privacy_policy']                                        = "Cms/privacy_policy";
$route['register']                                              = "Cms/register";
$route['forgot_password']                                       = "Cms/forgot_password";
$route['job-list-1']                                            = "Cms/job_list_1";
$route['posting/149jopwebnet20170714']                          = "Cms/job_detail";

$route['listings']                                              = "Job";
$route['listings/(:any)']                                       = "Job/index/$1";
$route['posting/(:any)']                                        = "Job/posting/$1";
$route['filter_results']                                        = "Job/filter_results";
$route['apply_job/(:any)']                                      = "Job/apply_job/$1";
$route['save_job_position/(:any)']                              = "Job/save_job_position/$1";
$route['like_job/(:any)']                                       = "Job/like_job/$1";
$route['newsletter_subscription']                               = "Account/newsletter_subscription";
$route['position_questions/(:any)']                             = "Portal/position_questions/$1";
$route['save_position_questions/(:any)']                        = "Portal/save_position_questions/$1";
$route['update_interview_schedule/(:any)']                      = "Portal/update_interview_schedule/$1";
$route['update_website_clicked_count']                          = "Portal/update_website_clicked_count";
$route['submit_contact_us']                                     = "Cms/submit_contact_us";
$route['submit_poll_feedback']                                  = "Cms/submit_poll_feedback";
$route['test']                                                  = "Cms/test";
$route['404_override'] 						= '';

/* Login/Registration Profile Pages */
$route['reset_password']                                        = "Account/reset_password";
$route['login']                                                 = "Account/login";
$route['login/validate/(:any)']                                 = "Account/login/validate/$1"; 
$route['login/validate']                                        = "Account/login/validate";

$route['login/linkedin']                                        = "Social/linkedin";
$route['login/google']                                          = "Social/google";
$route['login/facebook']                                        = "Social/facebook";
$route['login/twitter']                                         = "Social/twitter";
$route['login_as_admin']                                        = "Account/login_as_admin";

$route['logout_linkedin']                                       = "Social/linkedin_logout";
$route['logout_google']                                         = "Social/google_logout";
$route['logout_facebook']                                       = "Social/facebook_logout";
$route['logout_twitter']                                        = "Social/twitter_logout";
$route['logout']                                                = "Account/logout";

$route['register/candidate']                                    = "Account/register/candidate";
$route['register/employer']                                     = "Account/register/employer";

$route['people/(:any)/(:any)']                                   = "Portal/public_candidate_profile_view/$1/$2";

/* Candidate Pages */
$route['candidate']                                             = "Portal";
$route['candidate/dashboard']                                   = "Portal";

$route['candidate/profile']                                     = "Portal/candidate_profile";
$route['candidate/save_candidate_basic_profile_info']           = "Portal/save_candidate_basic_profile_info";
$route['candidate/save_candidate_contact_info']                 = "Portal/save_candidate_contact_info";
$route['candidate/save_about_you_info']                         = "Portal/save_about_you_info";
$route['candidate/save_salary_notice_period_info']              = "Portal/save_salary_notice_period_info";
$route['candidate/save_education_info']                         = "Portal/save_education_info";
$route['candidate/save_job_target_info']                        = "Portal/save_job_target_info";
$route['candidate/save_experience_info']                        = "Portal/save_experience_info";
$route['candidate/save_certificate_info']                       = "Portal/save_certificate_info";
$route['candidate/save_language_info']                          = "Portal/save_language_info";
$route['candidate/save_membership_info']                        = "Portal/save_membership_info";
$route['candidate/save_training_info']                        = "Portal/save_training_info";
$route['candidate/saved_jobs']                                  = "Portal/saved_jobs";
$route['candidate/settings']                                  = "Portal/candidate_settings";
$route['candidate/application_status'] 				= "Portal/application_status";
$route['candidate/application_history'] 			= "Portal/application_history";
$route['candidate/recommended_jobs'] 				= "Portal/recommended_jobs";
$route['candidate/visibility']                                  = "Portal/candidate_visibility";
$route['candidate/public_profile'] 				= "Portal/public_profile";
$route['candidate/delete_cv_item'] 				= "Portal/delete_cv_item";
$route['candidate/view_candidate'] 				= "Portal/view_candidate";
$route['candidate/job_history'] 				= "Portal/candidate_job_history";
$route['candidate/reply_to_message'] 				= "Portal/reply_to_message";
$route['candidate/view_messages'] 				= "Portal/view_messages";
$route['candidate/sent_messages'] 				= "Portal/sent_messages";
$route['candidate/change_email'] 				= "Account/change_email_from_settings";
$route['candidate/change_password'] 				= "Account/change_password_from_settings";
$route['candidate/save_candidate_cv_video'] 		= "Portal/upload_cv_video";
/* Employer/Company Pages */
$route['employer'] 						= "Portal/employer_dashboard";
$route['employer/dashboard'] 					= "Portal/employer_dashboard";
$route['employer/reports'] 					= "Portal/reports";
$route['employer/profile'] 					= "Portal/employer_profile";
$route['employer/service'] 					= "Portal/employer_service";
$route['employer/view_candidate/(:num)'] 			= "Portal/view_candidate/$1";
$route['employer/positions/(:any)'] 				= "Portal/positions/$1";
$route['employer/draft_candidate_message/(:num)'] 		= "Portal/draft_candidate_message/$1";
$route['employer/candidate_message'] 				= "Portal/candidate_message";
$route['employer/send_candidate_message'] 			= "Portal/send_candidate_message";

$route['employer/candidate_message_list'] 	                = "Portal/candidate_message_list";
$route['employer/received_message_list'] 	                = "Portal/received_message_list";

$route['employer/search_candidate'] 				= "Portal/search_candidate_ajax";
$route['employer/search_candidate_ajax'] 			= "Portal/search_candidate_ajax";
$route['employer/job_profile'] 					= "Portal/job_profile_listing";
$route['employer/update_position_filled_status/(:num)'] 	= "Portal/update_position_filled_status/$1";
$route['employer/update_service/(:num)'] 	= "Portal/update_service/$1";
$route['employer/job_profile/(:any)'] 				= "Portal/job_profile/$1";
$route['employer/job_profile/process_settings/(:any)'] 		= "Portal/process_settings/$1";
$route['employer/job_profile/process/(:any)'] 			= "Portal/shortlist_process/$1";
$route['employer/job_profile/view_candidates/(:any)/(:any)'] 	= "Portal/view_candidates/$1/$2";
$route['employer/schedule_interview/(:num)'] 			= "Portal/schedule_interview/$1";
$route['employer/save_question_profile_answers/(:any)'] 	= "Portal/save_question_profile_answers/$1";
$route['employer/save_test_selection_points/(:num)'] 		= "Portal/save_test_selection_points/$1";
$route['employer/question_profile'] 				= "Portal/question_profile";
$route['employer/save_job_profile'] 				= "Portal/save_job_profile";
$route['employer/delete_job_profile/(:num)'] 			= "Portal/delete_job_profile/$1";
$route['employer/save_job_profile_attachments'] 		= "Portal/save_job_profile_attachments";
$route['employer/save_job_profile_question'] 			= "Portal/save_job_profile_question";
$route['employer/delete_job_profile_question/(:any)/(:any)'] 	= "Portal/delete_job_profile_question/$1/$2";
$route['employer/save_basic_company_info'] 			= "Portal/save_basic_company_info";
$route['employer/save_representative'] 				= "Portal/save_representative";
$route['employer/save_company_registration_info'] 		= "Portal/save_company_registration_info";
$route['employer/save_about_company_info'] 			= "Portal/save_about_company_info";
$route['employer/change_email'] 				= "Account/change_email_from_settings";
$route['employer/change_password'] 				= "Account/change_password_from_settings";
$route['employer/settings']                                  = "Portal/employer_settings";

/* Admin Pages */
$route[ADMIN_PATH_NAME]                                         = "Admin/index";
$route[ADMIN_PATH_NAME.'/save_poll']                            = "Admin/save_poll";
$route[ADMIN_PATH_NAME.'/delete_poll/(:num)']                   = "Admin/delete_poll/$1";
$route[ADMIN_PATH_NAME.'/approve_company']                      = "Admin/approve_company";
$route[ADMIN_PATH_NAME.'/remind_candidate']                     = "Admin/remind_candidate";
$route[ADMIN_PATH_NAME.'/save_newsletter']                      = "Admin/save_newsletter";
$route[ADMIN_PATH_NAME.'/send_newsletter']                      = "Admin/send_newsletter";
$route[ADMIN_PATH_NAME.'/save_administrator']                   = "Admin/save_administrator";
$route[ADMIN_PATH_NAME.'/update_profile_status']                = "Admin/update_profile_status";
$route[ADMIN_PATH_NAME.'/make_company_featured']                = "Admin/make_company_featured";
$route[ADMIN_PATH_NAME.'/login_to_account/(:num)']              = "Admin/login_to_account/$1";
$route[ADMIN_PATH_NAME.'/delete_profile']                       = "Admin/delete_profile";
$route[ADMIN_PATH_NAME.'/get_employers']                        = "Admin/get_employers";
$route[ADMIN_PATH_NAME.'/get_candidates']                       = "Admin/get_candidates";
$route[ADMIN_PATH_NAME.'/delete_company']                       = "Admin/delete_company";
$route[ADMIN_PATH_NAME.'/delete_info_request']                  = "Admin/delete_info_request";

/* End of file routes.php */
/* Location: ./application/config/routes.php */