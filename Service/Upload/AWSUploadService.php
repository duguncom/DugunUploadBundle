<?php
namespace Dugun\UploadBundle\Service\Upload;


use Aws\S3\S3Client;
use Dugun\UploadBundle\Contracts\DugunUploadInterface;
use Imagine\Image\Point;

class AWSUploadService implements DugunUploadInterface
{

    protected $uploadService;
    protected $parameters;

    public function __construct($parameters)
    {
        $this->parameters = $parameters;
        $this->uploadService = new S3Client($parameters);
    }

    public function upload($filePath, $destinationFile)
    {
        $bucket = $this->parameters['bucket'];
        $response = $this->doesObjectExist($destinationFile);
        if ($response === true) {
            throw new \InvalidArgumentException('File already exist');
        }
        $result = $this->uploadService->putObject([
            'Bucket' => $bucket,
            'Key'    => $destinationFile,
            'SourceFile'   => $filePath,
            'ACL'    => 'public-read',
        ]);
        return ['success' => true];
    }

    public function doesObjectExist($destinationFile)
    {
        $bucket = $this->parameters['bucket'];
        $result = $this->uploadService->doesObjectExist($bucket, $destinationFile);
        return $result;
    }

    public function deleteObject($destinationFile)
    {
        if($this->doesObjectExist($destinationFile)) {
            $bucket = $this->parameters['bucket'];
            $result = $this->uploadService->deleteObject($bucket, $destinationFile);
        }
    }


    /**
     * @param $filePath
     * @param $destinationFile
     * @return string
     */
    public function download($filePath, $destinationFile)
    {
        $bucket = $this->parameters['bucket'];
        $response = $this->doesObjectExist($filePath);
        if ($response !== true) {
            throw new \InvalidArgumentException('File not exist');
        }
        $result = $this->uploadService->getObject(array(
            'Bucket' => $bucket,
            'Key'    => $filePath,
            'SaveAs' => $destinationFile
        ));

        return $destinationFile;
    }

    public function getFileFullUrl($filePath)
    {
        return sprintf('%s%s', $this->parameters['base_url'], $filePath);
    }
}