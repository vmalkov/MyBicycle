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
				$user->login();
				$this->_user = $user;
				$this->session['user_id'] = $this->_user->id;
			}
		} else $this->setMessage(['ok'=>'__no_user_found']);

		if($this->_user->isLogged()) $this->redirect($this->request->getBaseUrl()."/{$this->context}/read/{$this->_user->id}/");

		$output = $this->renderer->render(
            'user/login', $this->data
        );
        $this->response->setContent($output);
	}

	function logoutAction() {
		$this->_user->logout();
		unset($this->session['user_id']);
	}

}