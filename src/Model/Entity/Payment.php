<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Payment Entity
 *
 * @property int $id
 * @property string $payment_type
 * @property string $amount
 * @property bool $status
 * @property int $customer_id
 *
 * @property \App\Model\Entity\Customer $customer
 */
class Payment extends Entity
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
        'payment_type' => true,
        'amount' => true,
        'status' => true,
        'customer_id' => true,
        'customer' => true,
    ];
}
