<?php
/**
 * This file is part of opcache package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Opcache;

use Serafim\Opcache\Reader\ReaderInterface;

/**
 * Interface OpcacheInterface
 */
interface OpcacheInterface extends ReaderInterface
{
    /**
     * @param string $filename
     * @return FileInterface
     */
    public function open(string $filename): FileInterface;
}
