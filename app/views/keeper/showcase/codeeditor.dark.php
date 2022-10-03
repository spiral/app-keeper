<extends:keeper:layout.page title="Showcase: Code Editor"/>
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
    <ui:panel header="Code Editor">
        <form:wrapper action="/" method="PUT">
            <div class="col-sm-12">
                <h3>Pre-requisites</h3>
                <p>Code Editor uses codemirror 5.* and expects it to be in globals. There are 2 options to do that:</p>
                <p>1. Use <code>cdn=true</code> attribute for <code>form:codeeditor</code> tag. That will add default theme and core CodeMirror module</p>
                <p>2. Add <a href="https://cdnjs.com/libraries/codemirror/5.65.9">CDN</a> for modules and themes and CodeMirror core manually, i.e. for `javascript` and `json` support with `idea` theme:</p>
                <div>
                <utils:syntaxhilight />
                @declare(syntax=off)<pre class="language-markup"><code>
&lt;script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.9/codemirror.min.js" integrity="sha512-Kpi2Sp2KpXM2S7aM0p+CwWhm8NuogI15GFPXCmgqAnFr5c86VBXuLEZu0IGBwGSdhhTW6148hP9KTcRMmrjuFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"&gt;&lt;/script&gt;
&lt;link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.9/codemirror.min.css" integrity="sha512-uf06llspW44/LZpHzHT6qBOIVODjWtv4MxCricRxkzvopAlSWnTf6hpZTFxuuZcuNE9CBQhqE0Seu1CoRk84nQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /&gt;
&lt;link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.9/theme/idea.min.css" integrity="sha512-N+NJU9LvDmlEQyb3xDkcXPOR8SDXQGx4kRs9wCi/U6GPfN/FSsfjIzY61Svd8eg4Y1VcbBL1XhuC3VzzQYmcJg==" crossorigin="anonymous" referrerpolicy="no-referrer" /&gt;
&lt;script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.9/mode/javascript/javascript.js" integrity="sha512-9bZKsY+97AQthWWS54sUIWxo0GkS0yPvSXStcMshHDVj9lCfLgzhSTr9xa+Ho0WKkRTKMm2yy8M+EG10n9u0iQ==" crossorigin="anonymous" referrerpolicy="no-referrer"&gt;&lt;/script&gt;
</code></pre>@declare(syntax=on)</div>

                <p>&nbsp;</p>
                <p>Use <a href="https://codemirror.net/5/doc/manual.html">custom options</a> for fine tuning from official documentation</p>

                <p>&nbsp;</p>
            </div>

            <div class="col-sm-12">
                <hr/>
                <h3>Default JSON editor</h3>
            </div>
            <div class="with-form-control col-sm-12 col-md-6">
                <form:codeeditor
                    cdn="true"
                    name="date"
                    label="Default Editor"
                    value='{"foo": 1, "bar": "string", "boolean": true}'
                />

                <p>Default editor uses default theme and has support for JSON and JavaScript</p>
            </div>

            <div class="col-sm-12 col-md-6">
                <utils:syntaxhilight />
                @declare(syntax=off)<pre class="language-markup"><code>&lt;form:codeeditor
                        cdn="true"
                        name="date"
                        label="Default Editor"
                        value='{"foo": 1, "bar": "string", "boolean": true}'
                        /&gt;</code></pre>@declare(syntax=on)</div>


            <div class="col-sm-12">
                <hr/>
                <h3>Theme support</h3>
            </div>
            <div class="with-form-control col-sm-12 col-md-6">

                <stack:push name="styles" unique-id="codemirror-darcula">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.9/theme/darcula.min.css" integrity="sha512-kqCOYFDdyQF4JM8RddA6rMBi9oaLdR0aEACdB95Xl1EgaBhaXMIe8T4uxmPitfq4qRmHqo+nBU2d1l+M4zUx1g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                </stack:push>
                 <form:codeeditor
                    cdn="true"
                    name="date"
                    label="Theme Support"
                    value='{"foo": 1, "bar": "string", "boolean": true}'
                >
                    <script role="sf-options" type="application/json">
                        {
                            "options": {
                                "theme": "darcula",
                                "mode": "application/json",
                                "lineNumbers": true
                            }
                        }
                    </script>
                </form:codeeditor>

                Supports CodeMirror 5 <a href="https://codemirror.net/5/demo/theme.html#darcula">themes</a>
            </div>

            <div class="col-sm-12 col-md-6">
                <utils:syntaxhilight />
                @declare(syntax=off)<pre class="language-markup"><code>&lt;form:codeeditor
                            cdn="true"
                            name="date"
                            label="Theme Support"
                            value='{"foo": 1, "bar": "string", "boolean": true}'
                        &gt;
                    &lt;script role="sf-options" type="application/json"&gt;
                        {
                            "options": {
                                "theme": "darcula",
                                "mode": "application/json",
                                "lineNumbers": true
                            }
                        }
                    &lt;/script&gt;
                &lt;/form:codeeditor&gt;</code></pre>@declare(syntax=on)</div>
            <div class="col-sm-12">
                <hr/>
                <h3>Languages support</h3>
            </div>
            <div class="with-form-control col-sm-12 col-md-6">
                 <form:codeeditor
                    cdn="true"
                    name="date"
                    label="Language Support"
                    value='const json = {"foo": 1, "bar": "string", "boolean": true};'
                >
                    <script role="sf-options" type="application/json">
                        {
                            "options": {
                                "mode": "javascript",
                                "lineNumbers": true
                            }
                        }
                    </script>
                </form:codeeditor>

                <p>Supports CodeMirror 5 <a href="https://codemirror.net/5/doc/manual.html#config">modes</a>.</p>
                <p>To add mode, ensure to include corresponding module script from <a href="https://cdnjs.com/libraries/codemirror/5.65.9">CDN</a> as well.</p>
                <p>With `cdn="true"` JSON and javascript support are included by default.</p>
            </div>




            <div class="col-sm-12 col-md-6">
                <utils:syntaxhilight />
                @declare(syntax=off)<pre class="language-markup"><code>&lt;form:codeeditor
                            cdn="true"
                            name="date"
                            label="Language Support"
                            value='const json = {"foo": 1, "bar": "string", "boolean": true};'
                        &gt;
                    &lt;script role="sf-options" type="application/json"&gt;
                        {
                            "options": {
                                "mode": "javascript",
                                "lineNumbers": true
                            }
                        }
                    &lt;/script&gt;
                &lt;/form:codeeditor&gt;</code></pre>@declare(syntax=on)

</div>

        </form:wrapper>
    </ui:panel>
</define:content>
