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
 * Class Int64Type
 */
class Int64Type extends Type
{
    /**
     * Int64Type constructor.
     */
    public function __construct()
    {
        parent::__construct(function ($resource): int {
            return Bin::fromInt64(\fread($resource, 8));
        });
    }
}
