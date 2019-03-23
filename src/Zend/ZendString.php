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
use Serafim\Opcache\Struct\Type\Int64Type;
use Serafim\Opcache\Struct\Type\StringType;
use Serafim\Opcache\Struct\Type\UInt64Type;

/**
 * Representation of "_zend_string" structure
 *
 * @property-read ZendRefcounted $gc
 * @property-read int $h
 * @property-read int $len
 * @property-read string $val
 *
 * @see https://github.com/php/php-src/blob/PHP-7.3.4/Zend/zend_types.h#L211-L216
 */
class ZendString extends Struct
{
    /**
     * Name constructor.
     *
     * @param resource $descriptor
     */
    public function __construct($descriptor)
    {
        $this->gc = new UInt64Type();
        $this->h = new UInt64Type();
        $this->len = new UInt64Type();
        $this->val = new StringType(function ($resource) {
            return \fread($resource, (int)$this->get('len'));
        });

        parent::__construct($descriptor);
    }
}
