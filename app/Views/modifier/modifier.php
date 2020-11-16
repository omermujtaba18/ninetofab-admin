<?php

// use App\Models\ModifierModel;

// $modifier = new ModifierModel();

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-5">
            <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
                <div class="mr-4 mb-3 mb-sm-0">
                    <h1 class="mb-0"><?= esc(ucfirst($title)); ?></h1>
                    <div class="small"><span class="font-weight-500 text-primary"></div>
                    <div class="small"><span class="font-weight-500 text-primary"><?= $time->toLocalizedString('EEEE') ?></span> &middot; <?= $time->toLocalizedString('MMMM d, yyyy') ?> &middot; <?= $time->toLocalizedString('hh:mm aaa') ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-header-actions mb-4">
                        <div class="card-header"><?= esc(ucfirst($title)); ?>
                            <a class="btn btn-primary btn-sm" href="/modifier/create?rest_id=<?= $rest_id ?>">Add a new modifier</a>
                        </div>

                        <div class="card-body">
                            <div class="datatable table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th style="min-width: 15em;">Instruction</th>
                                            <th>Options</th>
                                            <th style="min-width: 5em;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if (!empty($modifiers)) : ?>

                                            <?php foreach ($modifiers as $modifier) : ?>

                                                <tr>
                                                    <td><?= esc($modifier['modifier_group_name']); ?></td>
                                                    <td><?= esc($modifier['modifier_group_instruct']); ?></td>
                                                    <td>
                                                        <?php
                                                        $modifierItems = $modifierModel->where('modifier_group_id', $modifier['modifier_group_id'])->findAll();
                                                        ?>
                                                        <?php foreach ($modifierItems as $item) : ?>
                                                            <span class="badge badge-pill badge-success"> <?= $item['modifier_item'] . ($item['modifier_price'] > 0 ? ' - $' . number_format($item['modifier_price'], 2, '.', '') : '') ?></span><br>
                                                        <?php endforeach; ?>
                                                    <td>

                                                        <a class="btn btn-icon btn-sm btn-yellow ml-2 text-white" href="/modifier/update/<?= esc($modifier['modifier_group_id']); ?>?rest_id=<?= $rest_id ?>">
                                                            <i data-feather="edit"></i></a>
                                                        <a class="btn btn-icon btn-sm btn-red ml-2 text-white" href="/modifier/delete/<?= esc($modifier['modifier_group_id']); ?>?rest_id=<?= $rest_id ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                            <i data-feather="trash-2"></i></a>
                                                    </td>
                                                </tr>

                                            <?php endforeach; ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>