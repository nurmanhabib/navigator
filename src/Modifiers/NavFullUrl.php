<?php

namespace Nurmanhabib\Navigator\Modifiers;

class NavFullUrl extends NavModifier
{
    public function getUrl()
    {
        return url()->to(parent::getUrl() ?: '#');
    }

    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'url' => $this->getUrl()
        ]);
    }
}
