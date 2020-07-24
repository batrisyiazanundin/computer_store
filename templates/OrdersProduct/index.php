<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrdersProduct[]|\Cake\Collection\CollectionInterface $ordersProduct
 */
?>
<div class="ordersProduct index content">
    <?= $this->Html->link(__('New Orders Product'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Orders Product') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('PRODUCT_ID') ?></th>
                    <th><?= $this->Paginator->sort('ORDER_ID') ?></th>
                    <th><?= $this->Paginator->sort('QUANTITY') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ordersProduct as $ordersProduct): ?>
                <tr>
                    <td><?= h($ordersProduct->PRODUCT_ID) ?></td>
                    <td><?= h($ordersProduct->ORDER_ID) ?></td>
                    <td><?= $this->Number->format($ordersProduct->QUANTITY) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $ordersProduct->PRODUCT_ID]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ordersProduct->PRODUCT_ID]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ordersProduct->PRODUCT_ID], ['confirm' => __('Are you sure you want to delete # {0}?', $ordersProduct->PRODUCT_ID)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
