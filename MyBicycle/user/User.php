<?

namespace MyBicycle\user;

Class User extends \RedBeanPHP\SimpleModel {

	public function update() {
        
        if($this->request->get('password')&&$this->request->get('password')!=$this->request->get('password2')) throw new \Exception( '__passwords_not_equal' );

        unset($this->bean->password2);
    }

    function allowed() {

    }

}