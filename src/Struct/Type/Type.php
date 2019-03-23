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
 * Class Type
 */
class Type implements TypeInterface
{
    /**
     * @var \Closure
     */
    private $decoder;

    /**
     * @var int
     */
    private $size;

    /**
     * Type constructor.
     *
     * @param \Closure $decoder
     * @param int $size
     */
    public function __construct(int $size, \Closure $decoder)
    {
        $this->decoder = $decoder;
        $this->size = $size;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    public function decode($value)
    {
        return ($this->decoder)($value);
    }
}
