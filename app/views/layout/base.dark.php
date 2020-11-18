<!DOCTYPE html>
<html lang="@{locale}">
<use:bundle path="writeaway/bundle"/>

<head>
    <writeaway:seo title="${title}" description="${description}" keywords="${keywords}">
        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:title" content="${title}">
        <meta property="og:description" content="${description}">
        <meta property="og:image" content="https://metatags.io/assets/meta-tags-16a33a6a8531e519cc0936fbba0ad904e52d35f34a46c97a2c9f6f7dd7d336f2.png">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:title" content="${title}">
        <meta property="twitter:description" content="${description}">
        <meta property="twitter:image" content="https://metatags.io/assets/meta-tags-16a33a6a8531e519cc0936fbba0ad904e52d35f34a46c97a2c9f6f7dd7d336f2.png">
    </writeaway:seo>
    <block:head>
        <stack:collect name="styles" level="2"/>
    </block:head>
</head>
<body>
<block:body/>
<stack:collect name="scripts" level="1"/>
</body>
<hidden>${context}</hidden>
</html>
