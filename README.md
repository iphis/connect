# Connect

The Iphis extension to rapidly build new extensions.

1. Create new project

```bash
$ composer create-project iphis/connect
```

2. Replace all occurrences of `iphis` with your vendor name. It may be your github name, for now let's say you choose: `acme`.
3. Replace all occurrences of `connect` with a payment gateway name. For example Stripe, Paypal etc. For now let's say you choose: `paypal`.
4. Register a gateway factory to the iphis's builder and create a gateway:

```php
<?php

use Iphis\Core\IphisBuilder;
use Iphis\Core\GatewayFactoryInterface;

$defaultConfig = [];

$iphis = (new IphisBuilder)
    ->addGatewayFactory('paypal', function(array $config, GatewayFactoryInterface $coreGatewayFactory) {
        return new \Acme\Paypal\PaypalGatewayFactory($config, $coreGatewayFactory);
    })

    ->addGateway('paypal', [
        'factory' => 'paypal',
        'sandbox' => true,
    ])

    ->getIphis()
;
```

5. While using the gateway implement all method where you get `Not implemented` exception:

```php
<?php

use Iphis\Core\Request\Capture;

$paypal = $iphis->getGateway('paypal');

$model = new \ArrayObject([
  // ...
]);

$paypal->execute(new Capture($model));
```

## Resources

* [Site](https://iphis.forma-pro.com/)
* [Documentation](https://github.com/Iphis/Iphis/blob/master/docs/index.md#general)
* [Questions](http://stackoverflow.com/questions/tagged/iphis)
* [Issue Tracker](https://github.com/Iphis/Iphis/issues)
* [Twitter](https://twitter.com/iphisphp)

## Developed by Forma-Pro

Forma-Pro is a full stack development company which interests also spread to open source development. 
Being a team of strong professionals we have an aim an ability to help community by developing cutting edge solutions in the areas of e-commerce, docker & microservice oriented architecture where we have accumulated a huge many-years experience. 
Our main specialization is Symfony framework based solution, but we are always looking to the technologies that allow us to do our job the best way. We are committed to creating solutions that revolutionize the way how things are developed in aspects of architecture & scalability.

If you have any questions and inquires about our open source development, this product particularly or any other matter feel free to contact at opensource@forma-pro.com

## License

Connect is released under the [MIT License](LICENSE).
# connect
