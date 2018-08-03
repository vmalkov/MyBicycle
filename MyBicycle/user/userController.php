<?
namespace MyBicycle\user;

use RedBeanPHP\R as R;

Class userController extends \MyBicycle\CRUD_Controller {
	function createAction($data=array()) {
		parent::createAction(['email','password']);
	}
}