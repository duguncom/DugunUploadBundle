<?php

namespace Dugun\UploadBundle\Tests;

use Dugun\UploadBundle\Service\DugunUploadService;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var DugunUploadService $service
     */
    private $service;


    public function setUp()
    {
        $kernel = new \AppKernel('test', true);
        $kernel->boot();
        $this->container = $kernel->getContainer();
        $this->service = $this->container->get('dugun_upload.service.upload_service');
    }

    public function test_upload_object()
    {
        $this->assertInstanceOf('\Dugun\UploadBundle\Service\DugunUploadService', $this->service);

        $interventionImageManager = new ImageManager();
        $image = $interventionImageManager->make(__DIR__ . '/../Resources/assets/test/file1.jpg');
        $this->service->upload($image, 'test.jpg', $delete = false, $overwrite = true);

        $image = new UploadedFile(
            __DIR__ . '/../Resources/assets/test/file1.jpg',
            'file1.jpg',
            'image/jpeg'
        );

        $result = $this->service->upload($image, 'test.jpg', $delete = false, $overwrite = true);

    }
}
