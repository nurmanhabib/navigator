<?php

namespace Nurmanhabib\Navigator\Items;

class NavHeading extends NavSeparator
{
    protected $text;

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getType()
    {
        return 'heading';
    }

    public function toArray()
    {
        return [
            'text' => $this->getText(),
            'type' => $this->getType(),
        ];
    }
}
