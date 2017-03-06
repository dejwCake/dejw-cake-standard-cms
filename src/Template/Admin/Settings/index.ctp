<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= __d('dejw_cake_standard_cms', 'Settings') ?>
        <div class="pull-right"><?= $this->Html->link(__d('dejw_cake_standard_cms', 'New'), ['action' => 'add'], ['class' => 'btn btn-success btn-xs']) ?></div>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?= __d('dejw_cake_standard_cms', 'List of Settings') ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="settingsTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <!--<th scope="col"><?= $this->Paginator->sort('id') ?></th>-->
                                <th scope="col"><?= $this->Paginator->sort('setting_key') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('enabled') ?></th>
                                <!--<th scope="col"><?= $this->Paginator->sort('created') ?></th>-->
                                <!--<th scope="col"><?= $this->Paginator->sort('modified') ?></th>-->
                                <th scope="col" class="actions"><?= __d('dejw_cake_standard_cms', 'Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($settings as $setting): ?>
                            <tr>
                                <!--<td><?= $this->Number->format($setting->id) ?></td>-->
                                <td><?= h($setting->setting_key) ?></td>
                                <td>
                                    <?= $setting->enabled ? __d('dejw_cake_standard_cms', 'Yes') : __d('dejw_cake_standard_cms', 'No') ?>
                                    &nbsp;
                                    <?php
                                        if ($setting->enabled) {
                                            echo $this->Form->postLink(__d('dejw_cake_standard_cms', 'Disable'), ['action' => 'enable', $setting->id], ['escape' => false, 'confirm' => __d('dejw_cake_standard_cms', 'Are you sure you want to disable this entry?'), 'class' => 'btn btn-default btn-xs']);
                                        } else {
                                            echo $this->Form->postLink(__d('dejw_cake_standard_cms', 'Enable'), ['action' => 'enable', $setting->id], ['escape' => false, 'confirm' => __d('dejw_cake_standard_cms', 'Are you sure you want to enable this entry?'), 'class' => 'btn btn-default btn-xs']);
                                        }
                                    ?>
                                </td>
                                <!--<td><?= h($setting->created) ?></td>-->
                                <!--<td><?= h($setting->modified) ?></td>-->
                                <td class="actions" style="white-space:nowrap">
                                    <?= $this->Html->link(__d('dejw_cake_standard_cms', 'View'), ['action' => 'view', $setting->id], ['escape' => false, 'class' => 'btn btn-info btn-xs']) ?>
                                    <?= $this->Html->link(__d('dejw_cake_standard_cms', 'Edit'), ['action' => 'edit', $setting->id], ['escape' => false, 'class' => 'btn btn-warning btn-xs']) ?>
                                    <?= $this->Form->postLink(__d('dejw_cake_standard_cms', 'Delete'), ['action' => 'delete', $setting->id], ['escape' => false, 'confirm' => __d('dejw_cake_standard_cms', 'Are you sure you want to delete this entry?'), 'class' => 'btn btn-danger btn-xs']) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <!--<th scope="col"><?= $this->Paginator->sort('id') ?></th>-->
                            <th scope="col"><?= $this->Paginator->sort('setting_key') ?></th>
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
            $('#settingsTable').DataTable({
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
