<?php
/**
 * Created by PhpStorm.
 * User: wangjin
 * Date: 2019-01-05
 * Time: 17:58
 */

namespace app\controllers;

use Latte\Engine;
use Latte\Macros;
class BaseController
{
    private $config;
    private $latte;
    public function __construct()
    {
        $this->loadConfig();
        $this->initDb();
        $this->initTpl();
    }

    private function loadConfig()
    {
        $this->config = require APP_ROOT.'/config/base.php';
    }

    private function initDb()
    {
        \Pheasant::setup($this->config['dsn']);
    } public function initTpl()
{
    $this->latte = new Engine();
    $this->latte->setTempDirectory(APP_ROOT .'/storage/views');
    $set = new Macros\MacroSet($this->latte->getCompiler());
    $set->addMacro('url',function ($node,$writer){
        return $writer->write('echo "' . SITE_URL . '%node.args' . '"');
    });
}
    public function render($name,array $params = [], $block = NULL)
    {
        $params['sitename'] = 'myselfmvc';
        $tplFile = APP_ROOT.'/views/'.$name.'.latte';
        $this->latte->render($tplFile,$params,$block);
    }
    public function redirect($name)
    {
        header('Location:' . SITE_URL . '/' . $name);
        exit;
    }


}