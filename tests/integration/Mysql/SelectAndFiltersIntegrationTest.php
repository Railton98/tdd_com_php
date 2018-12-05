<?php

namespace QueryBuilder\Mysql;

class SelectAndFiltersIntegrationTest extends \PHPUnit\Framework\TestCase
{
    public function testSelectComFiltroWhereEOrder()
    {
        $select = new Select;
        $select->setTable('pages');

        $filters = new Filters;
        $filters->where('id', '=', 1);
        $filters->orderBy('created', 'desc');

        $select->setFilters($filters);

        $actual = $select->getSql();
        $expected = 'SELECT * FROM pages WHERE id=1 ORDER BY created desc;';

        $this->assertEquals($expected, $actual);
    }
}
