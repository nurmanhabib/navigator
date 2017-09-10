<?php

namespace Nurmanhabib\Navigator\Modifiers;

class NavVisible extends NavModifier
{
    public function isVisible()
    {
        return true;
    }

    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'is_visible' => $this->isVisible()
        ]);
    }
}
