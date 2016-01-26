<?php

namespace Dugun\UploadBundle\Tests;


use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadTest extends WebTestCase
{

    public function test_upload_object()
    {
        $container = $this->getContainer();
        $service = $container->get('dugun_upload.service.upload_service');

        $image = new UploadedFile(
            __DIR__ . '/../Resources/assets/test/file1.jpg',
            'file1.jpg',
            'image/jpeg'
        );

//        $file = $service->imagineFile($image);
        $result = $service->upload($image, 'test.jpg');


    }
}
