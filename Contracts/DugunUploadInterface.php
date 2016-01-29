<?php

namespace Dugun\UploadBundle\Contracts;

interface DugunUploadInterface
{
    public function download($filePath, $destinationFile);
    public function upload($filePath, $destinationFile);
    public function doesObjectExist($destinationFile);

    public function getFileFullUrl($filePath);
}