<?php


namespace Core\Db;


class QueryHelper extends Connection
{
    public const ORDER_ASC = 1;
    public const ORDER_DESC = 2;

    protected $select = [];
    protected $create = [];
    protected $update = [];
    protected $delete = [];
    protected $from = null;
    protected $where = [];
    protected $orderBy = [];
    protected $limit;
    protected $offset;
    protected $leftJoin = [];
    protected $rightJoin = [];
    protected $innerJoin = [];
    protected $having = [];
    protected $groupBy = [];

    protected $query = "";

    protected $err = [];

    public function select(array $tableNames): QueryHelper
    {
        foreach ($tableNames as $tableName) {
            $select[] = $tableName;
        }
        return $this;
    }

    public function create()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function from()
    {

    }

    public function where(string $field, string $operator, string $value)
    {
        $this->where = ['field' => $field, 'operator' => $operator, 'value' => $value];
    }

    public function orderBy(string $field, int $orderType)
    {
        $this->orderBy[] = ["field" => $field, "orderType" => $orderType];
    }

    public function limit()
    {

    }

    public function offset()
    {

    }


    public function leftJoin()
    {

    }

    public function rightJoin()
    {

    }

    public function innerJoin()
    {

    }

    public function groupBy()
    {

    }

    public function having()
    {

    }

    public function execute()
    {

    }

    public function getAll()
    {
        $this->prepareQuery();
    }

    public function getOne()
    {
        $this->prepareQuery();
    }

    protected function prepareQuery()
    {
        if (!empty($this->select)) {
            $this->prepareSelect();
        } elseif (!empty($this->create())) {
            $this->prepareCreate();
        } elseif (!empty($this->update())) {
            $this->prepareUpdate();
        } elseif (!empty($this->delete)) {
            $this->prepareDelete();
        }
    }

    protected function prepareSelect()
    {
        $this->query .= "SELECT ";
        foreach ($this->select as $tableName) {
            $this->query .= $tableName;
            if ($tableName !== end($this->select)) {
                $this->query .= ", ";
            }
        }
        $this->prepareFrom();
    }

    protected function prepareFrom()
    {
        if (empty($this->from)) {
            $this->err[] = "";
        } else {
            $this->query .= " FROM " . $this->from;
        }
        $this->prepareWhere();
    }

    protected function prepareWhere()
    {
        if (!empty($this->where)) {
            $this->query .= " WHERE ";
            foreach ($this->where as $condition) {
                if (reset($this->where)) {
                    $this->query .= $condition['field'] . $condition['operator'] . $condition['value'];
                } else {
                    $this->query .= " AND (";
                    $this->query .= $condition['field'] . $condition['operator'] . $condition['value'];
                    $this->query .= ")";
                }
            }
        }
        $this->prepareOrderBy();
    }

    protected function prepareOrderBy()
    {
        if (!empty($this->orderBy())) {
            $this->query .= " ORDER BY ";
            foreach ($this->orderBy as $order) {

            }
        }
        $this->prepareLimit();
    }

    public function prepareLimit()
    {

        $this->prepareOffset();
    }

    public function prepareOffset()
    {

    }
}