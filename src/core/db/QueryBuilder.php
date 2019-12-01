<?php

namespace src\core\db;

class QueryBuilder extends Query
{
    public const ORDER_ASC = 1;
    public const ORDER_DESC = 2;

    protected $select = [];
    protected $insert = [];
    protected $update = [];
    protected $delete = false;
    protected $from = null;
    protected $where = [];
    protected $orderBy = [];
    protected $limit = null;
    protected $offset = null;
    protected $leftJoin = [];
    protected $rightJoin = [];
    protected $innerJoin = [];
    protected $having = [];
    protected $groupBy = [];

    protected $query = '';

    protected $err = [];

    protected function resetCondition()
    {
        $this->select = [];
        $this->insert = [];
        $this->update = [];
        $this->from = null;
        $this->where = [];
        $this->orderBy = [];
        $this->limit = null;
        $this->offset = null;
        $this->leftJoin = [];
        $this->rightJoin = [];
        $this->innerJoin = [];
        $this->having = [];
        $this->groupBy = [];
        $this->query = '';
        $this->err = [];
    }

    public function select($tableNames)
    {
        $this->resetCondition();
        if (is_string($tableNames)) {
            $this->select[] = $tableNames;
        } else {
            foreach ($tableNames as $tableName) {
                $this->select[] = $tableName;
            }
        }
        return $this;
    }

    public function insert(string $tableName, array $data)
    {
        $this->resetCondition();
        foreach ($data as $field => $value) {
            $this->insert[] = ["table" => $tableName, "field" => $field, "value" => $value];
        }
        return $this;
    }

    public function update(string $tableName, array $data)
    {
        $this->resetCondition();
        foreach ($data as $field => $value) {
            $this->update[] = ["table" => $tableName, "field" => $field, "value" => $value];
        }
        return $this;
    }

    public function delete()
    {
        $this->resetCondition();
        $this->delete = true;
        return $this;
    }

    public function from(string $tableName)
    {
        $this->from = $tableName;
        return $this;
    }

    public function where(string $field, string $operator, string $value)
    {
        $this->where[] = ['field' => $field, 'operator' => $operator, 'value' => $value];
        return $this;
    }

    public function orderBy(string $field, int $type)
    {
        $this->orderBy[] = ["field" => $field, "type" => $type];
        return $this;
    }

    public function limit(int $limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset(int $offset)
    {
        $this->offset = $offset;
        return $this;
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

    public function like()
    {

    }

    public function execute()
    {
        $this->prepareQuery();
        echo $this->query;
        $this->sth = $this->conn->prepare($this->query);
        return $this->sth->execute();
    }

    public function getAll(): array
    {
        $this->execute();
        return $this->sth->fetchAll();
    }

    public function getOne(): array
    {
        $this->execute();
        return $this->sth->fetch();
    }

    protected function prepareQuery(): void
    {
        if (!empty($this->select)) {
            $this->prepareSelect();
        } elseif (!empty($this->insert)) {
            $this->prepareInsert();
        } elseif (!empty($this->update)) {
            $this->prepareUpdate();
        } elseif ($this->delete) {
            $this->prepareDelete();
        }
    }

    protected function prepareSelect(): void
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

    protected function prepareDelete(): void
    {
        $this->query .= "DELETE ";
        $this->prepareFrom();
    }

    protected function prepareUpdate()
    {
        $this->query .= "UPDATE " . $this->update[''];

    }


    protected function prepareInsert()
    {
        $table = (current($this->insert))['table'];
        $fields = '(';
        $values = '(';
        foreach ($this->insert as $insert) {
            $fields .= $insert['field'] . ', ';
            $values .= "'" . $insert['value'] . "'" . ', ';
        }
        $fields = substr($fields, 0, -2);
        $values = substr($values, 0, -2);
        $fields .= ')';
        $values .= ')';
        $this->query .= 'INSERT INTO ' . $table . ' ' . $fields . ' VALUES ' . $values;
    }

    protected function prepareFrom(): void
    {
        if (empty($this->from)) {
            $this->err[] = "";
        } else {
            $this->query .= " FROM " . $this->from;
        }
        $this->prepareWhere();
    }

    protected function prepareWhere(): void
    {
        if (!empty($this->where)) {
            $this->query .= " WHERE ";
            foreach ($this->where as $condition) {
                if (reset($this->where)) {
                    $this->query .= $condition['field'] . $condition['operator'] . "'" . $condition['value'] . "'";
                } else {
                    $this->query .= " AND (";
                    $this->query .= $condition['field'] . $condition['operator'] . "'" . $condition['value'] . "'";
                    $this->query .= ")";
                }
            }
        }
        $this->prepareOrderBy();
    }

    protected function prepareOrderBy(): void
    {
        if (!empty($this->orderBy)) {
            $this->query .= " ORDER BY ";
            foreach ($this->orderBy as $order) {
                $this->query .= $order["field"] . " " . $order["type"];
                if ($order !== end($this->orderBy)) {
                    $this->query .= ", ";
                }
            }
        }
        $this->prepareLimit();
    }

    public function prepareLimit(): void
    {
        if (!empty($this->limit)) {
            $this->query = " LIMIT " . $this->limit;
        }
        $this->prepareOffset();
    }

    public function prepareOffset(): void
    {
        if (!empty($this->offset)) {
            $this->query = " OFFSET " . $this->offset;
        }
    }
}