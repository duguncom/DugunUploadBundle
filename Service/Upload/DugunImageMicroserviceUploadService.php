<?php

namespace Dugun\UploadBundle\Service\Upload;

use Dugun\UploadBundle\Contracts\DugunUploadInterface;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DugunImageMicroserviceUploadService implements DugunUploadInterface
{
    protected $uploadService;
    protected $parameters;

    public function __construct($parameters)
    {
        $this->parameters = $parameters;
        $this->client = new Client();
    }

    public function upload($filePath, $destinationFile, $overwrite = false)
    {
        $file = new UploadedFile(
            $filePath,
            basename($filePath)
        );
        $fileName = basename($destinationFile);
        $fileDirectory = pathinfo($destinationFile, PATHINFO_DIRNAME);

        $response = $this->client->post($this->parameters['url'], [
            'multipart' => [
                [
                    'name' => 'file',
                    'contents' => fopen($file, 'r'),
                ],
                [
                    'name' => 'directory_name',
                    'contents' => (string) $fileDirectory,
                ],
                [
                    'name' => 'filename',
                    'contents' => (string) $fileName,
                ],
                [
                    'name' => 'watermark',
                    'contents' => (string) false,
                ],
                [
                    'name' => 'type',
                    'contents' => '',
                ],
            ],
        ]);

        $result = (array) (json_decode($response->getBody()->getContents()));
        if (isset($result['status']) && $result['status'] === 'success') {
            return [
                'success' => true,
            ];
        }

        return [
            'success' => false,
        ];
    }

    /**
     * This function not exist on microservice.
     *
     * @param $destinationFile
     */
    public function doesObjectExist($destinationFile)
    {
        return;
    }

    /**
     * @param $filePath
     * @param $destinationFile
     */
    public function download($filePath, $destinationFile)
    {
        return;
    }

    public function getFileFullUrl($filePath)
    {
        return sprintf('%s%s', $this->parameters['base_url'], $filePath);
    }
}
