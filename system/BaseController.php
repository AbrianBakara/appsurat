<?php 
defined('ROOT') OR exit('No direct script access allowed');

class BaseController{

	public $status = 200;

	public $view = null;

	public $db = null;

	public $route = null;

	public $ordertype = ORDER_TYPE;

	public $rec_id = null;

	public $return_value = false;

	public $flash_msg = "";

	public $tablename = null;

	public $request = null;

	public $post = null;

	public $modeldata = array();

	public $soft_delete = false;

	public $delete_field_name = "is_deleted";

	public $delete_field_value = "1";

	public $file_upload_settings = array();

	public $fields = array();

	public $validate_captcha = false;

	public $filter_vals = false;

	public $filter_rules = false;


	function __construct(){
		$this->view = new BaseView; //initialize the view renderer

		if(is_post_request()){
			Csrf::cross_check();
			$this->post = new stdClass;
			$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			if(!empty($post)){
				foreach($post as $obj => $val){
					$this->post->$obj = $val; //pass each GET data to the current request class property
				}
			}
		}
		
		$this->set_request($_GET);

		$this->file_upload_settings['summernote_img_upload'] = array(
			"title" => "{{random}}",
			"extensions" => ".jpg,.png,.gif,.jpeg",
			"limit" => "10",
			"filesize" => "3",
			"returnfullpath" => false,
			"filenameprefix" => "",
			"uploadDir" => "uploads/files/"
		);
		
		$this->file_upload_settings['photo'] = array(
			"title" => "{{timestamp}}",
			"extensions" => ".jpg,.png,.gif,.jpeg",
			"limit" => "1",
			"filesize" => "3",
			"returnfullpath" => true,
			"filenameprefix" => "",
			"uploadDir" => "uploads/files/"
		);
	

		$this->file_upload_settings['file_surat'] = array(
			"title" => "{{random}}",
			"extensions" => ".docx,.doc,.xls,.xlsx,.xml,.csv,.pdf,.xps",
			"limit" => "1",
			"filesize" => "3",
			"returnfullpath" => true,
			"filenameprefix" => "",
			"uploadDir" => "uploads/files/"
		);
	

		$this->status = AUTHORIZED;
	}

	function GetModel(){
		//Initialse New Database Connection
		$this->db = new PDODb(DB_TYPE, DB_HOST , DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT, DB_CHARSET);
		if($this->soft_delete){
			$delete_field = $this->delete_field_name;
			$param = array($this->delete_field_value);
			$this->db->where("($delete_field IS NULL OR $delete_field != ?)", $param); //query only records not deleted
		}
		return $this->db;
	}

	function set_request($get = array()){
		$this->request = new stdClass;
		// filter all values of the GET Request
		$get = filter_var_array($get, FILTER_SANITIZE_STRING);
		if(!empty($get)){
			foreach($get as $obj => $val){
				$this->request->$obj = $val; //pass each request data to the current page request property
			}
		}
	}

	function set_route($route){
		$route->request = $this->request;
		$this->route = $this->view->route  = $route;
	}

	function get_pagination($page_count = MAX_RECORD_COUNT){
		$request = $this->request;
		$limit_count = (!empty($request->limit_count) ? $request->limit_count : $page_count);
		$limit_start = (!empty($request->limit_start) ? $request->limit_start : 1);
		$limit_start = ($limit_start - 1) * $limit_count;

		//pass the pagination to view
		$this->view->limit_count = $limit_count;
		$this->view->limit_start = $limit_start;
		return array($limit_start, $limit_count);
	}

	function validate_form($modeldata){
		if(!empty($this->sanitize_array)){
			$modeldata = GUMP::filter_input($modeldata, $this->sanitize_array);
		}

		if($this->validate_captcha){
			$form_captcha = strtoupper(!empty($modeldata['form_captcha_code']) ? $modeldata['form_captcha_code'] : '0');
			$session_captcha = strtoupper(get_session("captcha"));
			if($form_captcha !== $session_captcha){
				$this->view->page_error[] = "Invalid Captcha Code";
			}
		}

		$rules = $this->rules_array;
		if($this->filter_rules == true){
			$rules = array(); //set new rules
			//set rules for only fields in the posted data
			foreach($modeldata as $key => $val){
				if(array_key_exists($key, $this->rules_array)){
					$rules[$key] =  $this->rules_array[$key];
				}
			}
		}
		//accept posted fields if they are part of the page fields
		$fields = $this->fields;
		if(!empty($fields)){
			foreach($modeldata as $key => $val){
				if(!in_array($key, $fields)){
					unset($modeldata[$key]); //remove field if not part of the field list
				}
			}
		}
		$is_valid = GUMP::is_valid($modeldata, $rules);
		// remove empty field values
		if($this->filter_vals == true){
			$modeldata = array_filter($modeldata, function($val){
				if($val === "" || is_null($val)){
					return false;
				}
				else{
					return true;
				}
			});
		}
		if($is_valid !== true) {
			if(is_array($is_valid)){
				foreach($is_valid as  $error_msg){
					$this->view->page_error[] = strip_tags($error_msg);
				}
			}
			else{
				$this->view->page_error[] = $is_valid;
			}
		}

		if(empty($modeldata)){
			$this->view->page_error[] = "UnAccepted Fields";
		}
		return $modeldata;
	}

