<?php
/**
 * This file is part of opcache package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Opcache;

use Serafim\Opcache\Zend\Metainfo;
use Serafim\Opcache\Zend\ZendString;

/**
 * Class File
 */
class File implements FileInterface
{
    /**
     * @var array
     */
    private $sections = [];

    /**
     * File constructor.
     *
     * @param \SplFileInfo $file
     */
    public function __construct(\SplFileInfo $file)
    {
        foreach ($this->read($file) as $section) {
            $this->sections[\get_class($section)] = $section;
        }
    }

    /**
     * @param \SplFileInfo $file
     * @return \Traversable
     */
    private function read(\SplFileInfo $file): \Traversable
    {
        $descriptor = \fopen($file->getRealPath(), 'rb');

        yield new Metainfo($descriptor);
        //yield new ZendString($descriptor);

        \fclose($descriptor);
    }

    /**
     * @param string $name
     * @return mixed
     */
    private function section(string $name)
    {
        return $this->sections[$name];
    }

    /**
     * @return Metainfo
     */
    public function getMeta(): Metainfo
    {
        return $this->section(Metainfo::class);
    }

    /**
     * @return array
     */
    public function __debugInfo(): array
    {
        return $this->sections;
    }
}
