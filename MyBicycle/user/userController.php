<?
namespace MyBicycle\user;

use RedBeanPHP\R as R;

Class userController extends \MyBicycle\CRUD_Controller {
	
	function form($action='update') {
		$this->data['roles'] = R::find('role');

		try {
			if($this->request->getMethod()=='POST') {

				$this->user->sharedRoleList = R::loadAll('role',$this->request->get('role_id'));

				$this->request->request->remove('role_id');
			}

			parent::form($action);

		} catch(\Exception $e) {
			$this->data['user']=$this->user;

			$this->setMessage(['warning'=>$e->getMessage()]);
        
	        $output = $this->renderer->render(
	            'user/user_form', $this->data
	        );
	        $this->response->setContent($output);
		}
		
	}

	function loginAction() {

		if($this->request->getMethod()=='POST') if($user=R::findOne('user','email=?',[$this->request->get('email')])) {
			if(password_verify($this->request->get('password'),$user->password)) {
				$this->_me->login($user->id);
				$this->session['user_id'] = $this->_me->id;
			} else $this->setMessage(['warning'=>'__invalid_password']);
		} else $this->setMessage(['warning'=>'__no_me_found']);

		if($this->_me->isLogged()) $this->redirect($this->request->getBaseUrl()."/{$this->context}/read/{$this->_me->id}/");

		$this->data['email'] = $this->request->get('email','');

		$output = $this->renderer->render(
            'user/login', $this->data
        );
        $this->response->setContent($output);
	}

	function logoutAction() {
		$this->_me->logout();
		unset($this->session['user_id']);
	}

	/*function createAction() {
		var_dump($this->_me);exit;
		parent::createAction();
	}*/

}