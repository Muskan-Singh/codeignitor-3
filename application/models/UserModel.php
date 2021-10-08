<?php
class UserModel  extends CI_Model 
{
	
	function RegisterUser($data)
	{
        $this->db->insert('ci_register',$data);
        // dd($data);
	}
	function LoginCheckModel($login_data)
	{
		$email = $login_data['email'];
		$password = $login_data['password'];
		$q = $this->db->query("Select * from ci_register where email='$email' and password ='$password'")->result_array();
		// dd($q);
		if (!empty($q)) {
			return $q;
		} else {
			return FALSE;
		}
		}
	 
	function InsertProductDetails($data)
	{
		$this->db->insert('prod_details',$data);	
	}
	function getUsers()
	{
		$q = $this->db->query("Select * from ci_register")->result_array();
		return $q;
	}
	function getProdsMultiImg($user_id)
	{
		$q = $this->db->query("Select * from prod_details where user_id = '$user_id'")->num_rows();
		return $q;
	}
	function getProdId($pname)
	{
		$q = $this->db->query("Select * from prod_details where pname = '$pname'")->result_array();
		return $q[0]['prod_id'];
		// die(dd($q));
		
	}
	function InsertMultiImgData($data1)
	{
		$this->db->insert('multi_img',$data1);
	} 
	
	public function get_products($user_id,$first,$last){
		//die(dd($last));
		$prod_details = $this->db->query("select * from prod_details where  user_id = '$user_id' limit $first , $last;")->result();
		if(!empty($prod_details)){
			return $prod_details;
		}
}}
?>