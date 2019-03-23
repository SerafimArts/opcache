<?php
/**
 * This file is part of opcache package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Opcache\Struct;

/**
 * Class FileStruct
 */
class FileStruct extends Struct
{
    /**
     * FileStruct constructor.
     *
     * @param resource $descriptor
     */
    public function __construct($descriptor)
    {
        \assert(\get_resource_type($descriptor) === 'stream');

        parent::__construct(function ($iterator) use ($descriptor) {
            /**
             * @var string $name
             * @var Type $type
             */
            foreach ($iterator as $name => $type) {
                yield $name => $type->decode(\fread($descriptor, $type->getSize()));
            }
        });
    }
}
