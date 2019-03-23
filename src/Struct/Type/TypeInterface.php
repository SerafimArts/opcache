<?php
/**
 * This file is part of opcache package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Opcache\Struct\Type;

/**
 * Interface TypeInterface
 */
interface TypeInterface
{
    /**
     * @return int
     */
    public function getSize(): int;

    /**
     * @param mixed $value
     * @return mixed
     */
    public function decode($value);
}