	function validated(){
		return (empty($this->view->page_error) ? true : false);
	}

	function redirect($default_page = null){
		if($this->return_value){
			return $this->rec_id;
		}
		elseif (is_ajax()) {
			render_json($this->flash_msg);
		} else {
			$redirect = (!empty($this->request->redirect) ? $this->request->redirect : $default_page);
			redirect_to_page($redirect);
		}
	}

	function render_view($viewname, $data = null, $layout = "main_layout.php"){
		if($this->return_value){
			return $this->rec_id;
		}
		else{
			$this->view->render($viewname, $data, $layout);
		}
	}

	function set_page_error($page_error = null){
		if(!empty($this->db->getLastError())){
			$this->view->page_error[] = $this->db->getLastError(); 
		}

		if($page_error){
			if(is_array($page_error)){
				$this->view->page_error = $page_error;
			}
			else{
				$this->view->page_error[] = $page_error;
			}
		}
		return $this->rec_id;
	}

	function set_flash_msg($msg, $type = "success", $dismissable = true, $showduration = 5000)
	{
		$this->flash_msg = $msg;
		if (!is_ajax() && $msg !== '') {
			$class = null;
			$closeBtn = null;
			if ($type != 'custom') {
				$class = "alert alert-$type";
				if ($dismissable == true) {
					$class .= " alert-dismissable";
					$closeBtn = '<button type="button" class="close" data-dismiss="alert">&times;</button>';
				}
			}

			$msg = '<div data-show-duration="' . $showduration . '" id="flashmsgholder" class="' . $class . ' animated bounce">
							' . $closeBtn . '
							' . $msg . '
					</div>';

			set_session("MsgFlash", $msg);
		}
	}

	function format_request_data($arr){
		foreach($arr as $key => $val){
			if(is_array($val)){
				$arr[$key] = implode(",", $val);
			}
		}
		return $arr;
	}

	function format_multi_request_data($arr){
		$alldata = array();
		foreach($arr as $key => $val){
			$combine_vals = $val;
			if(is_array($val)){
				$combine_vals = recursive_implode($val, "");
			}
			//merge all values of each input into one string and check if each post data contains value
			if(!empty($combine_vals)){
				$alldata[] = $this -> format_request_data($val);
			}
		}
		return $alldata;
	}

	function delete_record_files($files, $field){
		foreach($files as $file_path){
			$comma_paths = explode( ',', $file_path[$field] );
			foreach($comma_paths as $file_url){
				try{
					$file_dir_path = str_ireplace( SITE_ADDR , "" , $file_url ) ;
					@unlink($file_dir_path);
				}
				catch(Exception $e) {
				  // error_log('Message: ' .$e->getMessage());
				}
			}
		}
	}

	function get_uploaded_file_paths($fieldname){
		$uploaded_files = "";
		if(!empty($_FILES[$fieldname])){
			$uploader = new Uploader;
			$upload_settings = $this->file_upload_settings[$fieldname];
			$upload_data = $uploader->upload($_FILES[$fieldname], $upload_settings );
			if($upload_data['isComplete']){
				$arr_files = $upload_data['data']['files'];
				if(!empty($arr_files)){
					if(!empty($upload_settings['returnfullpath'])){
						$arr_files = array_map( "set_url", $arr_files ); // set files with complete url of the website
					}
					$uploaded_files = implode("," , $arr_files);
				}
			}
			if($upload_data['hasErrors']){
				$errors = $upload_data['errors'];
				foreach($errors as $key=>$val){
					$this->view->page_error[] = "$key : $val[$key]";
				}
			}
		}
		return $uploaded_files;
	}

	function get_uploaded_file_data($fieldname){
		if(!empty($_FILES[$fieldname])){
			$file_name = $_FILES[$fieldname]['tmp_name'];
			return file_get_contents($file_name);
		}
		return null;
	}
	
}