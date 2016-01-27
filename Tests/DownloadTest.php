<?php

namespace Dugun\UploadBundle\Tests;

use Dugun\UploadBundle\Service\DugunUploadService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DownloadTest extends \PHPUnit_Framework_TestCase
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

    public function test_download_object()
    {
        $this->assertInstanceOf('\Dugun\UploadBundle\Service\DugunUploadService', $this->service);

        $file = $this->service->download('test.jpg');
    }
}
