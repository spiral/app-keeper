<extends:keeper:layout.page title="Showcase: TinyMCE"/>
<use:bundle path="keeper:bundle"/>
<use:element path="utils/syntaxhilight" as="utils:syntaxhilight"/>

<ui:action>
    <action:button icon="arrow-left" kind="light" href="@action('dashboard.index')" label="Back to Dashboard"/>
</ui:action>

<ui:action>
    <action:button icon="file" kind="primary" href="https://github.com/spiral/app-keeper/blob/master/app/views/keeper/showcase/tinymce.dark.php"
                   target="_blank" label="Source Code"/>
</ui:action>

<define:content>
    <ui:panel header="TinyMCE">
        <form:wrapper action="/" method="PUT">
            <div class="with-form-control col-sm-12 col-md-6">
                <form:tinymce
                    name="date"
                    label="Rich Text"
                    value=""
                />
            </div>

            <div class="col-sm-12 col-md-6">
                <utils:syntaxhilight />
                @declare(syntax=off)<pre class="language-markup"><code>&lt;form:tinymce
    name="date"
    label="Rich Text"
    value=""
/&gt;</code></pre>@declare(syntax=on)</div>

            <div class="with-form-control col-sm-12 col-md-6">
                <form:tinymce
                    name="date"
                    label="Rich Text"
                    value=""
                >
                    <script role="sf-options" type="application/json">
                        {
                            "options": {
                                "menubar": false,
                                "height": 300
                            }
                        }
                    </script>
                </form:tinymce>
            </div>

            <div class="col-sm-12 col-md-6">
                <utils:syntaxhilight />
                @declare(syntax=off)<pre class="language-markup"><code>&lt;form:tinymce
    name="date"
    label="Custom Options"
    value=""
&gt;
&lt;script  role="sf-options" type="application/json" &gt;
    {
        "options": {
            "menubar": false,
            "height": 300
        }
    }
&lt;script/&gt;
&lt;form:tinymce/&gt;</code></pre>@declare(syntax=on)
                <p><code>options</code> are passed to TinyMCE init action. <a href="https://www.tiny.cloud/docs/configure/">See all options here</a></p>
</div>

        </form:wrapper>
    </ui:panel>
</define:content>
