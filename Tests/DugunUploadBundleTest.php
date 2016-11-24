<?php

namespace Dugun\UploadBundle\Tests;

use Dugun\UploadBundle\Service\DugunUploadService;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DugunUploadBundleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var DugunUploadService
     */
    private $service;

    public function setUp()
    {
        $kernel = new \AppKernel('test', true);
        $kernel->boot();
        $this->container = $kernel->getContainer();
        $this->service = $this->container->get('dugun_upload.service.upload_service');
    }

    public function testUploadObject()
    {
        $this->assertInstanceOf('\Dugun\UploadBundle\Service\DugunUploadService', $this->service);

        $interventionImageManager = new ImageManager();
        $image = $interventionImageManager->make(__DIR__.'/../Resources/assets/test/file1.jpg');
        $this->service->upload($image, 'test.jpg', $delete = false, $overwrite = true);

        $image = new UploadedFile(
            __DIR__.'/../Resources/assets/test/file1.jpg',
            'file1.jpg',
            'image/jpeg'
        );

        $result = $this->service->upload($image, 'test.jpg', $delete = false, $overwrite = true);
    }

    public function testCheckUploadedObjectExist()
    {
        $this->assertInstanceOf('\Dugun\UploadBundle\Service\DugunUploadService', $this->service);

        $result = $this->service->doesObjectExist(
            'test.jpg'
        );
        $this->assertTrue($result);
    }

    public function testDownloadUploadedObject()
    {
        $this->assertInstanceOf('\Dugun\UploadBundle\Service\DugunUploadService', $this->service);
        $file = $this->service->download('test.jpg');
    }
}
