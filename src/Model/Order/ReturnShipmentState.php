<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Order;

/**
 * @package Sphere\Core\Model\Order
 * @apidoc http://dev.sphere.io/http-api-projects-orders.html#return-shipment-state
 */
class ReturnShipmentState
{
    const ADVISED = 'Advised';
    const RETURNED = 'Returned';
    const BACK_IN_STOCK = 'BackInStock';
    const UNUSABLE = 'Unusable';
}