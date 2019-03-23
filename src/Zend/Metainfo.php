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
use Serafim\Opcache\Struct\Struct;
use Serafim\Opcache\Struct\Type;
use Serafim\Opcache\Support\Bin;

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
     * @var Type
     */
    protected $magic;

    /**
     * @var Type
     */
    protected $systemId;

    /**
     * @var Type
     */
    protected $memSize;

    /**
     * @var Type
     */
    protected $strSize;

    /**
     * @var Type
     */
    protected $scriptOffset;

    /**
     * @var Type
     */
    protected $timestamp;

    /**
     * @var Type
     */
    protected $checksum;

    /**
     * Metainfo constructor.
     *
     * @param resource $descriptor
     */
    public function __construct($descriptor)
    {
        $this->magic = self::char(8);
        $this->systemId = self::char(32);
        $this->memSize = self::uInt32();
        $this->strSize = self::uInt32();
        $this->scriptOffset = self::uInt32();
        $this->timestamp = self::timeT();
        $this->checksum = self::uInt32();

        parent::__construct($descriptor);
    }
}
