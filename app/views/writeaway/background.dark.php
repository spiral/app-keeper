<?php /** @var \Spiral\Writeaway\Editor $writeawayEditor */ ?>
@inject($writeawayEditor, \Spiral\Writeaway\Editor::class)
<div
    title="${title}"
    class="${class}"
    style="background-image: url('${src}'); background-color: ${bgColor}; background-repeat: ${bgRepeat}; background-size: ${bgSize}; background-position: ${bgPosition};"
    @if($writeawayEditor->allows('background', inject('id')))
    data-id="${id}"
    data-piece="background"
    data-name="${name}"
    data-namespace="{{ $this->view->getNamespace() }}"
    data-view="{{ $this->view->getName() }}"
    @endif
>
    <?php ob_start(); ?>
    ${context}
    <?php
    $pieceData = $writeawayEditor->getPiece(
    'background',
    inject('id'),
    ['html' => ob_get_clean()],
    $this->view->getNamespace(),
    $this->view->getName()
);
    echo $pieceData['html']
    ?>
</div>
