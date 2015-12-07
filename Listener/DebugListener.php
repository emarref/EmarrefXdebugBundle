<?php

namespace Emarref\Bundle\XdebugBundle\Listener;

class DebugListener extends AbstractXdebugListener
{
    const COOKIE_NAME = 'XDEBUG_SESSION';

    /**
     * @inheritDoc
     */
    public function getCookieName()
    {
        return self::COOKIE_NAME;
    }

    /**
     * @inheritDoc
     */
    public function getCookieValue()
    {
        return $this->config['idekey'];
    }
}
