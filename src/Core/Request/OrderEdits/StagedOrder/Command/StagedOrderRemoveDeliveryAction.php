<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\StagedOrder\Command;

use Commercetools\Core\Request\Orders\Command\OrderRemoveDeliveryAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\StagedOrder\Command
 *
 * @method string getAction()
 * @method StagedOrderRemoveDeliveryAction setAction(string $action = null)
 * @method string getDeliveryId()
 * @method StagedOrderRemoveDeliveryAction setDeliveryId(string $deliveryId = null)
 */
class StagedOrderRemoveDeliveryAction extends OrderRemoveDeliveryAction implements StagedOrderUpdateAction
{
}
