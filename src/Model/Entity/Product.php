<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property string $product_id
 * @property string|null $brand
 * @property string|null $product_name
 * @property float|null $price
 * @property string|null $supplier_id
 *
 * @property \App\Model\Entity\Supplier $supplier
 */
class Product extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'brand' => true,
        'product_name' => true,
        'price' => true,
        'supplier_id' => true,
        'supplier' => true,
    ];
}
