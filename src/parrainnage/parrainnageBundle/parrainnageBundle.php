<?php

namespace parrainnage\parrainnageBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class parrainnageBundle extends Bundle
{
    public function getParent()
    {
      return 'FOSUserBundle';
    }
}
