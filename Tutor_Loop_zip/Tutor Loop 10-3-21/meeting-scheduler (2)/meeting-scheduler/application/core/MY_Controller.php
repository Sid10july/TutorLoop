<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Uncomment following line and override display error setting if disabled in production Environment, No need to uncomment for development Environment */
//error_reporting(-1); ini_set('display_errors', 1);

date_default_timezone_set("Asia/Kolkata");
class MY_Controller extends CI_Controller
{


	public function __construct()
	{
		 
		parent::__construct();

		
		/*get parent munu and submenu start*/
		/* $role_fid = 0;
		if (isset($_SESSION['role_fid'])) {
			$role_fid = $_SESSION['role_fid'];
		
			$this->getParentMenu = $this->common_model->getParentMenu($role_fid);

			foreach ($this->getParentMenu as $key => $value) {
			 	$this->getParentMenu[$key]->sub_menu = $this->common_model->getSubMenu($value->module_submodule_id,$value->role_fid); 
	 		}
 		} */
 		/*get parent munu and submenu end*/


 		

		 

		/*$this->_check_migration();*/
		//$this->content = new stdClass();
		//$this->content->money_format 		= new NumberFormatter($locale = 'en_IN', NumberFormatter::DECIMAL);

		/* meta info */

		

		$this->s 	= "Want a quick response to your IT issue? Look no further";
		/*$this->content->meta_keywords 		= "ePrompto";
		$this->content->og_title	 		= NULL;
		$this->content->og_image	 		= front_asset()."img/f-logo.png";

		$this->content->current_directory 	= strtolower($this->router->fetch_directory());
		$this->content->current_section 		= strtolower($this->router->fetch_class());
		$this->content->current_sub_section = strtolower($this->router->fetch_method());
		$this->content->current_url 		= str_replace(base_url(), '',current_url());
		$this->content->userdata 			= $this->session->userdata();
		$this->_get_sess_expiration_time();

		$this->_check_access();
		$this->content->pagetitle = '';
		$this->content->breadcrumb = [];
		$enc_password = $this->hash_password('123456');
		$this->content->no_email = "no_email".time()."@e.com";*/

		############# Check social login password #############
		/*$is_members = $this->uri->segment(1);
		if($is_members == 'members'){
			$logged_in_user = $this->session->userdata('user_id');
			$this->content->is_blank_social_password = $this->my_model->check_social_password($logged_in_user);*/
			//echo $this->db->last_query();
		/*}*/
		############# Check social login password #############
/*
		$log_user_id = $this->session->userdata('user_id');
		$access_obj = $this->get_module_wise_data($log_user_id);
		$access_data = [];
		foreach ($access_obj as $key => $access) {
			$access_data[] = $access->module_id;
		}
		$this->content->access_data = $access_data;
		$this->content->modules = $this->_get_module();

		$current_mod = $this->uri->segment(2);
		$this->content->module_permission = $this->_get_permission($log_user_id, $current_mod);*/
		//xdebug($this->db->last_query());
		//xdebug($this->content->module_permission);

		/*if (!isset($_SESSION['logged_in'])) {
			//redirect('Login','refresh');
		}*/
 	}

 	protected function hash_password($password){
		 
		$enc_key = $this->config->item('encryption_key');
		$options = [
		    'salt' => '_Key&123$@!#'.$enc_key.'&123$@!#_',
		];
		return @password_hash($password, PASSWORD_BCRYPT, $options);
	}

	protected function set_pagetitle($title){
		$this->content->pagetitle = $title;
	}

	protected function set_breadcrumb($arr){
		$this->content->breadcrumb = $arr;
	}
	private function _check_migration()
	{
		$this->config->load('migration');
		if($this->config->item('migration_enabled'))
		{
			$this->load->library('migration');
			//$this->migration->latest();
			if($this->migration->latest()){
				$this->eprompto->init_queries();
			}
		}
	}

	private function _get_sess_expiration_time()
	{
		if($this->session->userdata('user_id'))
		{
			$this->config->load('config');
			$this->content->sess_expiration_time = $this->config->item('sess_expiration') * 1000;
		}
	}

	private function _check_access()
	{
		$logged_in_user = $this->session->userdata('user_id');
		$folder 	= $this->content->current_directory;
		$class 		= $this->content->current_section;
		$method 	= $this->content->current_sub_section;
		$access_for = $class;
		$modify_for = $class;
		if(isset($folder) && !empty($folder)){
			$access_for = $folder.$class;
		}
		if(isset($method) && !empty($method) && $method != 'index'){
			$modify_for = $class.'/'.$method;
		}
		//echo "access for: ".$access_for;
		//echo "<br>modify for: ".$modify_for;
		$user_role = $this->session->userdata('user_role');

		$permission = [];
		$permission = json_decode($this->eprompto->rolewise_access($user_role));
		$is_ajax = $this->input->is_ajax_request();

		########## Check protected pages ###########
		if(!in_array($access_for, $permission->public)){
			if(in_array($access_for, $permission->protected)){
				if(!$logged_in_user){
					if ($this->input->is_ajax_request()) {
						show_401();
					}
					else{
						redirect('account/login');
					}
				}
			}
			else{
				if(!$logged_in_user){
					if ($this->input->is_ajax_request()) {
						show_401();
					}
					else{
						redirect('account/login?continue='.current_url());
					}
				}
				else if(!in_array($access_for, $permission->private->access)){
					show_403();
				}
				else if(in_array($modify_for, $permission->private->not_modify)){
					show_403();
				}
				else{ 
				}
			}

		}
		else{
			//echo 'public access';
		}

		//xdebug($permission);
	}



	function get_name($user_id){
		if(!isset($user_id)){
			show_403();
		}
		$this->load->model('my_model');
		return $this->my_model->get_name($user_id);
	}

	function check_partner_active($user_id)
	{
		if(!isset($user_id)){
			show_403();
		}
		$this->load->model('partner_model');
		return $partner_data = $this->partner_model->get_partner_status_by_userid($user_id);
	}

	private function get_module_wise_data($user_id)
	{
		$this->load->model('settings_model');
		return $this->settings_model->get_module_wise_access($user_id);
	}

	private function _get_module()
	{
		$this->load->model('settings_model');
		return $this->settings_model->get_module_list();
	}

	private function _get_permission($user_id, $module_cur)
	{
		$this->load->model('settings_model');
		return $this->settings_model->get_permission_module($user_id, $module_cur);
	}

	protected function _send_reset_link($user_data,$reset_code, $template)
	{
		$name = toProperCase($user_data->first_name .' '.$user_data->last_name);
		$data = array(
			'name' => $name,
			'reset_link' => base_url().'account/reset_password/'.$reset_code
		);

		$this->load->library('crest_email');
		//$this->load->library('email_service');
		$email_data = new Send_email_options();
		$email_data->email_to = $user_data->email;
		$email_data->email_subject = 'ePrompto | Reset Password';
		if(!empty($template)){
			$email_data->template = $template;
		}
		$email_data->data = $data;

		if($this->crest_email->send_email($email_data))
		{
			return TRUE;
		}
		return FALSE;
	}

}
/* end my_controller */