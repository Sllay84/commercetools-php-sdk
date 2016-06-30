<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CustomObjects;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractDeleteRequest;
use Commercetools\Core\Model\CustomObject\CustomObject;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\CustomObjects
 * @link https://dev.commercetools.com/http-api-projects-custom-objects.html#delete-customobject-by-id
 * @method CustomObject mapResponse(ApiResponseInterface $response)
 */
class CustomObjectDeleteRequest extends AbstractDeleteRequest
{
    protected $resultClass = '\Commercetools\Core\Model\CustomObject\CustomObject';

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(CustomObjectsEndpoint::endpoint(), $id, $version, $context);
    }

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofIdAndVersion($id, $version, Context $context = null)
    {
        return new static($id, $version, $context);
    }
}
