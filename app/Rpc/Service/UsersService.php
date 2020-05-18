<?php declare(strict_types=1);

namespace App\Rpc\Service;

use App\Model\Logic\UserLogic;
use App\Rpc\Lib\UsersInterface;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Rpc\Server\Annotation\Mapping\Service;

/**
 * Class UsersService
 *
 * @since 2.0
 *
 * @Service()
 */
class UsersService implements UsersInterface
{
    /**
     * @Inject()
     *
     * @var UserLogic
     */
    private $userLogic;

    /**
     * @return array
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getList(): array
    {
        return $this->userLogic->getUsers(10);
    }
}
