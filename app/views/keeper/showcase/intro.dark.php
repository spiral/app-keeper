<extends:keeper:layout.tabs title="Keeper Showcase"/>
<use:bundle path="keeper:bundle"/>


<use:element path="utils/syntaxhilight" as="utils:syntaxhilight"/>

<ui:action>
    <action:button icon="arrow-left" kind="light" href="@action('dashboard.index')" label="Back to Dashboard"/>
</ui:action>

<ui:action>
    <action:button icon="file" kind="primary" href="https://github.com/spiral/app-keeper/blob/master/app/views/showcase/intro.dark.php"
                   target="_blank" label="Source Code"/>
</ui:action>

<ui:tab id="general" title="General" active="true">
    <utils:syntaxhilight />
    <ui:row>
        <ui:col.4>
            <ui:panel header="Icons" icon="bacon" header-kind="secondary">
                <p>Keeper and Toolkit components based on <a
                        href="https://getbootstrap.com/docs/4.0/getting-started/introduction/"
                        target="_blank"><strong>Bootstrap 4</strong></a> and <a href="https://fontawesome.com/v4.7.0/icons/"
                                                                                target="_blank"><strong>Font Awesome</strong></a>
                    icons.
                </p>
                <p>This is an example icon - <i class="fa fa-home"></i>.</p>
                <pre class="language-markup"><code>&lt;i class="fa fa-home"&gt;&lt;/i&gt;</code></pre>
            </ui:panel>
        </ui:col.4>
        <ui:col.4>
            <ui:panel header="Grid System" header-kind="secondary">
                <p>Feel free to use Bootstrap 4 driven grid system. Or use Keeper <strong>UI DSL</strong> for the same purpose:
                </p>
                <pre class="language-markup"><code>
&lt;ui:row&gt;
  &lt;ui:col.6&gt; col col-6 &lt;/ui:col.6&gt;
  &lt;ui:col.3&gt; col col-3 &lt;/ui:col.3&gt;
  &lt;ui:col.3&gt; col col-3 &lt;/ui:col.3&gt;
&lt;/ui:row&gt;</code></pre>
            </ui:panel>

        </ui:col.4>

        <ui:col.4>
            <ui:panel header="Panels" header-kind="primary">
                <p>Use panels to organize your content.</p>
                <pre class="language-markup"><code>
&lt;ui:panel header="Panels" header-kind="primary"&gt;
  panel content
&lt;/ui:panel&gt;</code></pre>
            </ui:panel>
        </ui:col.4>
    </ui:row>
</ui:tab>

<ui:tab id="forms" title="Forms">
    <ui:row>
        <ui:col.6>
            <ui:panel header="Sample Form">
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
            <ui:panel header="Sample Form Code" icon="code">
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
&lt;/form:wrapper&gt;</code></pre>
                @declare(syntax=on)
            </ui:panel>
        </ui:col.6>
    </ui:row>
</ui:tab>

<ui:tab id="actions" title="Action Buttons">
    <ui:row>
        <ui:col.6>
            <ui:panel icon="file" header="Add to page">
                <p>Use <strong>ui:action</strong> to push one or multiple actions to page header.</p>
                <pre class="language-markup"><code>
&lt;ui:action&gt;
  &lt;action:button
      icon="arrow-left"
      kind="light"
      href="@@action('dashboard.index')"
      label="Back to Dashboard"
  /&gt;
&lt;/ui:action&gt;</pre>

                <p>Use <strong>permission</strong> attribute to limit who can see the action.</p>
                <pre class="language-markup"><code>
&lt;ui:action permission="keeper.users.create"&gt;
  &lt;action:button
      icon="plus"
      kind="primary"
      href="@@action('users.create')"
      label="Create User"
  /&gt;
&lt;/ui:action&gt;</code></pre>
            </ui:panel>
            <ui:panel icon="link" header="Links">
                <p>Use simple action buttons to create links to other parts of the Keeper.</p>

                <hr/>
                <p>
                    <action:button url="https://google.com" label="Google"/>
                </p>
                <pre class="language-markup"><code>&lt;action:button url="https://google.com" label="Google"/&gt;</code></pre>
                <hr/>
                <p>
                    <action:button url="https://google.com" icon="users" label="Google"/>
                </p>
                <pre class="language-markup"><code>&lt;action:button url="https://google.com" icon="users" label="Google"/&gt;</code></pre>
                <hr/>
                <p>
                    <action:button url="https://google.com" icon="search" label="Google" kind="secondary" target="_blank"/>
                </p>
                <pre class="language-markup"><code>&lt;action:button
  url="https://google.com"
  icon="search"
  label="Google"
  kind="secondary"
  target="_blank"
/&gt;</code></pre>
            </ui:panel>
        </ui:col.6>
        <ui:col.6>
            <ui:panel header="Invoke actions" icon="code" header-kind="primary">
                <p>Invoke REST actions using <strong>action:invoke</strong> buttons.</p>
                <p>
                    <action:invoke icon="cog" url="@action('dashboard.do')" method="POST" label="Do Something" kind="primary"
                                   data="@json(['key'=>'value'])"
                    />
                </p>
                <pre class="language-markup"><code>&lt;action:invoke
  icon="cog"
  url="@@action('dashboard.do')"
  method="POST"
  label="Do Something"
  kind="primary"
  confirm="Are you sure?"        #optional (default off)
  data="@@json(['key'=>'value'])" #optional (default none)
/&gt;</pre>
            </ui:panel>
            <ui:panel header="Delete Action" icon="trash" header-kind="danger">
                <p>Use special delete action to send <strong>DELETE</strong> request with modal confirmation. The success or
                    error message will be rendered as toast.</p>
                <p>
                    <action:delete url="/" redirect="https://google.com" label="Delete" confirm="Are you sure?"/>
                </p>
                <pre class="language-markup"><code>&lt;action:delete
  url="@@action('users.delete', ['user' => $user->id])"
  redirect="https://google.com"                         #optional (default off)
  confirm="Are you sure?"                               #optional (default on)
  label="Delete"
                        /&gt;</code></pre>
            </ui:panel>
        </ui:col.6>

    </ui:row>
</ui:tab>

<ui:tab id="qr" title="QR Codes">
    <ui:panel>
        <ui:row>
            <ui:col.4>
                <h2>SVG(default) QrCode</h2>
                <ui:qrcode value="HK3ARG6MYFMIDDHB"/>
            </ui:col.4>
            <ui:col.4>
                <h2>Canvas QrCode</h2>
                <ui:qrcode value="https://spiral.dev/" type="canvas"/>
            </ui:col.4>
            <ui:col.4>
                <h2>Custom Colors</h2>
                <ui:qrcode
                    value="https://spiral.dev/"
                    type="canvas"
                    size="200"
                    bgColor="#f8f9fa"
                    fgColor="#49545f"
                    ecLevel="H"/>
            </ui:col.4>
        </ui:row>
    </ui:panel>
</ui:tab>
