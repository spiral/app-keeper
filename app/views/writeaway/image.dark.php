<?php
/** @var \Spiral\Writeaway\Editor $writeawayEditor */ ?>
@inject($writeawayEditor, \Spiral\Writeaway\Editor::class)
<img
    src="${src}"
    alt="${alt}"
    title="${title}"
    width="${width}"
    height="${height}"
    class="${class}"
    @if($writeawayEditor->allows('image', inject('id')))
    data-id="${id}"
    data-piece="image"
    data-name="${name}"
    data-namespace="{{ $this->view->getNamespace() }}"
    data-view="{{ $this->view->getName() }}"
    @endif
/>
<?php ob_start(); ?>
${context}
<?php
$pieceData = $writeawayEditor->getPiece(
    'image',
    inject('id'),
    ['html' => ob_get_clean()/*todo*/],
    $this->view->getNamespace(),
    $this->view->getName()
);
echo $pieceData['html']
?>
