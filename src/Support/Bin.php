<?php
/**
 * This file is part of opcache package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Opcache\Support;

use Serafim\Opcache\Exception\PackException;
use Serafim\Opcache\Exception\UnpackException;

/**
 * Class Bin
 */
class Bin
{
    /**
     * @param int $i
     * @return string
     * @throws PackException
     */
    public static function toInt8(int $i): string
    {
        return self::pack('c', $i);
    }

    /**
     * @param string $i
     * @return int
     * @throws UnpackException
     */
    public static function fromInt8(string $i): int
    {
        return self::unpack('c', $i);
    }

    /**
     * @param int $i
     * @return string
     * @throws PackException
     */
    public static function toUInt8(int $i): string
    {
        return self::pack('C', $i);
    }

    /**
     * @param string $i
     * @return int
     * @throws UnpackException
     */
    public static function fromUInt8(string $i): int
    {
        return self::unpack('C', $i);
    }

    /**
     * @param int $i
     * @return string
     * @throws PackException
     */
    public static function toInt16(int $i): string
    {
        return self::pack('s', $i);
    }

    /**
     * @param string $i
     * @return int
     * @throws UnpackException
     */
    public static function fromInt16(string $i): int
    {
        return self::unpack('s', $i);
    }

    /**
     * @param int $i
     * @param bool|null $endian
     * @return string
     * @throws PackException
     */
    public static function toUInt16(int $i, ?bool $endian = false): string
    {
        switch ($endian) {
            case true:
                return self::pack('n', $i);
            case false:
                return self::pack('v', $i);
            default:
                return self::pack('S', $i);
        }
    }

    /**
     * @param string $i
     * @param bool|null $endian
     * @return int
     * @throws UnpackException
     */
    public static function fromUInt16(string $i, ?bool $endian = false): int
    {
        switch ($endian) {
            case true:
                return self::unpack('n', $i);
            case false:
                return self::unpack('v', $i);
            default:
                return self::unpack('S', $i);
        }
    }

    /**
     * @param int $i
     * @return string
     * @throws PackException
     */
    public static function toInt32(int $i): string
    {
        return self::pack('l', $i);
    }

    /**
     * @param string $i
     * @return int
     * @throws UnpackException
     */
    public static function fromInt32(string $i): int
    {
        return self::unpack('l', $i);
    }

    /**
     * @param int $i
     * @param bool|null $endian
     * @return string
     * @throws PackException
     */
    public static function toUInt32(int $i, ?bool $endian = false): string
    {
        switch ($endian) {
            case true:
                return self::pack('N', $i);
            case false:
                return self::pack('V', $i);
            default:
                return self::pack('L', $i);
        }
    }

    /**
     * @param string $i
     * @param bool|null $endian
     * @return int
     * @throws UnpackException
     */
    public static function fromUInt32(string $i, ?bool $endian = false): int
    {
        switch ($endian) {
            case true:
                return self::unpack('N', $i);
            case false:
                return self::unpack('V', $i);
            default:
                return self::unpack('L', $i);
        }
    }

    /**
     * @param int $i
     * @return string
     * @throws PackException
     */
    public static function toInt64(int $i): string
    {
        return self::pack('q', $i);
    }

    /**
     * @param string $i
     * @return int
     * @throws UnpackException
     */
    public static function fromInt64(string $i): int
    {
        return self::unpack('q', $i);
    }

    /**
     * @param int $i
     * @param bool|null $endian
     * @return string
     * @throws PackException
     */
    public static function toUInt64(int $i, ?bool $endian = false): string
    {
        switch ($endian) {
            case true:
                return self::pack('J', $i);
            case false:
                return self::pack('P', $i);
            default:
                return self::pack('Q', $i);
        }
    }

    /**
     * @param string $i
     * @param bool|null $endian
     * @return int
     * @throws UnpackException
     */
    public static function fromUInt64(string $i, ?bool $endian = false): int
    {
        switch ($endian) {
            case true:
                return self::unpack('J', $i);
            case false:
                return self::unpack('P', $i);
            default:
                return self::unpack('Q', $i);
        }
    }

    /**
     * @param string $mode
     * @param mixed $value
     * @return string
     * @throws PackException
     */
    public static function pack(string $mode, $value): string
    {
        $result = \pack($mode, $value);

        if (! \is_string($result)) {
            throw new PackException('Could not to pack incorrect data');
        }

        return $result;
    }

    /**
     * @param string $mode
     * @param string $value
     * @return mixed
     * @throws UnpackException
     */
    public static function unpack(string $mode, string $value)
    {
        $result = \unpack($mode, $value);

        if (! \is_array($result) || ! isset($result[1])) {
            throw new UnpackException('Could not to unpack incorrect data');
        }

        return $result[1];
    }
}
