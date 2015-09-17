CnertaMailingBundle
===================

CnertaMailinBundle is a Symfony2 Bundle who provide an easy way to send email build with Twig template.

Create your email message with Twig and use the CnertaMailinBundle's service for sending it.

Easy, fast and builded on the shoulders of giants like SwiftMail.

Because quality matters : [![SensioLabsInsight](https://insight.sensiolabs.com/projects/5989cc10-2893-4dca-9d02-f1589530d913/small.png)](https://insight.sensiolabs.com/projects/5989cc10-2893-4dca-9d02-f1589530d913)
[![Build Status](https://travis-ci.org/AgrosupDijon-Eduter/CnertaMailingBundle.svg?branch=master)](https://travis-ci.org/AgrosupDijon-Eduter/CnertaMailingBundle)

Installation
------------

### Composer

Add to composer json:

``` js
    "require": {
        //..
        "cnerta/mailing-bundle": "dev-master"
    }
```

Run:

``` bash
$ composer install cnerta/mailing-bundle
```

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

### Configure the bundle

In `config.yml`

```yaml
cnerta_mailing:
    default_bundle: "FooBundle" # The name of the bundle where the mail template are stored
    from_email:
        address: exemple@exemple.com
        sender_name: "My name is"
```

How To Use
----------

### Create mail templates

 - Create a `Mails` folder in your `src/AppBundle/Resources`
 - Create a `BlocksMail.html.twig` in this new folder
 - Create a `default.html.twig`
 - Create a `default.txt.twig`

The `BlocksMail.html.twig` must contain all the objects and bodys part of your mail.
Exemple :

```twig
{% block bar_object %}A mail object{% endblock %}
{% block bar_body %}
A Body with full of pretty things !
{% endblock %}
```

The `default.html.twig` is the base template of your mail
Exemple :

```twig
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <strong>Hello dear user</strong>
        <div>
            {{ body|raw }} {# This is mandatory, it's the body message of your mail #}
        </div>
    </body>
</html>
```


The `default.txt.twig` is the base template of your mail
Exemple :

```twig
Hello dear user</strong

{{ body|raw }} {# This is mandatory, it's the body message of your mail in text version (without HTML elements) #}
```


### Send mail !

Service name : `cnerta.mailing`

In a `Controller` :

```php
use Cnerta\MailingBundle\Mailing\MailingServiceInterface;
use Cnerta\MailingBundle\Mailing\MailParameters;
use Cnerta\MailingBundle\Mailing\MailParametersInterface;

[...]
public function fooAction() {
    $mailParameters = MailParameters();

    $mailParameters
            ->setTemplateBundle('MyBundle')
            ->addBodyParameters("user", "User name");

    $this->get('cnerta.mailing')
        ->sendEmail(
            array("user@exemple.com"), // List of mail address or Symfony\Component\Security\Core\User\UserInterface
            "template_email", // Name of the block define in `BlocksMail.html.twig`
            $mailParameters);
}
```
