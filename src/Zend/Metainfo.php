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
use Serafim\Opcache\Struct\Type\TimeType;
use Serafim\Opcache\Struct\Type\UInt32Type;
use Serafim\Opcache\Struct\Type\UInt64Type;

/**
 * Representation of "_zend_file_cache_metainfo" structure
 *
 * @property-read string $magic
 * @property-read string $systemId
 * @property-read int $memSize
 * @property-read int $strSize
 * @property-read int $scriptOffset
 * @property-read \DateTimeInterface $timestamp
 * @property-read int $checksum
 *
 * @see https://github.com/php/php-src/blob/PHP-7.3.4/ext/opcache/zend_file_cache.c#L162-L170
 */
class Metainfo extends Struct
{
    /**
     * Metainfo constructor.
     *
     * @param resource $descriptor
     */
    public function __construct($descriptor)
    {
        $this->magic = StringType::fixed(8);
        $this->systemId = StringType::fixed(32);
        $this->memSize = new UInt64Type();
        $this->strSize = new UInt64Type();
        $this->scriptOffset = new UInt64Type();
        $this->timestamp = new TimeType();
        $this->checksum = new UInt64Type();

        parent::__construct($descriptor);
    }
}
