<extends:keeper:layout.page title="Create User"/>
<use:bundle path="keeper:bundle"/>

<block:content>
  <ui:row>
    <ui:col.6>
      <ui:panel title="Create User">
        <form:wrapper action="@action('users.create')" method="PUT">
          <form:input name="firstName" label="First Name" value="" size="6" required="true"/>
          <form:input name="lastName" label="Last Name" value="" size="6" required="true"/>
          <form:input name="email" label="Email" value="" required="true"/>

          <form:input type="password" name="password" label="New Password" size="6" required="true"/>
          <form:input type="password" name="confirmPassword" label="Confirm Password" size="6" required="true"/>

          @auth('users.roles', ['user' => new \App\Database\User()])
            <form:label label="User Roles" name="roles" required="true">
              @foreach(\App\Bootloader\SecurityBootloader::ROLES as $role => $label)
                <form:checkbox id="role-{{ $role }}" name="roles[]" value="{{ $role }}" label="{{$label}}"/>
              @endforeach
            </form:label>
          @else
            <input type="hidden" name="roles[]" value="user">
          @endauth

          <form:button label="Create"/>
        </form:wrapper>
      </ui:panel>
    </ui:col.6>
  </ui:row>
</block:content>
