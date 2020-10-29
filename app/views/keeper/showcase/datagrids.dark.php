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
        </ui:col.12>
        <ui:col.6>
            <ui:panel header="Source">
                <p>Datagrids</p>
            </ui:panel>
        </ui:col.6>
        <ui:col.6>
            <ui:panel header="Source">
                <pre><code class="language-markup">

                </code></pre>
            </ui:panel>
        </ui:col.6>
    </ui:row>
</define:content>
