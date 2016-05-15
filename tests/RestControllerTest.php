<?php

/**
 * Test class for the RestController class.
 *
 * The responses are null because there are any database operation in the background
 * and the rest controller is mocked.
 */
class RestControllerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \app\controllers\RestController
     */
    private $mockedRestController;

    /**
     * @var \Slim\Http\Request
     */
    private $mockedRequest;

    /**
     * @var \Slim\Http\Response
     */
    private $mockedResponse;

    /**
     * @var mixed
     */
    private $args;

    public function setUp()
    {
        parent::setUp();
        $this->mockedRestController = $this
            ->getMockBuilder('app\controllers\RestController')
            ->disableOriginalConstructor()
            ->getMock();
        $this->mockedRequest = $this->getMockClass('Slim\Http\Request');
        $this->mockedResponse = $this->getMockClass('Slim\Http\Response');
        $this->args = [];
    }
    
    public function testGetAllItemsGivesNull()
    {
        $result = $this->mockedRestController->getAllItems(
            $this->mockedRequest, $this->mockedResponse , []
        );
        $this->assertNull($result);
    }

    public function testGetItemGivesNull()
    {
        $result = $this->mockedRestController->getAllItems(
            $this->mockedRequest, $this->mockedResponse , ['id' => 1]
        );
        $this->assertNull($result);
    }

    public function testCreateItemGivesNull()
    {
        $result = $this->mockedRestController->createItem(
            $this->mockedRequest, $this->mockedResponse , []
        );
        $this->assertNull($result);
    }

    public function testEditItemGivesNull()
    {
        $result = $this->mockedRestController->editItem(
            $this->mockedRequest, $this->mockedResponse , []
        );
        $this->assertNull($result);
    }

    public function testDeleteItemGivesNull()
    {
        $result = $this->mockedRestController->deleteItem(
            $this->mockedRequest, $this->mockedResponse , []
        );
        $this->assertNull($result);
    }
}