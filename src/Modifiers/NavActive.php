<?php

namespace Nurmanhabib\Navigator\Modifiers;

class NavActive extends NavModifier
{
    public function isActive()
    {
        return true;
    }

    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'is_active' => $this->isActive()
        ]);
    }
}
