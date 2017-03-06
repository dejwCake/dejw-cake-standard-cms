<section class="content-header">
  <h1>
    <?php echo __d('dejw_cake_standard_cms', 'Setting'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __d('dejw_cake_standard_cms', 'Back'), ['action' => 'index'], ['escape' => false])?>
    </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-info"></i>
                <h3 class="box-title"><?php echo __d('dejw_cake_standard_cms', 'Information'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                    <dt><?= __d('dejw_cake_standard_cms', 'Key') ?></dt>
                    <dd>
                        <?= h($setting->setting_key) ?>
                    </dd>
                    <dt><?= __d('dejw_cake_standard_cms', 'User') ?></dt>
                    <dd>
                        <?= $setting->has('user') ? $setting->user->email : '' ?>
                    </dd>
                    <dt><?= __d('dejw_cake_standard_cms', 'Enabled') ?></dt>
                    <dd>
                        <?= $setting->enabled ? __d('dejw_cake_standard_cms', 'Yes') : __d('dejw_cake_standard_cms', 'No'); ?>
                    </dd>
                    <dt><?= __d('dejw_cake_standard_cms', 'Value') ?></dt>
                    <dd>
                        <?= $this->Text->autoParagraph(h($setting->value)); ?>
                    </dd>
                    <dt><?= __d('dejw_cake_standard_cms', 'Created') ?></dt>
                    <dd>
                        <?= h($setting->created) ?>
                    </dd>
                    <dt><?= __d('dejw_cake_standard_cms', 'Modified') ?></dt>
                    <dd>
                        <?= h($setting->modified) ?>
                    </dd>
                </dl>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
</div>
<!-- div -->

</section>