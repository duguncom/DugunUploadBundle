<?php

namespace Dugun\UploadBundle\Tests;


use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DugunImageMicroserviceUploadTest extends WebTestCase
{

    public function test_upload_object()
    {
        $container = $this->getContainer();

        $service = $container->get('dugun_upload.service.upload_service');
        $service->setUploaderService('dugun_image_microservice');

        $image = new UploadedFile(
            'src/Dugun/UploadBundle/Resources/assets/test/file1.jpg',
            'file1.jpg',
            'image/jpeg'
        );

        $response = $service->upload($image, 't2/test77.jpg');
        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('success', $response);
        $this->assertTrue($response['success']);
    }
}
