<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrdersProductTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrdersProductTable Test Case
 */
class OrdersProductTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrdersProductTable
     */
    protected $OrdersProduct;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.OrdersProduct',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('OrdersProduct') ? [] : ['className' => OrdersProductTable::class];
        $this->OrdersProduct = TableRegistry::getTableLocator()->get('OrdersProduct', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->OrdersProduct);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
