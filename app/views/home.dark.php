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
    <div class="center">
        <div class="wrapper">
            <div class="placeholder" style="margin-bottom: 40px; padding-top: 40px">
                <img src="/images/logo.svg" alt="Framework Logotype" width="200px"/>
                <h2>[[Welcome to Spiral Framework]]</h2>

                <homepage:links git="https://github.com/spiral/app-keeper" style="font-weight: bold;"/>

                <div style="font-size: 12px; margin-top: 10px;">
                    [[This view file is located in]] <b>app/views/home.dark.php</b> [[and rendered by]] <b>Controller\IndexController</b>.
                </div>
            </div>
        </div>
        <writeaway:background id="bg-1" name="Background" bgColor="#f8f8f8">
            <div class="wrapper" style="padding: 10px">
                <writeaway:html id="html-1" name="Sample Text">
                    <h3>Inline Content Editor</h3>
                    <p>Comes with inline content editor now. Login to enable editor for this block and try it live.</p>
                    <p>Uses <a href="https://writeaway.github.io/">WriteAway</a> under the hood.</p>
                </writeaway:html>
            </div>
        </writeaway:background>
    </div>
    <writeaway:config></writeaway:config>
</define:body>
