<extends:layout.base title="[[Welcome To Spiral]]"/>
<use:element path="embed/links" as="homepage:links"/>
<use:bundle path="writeaway/bundle"/>

<stack:push name="styles">
    @if(!env('FRONT_END_PUBLIC_URL'))
        <link rel="stylesheet" href="/generated/css/client.css"/>
    @endif
    @if(env('FRONT_END_PUBLIC_URL'))
        <link rel="stylesheet" href="{{ env('FRONT_END_PUBLIC_URL') }}/generated/css/client.css"/>
    @endif
</stack:push>

<stack:push name="scripts">
    <script type="text/javascript" src="/generated/ie11.js"></script>
    @if(env('FRONT_END_PUBLIC_URL'))
        <script type="text/javascript" src="{{ env('FRONT_END_PUBLIC_URL') }}/generated/client.js"></script>
    @endif
    @if(!env('FRONT_END_PUBLIC_URL'))
        <script type="text/javascript" src="/generated/client.js"></script>
    @endif
</stack:push>

<define:body>
    <div class="wrapper">
        <div class="placeholder">
            <img src="/images/logo.svg" alt="Framework Logotype" width="200px"/>
            <h2>[[Welcome to Spiral Framework]]</h2>

            <homepage:links git="https://github.com/spiral/app-keeper" style="font-weight: bold;"/>

            <div style="font-size: 12px; margin-top: 10px;">
                [[This view file is located in]] <b>app/views/home.dark.php</b> [[and rendered by]] <b>Controller\IndexController</b>.
            </div>
        </div>
    </div>
    <writeaway:config></writeaway:config>
</define:body>
