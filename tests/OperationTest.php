<?php

/**
 * Created by Semen Kamenetskiy.
 * Date: 20/08/15
 */
class SampleOperation
    extends \salatnik\backop\operation\Operation
{

    /**
     * @return bool
     * @trows OperationException
     */
    public function run()
    {
        $this->d = $this->a;
        return true;
    }
}

/**
 * Class OperationTest
 */
class OperationTest
    extends PHPUnit_Framework_TestCase
{

    /**
     * @var SampleOperation
     */
    protected $operation;

    /**
     * @param null   $name
     * @param array  $data
     * @param string $dataName
     */
    public function __construct($name = null, $data = [], $dataName = '')
    {
        $this->operation = new SampleOperation;
        parent::__construct($name, $data, $dataName);
    }

    /**
     *
     */
    public function testOperation()
    {
        $this->assertInstanceOf(
            \salatnik\backop\operation\Operation::class,
            $this->operation,
            '$this->operation is not an instance of operation'
        );
    }

    public function testOperationRun()
    {
        $this->assertTrue($this->operation->run(), 'run() returned false');
    }

    public function testOperationGetterSetter()
    {
        $this->operation->setAttribute('a', true);
        $this->operation->b = 123;

        $this->assertEquals(true, $this->operation->a, 'Setter/Getter not working');
        $this->assertEquals(123, $this->operation->getAttribute('b'), 'Setter/Getter not working');
        $this->assertEmpty($this->operation->c, 'Isset not working');
        $this->assertEmpty($this->operation->getAttribute('c'), 'Isset not working');
    }

}
