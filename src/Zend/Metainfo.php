<?php
/**
 * This file is part of opcache package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Opcache\Zend;

use Serafim\Opcache\Struct\FileStruct;
use Serafim\Opcache\Struct\Type\StringType;
use Serafim\Opcache\Struct\Type\TimeType;
use Serafim\Opcache\Struct\Type\UInt32Type;

/**
 * Representation of "_zend_file_cache_metainfo" structure
 * <code>
 *  typedef struct _zend_file_cache_metainfo {
 *      char         magic[8];
 *      char         system_id[32];
 *      size_t       mem_size;
 *      size_t       str_size;
 *      size_t       script_offset;
 *      accel_time_t timestamp;
 *      uint32_t     checksum;
 *  } zend_file_cache_metainfo;
 * </code>
 *
 * @property-read string $magic
 * @property-read string $systemId
 * @property-read int $memSize
 * @property-read int $strSize
 * @property-read int $scriptOffset
 * @property-read \DateTimeInterface $timestamp
 * @property-read int $checksum
 *
 * @see https://github.com/php/php-src/blob/c32da66e129897f4f103ecc6319332f160ee52ea/ext/opcache/zend_file_cache.c#L160-L168
 */
class Metainfo extends FileStruct
{
    /**
     * Metainfo constructor.
     *
     * @param resource $descriptor
     */
    public function __construct($descriptor)
    {
        $this->magic = new StringType(8);
        $this->systemId = new StringType(32);
        $this->memSize = new UInt32Type();
        $this->strSize = new UInt32Type();
        $this->scriptOffset = new UInt32Type();
        $this->timestamp = new TimeType();
        $this->checksum = new UInt32Type();

        parent::__construct($descriptor);
    }
}
