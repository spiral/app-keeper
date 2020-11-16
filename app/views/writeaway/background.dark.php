<div
    title="${title}"
    data-id="${id}"
    data-piece="background"
    class="${class}"
    data-name="${name}"
    data-namespace="{{ $this->view->getNamespace() }}"
    data-view="{{ $this->view->getName() }}"
    style="background-image: url('${src}'); background-color: ${bgColor}; background-repeat: ${bgRepeat}; background-size: ${bgSize}; background-position: ${bgPosition};"
>
    <?php /** @var \Spiral\Writeaway\Editor $writeawayEditor */ ?>
    @inject($writeawayEditor, \Spiral\Writeaway\Editor::class)
    @if($writeawayEditor->allows('background', inject('id')))
        <?php ob_start(); ?>
        ${context}
        <?php
        $pieceContext = ob_get_clean();

        $pieceData = $writeawayEditor->getPiece(
            'background',
            inject('id'),
            ['html' => $pieceContext],
            $this->view->getNamespace(),
            $this->view->getName()
        );
        echo $pieceData['html']
        ?>
    @else
        ${context}
    @endif
</div>
