<?php /** @var \Spiral\Writeaway\Editor $writeawayEditor */ ?>
@inject($writeawayEditor, \Spiral\Writeaway\Editor::class)
<?php
$pieceData = $writeawayEditor->getPiece(
    'background',
    inject('id'),
    [
        'src'        => inject('src'),
        'bgColor'    => inject('bgColor'),
        'bgRepeat'   => inject('bgRepeat'),
        'bgSize'     => inject('bgSize'),
        'bgPosition' => inject('bgPosition'),
    ],
    $this->view->getNamespace(),
    $this->view->getName()
);
?>
<div
    title="${title}"
    class="${class}"
    style="background-image: url('{{ $pieceData['src'] ?? '' }}'); background-color: {{ $pieceData['bgColor'] ?? 'inherit' }}; background-repeat: {{ $pieceData['bgRepeat'] ?? 'inherit' }}; background-size: {{ $pieceData['bgSize'] ?? 'inherit' }}; background-position: {{ $pieceData['bgPosition'] ?? 'inherit' }};"
    @if($writeawayEditor->allows('background', inject('id')))
    data-id="${id}"
    data-piece="background"
    data-name="${name}"
    data-namespace="{{ $this->view->getNamespace() }}"
    data-view="{{ $this->view->getName() }}"
    @endif
>
    ${context}
</div>
