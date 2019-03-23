<?php
/**
 * This file is part of opcache package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Opcache\Reader;

use Serafim\Opcache\FileInterface;

/**
 * Interface ReaderInterface
 */
interface ReaderInterface
{
    /**
     * @return iterable|FileInterface[]
     */
    public function all(): iterable;

    /**
     * @param string $filename
     * @param bool $absolute
     * @return iterable|FileInterface[]
     */
    public function find(string $filename, bool $absolute = true): iterable;
}
