<?php

namespace QueryBuilder\Mysql;

class SelectTest extends \PHPUnit\Framework\TestCase
{
    public function testSelectSemFiltro()
    {
        $select = new Select;
        $select->setTable('pages');

        $actual = $select->getSql();
        $expected = 'SELECT * FROM pages;';

        $this->assertEquals($expected, $actual);
    }

    public function testSelectComFiltro()
    {
        $select = new Select;
        $select->setTable('pages');

        $stub = $this->getMockBuilder(Filters::class)
                        ->disableOriginalConstructor()
                        ->getMock();

        $stub->method('getSql')
                ->willReturn('WHERE id=1 ORDER BY created desc');

        $select->setFilters($stub);

        $actual = $select->getSql();
        $expected = 'SELECT * FROM pages WHERE id=1 ORDER BY created desc;';

        $this->assertEquals($expected, $actual);
    }

    public function testSelectEspecificandoOsCampos()
    {
        $select = new Select;
        $select->setTable('users');
        $select->setFields(['name', 'email']);

        $actual = $select->getSql();
        $expected = 'SELECT name, email FROM users;';

        $this->assertEquals($expected, $actual);
    }

}
