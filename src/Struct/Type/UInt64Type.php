<?php
/**
 * This file is part of opcache package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Opcache\Struct\Type;

use Serafim\Opcache\Struct\Bin;

/**
 * Class UInt64Type
 */
class UInt64Type extends Type
{
    /**
     * UInt64Type constructor.
     *
     * @param bool|null $littleEndian
     */
    public function __construct(?bool $littleEndian = false)
    {
        parent::__construct(function ($resource) use ($littleEndian): int {
            return Bin::fromUInt64(\fread($resource, 8), $littleEndian);
        });
    }
}
