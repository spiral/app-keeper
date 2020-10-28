<extends:keeper:layout.page title="Showcase: Autcomplete"/>
<use:bundle path="keeper:bundle"/>
<use:element path="utils/syntaxhilight" as="utils:syntaxhilight"/>

<ui:action>
    <action:button icon="arrow-left" kind="light" href="@action('dashboard.index')" label="Back to Dashboard"/>
</ui:action>

<ui:action>
    <action:button icon="file" kind="primary" href="https://github.com/spiral/app-keeper/blob/master/app/views/showcase/intro.dark.php"
                   target="_blank" label="Source Code"/>
</ui:action>

<define:content>

            <ui:panel header="Autocomplete">
                <form:wrapper action="/" method="PUT">
                    <div class="col-sm-12">
                        <h3>Autocomplete With Predefined Values</h3>
                        <p>Specifies array of items that will be used directly</p>
                    </div>
                    <div class="with-form-control col-sm-12 col-md-6">
                        <form:autocomplete
                            name="userId1"
                            label="User Name"
                            value=""
                        >
                            <script role="sf-options" type="application/json">
                                {
                                    "data": [
                                        { "id": "1", "name": "John Griffin" },
                                        { "id": "2", "name": "Adam Smith" },
                                        { "id": "3", "name": "New York" }
                                    ]
                                }
                            </script>
                        </form:autocomplete>
                        <p><code>data</code> option should contain array of <code>{id, name}</code> pairs used for suggestions</p>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <utils:syntaxhilight />
                        @declare(syntax=off)<pre class="language-markup"><code>&lt;form:autocomplete
    name="userId1"
    label="User Name"
    value=""
&gt;
    &lt;script role="sf-options" type="application/json"&gt;
        {
            "data": [
                { "id": "1", "name": "John Griffin" },
                { "id": "2", "name": "Adam Smith" },
                { "id": "3", "name": "New York" }
            ]
        }
    &lt;/script&gt;
&lt;/form:autocomplete></code></pre>@declare(syntax=on)
                    </div>


                    <div class="col-sm-12">
                        <hr/>
                        <h3>Simple Autocomplete</h3>
                        <p>Server side fetching</p>
                    </div>
                    <div class="with-form-control col-sm-12 col-md-6">
                        <form:autocomplete
                            name="userId2"
                            label="Simple Autocomplete"
                            value="1"
                        >
                            <script role="sf-options" type="application/json">
                                {
                                    "url": "/keeper/users/list",
                                    "searchKey": "firstName",
                                    "valueKey": "id"
                                }
                            </script>
                        </form:autocomplete>

                        <p>Use optional param <code>valueKey</code> for field with id (default <code>id</code>).<br/>
                            Use optional param <code>searchKey</code> for field with label to show (default <code>name</code>)</p>

                        <p>Specifying <code>value</code> attribute will trigger server request with <code>filter[valueKey]=value</code> parameters to <code>url</code> to fetch labels</p>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <utils:syntaxhilight />
                        @declare(syntax=off)<pre class="language-markup"><code>&lt;form:autocomplete
    name="userId2"
    label="Simple Autocomplete"
    value="1"
&gt;
    &lt;script role="sf-options" type="application/json"&gt;
        {
            "url": "/keeper/users/list",
            "searchKey": "firstName",
            "valueKey": "id"
        }
    &lt;/script&gt;
