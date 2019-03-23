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
 * Class UInt32Type
 */
class UInt32Type extends Type
{
    /**
     * UInt32Type constructor.
     *
     * @param bool|null $littleEndian
     */
    public function __construct(?bool $littleEndian = false)
    {
        parent::__construct(function ($resource) use ($littleEndian): int {
            return Bin::fromUInt32(\fread($resource, 4), $littleEndian);
        });
    }
}
