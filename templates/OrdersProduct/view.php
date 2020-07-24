<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrdersProduct $ordersProduct
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Orders Product'), ['action' => 'edit', $ordersProduct->PRODUCT_ID], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Orders Product'), ['action' => 'delete', $ordersProduct->PRODUCT_ID], ['confirm' => __('Are you sure you want to delete # {0}?', $ordersProduct->PRODUCT_ID), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Orders Product'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Orders Product'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="ordersProduct view content">
            <h3><?= h($ordersProduct->PRODUCT_ID) ?></h3>
            <table>
                <tr>
                    <th><?= __('PRODUCT ID') ?></th>
                    <td><?= h($ordersProduct->PRODUCT_ID) ?></td>
                </tr>
                <tr>
                    <th><?= __('ORDER ID') ?></th>
                    <td><?= h($ordersProduct->ORDER_ID) ?></td>
                </tr>
                <tr>
                    <th><?= __('QUANTITY') ?></th>
                    <td><?= $this->Number->format($ordersProduct->QUANTITY) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
