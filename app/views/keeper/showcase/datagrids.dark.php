<extends:keeper:layout.page title="Showcase: Datagrids"/>
<use:bundle path="keeper:bundle"/>

<ui:action>
    <action:button icon="arrow-left" kind="light" href="@action('dashboard.index')" label="Back to Dashboard"/>
</ui:action>

<ui:action>
    <action:button icon="file" kind="primary" href="https://github.com/spiral/app-keeper/blob/master/app/views/showcase/datagrids.dark.php"
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
            <ui:grid url="@action('users.list', inject('params', []))">
                <grid:filter search="true" immediate="300"/>
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
        <ui:col.6>
            <ui:panel header="Source">
                <pre><code class="language-markup">

                </code></pre>
            </ui:panel>
        </ui:col.6>
    </ui:row>
</define:content>
