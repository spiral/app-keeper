<?php /** @var \Spiral\Writeaway\Editor $writeawayEditor */ ?>
@inject($writeawayEditor, \Spiral\Writeaway\Editor::class)
<?php ob_start(); ?>
${context}
<?php
$seoPieceID = inject('id', "{$this->view->getNamespace()}:{$this->view->getName()}");
$pieceData = $writeawayEditor->getPiece(
    'seo',
    $seoPieceID,
    [
        'title'       => inject('title'),
        'description' => inject('description'),
        'keywords'    => inject('keywords'),
        'header'      => ob_get_clean(),
    ],
    $this->view->getNamespace(),
    $this->view->getName()
);
?>
<title>{{ $pieceData['title'] }}</title>
<meta name="description" content="{{ $pieceData['description'] }}"/>
<meta name="keywords" content="{{ $pieceData['keywords'] }}"/>
{!! $pieceData['header'] !!}

@if($writeawayEditor->allows('seo',$seoPieceID))
    <script type="application/javascript">
        var SEO_META = {
            id: {{ $seoPieceID }},
            namespace: {{ $this->view->getNamespace() }},
            view: {{ $this->view->getName() }}
        };
        var SEO_HEADER = {{ $pieceData['header'] }};
    </script>
@endif

