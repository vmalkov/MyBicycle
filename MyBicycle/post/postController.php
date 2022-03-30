<?
namespace MyBicycle\post;

use RedBeanPHP\R as R;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

Class postController extends \MyBicycle\CRUD_Controller {
	
    function form($action='update') {
        $this->data['categories'] = R::find('category');
        $this->data['users'] = R::find('user');
        if(!$this->post->user_id) $this->post->user_id = $this->_me->id;

        if($this->request->getMethod()=='POST') {
            if(!$this->post->date) {
                $this->post->date = date("Y-m-d H:i:s");
                $this->request->request->remove('date');
            }
            if(!$this->request->get('user_id')) $this->request->request->remove('user_id');

            $postFolder = $this->config->application->uploads_dir.DS.'post';

            $adapter = new Local($postFolder,0,NULL,[
                'file' => [
                    'public' => 0777,
                    'private' => 0777,
                ],
                'dir' => [
                    'public' => 0777,
                    'private' => 0777,
                ]
            ]);
            $this->files = new Filesystem($adapter,['visibility' => 'public']);

            if($this->request->get('deleteImage')) {
                if($this->files->has($this->post->image)) $this->files->delete($this->post->image);
                $this->post->image = '';
            }

            $this->request->request->remove('deleteImage');

            if($postImage = $this->request->files->get('image')) {
                if ($postImage->isValid()) {

                    $imgFilename = $postImage->getClientOriginalName();

                    if($this->files->has($imgFilename)) $this->files->delete($imgFilename);

                    $stream = fopen($postImage->getRealPath(), 'r+');
                    $this->files->writeStream($imgFilename, $stream);
                    fclose($stream);

                    $this->post->image = $imgFilename;
                }
            }

        }

        $this->data['blocks']['js'].=$this->renderer->fetch('editor',['textarea_name'=>'text','base'=>$this->request->getBaseUrl()]);
        

        parent::form($action);
        

    }

    function indexAction($params) {
        if(!$this->config->isAdmin) $this->setFilter(['status=?',[1]]);
        parent::indexAction($params);
    }
    
}