<?

namespace MyBicycle\user;

use RedBeanPHP\R as R;

Class User extends \MyBicycle\Model {

	private $permissions;
	private $logged=false;


	public function update() {

		if(!$this->bean->email) throw new \Exception( '__email_not_specified' );

		if(!$this->bean->id&&!$this->bean->password) throw new \Exception( '__password_not_specified' );
        
        if($this->bean->password&&$this->bean->password!=$this->bean->password2) throw new \Exception( '__passwords_not_equal' );

        if($this->bean->password) $this->bean->password = password_hash($this->bean->password,PASSWORD_DEFAULT);
        else unset($this->bean->password);

        unset($this->bean->password2);


    }

    function allowed($permission) {
    	if(!isset($this->permissions)) {
    		if($this->bean->sharedRoleList) $this->permissions = array_unique(
                call_user_func_array('array_merge',
                    array_map(function($r){return (array)json_decode($r->permissions);},$this->bean->sharedRoleList)
                )
            );
    		else $this->permissions = array();
    	}
		
    	return in_array($permission,$this->permissions);
    }

    function getRoles() {
    	
    	if(is_array($this->bean->sharedRoleList)) return array_map(function($r){return $r->id;},$this->bean->sharedRoleList);
    	return array();
    }

    function isLogged() {
    	return $this->logged;
    }

    function login($id) {
        $this->loadBean(R::load('user',$id));

    	$this->logged=true;
    }

    function logout() {
        $this->bean = NULL;

    	$this->logged = false;
    }

    function addRole(\MyBicycle\role\Role $role) {
    	$this->bean->sharedRoleList[] = $role;
    }

}