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
        <ui:col.3>
            3
        </ui:col.3>
        <ui:col.9>
            9
        </ui:col.9>
    </ui:row>
</define:content>
