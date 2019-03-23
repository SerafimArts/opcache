<?php
/**
 * This file is part of opcache package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Opcache\Struct;

use Serafim\Opcache\Struct\Type\TypeInterface;

/**
 * Class Struct
 */
class Struct
{
    /**
     * @var array|TypeInterface[]
     */
    private $types = [];

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
     * @return iterable|TypeInterface[]
     */
    public function read(): iterable
    {
        yield from $this->types;

        $reflection = new \ReflectionObject($this);
        $properties = $reflection->getProperties(\ReflectionProperty::IS_PROTECTED);

        foreach ($properties as $property) {
            $property->setAccessible(true);

            yield $property->getName() => $property->getValue($this);
        }
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
     * @param string $name
     * @param TypeInterface $value
     */
    public function __set(string $name, TypeInterface $value)
    {
        $this->types[$name] = $value;
    }

    /**
     * @return array
     */
    public function __debugInfo(): array
    {
        return $this->data;
    }
}
