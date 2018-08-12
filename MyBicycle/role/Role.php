<?
namespace MyBicycle\role;

Class Role extends \RedBeanPHP\SimpleModel {

	

	function update() {
		$this->bean->permissions = json_encode($this->bean->permissions);
	}

	/*function open() {
		$this->bean->permissions = json_decode($this->bean->permissions);
	}

	function after_update() {
		$this->bean->permissions = json_decode($this->bean->permissions);
	}*/

}
?>