<?php
/**
 */

namespace Commercetools\Core\Model\Store;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Model\Store
 * @link https://docs.commercetools.com/http-api-projects-stores#storedraft
 *
 * @method string getKey()
 * @method StoreDraft setKey(string $key = null)
 * @method LocalizedString getName()
 * @method StoreDraft setName(LocalizedString $name = null)
 * @method array getLanguages()
 * @method StoreDraft setLanguages(array $languages = null)
 */
class StoreDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'key' => [static::TYPE => 'string'],
            'name' => [static::TYPE => LocalizedString::class],
            'languages' => [static::TYPE => 'array'],
        ];
    }

    /**
     * @param string $key
     * @param Context|callable $context
     * @return StoreDraft
     */
    public static function ofKey($key, Context $context)
    {
        return static::of($context)->setKey($key);
    }

    /**
     * @param string $key
     * @param LocalizedString $name
     * @param Context|null $context
     * @return StoreDraft
     */
    public static function ofKeyAndName($key, LocalizedString $name, $context = null)
    {
        return static::of($context)->setKey($key)->setName($name);
    }
}
