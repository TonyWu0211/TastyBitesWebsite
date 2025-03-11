<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PaymentFixture
 */
class PaymentFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'payment';
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
                'payment_type' => 'Lorem ipsum dolor sit amet',
                'amount' => 1.5,
                'status' => 1,
                'customer_id' => 1,
            ],
        ];
        parent::init();
    }
}
