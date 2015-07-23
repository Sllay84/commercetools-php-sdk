<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Cart;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\JsonObject;

/**
 * @package Sphere\Core\Model\Cart
 * @link http://dev.sphere.io/http-api-projects-carts.html#create-cart
 * @method string getCurrency()
 * @method string getCustomerId()
 * @method string getCountry()
 * @method string getInventoryMode()
 * @method CartDraft setCurrency(string $currency = null)
 * @method CartDraft setCustomerId(string $customerId = null)
 * @method CartDraft setCountry(string $country = null)
 * @method CartDraft setInventoryMode(string $inventoryMode = null)
 */
class CartDraft extends JsonObject
{
    public function getFields()
    {
        return [
            'currency' => [self::TYPE => 'string'],
            'customerId' => [self::TYPE => 'string'],
            'country' => [self::TYPE => 'string'],
            'inventoryMode' => [self::TYPE => 'string']
        ];
    }

    /**
     * @param string $currency
     * @param Context|callable $context
     * @return CartDraft
     */
    public static function ofCurrency($currency, $context = null)
    {
        $draft = static::of($context);
        return $draft->setCurrency($currency);
    }
}
