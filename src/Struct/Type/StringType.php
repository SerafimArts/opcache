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
 * Class StringType
 */
class StringType extends Type
{
    /**
     * StringType constructor.
     *
     * @param int $size
     */
    public function __construct(int $size)
    {
        \assert($size > 0);

        parent::__construct($size, function (string $value): string {
            return Bin::fromString($value);
        });
    }
}
