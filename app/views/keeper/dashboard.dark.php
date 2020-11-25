<extends:keeper:layout.page title="Dashboard"/>
<use:bundle path="keeper:bundle"/>

<define:content>
  <ui:row>
    <ui:col.3>
      @inject($users, App\Repository\UserRepository::class)
      <ui:value-card
        kind="primary"
        href="@action('users.index')"
        value="{{ count($users->select()) }}"
        label="users"
        icon="users"/>
    </ui:col.3>
    <ui:col.9>
      <ui:panel header="Welcome to Keeper">
        <p>Welcome to Keeper panel.</p>
        <p>Check the elements showcase <a href="@action('showcase.index')">here</a>.</p>
      </ui:panel>
    </ui:col.9>
  </ui:row>
</define:content>
