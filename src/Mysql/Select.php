<?php

namespace QueryBuilder\Mysql;

class Select
{
    private $table;
    private $filters;
    private $fields = [];

    public function setTable(string $table)
    {
        $this->table = $table;
        return $this;
    }

    public function setFields(array $fields)
    {
        $this->fields = $fields;
    }

    public function setFilters(Filters $filters)
    {
        $this->filters = $filters->getSql();
    }

    public function getSql() : string
    {
        $fields = '*';
        if (!empty($this->fields)) {
            $fields = implode(', ', $this->fields);
        }
        $filters = '';
        if (!empty($this->filters)) {
            $filters = ' ' . $this->filters;
        }

        $query = 'SELECT %s FROM %s%s;';
        return sprintf($query, $fields, $this->table, $filters);
    }
}
