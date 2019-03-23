<?php
/**
 * This file is part of opcache package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Opcache;

use Serafim\Opcache\Reader\FilesystemReader;
use Serafim\Opcache\Reader\ReaderInterface;
use Serafim\Opcache\Zend\File;
use Serafim\Opcache\Zend\FileInterface;

/**
 * Class Opcache
 */
class Opcache implements OpcacheInterface
{
    /**
     * @var ReaderInterface
     */
    private $reader;

    /**
     * Opcache constructor.
     *
     * @param ReaderInterface $reader
     */
    public function __construct(ReaderInterface $reader = null)
    {
        $this->reader = $reader ?? new FilesystemReader();
    }

    /**
     * @return iterable|FileInterface[]
     * @throws \InvalidArgumentException
     */
    public function all(): iterable
    {
        return $this->reader->all();
    }

    /**
     * @param string $filename
     * @param bool $absolute
     * @return iterable|FileInterface[]
     * @throws \InvalidArgumentException
     */
    public function find(string $filename, bool $absolute = true): iterable
    {
        return $this->reader->find($filename, $absolute);
    }

    /**
     * @param string $filename
     * @return FileInterface
     */
    public function open(string $filename): FileInterface
    {
        return new File(new \SplFileInfo($filename));
    }
}
