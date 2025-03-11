<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CustomerFixture
 */
class CustomerFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'customer';
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
                'name' => 'Lorem ipsum dolor sit amet',
                'DOB' => '2024-04-13',
                'address' => 'Lorem ipsum dolor sit amet',
                'dietary_restrictions' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
