<?php
/**
 * Created by PhpStorm.
 * User: wangjin
 * Date: 2019-01-05
 * Time: 17:59
 */

namespace app\controllers;
use Pheasant;
use app\models\Todo;
class TodoController extends BaseController
{
    public function index()
    {
        $todos= Todo::all();
        return $this->render('todo/index',['todos'=>$todos]);
    }

    public function create()
    {
        $model = new Todo();
        $model->title = $_POST['title'];
        $model->status = false;
        $result = $model->save();
        if($result){
            return $this->redirect('todo/index');
        }
    }
    public function edit($id)
    {
        $model = Todo::byId($id);
        $model->status = true;
        $result = $model->save();
        if($result){
            return $this->redirect('todo/index');
        }
    }
    public function remove($id)
    {
        $model = Todo::byId($id);
        $result = $model->delete($id);
        if($result){
            return $this->redirect('todo/index');
        }
    }

//    public function init()
//    {
//        $migrator = new \Pheasant\Migrate\Migrator();
//        $migrator->initialize(TodoModel::schema(),'todo');
//        echo 'migrator done !';
//    }
}