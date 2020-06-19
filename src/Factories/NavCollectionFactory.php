<?php

namespace Nurmanhabib\Navigator\Factories;

use Nurmanhabib\Navigator\NavCollection;

interface NavCollectionFactory
{
    /**
     * @return NavCollection
     */
    public function createNavCollection();
}