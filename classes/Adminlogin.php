<?php 
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Session.php');
Session::checklogin();

include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
 ?>
<?php 
class Adminlogin{
	private $db;
	private $fm;

	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function adminLogin($adminUser, $adminPass){
		$adminUser=$this->fm->validation($adminUser);
		$adminPass=$this->fm->validation($adminPass);

		$adminUser=mysqli_real_escape_string($this->db->link, $adminUser);
		$adminPass=mysqli_real_escape_string($this->db->link, $adminPass);

		if ($adminUser=="" || $adminPass=="") {
			$loginmsg="Username and Password must not be empty!";
			return $loginmsg;
		}else{
			$sql="SELECT * FROM  tbl_admin WHERE adminUser='$adminUser' AND adminPass='$adminPass'";
			$query=$this->db->select($sql);
			if ($query !=false) {
				$result=$query->fetch_assoc();
				Session::set("adminlogin", true);
				Session::set("adminId", $value['adminId']);
				Session::set("adminUser", $value['adminUser']);
				Session::set("adminName", $value['adminName']);
				header("Location:dashbord.php");
			}else{
				$loginmsg="Username and Password did't match!";
			    return $loginmsg;
			}
		}
	}
}
 ?>