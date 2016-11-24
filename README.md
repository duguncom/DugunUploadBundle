Installation
============

1: Download the Bundle
-------------------------

You can add duguncom/uploadbundle to your requirements with dev-master

    "duguncom/uploadbundle": "~2.0",
    
or you can directly run:

    composer require duguncom/uploadbundle


2: Enable Bundle
-------------------------

Add bundle to your registered bundles list in the `app/AppKernel.php`:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new Dugun\UploadBundle\DugunUploadBundle(),
        );

        // ...
    }

    // ...
}
```

3: Configuration
-------------------------

Add our needed configuration parameters to your `app/config/config.yml`
```yml
dugun_upload:
    upload_service_name: %dugun_upload.upload_service_name% # choose your side
    temporary_path: %dugun_upload.temporary_path% # give a folder path that web-server has access to write (maybe /tmp is good)
    credentials:
        aws:
            base_url: %dugun_upload.credentials.aws.base_url%
            bucket: %dugun_upload.credentials.aws.bucket%
            version: latest
            region: %dugun_upload.credentials.aws.region%
            scheme: http
            credentials:
                key: %dugun_upload.credentials.aws.credentials.key%
                secret: %dugun_upload.credentials.aws.credentials.secret%

```
4: Usage
-------------------------

You can use upload_service on your controllers by getting from container or you can pass service to your other services.
    
    Service naming: dugun_upload.service.dugun_upload

####Uploading File
    
    $file = 'It can be path of a file';
    $file = 'OR It can be UploadedFile instance';
    $file = 'OR It can be \Intervention\Image\Image instance';
    $destinationPath = '/uploaded/folder/filename.jpg';
    $result = $this->uploadService->upload($file, $destinationPath);
    //If file uploaded successfully, $result['success'] returns as (boolean)true
    //And if its true, it returns $result['file_url'] that you can access your file
    
