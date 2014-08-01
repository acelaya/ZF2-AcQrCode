<?php
namespace Acelaya\QrCode\Test\Controller;

use Zend\EventManager\EventInterface as Event;
use Zend\Mvc\InjectApplicationEventInterface;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\Console\RouteMatch;
use Zend\Stdlib\DispatchableInterface;
use Zend\Stdlib\RequestInterface;
use Zend\Stdlib\Response;
use Zend\Stdlib\ResponseInterface;

/**
 * Controller mock to be used to test the Params view helper
 * @author
 * @link
 */
class ControllerMock implements DispatchableInterface, InjectApplicationEventInterface
{
    /**
     * @var array
     */
    private $routeParams;
    /**
     * @var MvcEvent
     */
    private $event;

    public function __construct(array $routeParams)
    {
        $this->routeParams = $routeParams;
    }

    /**
     * Dispatch a request
     *
     * @param RequestInterface $request
     * @param null|ResponseInterface $response
     * @return Response|mixed
     */
    public function dispatch(RequestInterface $request, ResponseInterface $response = null)
    {
        // Do nothing
    }

    /**
     * Compose an Event
     *
     * @param  Event $event
     * @return void
     */
    public function setEvent(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Retrieve the composed event
     *
     * @return Event
     */
    public function getEvent()
    {
        if (!isset($this->event)) {
            $this->setEvent(new MvcEvent());
            $this->event->setRouteMatch(new RouteMatch($this->routeParams));
        }

        return $this->event;
    }
}
