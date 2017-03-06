<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= __d('dejw_cake_standard_cms', 'Pages') ?>
        <div class="pull-right"><?= $this->Html->link(__d('dejw_cake_standard_cms', 'New'), ['action' => 'add'], ['class' => 'btn btn-success btn-xs']) ?></div>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= __d('dejw_cake_standard_cms', 'List of Pages') ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="pagesTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <!--<th scope="col"><?= $this->Paginator->sort('id') ?></th>-->
                                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('slug') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('view') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('enabled') ?></th>
                                <!--<th scope="col"><?= $this->Paginator->sort('created') ?></th>-->
                                <!--<th scope="col"><?= $this->Paginator->sort('modified') ?></th>-->
                                <th scope="col" class="actions"><?= __d('dejw_cake_standard_cms', 'Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($pages as $page): ?>
                            <tr>
                                <!--<td><?= $this->Number->format($page->id) ?></td>-->
                                <td><?= h($page->title) ?></td>
                                <td><?= h($page->slug) ?></td>
                                <td><?= h($views[$page->view]) ?></td>
                                <td>
                                    <?= $page->enabled ? __d('dejw_cake_standard_cms', 'Yes') : __d('dejw_cake_standard_cms', 'No') ?>
                                    &nbsp;
                                    <?php
                                        if ($page->enabled) {
                                            echo $this->Form->postLink(__d('dejw_cake_standard_cms', 'Disable'), ['action' => 'enable', $page->id], ['escape' => false, 'confirm' => __d('dejw_cake_standard_cms', 'Are you sure you want to disable this entry?'), 'class' => 'btn btn-default btn-xs']);
                                        } else {
                                            echo $this->Form->postLink(__d('dejw_cake_standard_cms', 'Enable'), ['action' => 'enable', $page->id], ['escape' => false, 'confirm' => __d('dejw_cake_standard_cms', 'Are you sure you want to enable this entry?'), 'class' => 'btn btn-default btn-xs']);
                                        }
                                    ?>
                                </td>
                                <!--<td><?= h($page->created) ?></td>-->
                                <!--<td><?= h($page->modified) ?></td>-->
                                <td class="actions" style="white-space:nowrap">
                                    <?= $this->Html->link(__d('dejw_cake_standard_cms', 'View'), ['action' => 'view', $page->id], ['escape' => false, 'class' => 'btn btn-info btn-xs']) ?>
                                    <?= $this->Html->link(__d('dejw_cake_standard_cms', 'Edit'), ['action' => 'edit', $page->id], ['escape' => false, 'class' => 'btn btn-warning btn-xs']) ?>
                                    <?= $this->Form->postLink(__d('dejw_cake_standard_cms', 'Delete'), ['action' => 'delete', $page->id], ['escape' => false, 'confirm' => __d('dejw_cake_standard_cms', 'Are you sure you want to delete this entry?'), 'class' => 'btn btn-danger btn-xs']) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <!--<th scope="col"><?= $this->Paginator->sort('id') ?></th>-->
                            <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('slug') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('view') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('enabled') ?></th>
                            <!--<th scope="col"><?= $this->Paginator->sort('created') ?></th>-->
                            <!--<th scope="col"><?= $this->Paginator->sort('modified') ?></th>-->
                            <th scope="col" class="actions"><?= __d('dejw_cake_standard_cms', 'Actions') ?></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<!-- /.content -->

<?php $this->append('css'); ?>
<?php echo $this->Html->css('DejwCake/AdminLTE./plugins/datatables/dataTables.bootstrap.css'); ?>
<?php $this->end(); ?>
<?php $this->append('scriptBottom'); ?>
<?php echo $this->Html->script('DejwCake/AdminLTE./plugins/datatables/jquery.dataTables.min.js'); ?>
<?php echo $this->Html->script('DejwCake/AdminLTE./plugins/datatables/dataTables.bootstrap.min.js'); ?>
    <script>
        $(function () {
            $('#pagesTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": true
            });
        });
    </script>
<?php $this->end(); ?>
