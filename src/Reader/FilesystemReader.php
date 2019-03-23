<?php
/**
 * This file is part of opcache package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Opcache\Reader;

use Serafim\Opcache\Exception\ConfigurationException;
use Serafim\Opcache\Zend\File;
use Serafim\Opcache\Zend\FileInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Class FilesystemReader
 */
class FilesystemReader implements ReaderInterface
{
    /**
     * @var string
     */
    protected const OPCACHE_FILE_EXTENSION = '.bin';

    /**
     * @var string
     */
    public $directory;

    /**
     * FilesystemReader constructor.
     *
     * @param string $directory
     */
    public function __construct(string $directory = null)
    {
        $this->directory = $directory;
    }

    /**
     * @return string
     * @throws ConfigurationException
     */
    private function getDirectory(): string
    {
        return $this->directory ?? self::detectDirectory();
    }

    /**
     * @return string
     * @throws ConfigurationException
     */
    private static function detectDirectory(): string
    {
        $directory = \ini_get('opcache.file_cache');

        if (! $directory || ! \is_dir($directory)) {
            $error = 'Opcache output directory not found or not defined, please ';
            $error .= 'define the correct parameter "opcache.file_cache" value in php.ini';

            throw new ConfigurationException($error);
        }

        return $directory;
    }

    /**
     * @return iterable|FileInterface[]
     * @throws \InvalidArgumentException
     */
    public function all(): iterable
    {
        return $this->wrap($this->finder()->name($this->withExtension('*.php')));
    }

    /**
     * @param string $name
     * @return string
     */
    private function withExtension(string $name): string
    {
        return $this->escape($name) . self::OPCACHE_FILE_EXTENSION;
    }

    /**
     * @param iterable|SplFileInfo[] $files
     * @return iterable|FileInterface[]
     */
    private function wrap(iterable $files): iterable
    {
        foreach ($files as $file) {
            yield new File($file);
        }
    }

    /**
     * @param string $pathname
     * @param bool $absolute
     * @return iterable|FileInterface[]
     * @throws \InvalidArgumentException
     */
    public function find(string $pathname, bool $absolute = true): iterable
    {
        $pathname = $this->withExtension($pathname);

        $result = $this->finder()->name(\basename($pathname));

        if ($absolute) {
            $result = $result->filter(function (SplFileInfo $file) use ($pathname): bool {
                return \mb_substr($this->escape($file->getPathname()), -\mb_strlen($pathname)) === $pathname;
            });
        }

        return $this->wrap($result);
    }

    /**
     * @param string $pathname
     * @return string
     */
    private function escape(string $pathname): string
    {
        $pathname = \str_replace('\\', '/', $pathname);
        $pathname = \preg_replace('~/+~u', '/', $pathname);
        $pathname = \preg_replace('~:~u', '', $pathname);

        return $pathname;
    }

    /**
     * @return Finder
     * @throws \InvalidArgumentException
     * @throws ConfigurationException
     */
    private function finder(): Finder
    {
        return (new Finder())->files()->in($this->getDirectory());
    }
}
