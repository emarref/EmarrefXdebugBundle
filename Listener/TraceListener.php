<?php

namespace Emarref\Bundle\XdebugBundle\Listener;

class TraceListener extends AbstractXdebugListener
{
    const COOKIE_NAME = 'XDEBUG_TRACE';

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
        return '1';
    }
}
