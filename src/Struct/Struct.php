<?php
/**
 * This file is part of opcache package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Opcache\Struct;

use Serafim\Opcache\Support\Bin;

/**
 * Class Struct
 */
class Struct
{
    /**
     * @var array|mixed
     */
    private $data = [];

    /**
     * Struct constructor.
     *
     * @param \Closure $execute
     */
    public function __construct(\Closure $execute)
    {
        foreach ($execute($this->read()) as $name => $value) {
            $this->data[$name] = $value;
        }
    }

    /**
     * @return iterable|Type[]
     */
    public function read(): iterable
    {
        $reflection = new \ReflectionObject($this);
        $properties = $reflection->getProperties(\ReflectionProperty::IS_PROTECTED);

        foreach ($properties as $property) {
            $property->setAccessible(true);

            yield $property->getName() => $property->getValue($this);
        }
    }

    /**
     * @param int $size
     * @return Type
     */
    public static function char(int $size = 1): Type
    {
        \assert($size > 0);

        return new Type($size, function ($value) {
            return \trim($value);
        });
    }

    /**
     * @return Type
     */
    public static function uInt32(): Type
    {
        return new Type(4, function ($value): int {
            return Bin::fromUInt32($value);
        });
    }

    /**
     * @return Type
     */
    public static function timeT(): Type
    {
        return new Type(4, function ($value): \DateTimeInterface {
            $date = new \DateTime();
            $date->setTimezone(new \DateTimeZone('UTC'));
            $date->setTimestamp(Bin::fromUInt32($value));

            return $date;
        });
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset(string $name): bool
    {
        return isset($this->data[$name]);
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function __get(string $name)
    {
        return $this->data[$name] ?? null;
    }

    /**
     * @return array
     */
    public function __debugInfo(): array
    {
        return $this->data;
    }
}
