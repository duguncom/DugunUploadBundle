Installation
============

1: Download the Bundle
-------------------------

For now we dont support composer install :)

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
        temporary_path: %dugun_upload.temporary_path% # choose your side
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