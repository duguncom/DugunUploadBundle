<?php

namespace Dugun\UploadBundle\Tests;

use Dugun\UploadBundle\Service\DugunUploadService;
use Symfony\Component\DependencyInjection\ContainerInterface;

class GetObjectTest extends \PHPUnit_Framework_TestCase
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
    public function test_get_object()
    {
        $this->assertInstanceOf('\Dugun\UploadBundle\Service\DugunUploadService', $this->service);

        $result = $this->service->doesObjectExist(
           't2/test4.jpg'
        );
        $this->assertTrue($result);
    }
}
