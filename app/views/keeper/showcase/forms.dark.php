<extends:keeper:layout.page title="Showcase: Forms"/>
<use:bundle path="keeper:bundle"/>
<use:element path="utils/syntaxhilight" as="utils:syntaxhilight"/>

<ui:action>
    <action:button icon="arrow-left" kind="light" href="@action('dashboard.index')" label="Back to Dashboard"/>
</ui:action>

<ui:action>
    <action:button icon="file" kind="primary" href="https://github.com/spiral/app-keeper/blob/master/app/views/showcase/forms.dark.php"
                   target="_blank" label="Source Code"/>
</ui:action>

<define:content>
    <ui:row>
        <ui:col.6>

            <ui:panel header="Sample Form">
                <h3>Forms</h3>
                <p>All forms are submitted with ajax request as multipart (for form with files) or JSON payload</p>
                <form:wrapper action="/" method="PUT">
                    <form:input name="firstName" label="First Name" value="" size="6" required="true"/>
                    <form:input name="lastName" label="Last Name" value="" size="6" required="true"/>
                    <form:input name="email" label="Email" value="" required="true"/>

                    <form:input type="password" name="password" label="New Password" size="6" required="true"/>
                    <form:input type="password" name="confirmPassword" label="Confirm Password" size="6"/>

                    <form:label label="User Roles" name="roles" required="true">
                        @foreach(['admin'=>'Admin', 'super-admin'=>'Super Admin'] as $role => $label)
                        <form:checkbox id="role-{{ $role }}" name="roles[]" value="{{ $role }}" label="{{$label}}"/>
                        @endforeach
                    </form:label>

                    <form:select
                        label="Select Something"
                        values="{{ [1 => 'First', 2 => 'Second', 3 => 'Third'] }}"
                        value="2"
                        placeholder="Select Value"
                    />

                    <form:radio-group
                        name="radios"
                        values="{{ [1 => 'First', 2 => 'Second', 3 => 'Third'] }}"
                        value="2"
                    />

                    <form:button label="Create"/>
                </form:wrapper>
            </ui:panel>
        </ui:col.6>
        <ui:col.6>
            <ui:panel header="Sample Form"  header="Sample Form Code" icon="code">
                <utils:syntaxhilight />
                @declare(syntax=off)
<pre class="language-markup"><code>&lt;form:wrapper action="@@action('users.create')" method="PUT"&gt;
  &lt;form:input name="firstName" label="First Name" value="" size="6" required="true"/&gt;
  &lt;form:input name="lastName" label="Last Name" value="" size="6" required="true"/&gt;
  &lt;form:input name="email" label="Email" value="" required="true"/&gt;

  &lt;form:input type="password" name="password" label="New Password" size="6" required="true"/&gt;
  &lt;form:input type="password" name="confirmPassword" label="Confirm Password" size="6"/&gt;

  &lt;form:label label="User Roles" name="roles" required="true"&gt;
    @@foreach(['admin'=>'Admin', 'super-admin'=>'Super Admin'] as $role => $label)
      &lt;form:checkbox id="role-{{ $role }}" name="roles[]" value="{{ $role }}" label="{{$label}}"/&gt;
    @@endforeach
  &lt;/form:label&gt;

  &lt;form:select
    label="Select Something"
    values="{{ [1 =&gt; 'First', 2 =&gt; 'Second', 3 =&gt; 'Third'] }}"
    value="2"
    placeholder="Select Value"
  /&gt;

  &lt;form:radio-group
    name="radios"
    values="{{ [1 =&gt; 'First', 2 =&gt; 'Second', 3 =&gt; 'Third'] }}"
    value="2"
  /&gt;

  &lt;form:button label="Create"/&gt;
&lt;/form:wrapper&gt;
</code></pre>@declare(syntax=on)
            </ui:panel>
        </ui:col.6>
    </ui:row>
</define:content>
