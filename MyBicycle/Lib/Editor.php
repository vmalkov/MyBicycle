<?
namespace MyBicycle\Lib;

Class Editor {
	function __construct(Request $request) {
		$this->request = $request;
	}
	function output($id) {
		return str_replace(array('{{id}}','{{site_live}}'),array($id,$this->request->getBaseUrl()),file_get_contents(__DIR__.DS.'editor-js'));
	}
}