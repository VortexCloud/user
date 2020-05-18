<?php declare(strict_types=1);

namespace App\Model\Dao;

use Swoft\Db\DB;
use ReflectionException;

/**
 * Class DbBaseDao
 *
 * @since 2.0
 */
class DbBaseDao
{
    protected $tableName;

    /**
     * 插入数据-支持批量插入
     * @param $data
     * @return bool
     * @throws ReflectionException
     */
    public function insert($data)
    {
        $query = DB::table($this->tableName);
        return $query->insert($data);
    }

    /**
     * 插入数据并返回主键id
     * @param $data
     * @return string
     * @throws ReflectionException
     */
    public function insertGetId($data)
    {
        $query = DB::table($this->tableName);
        return $query->insertGetId($data);
    }

    /**
     * 删除
     * @param $condition
     * @return int
     * @throws ReflectionException
     */
    public function delete($condition)
    {
        $query = DB::table($this->tableName);
        return $query->where($condition)->delete();
    }

    /**
     * 更新
     * @param $condition
     * @param $data
     * @return int
     * @throws ReflectionException
     */
    public function update($condition, $data)
    {
        $query = DB::table($this->tableName);
        return $query->where($condition)->update($data);
    }

    /**
     * 自增
     * @param $condition
     * @param string $field
     * @param int $amount
     * @return int
     * @throws ReflectionException
     */
    public function increment($condition, string $field, $amount = 1)
    {
        $query = DB::table($this->tableName);
        return $query->where($condition)->increment($field, $amount);
    }

    /**
     * 自减
     * @param $condition
     * @param string $field
     * @param int $amount
     * @return int
     * @throws ReflectionException
     */
    public function decrement($condition, string $field, $amount = 1)
    {
        $query = DB::table($this->tableName);
        return $query->where($condition)->decrement($field, $amount);
    }

    /**
     * 获取多条记录
     * @param $condition
     * @param array $fields
     * @param array $join
     * @param string $group
     * @param bool $isAll
     * @param int $page
     * @param int $limit
     * @param string $orderByField
     * @param string $order
     * @return \Swoft\Db\Eloquent\Collection
     */
    public function get(
        $condition,
        $fields = ['*'],
        $join = [],
        $group = '',
        $isAll = false,
        $page = 0,
        $limit = 15,
        $orderByField = '',
        $order = ''
    ) {
        $query = DB::table($this->tableName);
        if ($join) {
            foreach ($join as $item) {
                $query->join($item['table'], $item['first'], $item['operator'], $item['second'],
                    $item['type'] ?: 'inner');
            }
        }
        if ($group) {
            $query->groupBy($group);
        }
        if (!$isAll) {
            if (empty($page)) {
                $query->limit($limit);
            } else {
                $query->forPage($page, $limit);
            }
        }
        if ($orderByField && $order) {
            $query->orderBy($orderByField, $order);
        }
        return $query->where($condition)->get($fields);
    }

    /**
     * 获取单条记录
     * @param $condition
     * @param array $fields
     * @param array $join
     * @param string $group
     * @return object|\Swoft\Db\Eloquent\Model|\Swoft\Db\Query\Builder|null
     */
    public function first($condition, $fields = ['*'], $join = [], $group = '')
    {
        $query = DB::table($this->tableName);
        if ($join) {
            foreach ($join as $item) {
                $query->join($item['table'], $item['first'], $item['operator'], $item['second'],
                    $item['type'] ?: 'inner');
            }
        }
        if ($group) {
            $query->groupBy($group);
        }
        return $query->where($condition)->first($fields);
    }

    /**
     * count
     * @param $condition
     * @return int
     */
    public function count($condition)
    {
        $query = DB::table($this->tableName);
        return $query->where($condition)->count();
    }

    /**
     * exists
     * @param $condition
     * @return bool
     * @throws ReflectionException
     */
    public function exists($condition)
    {
        $query = DB::table($this->tableName);
        return $query->where($condition)->exists();
    }

    /**
     * sum
     * @param $condition
     * @param string $field
     * @return int
     */
    public function sum($condition, string $field)
    {
        $query = DB::table($this->tableName);
        return $query->where($condition)->sum($field);
    }
}
