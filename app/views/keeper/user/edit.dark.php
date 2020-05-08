<extends:keeper:layout.tabs title="{{ $user->firstName . ' ' . $user->lastName }}"/>
<use:bundle path="keeper:bundle"/>

<ui:action>
  <action:button icon="arrow-left" kind="light" href="@action('users.index')">Back</action:button>

  @auth('users.delete', compact('user'))
    <action:delete url="@action('users.delete', ['user' => $user->id])"
                   redirect="@action('users.index')"
                   label="Delete User"/>
  @endauth
</ui:action>

<ui:tab id="general" icon="user" title="User Details" active="true">
  <ui:row>

    <ui:col.5>
      <ui:panel>
        <ui:dl horizontal>
          <dl:item name="Name">{{ $user->firstName . ' ' . $user->lastName}}</dl:item>
          <dl:item name="Email">{{ $user->email }}</dl:item>
          <dl:item name="Registration">
            <ui:date value="{{ $user->getCreatedAt()->format(DATE_RFC822) }}"/>
          </dl:item>
          <dl:item name="Updated at">
            <ui:date value="{{ $user->getUpdatedAt()->format(DATE_RFC822) }}"/>
          </dl:item>
        </ui:dl>
      </ui:panel>
    </ui:col.5>

    <ui:col.7>
      <ui:panel header="Edit User" icon="edit" permission="users.update" permission-context="{{ compact('user') }}">
        <form:wrapper action="@action('users.update', ['user' => $user->id])">
          <form:input name="firstName" label="First Name" value="{{$user->firstName}}" size="6" required="true"/>
          <form:input name="lastName" label="Last Name" value="{{$user->lastName}}" size="6" required="true"/>
          <form:input name="email" label="Email" value="{{$user->email}}" required="true"/>

          <form:button label="Update"/>
        </form:wrapper>
      </ui:panel>
    </ui:col.7>

  </ui:row>
</ui:tab>

<ui:tab id="security" icon="shield-alt" title="Security" permission="users.security"
        permission-context="{{ compact('user') }}">
  <ui:row>

    <ui:col.6>
      <ui:panel header="Update Password" icon="key" permission="users.password"
                permission-context="{{ compact('user') }}">
        <form:wrapper action="@action('users.password', ['user' => $user->id])">
          <form:input type="password" name="password" label="New Password"/>
          <form:input type="password" name="confirmPassword" label="Confirm Password"/>

          <form:button label="Update"/>
        </form:wrapper>
      </ui:panel>
    </ui:col.6>

    <ui:col.6>
      <ui:panel header="User Roles" icon="lock" permission="users.roles" permission-context="{{ compact('user') }}">
        <form:wrapper action="@action('users.roles', ['user' => $user->id])">
          @foreach(\App\Bootloader\SecurityBootloader::ROLES as $role => $label)
            <form:checkbox
              id="role-{{ $role }}"
              name="roles[]"
              value="{{ $role }}"
              label="{{$label}}"
              checked="{{ in_array($role, $user->getRoles()) }}"
            />
          @endforeach
          <form:button label="Update"/>
          <form:error-placeholder name="roles"/>
        </form:wrapper>
      </ui:panel>
    </ui:col.6>

  </ui:row>
</ui:tab>
