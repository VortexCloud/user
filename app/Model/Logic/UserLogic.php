<?php declare(strict_types=1);

namespace App\Model\Logic;

use App\Model\Dao\UserDao;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class UserLogic
 *
 * @since 2.0
 *
 * @Bean()
 */
class UserLogic
{
    /**
     * @Inject()
     *
     * @var UserDao
     */
    private $userDao;

    /**
     * @param $page
     * @return array
     * @throws \Swoft\Db\Exception\DbException
     */
    public function getUsers($page):array
    {
        return $this->userDao->findAll($page);
    }
}
