<?php declare(strict_types=1);

namespace App\Model\Dao;

use App\Model\Entity\User;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * Class UserDao
 *
 * @since 2.0
 *
 * @Bean()
 */
class UserDao
{
    /**
     * @param int $page
     * @return array
     * @throws \Swoft\Db\Exception\DbException
     */
    public function findAll($page = 10):array
    {
        $rst = [];
        $rst = User::all();
        if (!empty($rst)){
            $rst = $rst->toArray();
        }
        return $rst;
    }
}
