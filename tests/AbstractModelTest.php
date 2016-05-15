<?php

/**
 * Test class for the AbstractModel class.
 */
class AbstractModelTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \app\lib\AbstractModel
     */
    private $mockedAbstractModel;

    public function setUp()
    {
        parent::setUp();
        $this->mockedAbstractModel = $this->getMockForAbstractClass('app\lib\AbstractModel');
    }

    public function testGetTableNameByClassName()
    {
        $this->assertSame('abstracts', $this->mockedAbstractModel->getTableNameByClassName('AbstractModel'));
    }

    /**
     * @expectedException PDOException
     */
    public function testFindAllExceptionTableNotExists()
    {
        $this->mockedAbstractModel->findAll();
    }

    /**
     * @expectedException PDOException
     */
    public function testFindExceptionTableNotExists()
    {
        $this->mockedAbstractModel->find(1);
    }

    public function testInsertEmptyThenResultFalse()
    {
        $result = $this->mockedAbstractModel->save(null, null);
        $this->assertFalse($result);
    }

    public function testUpdateEmptyThenResultFalse()
    {
        $result = $this->mockedAbstractModel->save(null, 1);
        $this->assertFalse($result);
    }


    public function testDeleteGivesFalseResultInfo()
    {
        $resultInfo = $this->mockedAbstractModel->delete(1);
        $this->assertFalse($resultInfo['result']);
    }
}