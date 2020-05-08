<extends:keeper:layout.page title="My Profile"/>
<use:bundle path="keeper:bundle"/>

<?php
/**
 * @var \App\Database\User            $user
 * @var \App\Security\TFAuthenticator $tfa
 */
?>

<block:content>
  <ui:row>

    <ui:col.5>
      <ui:panel>
        <ui:dl horizontal="true">
          <dl:item name="Name">{{ $user->firstName . ' ' . $user->lastName}}</dl:item>
          <dl:item name="Email">{{ $user->email }}</dl:item>
          <dl:item name="Registration">
            <ui:date value="{{ $user->getCreatedAt()->format(DATE_RFC822) }}"/>
          </dl:item>
        </ui:dl>
      </ui:panel>
    </ui:col.5>

    <ui:col.7>
      <ui:panel header="Update Profile">
        <form:wrapper action="@action('profile.update', ['user' => $user->id])">
          <form:input name="firstName" label="First Name" value="{{$user->firstName}}" size="6" required="true"/>
          <form:input name="lastName" label="Last Name" value="{{$user->lastName}}" size="6" required="true"/>
          <form:input name="email" label="Email" value="{{$user->email}}" required="true"/>
          <form:input type="password" name="password" label="New Password" help="Keep empty to skip password update."
                      size="6"/>
          <form:input type="password" name="confirmPassword" label="Confirm Password" size="6"/>
          <form:input type="password" name="currentPassword" label="Current Password" required="true"/>

          <form:button label="Update"/>
        </form:wrapper>
      </ui:panel>
    </ui:col.7>
  </ui:row>
</block:content>
