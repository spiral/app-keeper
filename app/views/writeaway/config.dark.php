<stack:push name="scripts" unique-id="writeaway">
    <?php /** @var \Spiral\Writeaway\Editor $writeawayEditor */ ?>
    @inject($writeawayEditor, \Spiral\Writeaway\Editor::class)
    @if($writeawayEditor->allows())
        <script type="text/javascript" src="/generated/writeaway.js"></script>
        <script type="text/javascript">
            /**
             * WriteAwayBridge variable is put in global scope in application entry point by front end engineer
             */
            WriteAwayBridge.start({
                imageGalleryUrl: "@route('writeaway:images:list')", // Url to fetch images list
                uploadUrl: "@route('writeaway:images:upload')", // Url to upload image resources
                deleteImageUrl: "@route('writeaway:images:delete')", // Url to delete image
                getPieceUrl: "@route('writeaway:pieces:get')", // Url to fetch piece data. This is fired only for pieces that can't be read directly from DOM
                savePieceUrl: "@route('writeaway:pieces:save')", // Url to save piece. This may be overrided by piece container 'data-save-url' attribute
                getPieceBulkUrl: "@route('writeaway:pieces:bulk')" // Url to fetch piece data by multiple ids
            },
            window.SEO_HEADER || '', // Specify HTML for custom meta page headers here for SEO Editor,
            {
                html: { // Options per editor type, if any
                    // pickerColors: ["red", "blue"]
                }
            },
            @json($writeawayEditor->getMeta()),
            typeof window.SpiralSocketConnection !== 'undefined' ? WriteAwayBridge.useWS(window.SpiralSocketConnection) : undefined,
        );
        </script>
    @endif
</stack:push>

<stack:push name="styles" unique-id="writeaway">
    @inject($writeawayEditor, \Spiral\Writeaway\Editor::class)
    @if($writeawayEditor->allows())
        <link rel="stylesheet" href="/generated/css/writeaway.css"/>
    @endif
</stack:push>
