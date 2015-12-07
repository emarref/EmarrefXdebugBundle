<?php

namespace Emarref\Bundle\XdebugBundle\Listener;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

abstract class AbstractXdebugListener
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return (bool)$this->config['enabled'];
    }

    /**
     * @param FilterResponseEvent $event
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        $request  = $event->getRequest();
        $response = $event->getResponse();
        $cookies  = $request->cookies->all();

        $cookieName = $this->getCookieName();
        $cookieValue = $this->getCookieValue();
        $cookiePath  = $this->getCookiePath();

        if ($this->isEnabled() && !array_key_exists($cookieName, $cookies)) {
            $response->headers->setCookie(new Cookie($cookieName, $cookieValue, 0, $cookiePath));
        } elseif (!$this->isEnabled() && array_key_exists($cookieName, $cookies)) {
            $response->headers->setCookie(new Cookie($cookieName, null, 0, $cookiePath));
            $response->headers->removeCookie($cookieName);
        }

        $event->setResponse($response);
    }

    /**
     * @return string|null
     */
    public function getCookieValue()
    {
        return null;
    }

    /**
     * @return string
     */
    public function getCookiePath()
    {
        return $this->config['path'];
    }

    /**
     * @return string
     */
    abstract public function getCookieName();
}
