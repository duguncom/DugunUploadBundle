<?php

namespace Dugun\UploadBundle\Tests;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class GetObjectTest extends WebTestCase
{

    public function test_get_object()
    {
        $container = $this->getContainer();
        $service = $container->get('dugun_upload.service.upload_service');
        $result = $service->doesObjectExist(
           't2/test4.jpg'
        );
        $this->assertTrue($result);
    }
}
