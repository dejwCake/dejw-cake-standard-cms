<section class="content-header">
  <h1>
    <?php echo __('Page'); ?>
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
                    <dt><?= __('Title ({0})', $supportedLanguages[$defaultLanguage]['title']) ?></dt>
                    <dd>
                        <?= h($page->title) ?>
                    </dd>
                    <?php foreach ($supportedLanguages as $language => $languageSettings): ?>
                        <?php if($languageSettings['locale'] == $defaultLocale) { continue; } ?>
                    <dt><?= __('Title ({0})', $languageSettings['title']) ?></dt>
                    <dd>
                        <?= h($page->translation($languageSettings['locale'])->title) ?>
                    </dd>
                    <?php endforeach; ?>
                    <dt><?= __('Slug ({0})', $supportedLanguages[$defaultLanguage]['title']) ?></dt>
                    <dd>
                        <?= h($page->slug) ?>
                    </dd>
                    <?php foreach ($supportedLanguages as $language => $languageSettings): ?>
                        <?php if($languageSettings['locale'] == $defaultLocale) { continue; } ?>
                    <dt><?= __('Slug ({0})', $languageSettings['title']) ?></dt>
                    <dd>
                        <?= h($page->translation($languageSettings['locale'])->slug) ?>
                    </dd>
                    <?php endforeach; ?>
                    <dt><?= __('View') ?></dt>
                    <dd>
                        <?= h($views[$page->view]) ?>
                    </dd>
                    <dt><?= __('User') ?></dt>
                    <dd>
                        <?= $page->has('user') ? $page->user->id : '' ?>
                    </dd>
                    <dt><?= __('Meta Item') ?></dt>
                    <dd>
                        <?= $page->has('meta_item') ? $this->Html->link($page->meta_item->title, ['controller' => 'MetaItems', 'action' => 'view', $page->meta_item->id]) : '' ?>
                    </dd>
                    <dt><?= __('Enabled') ?></dt>
                    <dd>
                        <?= $page->enabled ? __('Yes') : __('No'); ?>
                    </dd>
                    <dt><?= __('Perex ({0})', $supportedLanguages[$defaultLanguage]['title']) ?></dt>
                    <dd>
                        <?= $this->Text->autoParagraph($page->perex) ?>
                    </dd>
                    <?php foreach ($supportedLanguages as $language => $languageSettings): ?>
                        <?php if($languageSettings['locale'] == $defaultLocale) { continue; } ?>
                    <dt><?= __('Perex ({0})', $languageSettings['title']) ?></dt>
                    <dd>
                        <?= $this->Text->autoParagraph($page->translation($languageSettings['locale'])->perex) ?>
                    </dd>
                    <?php endforeach; ?>
                    <dt><?= __('Text ({0})', $supportedLanguages[$defaultLanguage]['title']) ?></dt>
                    <dd>
                        <?= $this->Text->autoParagraph($page->text) ?>
                    </dd>
                    <?php foreach ($supportedLanguages as $language => $languageSettings): ?>
                        <?php if($languageSettings['locale'] == $defaultLocale) { continue; } ?>
                    <dt><?= __('Text ({0})', $languageSettings['title']) ?></dt>
                    <dd>
                        <?= $this->Text->autoParagraph($page->translation($languageSettings['locale'])->text) ?>
                    </dd>
                    <?php endforeach; ?>
                    <dt><?= __('Created') ?></dt>
                    <dd>
                        <?= h($page->created) ?>
                    </dd>
                    <dt><?= __('Modified') ?></dt>
                    <dd>
                        <?= h($page->modified) ?>
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