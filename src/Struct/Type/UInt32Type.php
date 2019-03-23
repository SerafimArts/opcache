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
     * CharType constructor.
     */
    public function __construct()
    {
        parent::__construct(4, function (string $value): int {
            return Bin::fromUInt32($value);
        });
    }
}
