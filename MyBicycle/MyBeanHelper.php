<?

namespace MyBicycle;

use RedBeanPHP\BeanHelper\SimpleFacadeBeanHelper as SimpleFacadeBeanHelper;

class MyBeanHelper extends SimpleFacadeBeanHelper {

    public function getModelForBean( \RedBeanPHP\OODBBean $bean )
    {
        $model     = $bean->getMeta( 'type' );
        
        $obj = self::factory( $model );

        if($obj instanceof Model) {
        	$obj->loadBean( $bean );
        	return $obj;
        }
    }

}