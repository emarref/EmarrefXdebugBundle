<?php

namespace Emarref\Bundle\XdebugBundle\Listener;

class ProfileListener extends AbstractXdebugListener
{
    const COOKIE_NAME = 'XDEBUG_PROFILE';

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
