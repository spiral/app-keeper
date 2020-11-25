<?php
/** @var \Spiral\Writeaway\Editor $writeawayEditor */ ?>
@inject($writeawayEditor, \Spiral\Writeaway\Editor::class)
<?php
$pieceData = $writeawayEditor->getPiece(
    'image',
    inject('id'),
    [
        'src'    => inject('src'),
        'alt'    => inject('alt'),
        'title'  => inject('title'),
        'width'  => inject('width'),
        'height' => inject('height'),
    ],
    $this->view->getNamespace(),
    $this->view->getName()
);
?>
<img
    src="{{ $pieceData['src'] }}"
    alt="{{ $pieceData['alt'] }}"
    title="{{ $pieceData['title'] }}"
    width="{{ $pieceData['width'] ?? '' }}"
    height="{{ $pieceData['height'] ?? '' }}"
    class="${class}"
    @if($writeawayEditor->allows('image', inject('id')))
    data-id="${id}"
    data-piece="image"
    data-name="${name}"
    data-namespace="{{ $this->view->getNamespace() }}"
    data-view="{{ $this->view->getName() }}"
    @endif
/>
