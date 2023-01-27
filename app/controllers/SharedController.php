<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	function surat_keluar_id_perihal_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT id_perihal AS value, perihal_name AS label FROM perihalsurat";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}
	
	/**
     * pengguna_user_role_id_option_list Model Action
     * @return array
     */
	function pengguna_user_role_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT role_id AS value, role_name AS label FROM roles";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * pengguna_username_value_exist Model Action
     * @return array
     */
	function pengguna_username_value_exist($val){
		$db = $this->GetModel();
		$db->where("username", $val);
		$exist = $db->has("pengguna");
		return $exist;
	}

	/**
     * pengguna_email_value_exist Model Action
     * @return array
     */
	function pengguna_email_value_exist($val){
		$db = $this->GetModel();
		$db->where("email", $val);
		$exist = $db->has("pengguna");
		return $exist;
	}

	/**
     * role_permissions_role_id_option_list Model Action
     * @return array
     */
	function role_permissions_role_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT role_name AS value , role_id AS label FROM roles ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}


	

	/**
     * getcount_jumlahuser Model Action
     * @return Value
     */
	function getcount_jumlahuser(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM pengguna WHERE user_role_id=2";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	function getcount_surat_proyek(){
		$db = $this->GetModel();
		$sqltext = "SELECT Nomor_surat FROM surat_keluar WHERE id_perihal = 1 ORDER BY Nomor_surat DESC LIMIT 1;";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}
		
	function getcount_surat_magang(){
		$db = $this->GetModel();
		$sqltext = "SELECT Nomor_surat FROM surat_keluar WHERE id_perihal = 2 ORDER BY Nomor_surat DESC LIMIT 1;";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}


	
	
}
