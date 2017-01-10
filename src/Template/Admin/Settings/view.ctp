<section class="content-header">
  <h1>
    <?php echo __('Setting'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false])?>
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
                <h3 class="box-title"><?php echo __('Information'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                    <dt><?= __('Key') ?></dt>
                    <dd>
                        <?= h($setting->setting_key) ?>
                    </dd>
                    <dt><?= __('User') ?></dt>
                    <dd>
                        <?= $setting->has('user') ? $setting->user->email : '' ?>
                    </dd>
                    <dt><?= __('Enabled') ?></dt>
                    <dd>
                        <?= $setting->enabled ? __('Yes') : __('No'); ?>
                    </dd>
                    <dt><?= __('Value') ?></dt>
                    <dd>
                        <?= $this->Text->autoParagraph(h($setting->value)); ?>
                    </dd>
                    <dt><?= __('Created') ?></dt>
                    <dd>
                        <?= h($setting->created) ?>
                    </dd>
                    <dt><?= __('Modified') ?></dt>
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