&lt;/form:autocomplete></code></pre>@declare(syntax=on)
                    </div>


                    <div class="col-sm-12">
                        <hr/>
                        <h3>Custom Templates</h3>
                        <p>Uses custom templates for elements</p>
                    </div>
                    <div class="with-form-control col-sm-12 col-md-6">
                        <form:autocomplete
                            name="userId3"
                            label="Autocomplete From Server Url"
                            value=""
                        >
                            @declare(syntax=off)
                            <script role="sf-options" type="application/json">
                                {
                                    "url": "/keeper/users/list",
                                    "inputTemplate": "{{firstName}} {{lastName}}",
                                    "suggestTemplate": "<span class='badge badge-primary'>{{roles}}</span> {{firstName}} {{lastName}}",
                                    "loadingTemplate": "Wait please...",
                                    "valueKey": "id"
                                }
                            </script>
                            @declare(syntax=on)
                        </form:autocomplete>
                        <p>Use <code>inputTemplate</code> <a href="https://handlebarsjs.com/">handlebars</a> template to customize what will display in input.<br/>
                            Use <code>suggestTemplate</code> <a href="https://handlebarsjs.com/">handlebars</a> template to customize render of suggestions<br/>
                            Use <code>loadingTemplate</code> <a href="https://handlebarsjs.com/">handlebars</a> template to customize render of loading message
                        </p>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <utils:syntaxhilight />
                        @declare(syntax=off)<pre class="language-markup"><code>&lt;form:autocomplete
    name="userId3"
    label="Autocomplete From Server Url"
    value=""
&gt;
    &#64;declare(syntax=off)
    &lt;script role="sf-options" type="application/json"&gt;
        {
            "url": "/keeper/users/list",
            "inputTemplate": "{{firstName}} {{lastName}}",
            "suggestTemplate": "<span class='badge badge-primary'>{{roles}}</span> {{firstName}} {{lastName}}",
            "loadingTemplate": "Wait please...",
            "valueKey": "id"
        }
    &lt;/script&gt;
    &#64;declare(syntax=on)
&lt;/form:autocomplete></code></pre>@declare(syntax=on)
                    </div>

                    <div class="col-sm-12">
                        <hr/>
                        <h3>Including Label</h3>
                        <p>Includes label in sent data as separate field and sets label value beforehand</p>
                    </div>
                    <div class="with-form-control col-sm-12 col-md-6">
                        <form:autocomplete
                            name="date"
                            label="Autocomplete That Exposes Label"
                            description="This autocomplete has input text being sent to server too"
                            value="1"
                            labelValue="Admin"
                            size="6"
                        >
                            @declare(syntax=off)
                            <script role="sf-options" type="application/json">
                                {
                                    "url": "/keeper/users/list",
                                    "exposeLabelAs": "valueLabel",
                                    "exposeLabelAsRequired": true,
                                    "searchKey": "firstName",
                                    "valueKey": "id"
                                }
                            </script>
                            @declare(syntax=on)
                        </form:autocomplete>
                        <p><code>exposeLabelAs</code> exposes text value of autocomplete as individual field that also will be sent to server<br/>
                            Setting <code>labelValue</code> assumes <code>value</code> is pre-resolved from server and wont be fetched<br/>
                            If <code>labelValue</code> is not set, non-empty <code>value</code> will trigger server request to get value label<br/>
                        </p>
                    </div>

                    <div class="form-group col-sm-12 col-md-6">
                        <utils:syntaxhilight />
                        @declare(syntax=off)<pre class="language-markup"><code>&lt;form:autocomplete
    name="date"
    label="Native Date Picker"
    value=""
    size="12"
/&gt;</code></pre>@declare(syntax=on)

                    </div>

                    <div class="col-sm-12">
                        <hr/>
                        <h3>Multi-select Autocomplete</h3>
                        <p>Allow selecting multiple values</p>
                    </div>
                    <div class="with-form-control col-sm-12 col-md-6">
                        <form:autocomplete
                            name="date"
                            label="Multi-select Autocomplete"
                            value="1,2"
                            size="6"
                        >
                            @declare(syntax=off)
                            <script role="sf-options" type="application/json">
                                {
                                    "url": "/keeper/users/list",
                                    "isMultiple": true,
                                    "inputTemplate": "{{firstName}} {{lastName}}",
                                    "suggestTemplate": "{{firstName}} {{lastName}}",
                                    "valueKey": "id"
                                }
                            </script>
                            @declare(syntax=on)
                        </form:autocomplete>
                    </div>

                    <div class="form-group col-sm-12 col-md-6">
                        <utils:syntaxhilight />
                        @declare(syntax=off)<pre class="language-markup"><code>&lt;form:autocomplete
    name="date"
    label="Native Date Picker"
    value=""
    size="12"
/&gt;</code></pre>@declare(syntax=on)

                    </div>

                </form:wrapper>
            </ui:panel>
</define:content>
