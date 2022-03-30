<?

namespace MyBicycle;


Class Model extends \RedBeanPHP\SimpleModel {

	protected $config;

	static function S() {

		static $instance=null;
		if ($instance === null) {
			$instance = new static();
		} //else 
		//var_dump($instance);

		return $instance;

	}

	function setConfig($config) {

		$this->config = $config;

	}

}