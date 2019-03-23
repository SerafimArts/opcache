<?php
/**
 * This file is part of opcache package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Opcache\Zend;

use Serafim\Opcache\Struct\Struct;
use Serafim\Opcache\Struct\Type\UInt32Type;

/**
 * Representation of "_zend_refcounted_h" structure
 *
 * @property-read int $refcount
 * @property-read int $typeinfo
 *
 * @see https://github.com/php/php-src/blob/PHP-7.3.4/Zend/zend_types.h#L211-L216
 */
class ZendRefcounted extends Struct
{
    /**
     * Refcounted constructor.
     *
     * @param resource $descriptor
     */
    public function __construct($descriptor)
    {
        $this->refcount = new UInt32Type();
        $this->typeinfo = new UInt32Type();

        parent::__construct($descriptor);
    }
}
