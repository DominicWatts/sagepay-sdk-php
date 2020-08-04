<?php

namespace Xigen\Library\Sagepay\Classes;

/**
 * Factory to obtain an instance of any of the available APIs.
 *
 * @category  Payment
 * @copyright (c) 2013, Sage Pay Europe Ltd.
 */
class SagepayApiFactory
{
    /**
     * Create instance of required integration type
     * Switching to namespaces broke autoloading
     *
     * @param string           $type    Integration type
     * @param SagepaySettings  $config  Sagepay config instance
     *
     * @return SagepayAbstractApi
     */
    public static function create($type, SagepaySettings $config)
    {
        $integration = strtolower($type);
        $integrationApi = 'Sagepay' . ucfirst($integration) . 'Api';
        switch ($integrationApi) {
            case (stripos(SagepayDirectApi::class, $integrationApi) !== false):
                return new SagepayDirectApi($config);
            case (stripos(SagepayServerApi::class, $integrationApi) !== false):
                return new SagepayServerApi($config);
            case (stripos(SagepayFormApi::class, $integrationApi) !== false):
                return new SagepayFormApi($config);
            default:
                throw new SagepayApiException('Invalid payment type');
        }
    }
}
