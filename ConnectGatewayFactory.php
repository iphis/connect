<?php

namespace Iphis\Connect;

use Iphis\Connect\Action\AuthorizeAction;
use Iphis\Connect\Action\CancelAction;
use Iphis\Connect\Action\CaptureAction;
use Iphis\Connect\Action\ConvertPaymentAction;
use Iphis\Connect\Action\NotifyAction;
use Iphis\Connect\Action\RefundAction;
use Iphis\Connect\Action\StatusAction;
use Payum\Core\Bridge\Spl\ArrayObject;
use Payum\Core\GatewayFactory;

class ConnectGatewayFactory extends GatewayFactory
{
    /**
     * {@inheritDoc}
     */
    protected function populateConfig(ArrayObject $config)
    {
        $config->defaults(
            [
                'iphis.factory_name' => 'connect',
                'iphis.factory_title' => 'connect',
                'iphis.action.capture' => new CaptureAction(),
                'iphis.action.authorize' => new AuthorizeAction(),
                'iphis.action.refund' => new RefundAction(),
                'iphis.action.cancel' => new CancelAction(),
                'iphis.action.notify' => new NotifyAction(),
                'iphis.action.status' => new StatusAction(),
                'iphis.action.convert_payment' => new ConvertPaymentAction(),
            ]
        );

        if (false == $config['payum.api']) {
            $config['payum.default_options'] = array(
                'sandbox' => true,
            );
            $config->defaults($config['payum.default_options']);
            $config['payum.required_options'] = [];

            $config['payum.api'] = function (ArrayObject $config) {
                $config->validateNotEmpty($config['payum.required_options']);

                return new Api((array)$config, $config['payum.http_client'], $config['httplug.message_factory']);
            };
        }
    }
}
