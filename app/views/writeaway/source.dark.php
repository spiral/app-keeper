<?php /** @var \Spiral\Writeaway\Editor $writeawayEditor */ ?>
@inject($writeawayEditor, \Spiral\Writeaway\Editor::class)
<div
    title="${title}"
    class="${class}"
    @if($writeawayEditor->allows('source', inject('id')))
    data-id="${id}"
    data-piece="source"
    data-name="${name}"
    data-namespace="{{ $this->view->getNamespace() }}"
    data-view="{{ $this->view->getName() }}"
    @endif
>
    <?php ob_start(); ?>
    ${context}
    <?php
    $pieceData = $writeawayEditor->getPiece(
    'source',
    inject('id'),
    ['html' => ob_get_clean()],
    $this->view->getNamespace(),
    $this->view->getName()
);
    echo $pieceData['html']
    ?>
</div>
