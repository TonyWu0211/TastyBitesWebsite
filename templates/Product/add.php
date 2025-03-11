<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
//session_start(); // Ensure session is started to access session data
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h3 class="heading" style="font-size: 24px;"><?= __('Admin Page') ?></h3>
            <?= $this->Html->link(__('Return to Menu'), ['action' => 'index'], ['class' => 'side-nav-item', 'style' => 'font-size: 20px;']) ?>
        </div>
        <br>
        <div class="text-left">
            <?= $this->Html->link(
                'Log out',
                ['controller' => 'Auth', 'action' => 'logout'],
                ['class' => 'btn btn-primary btn-xl text-uppercase']
            ) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="product form content">
            <?= $this->Form->create($product, ['type' => 'file', 'enctype' => 'multipart/form-data']) ?>
            <fieldset>
                <h2><?= __('Add Product') ?></h2>
                <?= $this->Form->control('name'); ?>
                <?= $this->Form->control('price'); ?>
                <?= $this->Form->control('availability', ['label' => 'Description']); ?>
                <?= $this->Form->control('dietary_type'); ?>
                <label for="imagePath">Image Path</label>
                <?= $this->Form->control('image_path', ['type' => 'file', 'label' => false]); ?>
            </fieldset>

            <br />
            <div class="text-left">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary btn-xl text-uppercase']) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>

        <br>

        <div class="products list content">
            <h2><?= __('List of Products') ?></h2>
            <table>
                <thead style="font-size: medium;">
                <tr>
                    <th><?= __('Name') ?></th>
                    <th><?= __('Price') ?></th>
                    <th><?= __('Description') ?></th>
                    <th><?= __('Dietary Type') ?></th>
                    <th><?= __('image_path') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <tbody>
                <?php foreach ($products as $currentProduct): ?>
                    <tr>
                        <td style="font-size: 16px;"><?= h($currentProduct->name) ?></td>
                        <td style="font-size: 16px;"><?= '$' . h($currentProduct->price) ?></td>
                        <td style="font-size: 16px;"><?= h($currentProduct->availability) ?></td>
                        <td style="font-size: 16px;"><?= h($currentProduct->dietary_type) ?></td>
                        <td style="font-size: 16px;"><?= h($currentProduct->image_path) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $currentProduct->id]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>

                </tbody>
            </table>
        </div>

        <br>

        <div class="session-orders list content">
            <h2><?= __('Current Orders ') ?></h2>
            <table>
                <thead style="font-size: medium;">
                <tr>
                    <th><?= __('Product Name') ?></th>
                    <th><?= __('Price') ?></th>
                    <th><?= __('Quantity') ?></th>
                    <th><?= __('Subtotal') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $total = 0;
                if (isset($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $index => $item) {
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                        ?>
                        <tr>
                            <td><?= h($item['name']); ?></td>
                            <td><?= '$' . number_format($item['price'], 2); ?></td>
                            <td><?= h($item['quantity']); ?></td>
                            <td><?= '$' . number_format($subtotal, 2); ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="4" style="text-align: center;"><?= __('No orders found in session.'); ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3" class="text-right"><strong><?= __('Total:'); ?></strong></td>
                    <td><?= '$' . number_format($total, 2); ?></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
