CnertaMailingBundle
===================

Installation
------------

### Step 1

Add to composer json:

``` js
    "require": {
        //..
        "cnerta/mailing-bundle": "dev-master"
    },
    //..
    "repositories": [
        //...
            {
              "type": "git",
               "url": "git@eduforge.eduter.local:webmodules/mailingbundle.git"
            }
    ]
```

Run:

``` bash
$ composer install cnerta/mailing-bundle
```

### Step 2

Register the bundle in your `AppKernel` class.

``` php
<?php
// app/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Cnerta\MailingBundle\CnertaMailingBundle(),
        );

        // ...
    }

    // ...
```
