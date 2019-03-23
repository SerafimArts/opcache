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
     * @param \Closure $decoder
     */
    public function __construct(\Closure $decoder)
    {
        parent::__construct(function ($resource) use ($decoder): string {
            return Bin::fromString($decoder($resource));
        });
    }

    /**
     * @param int $size
     * @return StringType
     */
    public static function fixed(int $size): StringType
    {
        return new static(function ($resource) use ($size): string {
            return \fread($resource, $size);
        });
    }
}
