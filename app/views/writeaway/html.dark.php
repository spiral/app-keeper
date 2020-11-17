<?php /** @var \Spiral\Writeaway\Editor $writeawayEditor */ ?>
@inject($writeawayEditor, \Spiral\Writeaway\Editor::class)
<div
    title="${title}"
    class="${class}"
    @if($writeawayEditor->allows('html', inject('id')))
    data-id="${id}"
    data-piece="html"
    data-name="${name}"
    data-namespace="{{ $this->view->getNamespace() }}"
    data-view="{{ $this->view->getName() }}"
    @endif
>
    <?php ob_start(); ?>
    ${context}
    <?php
    $pieceData = $writeawayEditor->getPiece(
    'html',
    inject('id'),
    ['html' => ob_get_clean()],
    $this->view->getNamespace(),
    $this->view->getName()
);
    echo $pieceData['html']
    ?>
</div>
