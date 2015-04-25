<?php

namespace FamGenTree\AdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class FamGenTreeAdminBundle extends Bundle
{
    //declare bundle as a child of the FOSUserBundle so we can override the parent bundle's templates
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
