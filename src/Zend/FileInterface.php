<?php
/**
 * This file is part of opcache package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Opcache\Zend;

/**
 * Interface FileInterface
 */
interface FileInterface
{
    /**
     * @return Metainfo
     */
    public function getMeta(): Metainfo;
}
