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
     * @param resource $descriptor
     */
    public function __construct($descriptor)
    {
        \assert(\get_resource_type($descriptor) === 'stream');

        /**
         * @var string $name
         * @var TypeInterface|mixed $type
         */
        foreach ($this->read() as $name => $type) {
            if ($type instanceof TypeInterface) {
                $this->data[$name] = $type->decode($descriptor);
                continue;
            }

            $this->data[$name] = $type;
        }
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    protected function get(string $name)
    {
        return $this->data[$name] ?? null;
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
        return $this->get($name);
    }

    /**
     * @param string $name
     * @param TypeInterface|Struct $value
     */
    public function __set(string $name, $value)
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
