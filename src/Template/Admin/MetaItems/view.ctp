<section class="content-header">
  <h1>
    <?php echo __d('dejw_cake_standard_cms', 'Meta Item'); ?>
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
                    <dt><?= __d('dejw_cake_standard_cms', 'Entity Class') ?></dt>
                    <dd>
                        <?= h($metaItem->entity_class) ?>
                    </dd>
                    <dt><?= __d('dejw_cake_standard_cms', 'Title ({0})', $supportedLanguages[$defaultLanguage]['title']) ?></dt>
                    <dd>
                        <?= h($metaItem->title) ?>
                    </dd>
                    <?php foreach ($supportedLanguages as $language => $languageSettings): ?>
                        <?php if($languageSettings['locale'] == $defaultLocale) { continue; } ?>
                    <dt><?= __d('dejw_cake_standard_cms', 'Title ({0})', $languageSettings['title']) ?></dt>
                    <dd>
                        <?= h($metaItem->translation($languageSettings['locale'])->title) ?>
                    </dd>
                    <?php endforeach; ?>
                    <dt><?= __d('dejw_cake_standard_cms', 'Keywords ({0})', $supportedLanguages[$defaultLanguage]['title']) ?></dt>
                    <dd>
                        <?= h($metaItem->keywords) ?>
                    </dd>
                    <?php foreach ($supportedLanguages as $language => $languageSettings): ?>
                        <?php if($languageSettings['locale'] == $defaultLocale) { continue; } ?>
                    <dt><?= __d('dejw_cake_standard_cms', 'Keywords ({0})', $languageSettings['title']) ?></dt>
                    <dd>
                        <?= h($metaItem->translation($languageSettings['locale'])->keywords) ?>
                    </dd>
                    <?php endforeach; ?>
                    <dt><?= __d('dejw_cake_standard_cms', 'Entity Id') ?></dt>
                    <dd>
                        <?= $this->Number->format($metaItem->entity_id) ?>
                    </dd>
                    <dt><?= __d('dejw_cake_standard_cms', 'Enabled') ?></dt>
                    <dd>
                        <?= $metaItem->enabled ? __d('dejw_cake_standard_cms', 'Yes') : __d('dejw_cake_standard_cms', 'No'); ?>
                    </dd>
                    <dt><?= __d('dejw_cake_standard_cms', 'Description ({0})', $supportedLanguages[$defaultLanguage]['title']) ?></dt>
                    <dd>
                        <?= h($metaItem->description) ?>
                    </dd>
                    <?php foreach ($supportedLanguages as $language => $languageSettings): ?>
                        <?php if($languageSettings['locale'] == $defaultLocale) { continue; } ?>
                    <dt><?= __d('dejw_cake_standard_cms', 'Description ({0})', $languageSettings['title']) ?></dt>
                    <dd>
                        <?= $this->Text->autoParagraph(h($metaItem->translation($languageSettings['locale'])->description)) ?>
                    </dd>
                    <?php endforeach; ?>
                    <dt><?= __d('dejw_cake_standard_cms', 'Created') ?></dt>
                    <dd>
                        <?= h($metaItem->created) ?>
                    </dd>
                    <dt><?= __d('dejw_cake_standard_cms', 'Modified') ?></dt>
                    <dd>
                        <?= h($metaItem->modified) ?>
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