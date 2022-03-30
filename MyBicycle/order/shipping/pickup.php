<?
namespace MyBicycle\order\shipping;

class pickup extends \MyBicycle\order\Method {
	function __construct() {
		parent::__construct();
		$this->cost = 100;
		
	}
}
?>