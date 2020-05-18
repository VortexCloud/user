<?php declare(strict_types=1);

namespace App\Rpc\Lib;

/**
 * Interface UsersInterface
 *
 * @since 2.0
 */
interface UsersInterface
{
    /**
     * @return array
     */
    public function getList(): array;
}
