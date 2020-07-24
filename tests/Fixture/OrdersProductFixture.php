<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrdersProductFixture
 */
class OrdersProductFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'orders_product';
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'PRODUCT_ID' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'ORDER_ID' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'QUANTITY' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'ORDER_ID' => ['type' => 'index', 'columns' => ['ORDER_ID'], 'length' => []],
            'PRODUCT_ID' => ['type' => 'index', 'columns' => ['PRODUCT_ID'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['PRODUCT_ID', 'ORDER_ID'], 'length' => []],
            'orders_product_ibfk_3' => ['type' => 'foreign', 'columns' => ['PRODUCT_ID'], 'references' => ['products', 'product_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'orders_product_ibfk_2' => ['type' => 'foreign', 'columns' => ['PRODUCT_ID'], 'references' => ['products', 'product_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'orders_product_ibfk_1' => ['type' => 'foreign', 'columns' => ['ORDER_ID'], 'references' => ['orders', 'order_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'PRODUCT_ID' => '88824ed4-cb93-467c-8285-ea539539f077',
                'ORDER_ID' => '29f54ede-d997-427d-88bf-2b7d85bfe658',
                'QUANTITY' => 1,
            ],
        ];
        parent::init();
    }
}
