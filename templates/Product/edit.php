<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $product->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $product->id), 'class' => 'side-nav-item']
            ) ?>
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
            <?= $this->Form->create($product,['type' => 'file','enctype' => 'multipart/form-data']) ?>
            <fieldset>
                <h2><?= __('Edit Product') ?></h2>
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
    </div>
</div>
