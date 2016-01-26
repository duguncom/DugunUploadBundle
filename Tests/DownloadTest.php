<?php

namespace Dugun\UploadBundle\Tests;


use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DownloadTest extends WebTestCase
{
    public function test_upload_object()
    {
        $container = $this->getContainer();

        $upload_service = $container->get('dugun_upload.service.upload_service');
        $image_service = $container->get('dugun_image.service.image_service');

        $file = $upload_service->download('test.jpg');
        $image = $image_service->openFile($file);

        $image_service->addWatermark($image);
        $image = $image_service->save($image, true);
        $filePath = $image_service->getPath($image);
        $upload_service->upload($filePath, 'test1.jpg', true);

    }
}
