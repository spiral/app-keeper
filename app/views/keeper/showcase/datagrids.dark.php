<extends:keeper:layout.page title="Showcase: Datagrids"/>
<use:bundle path="keeper:bundle"/>
<use:element path="utils/syntaxhilight" as="utils:syntaxhilight"/>

<ui:action>
    <action:button icon="arrow-left" kind="light" href="@action('dashboard.index')" label="Back to Dashboard"/>
</ui:action>

<ui:action>
    <action:button icon="file" kind="primary" href="https://github.com/spiral/app-keeper/blob/master/app/views/keeper/showcase/datagrids.dark.php"
                   target="_blank" label="Source Code"/>
</ui:action>

<define:content>
    <ui:row>
        <ui:col.12>
            <stack:push name="scripts" unique-id="datagrid-roles-renderer">
                <script type="text/javascript">
                    SFToolkit.tools._datagrid.register('roles', function () {
                        return function (roles) {
                            return roles.map(function (role) {
                                return '<span class="badge badge-primary mr-1">' + role.toUpperCase() + '</span>'
                            }).join('');
                        }
                    });
                </script>
            </stack:push>
            <ui:grid url="@action('users.list', inject('params', []))" namespace="main">
                <grid:filter search="true" immediate="300" buttons="true">
                    <form:input name="firstName" label="First Name" value="" size="6" required="true"/>
                    <form:input name="lastName" label="Last Name" value="" size="6" required="true"/>
                    <form:input name="email" label="Email" value="" required="true"/>
                </grid:filter>
                <grid:cell.link name="name" label="Name" url="@action('users.edit', ['user' => '{id}'])" sort="true">
                    {firstName}&nbsp;{lastName}
                </grid:cell.link>
                <grid:cell.link name="email" label="Email" href="mailto:{email}" body="{email}" sort="true"/>
                <grid:cell.date name="created" label="Created At" sort="true" sort-dir="desc" sort-default="true"/>
                <grid:cell.render name="roles" label="Roles" renderer="roles"/>
                <grid:cell.template name="id" label="ID" template="{id}"/>
                <grid:action.link label="Edit" icon="edit" url="@action('users.edit', ['user'=>'{id}'])"/>
                <grid:action.delete url="@action('users.edit', ['user'=>'{id}'])"/>

            </ui:grid>
        </ui:col.12>
        <ui:col.12>
            <ui:panel header="Wrapper">
                <p>Datagrids are implemented in JavaScript and can be initialized directly with JS. <a href="https://github.com/spiral/toolkit/tree/master/packages/datagrid/src">See source codes here</a></p>
                <p>Keeper library has predefined set of stempler tags to make integration easier</p>
                <p>Start with <code>ui:grid</code> element to create a grid</p>
                <utils:syntaxhilight />
                <pre><code class="language-markup">
                    &lt;ui:grid
                        url="/some/url"
                        method="/some/url"
                        id="my-grid"
                        namespace="foo"
                        capture-forms="['form1','form2']"
                        capture-filters="['filter1','filter2']"
                        paginate-options="[10,20,30]"

                        actions-title=""
                        actions-label="Actions"
                        actions-kind=""
                        actions-icon="cog"
                        actions-size="sm"
                        actions-class=""
                        actions-cell-class=""
                    &gt;
                        ....
                    &lt;/ui:grid&gt;
                </code></pre>
                <p><code>url</code> is mandatory and should contain url that implements DataGrid API</p>
                <p><code>method</code> optional, default is <code>GET</code>. Http method to use, GET or POST</p>
                <p><code>id</code> optional, default is generated. Id of datagrid to use.</p>
                <p><code>namespace</code> optional, default is empty. Prefix for field names that is used in datagrid filters serialization. Used when multiple datagrids present on page. I.e. if <code>namespace="foo"</code> filter value <code>bar=1</code> will end up as "foo-bar=1" in URL. It's developer responsibility to use namespaces if multiple datagrids present on page. Otherwise behavior is unpredictable.</p>
                <p><code>capture-forms</code> optional, default is empty. Attaches forms to datagrid as filter data source. Can be used for filters that are visually separated from datagrids.</p>
                <p><code>capture-filters</code> optional, default is empty. Attaches instances of <a href="https://github.com/spiral/toolkit/tree/master/packages/datagrid/src/filter-toggle">filter toggle buttons.</a></p>
                <p><code>actions-*</code> are optional fields to set properties of 'Actions' column that is generated automatically with <code>grid:actions.*</code> tags</p>
            </ui:panel>
        </ui:col.12>
        <ui:col.12>
            <stack:push name="scripts" unique-id="datagrid-bulkdelete">
                <script type="text/javascript">
                    window['datagrid-bulkdelete'] = function (state, grid, actionBar, event) {
                        SFKeeper.confirmModal("Delete users", "Do you wish to delete " + state.selectedCount + " users?").then(
                            function () {
                                SFToolkit.ajax.send({url: '/fake-delete', data: {ids: state.selectedIds}}).then(() => {
                                    grid.reload();
                                    const event = new CustomEvent('sf:notification-show', {
                                        bubbles: true,
                                        detail: {
                                            message: `Succesfully deleted users`,
                                            type: 'primary',
                                            position: 'tr',
                                            timeout: 2000,
                                        },
                                    });
                                    document.dispatchEvent(event);
                                }).catch(() => {
                                    grid.reload();
                                    const event = new CustomEvent('sf:notification-show', {
                                        bubbles: true,
                                        detail: {
                                            message: `Failed to delete users`,
                                            type: 'danger',
                                            position: 'tr',
                                            timeout: 2000,
                                        },
                                    });
                                    document.dispatchEvent(event);
                                });
                            }
                        )
                    }
                </script>
            </stack:push>
            <ui:grid url="@action('users.list', inject('params', []))" namespace="main" selectable="id">
                <grid:filter search="true" immediate="300" buttons="true">
                    <form:input name="firstName" label="First Name" value="" size="6" required="true"/>
                    <form:input name="lastName" label="Last Name" value="" size="6" required="true"/>
                    <form:input name="email" label="Email" value="" required="true"/>
                </grid:filter>
                <grid:cell.link name="name" label="Name" url="@action('users.edit', ['user' => '{id}'])" sort="true">
                    {firstName}&nbsp;{lastName}
                </grid:cell.link>
                <grid:cell.link name="email" label="Email" href="mailto:{email}" body="{email}" sort="true"/>
                <grid:cell.date name="created" label="Created At" sort="true" sort-dir="desc" sort-default="true"/>
                <grid:cell.render name="roles" label="Roles" renderer="roles"/>
                <grid:cell.template name="id" label="ID" template="{id}"/>
                <grid:action.link label="Edit" icon="edit" url="@action('users.edit', ['user'=>'{id}'])"/>
                <grid:action.delete url="@action('users.edit', ['user'=>'{id}'])"/>
                <grid:bulkaction id="delete" class="custom-class" onclick="datagrid-bulkdelete" action="datagrid-bulkdelete">
                    <div class="btn btn-danger">Delete</div>
                </grid:bulkaction>
            </ui:grid>
        </ui:col.12>
        <ui:col.12>

            <utils:syntaxhilight />
            <pre><code class="language-markup">

            &lt;stack:push name="scripts" unique-id="datagrid-bulkdelete"&gt;
                &lt;script type="text/javascript"&gt;
                    window['datagrid-bulkdelete'] = function (state, grid, actionBar, event) {
                        SFKeeper.confirmModal("Delete users", "Do you wish to delete " + state.selectedCount + " users?").then(
                            function () {
                                SFToolkit.ajax.send({url: '/fake-delete', data: {ids: state.selectedIds}}).then(() =&gt; {
                                    grid.reload();
                                    const event = new CustomEvent('sf:notification-show', {
                                        bubbles: true,
                                        detail: {
                                            message: `Succesfully deleted users`,
                                            type: 'primary',
                                            position: 'tr',
                                            timeout: 2000,
                                        },
                                    });
                                    document.dispatchEvent(event);
                                }).catch(() =&gt; {
                                    grid.reload();
                                    const event = new CustomEvent('sf:notification-show', {
                                        bubbles: true,
                                        detail: {
                                            message: `Failed to delete users`,
                                            type: 'danger',
                                            position: 'tr',
                                            timeout: 2000,
                                        },
                                    });
                                    document.dispatchEvent(event);
                                });
                            }
                        )
                    }
                &lt;/script&gt;
            &lt;/stack:push&gt;
            &lt;ui:grid url="action url here" namespace="main" selectable="id"&gt;
                &lt;grid:filter search="true" immediate="300" buttons="true"&gt;
                    &lt;form:input name="firstName" label="First Name" value="" size="6" required="true"/&gt;
                    &lt;form:input name="lastName" label="Last Name" value="" size="6" required="true"/&gt;
                    &lt;form:input name="email" label="Email" value="" required="true"/&gt;
                &lt;/grid:filter&gt;
                &lt;grid:cell.link name="name" label="Name" url="action url here" sort="true"&gt;
                    {firstName}&nbsp;{lastName}
                &lt;/grid:cell.link&gt;
                &lt;grid:cell.link name="email" label="Email" href="mailto:{email}" body="{email}" sort="true"/&gt;
                &lt;grid:cell.date name="created" label="Created At" sort="true" sort-dir="desc" sort-default="true"/&gt;
                &lt;grid:cell.render name="roles" label="Roles" renderer="roles"/&gt;
                &lt;grid:cell.template name="id" label="ID" template="{id}"/&gt;
                &lt;grid:action.link label="Edit" icon="edit" url="action url here"/&gt;
                &lt;grid:action.delete url="action url here"/&gt;
                &lt;grid:bulkaction id="delete" class="custom-class" onclick="datagrid-bulkdelete" action="datagrid-bulkdelete"&gt;
                    &lt;div class="btn btn-danger"&gt;Delete&lt;/div&gt;
                &lt;/grid:bulkaction&gt;
            &lt;/ui:grid&gt;
                </code></pre>
        </ui:col.12>
        <ui:col.12>
            <ui:panel header="Cell Types">
                <h4>Text</h4>
                <utils:syntaxhilight />
                <pre><code class="language-markup">
                    &lt;grid:cell.text
                        name="user"
                        label="User Name"
                    /&gt;
                </code></pre>
                <p><code>name</code> is mandatory and should contain semantic column name. That name is used as sort key and typically matches field from server data. By specifying custom template developer can output any other field with instead or use a custom renderer.</p>
                <p><code>label</code> is a mandatory column label</p>
                <p><code>sort</code> optional, default is empty. Enables sorting for column</p>
                <p><code>sort-dir</code> optional, default is 'asc'. Specifies default sort direction. Typically all dates need 'desc', rest needs 'asc'</p>
                <p><code>sort-default</code> optional, default is empty. Supply "true" to make this column sorted by default.</p>

                <hr/>
                <h4>Link</h4>
                <utils:syntaxhilight />
                <pre><code class="language-markup">
                    &lt;grid:cell.link
                        name="user"
                        title="Edit user {firstName}"
                        body="{fistName}"
                        href="/edit/{id}"
                    /&gt;
                </code></pre>
                <p><code>name</code> is mandatory and should contain semantic column name. That name is used as sort key and typically matches field from server data. By specifying custom template developer can output any other field with instead or use a custom renderer.</p>
                <p><code>title</code> handlebars template for title link attribute</p>
                <p><code>body</code> handlebars template for link body text</p>
                <p><code>href</code> handlebars template for URL</p>
                <p><code>sort</code> optional, default is empty. Enables sorting for column</p>
                <p><code>sort-dir</code> optional, default is 'asc'. Specifies default sort direction. Typically all dates need 'desc', rest needs 'asc'</p>
                <p><code>sort-default</code> optional, default is empty. Supply "true" to make this column sorted by default.</p>

                <hr/>
                <h4>Date</h4>
                <utils:syntaxhilight />
                <pre><code class="language-markup">
                    &lt;grid:cell.date
                        name="created"
                        label="Created At"
                        format="LLL dd, yyyy HH:mm"
                        sort="true"
                        sort-dir="desc"
                        sort-default="true"
                    /&gt;
                </code></pre>
                <p><code>format</code> optional, default <code>LLL dd, yyyy HH:mm</code>. Output date format.</p>
                <p><code>name</code> is mandatory and should contain semantic column name. That name is used as sort key and typically matches field from server data. By specifying custom template developer can output any other field with instead or use a custom renderer.</p>
                <p><code>label</code> is a mandatory column label</p>
                <p><code>sort</code> optional, default is empty. Enables sorting for column</p>
                <p><code>sort-dir</code> optional, default is 'asc'. Specifies default sort direction. Typically all dates need 'desc', rest needs 'asc'</p>
                <p><code>sort-default</code> optional, default is empty. Supply "true" to make this column sorted by default.</p>

                <hr/>
                <h4>Custom Template</h4>
                <utils:syntaxhilight />
                <pre><code class="language-markup">
                    &lt;grid:cell.template
                        name="user"
                        label="User Name"
                        template="{firstName} {lastName}"
                    /&gt;
                </code></pre>
                <p><code>name</code> is mandatory and should contain semantic column name. That name is used as sort key and typically matches field from server data. By specifying custom template developer can output any other field with instead or use a custom renderer.</p>
                <p><code>label</code> is a mandatory column label</p>
                <p><code>template</code> optional, default is empty. Customs handlebars template.</p>
                <p><code>sort</code> optional, default is empty. Enables sorting for column</p>
                <p><code>sort-dir</code> optional, default is 'asc'. Specifies default sort direction. Typically all dates need 'desc', rest needs 'asc'</p>
                <p><code>sort-default</code> optional, default is empty. Supply "true" to make this column sorted by default.</p>

                <hr/>
                <h4>Custom Render Function</h4>
                <utils:syntaxhilight />
                <pre><code class="language-markup">
                    &lt;grid:cell.render
                        name="roles"
                        label="Roles"
                        renderer="roles"
                    /&gt;
                </code></pre>
                <p><code>name</code> is mandatory and should contain semantic column name. That name is used as sort key and typically matches field from server data. By specifying custom template developer can output any other field with instead or use a custom renderer.</p>
                <p><code>label</code> is a mandatory column label</p>
                <p><code>sort</code> optional, default is empty. Enables sorting for column</p>
                <p><code>sort-dir</code> optional, default is 'asc'. Specifies default sort direction. Typically all dates need 'desc', rest needs 'asc'</p>
                <p><code>sort-default</code> optional, default is empty. Supply "true" to make this column sorted by default.</p>
                <p><code>renderer</code> optional, default is empty. Specifies renderer name. Renderer should be declared beforehand like so. See all parameters being passed to renderer in datagrids source code.</p>
                <utils:syntaxhilight />
                <pre><code class="language-markup">
                    &lt;stack:push name="scripts" unique-id="datagrid-roles-renderer"&gt;
                        &lt;script type="text/javascript"&gt;
                            SFToolkit.tools._datagrid.register('roles', function () {
                                return function (roles) {
                                    return roles.map(function (role) {
                                        return '&lt;span class="badge badge-primary mr-1"&gt;' + role.toUpperCase() + '&lt;/span&gt;'
                                    }).join('');
                                }
                            });
                        &lt;/script&gt;
                    &lt;/stack:push&gt;
                </code></pre>
            </ui:panel>
        </ui:col.12>
        <ui:col.12>
            <ui:panel header="Actions">
                <p>Separate kind of tags provided are action tags. Using any of them adds 'actions' column with button with actions dropdown. Each actions tag appends an action to that dropdown</p>
                <h4>Link</h4>
                <utils:syntaxhilight />
                <pre><code class="language-markup">
                    &lt;grid:action.link
                        href="edit/{id}"
                        template="{id}"
                        label="Edit"
                        title="Edit {firstName}"
                        icon="edit"
                        target="_blank"
                    /&gt;
                </code></pre>
                <p><code>href</code> is handlebars template to format link url</p>
                <p><code>template</code> is handlebars template to format link body. Specify either template or label + icon</p>
                <p><code>label</code> is handlebars template to format link label. When body is not specified, body is generated as icon from icon property plus label from label property</p>
                <p><code>icon</code> is handlebars template to format link icon. When body is not specified, body is generated as icon from icon property plus label from label property</p>
                <p><code>title</code> is handlebars template to format link title attribute</p>
                <p><code>target</code> is handlebars template to format link target attribute</p>

                <hr/>
                <h4>Action</h4>
                <utils:syntaxhilight />
                <pre><code class="language-markup">
                    &lt;grid:action.action
                        href="edit/{id}"
                        template="{id}"
                        label="Edit"
                        title="Edit {firstName}"
                        icon="edit"
                        method="POST"
                        data="{ foo: 1}"
                        refresh="true"
                        confirm="true"
                        confirm-title="true"
                        confirm-ok="true"
                        confirm-cancel="true"
                    /&gt;
                </code></pre>
                <p><code>href</code> is handlebars template to format action request url</p>
                <p><code>method</code> method to use when performing action</p>
                <p><code>template</code> is handlebars template to format link body. Specify either template or label + icon</p>
                <p><code>label</code> is handlebars template to format link label. When body is not specified, body is generated as icon from icon property plus label from label property</p>
                <p><code>icon</code> is handlebars template to format link icon. When body is not specified, body is generated as icon from icon property plus label from label property</p>
                <p><code>title</code> is handlebars template to format link title attribute</p>
                <p><code>data</code> JSON parsable string of data that will be used as POST body performing an action</p>
                <p><code>refresh</code> Refresh datagrid if action results in success. Useful for delete actions.</p>
                <p><code>condition</code> Field name that contains boolean variable indicating if that action should be shown. Alternatively can be a handlebars template that should return '' for false value or anything else for positive value.</p>
                <p><code>toastError</code> Template for toast message to show on action error</p>
                <p><code>toastSuccess</code> Template for toast message to show on action success</p>
                <p><code>confirm</code> If specified, specify confirm-title, confirm-ok and confirm-cancel. Will show a confirm dialog before executing an action. <code>confirm</code> specifies handlebars template for confirm dialog body</p>
                <p><code>confirm-title</code> specifies handlebars template for confirm dialog title</p>
                <p><code>confirm-ok</code> specifies handlebars template for confirm dialog positive result button text</p>
                <p><code>confirm-cancel</code> specifies handlebars template for confirm dialog negative result button text</p>

                <hr/>
                <h4>Delete Action</h4>
                <pre><code class="language-markup">
                    &lt;grid:action.delete url="/user/{id}"/&gt;
                </code></pre>
                <p>Same as 'action' but with confirm texts pre-defined beforehand and having danger class. Typically only `url` is needed for that action type</p>
            </ui:panel>
        </ui:col.12>
        <ui:col.12>
            <ui:panel header="Filter">
                <h4>Search Only</h4>
                <utils:syntaxhilight />

                <pre><code class="language-markup">
                    &lt;grid:filter
                        search="true"
                        immediate="300"
                    /&gt;
                </code></pre>
                <p><code>search</code> enable search bar</p>
                <p><code>immediate</code> if specified, will remove "Search" button and will trigger search as user types. Value is input debounce in ms.</p>
                <hr/>
                <h4>Search And Filter Modal</h4>
                <p>In the body of filter tag you can add content with form inputs same way as you would do in form wrapper. If specified, will add additional "Filter" button to datagrid that will toggle a modal with there inputs. Specify <code>buttons="true"</code> to append predefined Clear/Apply buttons or render your own ones manually.</p>
                <utils:syntaxhilight />
                <pre><code class="language-markup">
                    &lt;grid:filter
                        search="true"
                        buttons="true"
                        immediate="300"
                    &gt;
                        &lt;form:input name="firstName" label="First Name" value="" size="6" required="true"/&gt;
                        &lt;form:input name="lastName" label="Last Name" value="" size="6" required="true"/&gt;
                        &lt;form:input name="email" label="Email" value="" required="true"/&gt;
                    &lt;/grid:filter&gt;
                </code></pre>
            </ui:panel>
        </ui:col.12>
        <ui:col.12>
            <ui:panel header="Advanced Usage">
                <h4>Advanced Usage Example</h4>
                <p>DataGrids support more customizable features from JavaScript API. I.e. selecting rows, global table actions, custom headers, custom row wrappers, multiple action columns, etc.</p>
                <p><a href="https://github.com/spiral/toolkit/tree/master/packages/datagrid/src">See source codes here</a> for more details.</p>
                <div class="sf-table">
                    <div class="js-sf-datagrid">
                        @declare(syntax=off)
                        <script type="text/javascript" role="sf-options">
                            (function () {
                                return {
                                    "id": "custom",
                                    "url": "/keeper/users/list",
                                    "namespace": "custom",
                                    "method": "GET",
                                    "ui": {
                                        "headerCellClassName": {"actions": "text-right"},
                                        "cellClassName": {"actions": "text-right py-2", "created": "text-nowrap"}
                                    },
                                    "paginator": {"limitOptions": [10, 20, 50, 100]},
                                    "sort": "created",
                                    "columns": [{"id": "name", "title": "Name", "sortDir": "asc"}, {"id": "actions2", "title": " "}, {
                                        "id": "email",
                                        "title": "Email",
                                        "sortDir": "asc"
                                    }, {"id": "created", "title": "Created At", "sortDir": "desc"}, {
                                        "id": "roles",
                                        "title": "Roles",
                                        "sortDir": null
                                    }, {"id": "id", "title": "ID", "sortDir": null}, {"id": "actions", "title": " "}],
                                    "selectable": {
                                        "type": "multiple",
                                        "id": "id"
                                    },
                                    "renderers": {
                                        "cells": {
                                            "name": {
                                                "name": "link",
                                                "arguments": {
                                                    "title": "",
                                                    "body": "{{firstName}}&nbsp;{{lastName}}",
                                                    "href": "\/keeper\/users\/{{id}}"
                                                }
                                            },
                                            "email": {"name": "link", "arguments": {"title": "", "body": "{{email}}", "href": "mailto:{{email}}"}},
                                            "created": {"name": "dateFormat", "arguments": ["LLL dd, yyyy HH:mm"]},
                                            "roles": {"name": "roles", "arguments": []},
                                            "id": {"name": "template", "arguments": ["{{id}}"]},
                                            "actions": {
                                                "name": "actions",
                                                "arguments": {
                                                    "kind": "",
                                                    "size": "sm",
                                                    "className": "",
                                                    "icon": "cog",
                                                    "label": "Actions",
                                                    "actions": [{
                                                        "type": "href",
                                                        "url": "\/keeper\/users\/{{id}}",
                                                        "label": "Edit",
                                                        "target": null,
                                                        "icon": "edit",
                                                        "template": ""
                                                    }, {
                                                        "type": "action",
                                                        "url": "\/keeper\/users\/{{id}}",
                                                        "method": "DELETE",
                                                        "label": "Delete",
                                                        "icon": "trash",
                                                        "template": "<span class=\"text-danger\"><i class=\"fa fw fa-trash\"><\/i>&nbsp;&nbsp; Delete<\/span>",
                                                        "condition": null,
                                                        "data": [],
                                                        "refresh": true,
                                                        "confirm": {
                                                            "body": "Are you sure to delete this entry?",
                                                            "title": "Confirmation Required",
                                                            "confirm": "Delete",
                                                            "confirmKind": "danger",
                                                            "cancel": "Cancel"
                                                        },
                                                        "toastSuccess": "<i class=\"fa fa-check-circle\"><\/i>&nbsp; {{message}}\n              ",
                                                        "toastError": "<i class=\"fa fa-exclamation\"><\/i>&nbsp; {{error}}\n              "
                                                    }]
                                                }
                                            },
                                            "actions2": {
                                                "name": "actions",
                                                "arguments": {
                                                    "kind": "",
                                                    "size": "sm",
                                                    "className": "",
                                                    "icon": "cog",
                                                    "label": "Actions 2",
                                                    "actions": [{
                                                        "type": "href",
                                                        "url": "\/keeper\/users\/{{id}}",
                                                        "label": "Edit",
                                                        "target": null,
                                                        "icon": "edit",
                                                        "template": ""
                                                    }, {
                                                        "type": "action",
                                                        "url": "\/keeper\/users\/{{id}}",
                                                        "method": "DELETE",
                                                        "label": "Delete",
                                                        "icon": "trash",
                                                        "template": "<span class=\"text-danger\"><i class=\"fa fw fa-trash\"><\/i>&nbsp;&nbsp; Delete<\/span>",
                                                        "condition": null,
                                                        "data": [],
                                                        "refresh": true,
                                                        "confirm": {
                                                            "body": "Are you sure to delete this entry?",
                                                            "title": "Confirmation Required",
                                                            "confirm": "Delete",
                                                            "confirmKind": "danger",
                                                            "cancel": "Cancel"
                                                        },
                                                        "toastSuccess": "<i class=\"fa fa-check-circle\"><\/i>&nbsp; {{message}}\n              ",
                                                        "toastError": "<i class=\"fa fa-exclamation\"><\/i>&nbsp; {{error}}\n              "
                                                    }]
                                                }
                                            }
                                        },
                                        "actions": {
                                            "delete": {
                                                renderAs: "<div class='btn btn-danger'>Delete</div>",
                                                onClick: function (state, grid) {
                                                    console.log(state, grid);
                                                }
                                            }
                                        }
                                    }
                                };
                            });
                        </script>
                        @declare(syntax=on)
                    </div>
                </div>

                <pre><code class="language-markup">
                        &lt;div class="sf-table"&gt;
                    &lt;div class="js-sf-datagrid"&gt;
                        @declare(syntax=off)
                        &lt;script type="text/javascript" role="sf-options"&gt;
                            (function () {
                                return {
                                    "id": "custom",
                                    "url": "/keeper/users/list",
                                    "namespace": "custom",
                                    "method": "GET",
                                    "ui": {
                                        "headerCellClassName": {"actions": "text-right"},
                                        "cellClassName": {"actions": "text-right py-2", "created": "text-nowrap"}
                                    },
                                    "paginator": {"limitOptions": [10, 20, 50, 100]},
                                    "sort": "created",
                                    "columns": [{"id": "name", "title": "Name", "sortDir": "asc"}, {"id": "actions2", "title": " "}, {
                                        "id": "email",
                                        "title": "Email",
                                        "sortDir": "asc"
                                    }, {"id": "created", "title": "Created At", "sortDir": "desc"}, {
                                        "id": "roles",
                                        "title": "Roles",
                                        "sortDir": null
                                    }, {"id": "id", "title": "ID", "sortDir": null}, {"id": "actions", "title": " "}],
                                    "selectable": {
                                        "type": "multiple",
                                        "id": "id"
                                    },
                                    "renderers": {
                                        "cells": {
                                            "name": {
                                                "name": "link",
                                                "arguments": {
                                                    "title": "",
                                                    "body": "{{firstName}}&nbsp;{{lastName}}",
                                                    "href": "\/keeper\/users\/{{id}}"
                                                }
                                            },
                                            "email": {"name": "link", "arguments": {"title": "", "body": "{{email}}", "href": "mailto:{{email}}"}},
                                            "created": {"name": "dateFormat", "arguments": ["LLL dd, yyyy HH:mm"]},
                                            "roles": {"name": "roles", "arguments": []},
                                            "id": {"name": "template", "arguments": ["{{id}}"]},
                                            "actions": {
                                                "name": "actions",
                                                "arguments": {
                                                    "kind": "",
                                                    "size": "sm",
                                                    "className": "",
                                                    "icon": "cog",
                                                    "label": "Actions",
                                                    "actions": [{
                                                        "type": "href",
                                                        "url": "\/keeper\/users\/{{id}}",
                                                        "label": "Edit",
                                                        "target": null,
                                                        "icon": "edit",
                                                        "template": ""
                                                    }, {
                                                        "type": "action",
                                                        "url": "\/keeper\/users\/{{id}}",
                                                        "method": "DELETE",
                                                        "label": "Delete",
                                                        "icon": "trash",
                                                        "template": "&lt;span class=\"text-danger\"&gt;&lt;i class=\"fa fw fa-trash\"&gt;&lt;\/i&gt;&nbsp;&nbsp; Delete&lt;\/span&gt;",
                                                        "condition": null,
                                                        "data": [],
                                                        "refresh": true,
                                                        "confirm": {
                                                            "body": "Are you sure to delete this entry?",
                                                            "title": "Confirmation Required",
                                                            "confirm": "Delete",
                                                            "confirmKind": "danger",
                                                            "cancel": "Cancel"
                                                        },
                                                        "toastSuccess": "&lt;i class=\"fa fa-check-circle\"&gt;&lt;\/i&gt;&nbsp; {{message}}\n              ",
                                                        "toastError": "&lt;i class=\"fa fa-exclamation\"&gt;&lt;\/i&gt;&nbsp; {{error}}\n              "
                                                    }]
                                                }
                                            },
                                            "actions2": {
                                                "name": "actions",
                                                "arguments": {
                                                    "kind": "",
                                                    "size": "sm",
                                                    "className": "",
                                                    "icon": "cog",
                                                    "label": "Actions 2",
                                                    "actions": [{
                                                        "type": "href",
                                                        "url": "\/keeper\/users\/{{id}}",
                                                        "label": "Edit",
                                                        "target": null,
                                                        "icon": "edit",
                                                        "template": ""
                                                    }, {
                                                        "type": "action",
                                                        "url": "\/keeper\/users\/{{id}}",
                                                        "method": "DELETE",
                                                        "label": "Delete",
                                                        "icon": "trash",
                                                        "template": "&lt;span class=\"text-danger\"&gt;&lt;i class=\"fa fw fa-trash\"&gt;&lt;\/i&gt;&nbsp;&nbsp; Delete&lt;\/span&gt;",
                                                        "condition": null,
                                                        "data": [],
                                                        "refresh": true,
                                                        "confirm": {
                                                            "body": "Are you sure to delete this entry?",
                                                            "title": "Confirmation Required",
                                                            "confirm": "Delete",
                                                            "confirmKind": "danger",
                                                            "cancel": "Cancel"
                                                        },
                                                        "toastSuccess": "&lt;i class=\"fa fa-check-circle\"&gt;&lt;\/i&gt;&nbsp; {{message}}\n              ",
                                                        "toastError": "&lt;i class=\"fa fa-exclamation\"&gt;&lt;\/i&gt;&nbsp; {{error}}\n              "
                                                    }]
                                                }
                                            }
                                        },
                                        "actions": {
                                            "delete": {
                                                renderAs: "&lt;div class='btn btn-danger'&gt;Delete&lt;/div&gt;",
                                                onClick: function (state, grid) {
                                                    console.log(state, grid);
                                                }
                                            }
                                        }
                                    }
                                };
                            });
                        &lt;/script&gt;
                        @declare(syntax=on)
                    &lt;/div&gt;
                &lt;/div&gt;
                    </code></pre>
            </ui:panel>
        </ui:col.12>
        <ui:col.12>
            <ui:panel header="Experimental Responsive Support">
                <h4>Experimental Responsive Support</h4>
                <p>Providing <code>responsive</code> option allows enabling experimental double rendering for collapsing table in a list with expandable items</p>
                <div class="sf-table">
                    <div class="js-sf-datagrid">
                        @declare(syntax=off)
                        <script type="text/javascript" role="sf-options">
                            (function () {
                                return {
                                    "id": "custom2",
                                    "url": "/keeper/users/list",
                                    "namespace": "custom2",
                                    "method": "GET",
                                    "ui": {
                                        "headerCellClassName": {"actions": "text-right"},
                                        "cellClassName": {"actions": "text-right py-2", "created": "text-nowrap"}
                                    },
                                    "paginator": {"limitOptions": [10, 20, 50, 100]},
                                    "sort": "created",
                                    "columns": [{"id": "name", "title": "Name", "sortDir": "asc"}, {"id": "actions2", "title": " "}, {
                                        "id": "email",
                                        "title": "Email",
                                        "sortDir": "asc"
                                    }, {"id": "created", "title": "Created At", "sortDir": "desc"}, {
                                        "id": "roles",
                                        "title": "Roles",
                                        "sortDir": null
                                    }, {"id": "id", "title": "ID", "sortDir": null}, {"id": "actions", "title": " "}],
                                    "selectable": {
                                        "type": "multiple",
                                        "id": "id"
                                    },
                                    "renderers": {
                                        "cells": {
                                            "name": {
                                                "name": "link",
                                                "arguments": {
                                                    "title": "",
                                                    "body": "{{firstName}}&nbsp;{{lastName}}",
                                                    "href": "\/keeper\/users\/{{id}}"
                                                }
                                            },
                                            "email": {"name": "link", "arguments": {"title": "", "body": "{{email}}", "href": "mailto:{{email}}"}},
                                            "created": {"name": "dateFormat", "arguments": ["LLL dd, yyyy HH:mm"]},
                                            "roles": {"name": "roles", "arguments": []},
                                            "id": {"name": "template", "arguments": ["{{id}}"]},
                                            "actions": {
                                                "name": "actions",
                                                "arguments": {
                                                    "kind": "",
                                                    "size": "sm",
                                                    "className": "",
                                                    "icon": "cog",
                                                    "label": "Actions",
                                                    "actions": [{
                                                        "type": "href",
                                                        "url": "\/keeper\/users\/{{id}}",
                                                        "label": "Edit",
                                                        "target": null,
                                                        "icon": "edit",
                                                        "template": ""
                                                    }, {
                                                        "type": "action",
                                                        "url": "\/keeper\/users\/{{id}}",
                                                        "method": "DELETE",
                                                        "label": "Delete",
                                                        "icon": "trash",
                                                        "template": "<span class=\"text-danger\"><i class=\"fa fw fa-trash\"><\/i>&nbsp;&nbsp; Delete<\/span>",
                                                        "condition": null,
                                                        "data": [],
                                                        "refresh": true,
                                                        "confirm": {
                                                            "body": "Are you sure to delete this entry?",
                                                            "title": "Confirmation Required",
                                                            "confirm": "Delete",
                                                            "confirmKind": "danger",
                                                            "cancel": "Cancel"
                                                        },
                                                        "toastSuccess": "<i class=\"fa fa-check-circle\"><\/i>&nbsp; {{message}}\n              ",
                                                        "toastError": "<i class=\"fa fa-exclamation\"><\/i>&nbsp; {{error}}\n              "
                                                    }]
                                                }
                                            },
                                            "actions2": {
                                                "name": "actions",
                                                "arguments": {
                                                    "kind": "",
                                                    "size": "sm",
                                                    "className": "",
                                                    "icon": "cog",
                                                    "label": "Actions 2",
                                                    "actions": [{
                                                        "type": "href",
                                                        "url": "\/keeper\/users\/{{id}}",
                                                        "label": "Edit",
                                                        "target": null,
                                                        "icon": "edit",
                                                        "template": ""
                                                    }, {
                                                        "type": "action",
                                                        "url": "\/keeper\/users\/{{id}}",
                                                        "method": "DELETE",
                                                        "label": "Delete",
                                                        "icon": "trash",
                                                        "template": "<span class=\"text-danger\"><i class=\"fa fw fa-trash\"><\/i>&nbsp;&nbsp; Delete<\/span>",
                                                        "condition": null,
                                                        "data": [],
                                                        "refresh": true,
                                                        "confirm": {
                                                            "body": "Are you sure to delete this entry?",
                                                            "title": "Confirmation Required",
                                                            "confirm": "Delete",
                                                            "confirmKind": "danger",
                                                            "cancel": "Cancel"
                                                        },
                                                        "toastSuccess": "<i class=\"fa fa-check-circle\"><\/i>&nbsp; {{message}}\n              ",
                                                        "toastError": "<i class=\"fa fa-exclamation\"><\/i>&nbsp; {{error}}\n              "
                                                    }]
                                                }
                                            }
                                        },
                                        "actions": {
                                            "delete": {
                                                renderAs: "<div class='btn btn-danger'>Delete</div>",
                                                onClick: function (state, grid) {
                                                    console.log(state, grid);
                                                }
                                            }
                                        }
                                    },
                                    "responsive": {
                                        listSummaryColumn: "name",
                                        tableClass: "table d-none d-md-table",
                                        listClass: "d-md-block",
                                    }
                                };
                            });
                        </script>
                        @declare(syntax=on)
                    </div>
                </div>

                <pre><code class="language-markup">
                        &lt;div class="sf-table"&gt;
                    &lt;div class="js-sf-datagrid"&gt;
                        @declare(syntax=off)
                        &lt;script type="text/javascript" role="sf-options"&gt;
                            (function () {
                                return {
                                    "id": "custom",
                                    "url": "/keeper/users/list",
                                    "namespace": "custom",
                                    "method": "GET",
                                    "ui": {
                                        "headerCellClassName": {"actions": "text-right"},
                                        "cellClassName": {"actions": "text-right py-2", "created": "text-nowrap"}
                                    },
                                    "paginator": {"limitOptions": [10, 20, 50, 100]},
                                    "sort": "created",
                                    "columns": [{"id": "name", "title": "Name", "sortDir": "asc"}, {"id": "actions2", "title": " "}, {
                                        "id": "email",
                                        "title": "Email",
                                        "sortDir": "asc"
                                    }, {"id": "created", "title": "Created At", "sortDir": "desc"}, {
                                        "id": "roles",
                                        "title": "Roles",
                                        "sortDir": null
                                    }, {"id": "id", "title": "ID", "sortDir": null}, {"id": "actions", "title": " "}],
                                    "selectable": {
                                        "type": "multiple",
                                        "id": "id"
                                    },
                                    "renderers": {
                                        "cells": {
                                            "name": {
                                                "name": "link",
                                                "arguments": {
                                                    "title": "",
                                                    "body": "{{firstName}}&nbsp;{{lastName}}",
                                                    "href": "\/keeper\/users\/{{id}}"
                                                }
                                            },
                                            "email": {"name": "link", "arguments": {"title": "", "body": "{{email}}", "href": "mailto:{{email}}"}},
                                            "created": {"name": "dateFormat", "arguments": ["LLL dd, yyyy HH:mm"]},
                                            "roles": {"name": "roles", "arguments": []},
                                            "id": {"name": "template", "arguments": ["{{id}}"]},
                                            "actions": {
                                                "name": "actions",
                                                "arguments": {
                                                    "kind": "",
                                                    "size": "sm",
                                                    "className": "",
                                                    "icon": "cog",
                                                    "label": "Actions",
                                                    "actions": [{
                                                        "type": "href",
                                                        "url": "\/keeper\/users\/{{id}}",
                                                        "label": "Edit",
                                                        "target": null,
                                                        "icon": "edit",
                                                        "template": ""
                                                    }, {
                                                        "type": "action",
                                                        "url": "\/keeper\/users\/{{id}}",
                                                        "method": "DELETE",
                                                        "label": "Delete",
                                                        "icon": "trash",
                                                        "template": "&lt;span class=\"text-danger\"&gt;&lt;i class=\"fa fw fa-trash\"&gt;&lt;\/i&gt;&nbsp;&nbsp; Delete&lt;\/span&gt;",
                                                        "condition": null,
                                                        "data": [],
                                                        "refresh": true,
                                                        "confirm": {
                                                            "body": "Are you sure to delete this entry?",
                                                            "title": "Confirmation Required",
                                                            "confirm": "Delete",
                                                            "confirmKind": "danger",
                                                            "cancel": "Cancel"
                                                        },
                                                        "toastSuccess": "&lt;i class=\"fa fa-check-circle\"&gt;&lt;\/i&gt;&nbsp; {{message}}\n              ",
                                                        "toastError": "&lt;i class=\"fa fa-exclamation\"&gt;&lt;\/i&gt;&nbsp; {{error}}\n              "
                                                    }]
                                                }
                                            },
                                            "actions2": {
                                                "name": "actions",
                                                "arguments": {
                                                    "kind": "",
                                                    "size": "sm",
                                                    "className": "",
                                                    "icon": "cog",
                                                    "label": "Actions 2",
                                                    "actions": [{
                                                        "type": "href",
                                                        "url": "\/keeper\/users\/{{id}}",
                                                        "label": "Edit",
                                                        "target": null,
                                                        "icon": "edit",
                                                        "template": ""
                                                    }, {
                                                        "type": "action",
                                                        "url": "\/keeper\/users\/{{id}}",
                                                        "method": "DELETE",
                                                        "label": "Delete",
                                                        "icon": "trash",
                                                        "template": "&lt;span class=\"text-danger\"&gt;&lt;i class=\"fa fw fa-trash\"&gt;&lt;\/i&gt;&nbsp;&nbsp; Delete&lt;\/span&gt;",
                                                        "condition": null,
                                                        "data": [],
                                                        "refresh": true,
                                                        "confirm": {
                                                            "body": "Are you sure to delete this entry?",
                                                            "title": "Confirmation Required",
                                                            "confirm": "Delete",
                                                            "confirmKind": "danger",
                                                            "cancel": "Cancel"
                                                        },
                                                        "toastSuccess": "&lt;i class=\"fa fa-check-circle\"&gt;&lt;\/i&gt;&nbsp; {{message}}\n              ",
                                                        "toastError": "&lt;i class=\"fa fa-exclamation\"&gt;&lt;\/i&gt;&nbsp; {{error}}\n              "
                                                    }]
                                                }
                                            }
                                        },
                                        "actions": {
                                            "delete": {
                                                renderAs: "&lt;div class='btn btn-danger'&gt;Delete&lt;/div&gt;",
                                                onClick: function (state, grid) {
                                                    console.log(state, grid);
                                                }
                                            }
                                        }
                                    }
                                };
                            });
                        &lt;/script&gt;
                        @declare(syntax=on)
                    &lt;/div&gt;
                &lt;/div&gt;
                    </code></pre>
            </ui:panel>
        </ui:col.12>

    </ui:row>
</define:content>
