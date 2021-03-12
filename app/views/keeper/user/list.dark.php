<extends:keeper:layout.page title="Users"/>
<use:bundle path="keeper:bundle"/>

<ui:action>
  @auth('users.create')
    <action:button href="@action('users.new')" label="Create User" icon="plus" kind="primary"/>
  @endauth
</ui:action>

<block:content>
  <ui:grid url="@action('users.list', inject('params', []))">
    <grid:filter search="true" immediate="300"/>

    <grid:cell.text name="id" label="ID"/>
    <grid:cell.link name="name" label="Name" url="@action('users.edit', ['user' => '{id}'])" sort="true">
      {firstName}&nbsp;{lastName}
    </grid:cell.link>
    <grid:cell.link name="email" label="Email" href="mailto:{email}" body="{email}" sort="true"/>
    <grid:cell.date name="created" label="Created At" sort="true" sort-dir="desc" sort-default="true"/>
    <grid:cell.render name="roles" label="Roles" renderer="roles"/>

    <grid:action.link label="Edit" icon="edit" url="@action('users.edit', ['user'=>'{id}'])"/>
    <grid:action.delete url="@action('users.edit', ['user'=>'{id}'])"/>

  </ui:grid>
</block:content>

<stack:push name="datagridrenderers" unique-id="datagrid-roles-renderer">
    <script type="text/javascript" role="sf-datagrid-renderer">
        window.SFToolkit_tools_datagrid = window.SFToolkit_tools_datagrid || {}; window.SFToolkit_tools_datagrid['roles'] = function () {
            return function (roles) {
                return roles.map(function (role) {
                    return '<span class="badge badge-primary mr-1">' + role.toUpperCase() + '</span>'
                }).join('');
            }
        };
    </script>
</stack:push>
