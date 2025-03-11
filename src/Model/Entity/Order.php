<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property int $product_id
 * @property int $customer_id
 * @property bool $status
 * @property string $price
 * @property int $quantity
 * @property string $delivery_type
 *
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\Customer $customer
 */
class Order extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'product_id' => true,
        'customer_id' => true,
        'status' => true,
        'price' => true,
        'quantity' => true,
        'delivery_type' => true,
        'product' => true,
        'customer' => true,
    ];
}
