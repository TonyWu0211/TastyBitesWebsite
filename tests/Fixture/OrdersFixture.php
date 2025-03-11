<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrdersFixture
 */
class OrdersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'product_id' => 1,
                'customer_id' => 1,
                'status' => 1,
                'price' => 1.5,
                'quantity' => 1,
                'delivery_type' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
