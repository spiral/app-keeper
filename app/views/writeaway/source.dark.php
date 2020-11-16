<div
    title="${title}"
    data-id="${id}"
    data-piece="source"
    class="${class}"
    data-name="${name}"
    data-namespace="{{ $this->view->getNamespace() }}"
    data-view="{{ $this->view->getName() }}"
>
    <?php /** @var \Spiral\Writeaway\Editor $writeawayEditor */ ?>
    @inject($writeawayEditor, \Spiral\Writeaway\Editor::class)
    @if($writeawayEditor->allows('source', inject('id')))
        <?php ob_start(); ?>
        ${context}
        <?php
        $pieceContext = ob_get_clean();

        $pieceData = $writeawayEditor->getPiece(
            'source',
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
