<extends:keeper:layout.page title="Showcase: QR Codes"/>
<use:bundle path="keeper:bundle"/>
<use:element path="utils/syntaxhilight" as="utils:syntaxhilight"/>

<ui:action>
    <action:button icon="arrow-left" kind="light" href="@action('dashboard.index')" label="Back to Dashboard"/>
</ui:action>

<ui:action>
    <action:button icon="file" kind="primary" href="https://github.com/spiral/app-keeper/blob/master/app/views/keeper/showcase/qrcode.dark.php"
                   target="_blank" label="Source Code"/>
</ui:action>

<define:content>
    <ui:panel header="QR Codes">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <h3>Rendered as SVG (default)</h3>
                <ui:qrcode value="HK3ARG6MYFMIDDHB"/>
            </div>

            <div class="col-sm-12 col-md-6">
                <utils:syntaxhilight />
                @declare(syntax=off)<pre class="language-markup"><code>&lt;ui:qrcode value="HK3ARG6MYFMIDDHB"/&gt;</code></pre>@declare(syntax=on)</div>

            <div class="col-sm-12">
                <hr/>
            </div>

            <div class="col-sm-12 col-md-6">
                <h3>Rendered as CANVAS</h3>
                <ui:qrcode value="https://spiral.dev/" type="canvas"/>
            </div>

            <div class="col-sm-12 col-md-6">
                <utils:syntaxhilight />
                @declare(syntax=off)<pre class="language-markup"><code>&lt;ui:qrcode value="https://spiral.dev/" type="canvas"/&gt;</code></pre>@declare(syntax=on)
                <p><code>type</code> attribute accepts <code>canvas</code> or <code>svg</code> value. Default is <code>svg</code>.</p>
            </div>

            <div class="col-sm-12">
                <hr/>
            </div>

            <div class="col-sm-12 col-md-6">
                <h3>Uses custom colors</h3>
                <ui:qrcode
                    value="https://spiral.dev/"
                    type="canvas"
                    size="200"
                    bgColor="#f8f9fa"
                    fgColor="#49545f"
                    ecLevel="H"
                />
            </div>

            <div class="col-sm-12 col-md-6">
                <utils:syntaxhilight />
                @declare(syntax=off)<pre class="language-markup"><code>&lt;ui:qrcode
    value="https://spiral.dev/"
    type="canvas"
    size="200"
    bgColor="#f8f9fa"
    fgColor="#49545f"
    ecLevel="H"
/&gt;</code></pre>@declare(syntax=on)
                <p><code>type</code> attribute accepts <code>canvas</code> or <code>svg</code> value. Default is <code>svg</code>.</p>
                <p><code>size</code> specifies size in pixels. Default is <code>200</code></p>
                <p><code>bgColor</code> specifies background color</p>
                <p><code>fgColor</code> specifies foreground color</p>
                <p><code>ecLevel</code> specifies error correction level. Valid values as <code>H</code>, <code>M</code> and <code>L</code> for High, Medium, Low respectively</p>
</div>

            <div class="col-sm-12">
                <hr/>
            </div>

            <div class="col-sm-12 col-md-6">
                <h3>Custom Logo</h3>
                <ui:qrcode
                    value="https://spiral.dev/"
                    type="canvas"
                    size="300"
                    bgColor="#f8f9fa"
                    fgColor="#578fca"
                    ecLevel="H"
                    logoUrl="/logo.svg"
                    logoHeight="50"
                    logoWidth="40"
                    logoX="130"
                    logoY="125"
                    logoMargin="0"
                />
            </div>

            <div class="col-sm-12 col-md-6">
                <utils:syntaxhilight />
                @declare(syntax=off)<pre class="language-markup"><code>&lt;ui:qrcode
    value="https://spiral.dev/"
    type="canvas"
    size="300"
    bgColor="#f8f9fa"
    fgColor="#578fca"
    ecLevel="H"
    logoUrl="/logo.svg"
    logoHeight="50"
    logoWidth="40"
    logoX="130"
    logoY="125"
    logoMargin="0"
/&gt;</code></pre>@declare(syntax=on)
                <p><code>logoUrl</code> specifies URL of logo to render on top of code.</p>
                <p><code>logoHeight</code> logo render height</p>
                <p><code>logoWidth</code> logo render width</p>
                <p><code>logoX</code> position to render logo at</p>
                <p><code>logoY</code> position to render logo at</p>
                <p><code>logoMargin</code> renders background color space around logo. Specify 0 to render only under logo. Omit to render logos with transparent BG.</p>
</div>

        </div>
    </ui:panel>
</define:content>
