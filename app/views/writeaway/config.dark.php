<stack:push name="scripts" unique-id="writeaway">
    <script type="text/javascript" src="/generated/writeaway.js"></script>
    <script type="text/javascript">
        /**
         * WriteAwayBridge variable is put in global scope in application entry point by front end engineer
         */
        false && WriteAwayBridge.start({
                imageGalleryUrl: "<?= ('writeaway/imagesList') ?>", // Url to fetch images list
                getPieceBulkUrl: "<?= ('writeaway/pieceList') ?>", // Url to fetch piece data by multiple ids
                getPieceUrl: "<?= ('writeaway/getPiece') ?>", // Url to fetch piece data. This is fired only for pieces that can't be read directly from DOM
                saveMetaUrl: "<?= ('writeaway/saveSeo') ?>", // Url to save SEO data from SEO editor
                savePieceUrl: "<?= ('writeaway/savePiece') ?>", // Url to save piece. This may be overrided by piece container 'data-save-url' attribute
                uploadUrl: "<?= ('writeaway/uploadImage') ?>", // Url to upload image resources
                deleteImageUrl: "<?= ('writeaway/deleteImage') ?>" // Url to delete image
            },
            "<meta></meta>", // Specify HTML for custom meta page headers here for SEO Editor,
            {
                html: { // Options per editor type, if any
                    // pickerColors: ["red", "blue"]
                }
            },
            { // Meta data to attach to pieces when editing them
                id: "user-id",
                label: "John Smith",
            },
            typeof window.SpiralSocketConnection !== 'undefined' ? WriteAwayBridge.useWS(window.SpiralSocketConnection) : undefined,
        );
    </script>
</stack:push>

<stack:push name="styles" unique-id="writeaway">
    <link rel="stylesheet" href="/generated/css/writeaway.css"/>
</stack:push>
