<?php
namespace Acelaya\QrCode\Test\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

/**
 * Class ParamsMock
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class ParamsMock extends AbstractPlugin
{
    private $params = array(
        'extension' => 'jpg'
    );

    public function __invoke($name = null)
    {
        return (isset($name)) ? $this->fromRoute($name) : $this;
    }

    public function fromRoute($name)
    {
        return (isset($this->params[$name])) ? $this->params[$name] : null;
    }
}
