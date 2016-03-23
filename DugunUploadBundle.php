<?php

namespace Dugun\UploadBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DugunUploadBundle extends Bundle
{
    public function __construct()
    {
    }

    public function getContainerExtension()
    {
        return parent::getContainerExtension();
    }
}
