Simplify the use of a debugging tool in your IDE by automatically setting/removing cookies.

Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require emarref/xdebug-bundle "~1.0.0"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the development section of the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        // ...

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            // ...
            $bundles[] = new Emarref\Bundle\XdebugBundle\EmarrefXdebugBundle();
        }
    }

    // ...
}
```

Step 3: Configure the bundle
----------------------------

By default, the only required configuration is the IDE Key.

```yaml
emarref_xdebug:
    debugger:
        idekey: MY_KEY
```

Full default configuration is below:

```yaml
emarref_xdebug:
    enabled: true
    debugger:
        enabled: true
        idekey: <yourkey>
        path: /
    profiler:
        enabled: false
        path: /
    tracer:
        enabled: false
        path: /
```
