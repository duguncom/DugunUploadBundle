Installation
============

1: Download the Bundle
-------------------------

Bundle is not on packagist yet, so you need to add repository your composer.json

    "repositories": [
            {
                "type": "vcs",
                "url": "https://github.com/duguncom/DugunUploadBundle"
            }
    ]
    
Now you can add duguncom/uploadbundle to your requirements with dev-master

    "duguncom/uploadbundle": "dev-master",
       

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

    dugun_upload:
        upload_service_name: %dugun_upload.upload_service_name% # choose your side
        temporary_path: %dugun_upload.temporary_path% # give a folder path that web-server has access to write (maybe /tmp is good)
        credentials:
            aws:
                bucket: %dugun_upload.credentials.aws.bucket%
                version: latest
                region: %dugun_upload.credentials.aws.region%
                scheme: http
                credentials:
                    key: %dugun_upload.credentials.aws.credentials.key%
                    secret: %dugun_upload.credentials.aws.credentials.secret%
            dugun_image_microservice: #this is our top secret image upload service!
                url: %dugun_upload.credentials.dugun_image_microservice.url%
                
4: Usage
-------------------------

You can use upload_service on your controllers by getting from container or you can pass service to your other services.
    
    Service naming: dugun_upload.service.dugun_upload

####Uploading File
    
    $file = 'It can be path of a file';
    $file = 'OR It can be UploadedFile instance';
    $destinationPath = '/uploaded/folder/filename.jpg';
    $result = $this->uploadService->upload($file, $destinationPath);
    //If file uploaded successfully, $result['success'] returns as (boolean)true
    
