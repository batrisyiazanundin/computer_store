<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Supplier[]|\Cake\Collection\CollectionInterface $suppliers
 */
?>
<div class="suppliers index content">
    <?= $this->Html->link(__('New Supplier'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Suppliers') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('supplier_id') ?></th>
                    <th><?= $this->Paginator->sort('supp_name') ?></th>
                    <th><?= $this->Paginator->sort('supp_add') ?></th>
                    <th><?= $this->Paginator->sort('supp_pnum') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($suppliers as $supplier): ?>
                <tr>
                    <td><?= h($supplier->supplier_id) ?></td>
                    <td><?= h($supplier->supp_name) ?></td>
                    <td><?= h($supplier->supp_add) ?></td>
                    <td><?= h($supplier->supp_pnum) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $supplier->supplier_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $supplier->supplier_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $supplier->supplier_id], ['confirm' => __('Are you sure you want to delete # {0}?', $supplier->supplier_id)]) ?>
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
