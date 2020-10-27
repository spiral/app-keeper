<extends:keeper:layout.page title="Showcase: Forms"/>
<use:bundle path="keeper:bundle"/>
<use:element path="utils/syntaxhilight" as="utils:syntaxhilight"/>

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
    <ui:row>
        <ui:col.12>

            <ui:panel header="Date Pickers">
                <form:wrapper action="/" method="PUT">
                    <form:date
                        name="date"
                        label="Native Date Picker"
                        value=""
                        size="6"
                    />

                    <div class="form-group col-sm-12 col-md-6">
                    <utils:syntaxhilight />
                    @declare(syntax=off)<pre class="language-markup"><code>&lt;form:date
    name="date"
    label="Native Date Picker"
    value=""
    size="12"
/&gt;</code></pre>@declare(syntax=on)</div>

                    <form:date-js
                        name="date1"
                        label="Date"
                        value=""
                        size="6"
                    />

                    <div class="form-group col-sm-12 col-md-6">
                        <utils:syntaxhilight />
                        @declare(syntax=off)<pre class="language-markup"><code>&lt;form:date-js
    name="date1"
    label="Date"
    value=""
    size="6"
/&gt;</code></pre>@declare(syntax=on)</div>

                    <form:date-js
                        display-format="yyyy-MM-dd"
                        name="date2"
                        label="Date Output Format"
                        value=""
                        size="6"
                    />

                    <div class="form-group col-sm-12 col-md-6">
                        <utils:syntaxhilight />
                        @declare(syntax=off)<pre class="language-markup"><code>&lt;form:date-js
    display-format="yyyy-MM-dd"
    name="date2"
    label="Date Output Format"
    value=""
    size="6"
/&gt;</code></pre>@declare(syntax=on)</div>

                    <form:date-js
                        format="yyyy-MM-dd"
                        name="date3"
                        label="Date Server Format"
                        value=""
                        size="6"
                    />

                    <div class="form-group col-sm-12 col-md-6">
                        <utils:syntaxhilight />
                        @declare(syntax=off)<pre class="language-markup"><code>&lt;form:date-js
    format="yyyy-MM-dd"
    name="date3"
    label="Date Server Format"
    value=""
    size="6"
/&gt;</code></pre>@declare(syntax=on)</div>

                    <form:date-js
                        display-format="yyyy-dd-MM HH:mm"
                        name="date2"
                        enable-time="true"
                        force-confirm-button="true"
                        label="Date & Time"
                        value=""
                        required="true"
                        size="6"
                    />

                    <div class="form-group col-sm-12 col-md-6">
                        <utils:syntaxhilight />
                        @declare(syntax=off)<pre class="language-markup"><code>&lt;form:date-js
    display-format="yyyy-dd-MM HH:mm"
    name="date2"
    enable-time="true"
    force-confirm-button="true"
    label="Date & Time"
    value=""
    required="true"
    size="6"
/&gt;</code></pre>@declare(syntax=on)
                    </div>

                    <form:date-js
                        display-format="HH:mm"
                        force-confirm-button="true"
                        name="date3"
                        enable-time="true"
                        no-calendar="true"
                        label="Time"
                        value=""
                        size="6"
                    />

                    <div class="form-group col-sm-12 col-md-6">
                        <utils:syntaxhilight />
                        @declare(syntax=off)<pre class="language-markup"><code>&lt;form:date-js
    display-format="HH:mm"
    force-confirm-button="true"
    name="date3"
    enable-time="true"
    no-calendar="true"
    label="Time"
    value=""
    size="6"
/&gt;</code></pre>@declare(syntax=on)
                    </div>

                    <form:date-range
                        name="date4"
                        label="Date Range as Single Input"
                        value=""
                        size="6"
                    />

                    <div class="form-group col-sm-12 col-md-6">
                        <utils:syntaxhilight />
                        @declare(syntax=off)<pre class="language-markup"><code>&lt;form:date-range
    name="date4"
    label="Date Range as Single Input"
    value=""
    size="6"
/&gt;</code></pre>@declare(syntax=on)
                    </div>

                    <form:date-range-double
                        startName="date5"
                        endName="date5"
                        startValue=""
                        endValue=""
                        label="Date Range as 2 Inputs"
                        size="6"
                    />

                    <div class="form-group col-sm-12 col-md-6">
                        <utils:syntaxhilight />
                        @declare(syntax=off)<pre class="language-markup"><code>&lt;form:date-range-double
    startName="date5"
    endName="date5"
    startValue=""
    endValue=""
    label="Date Range as 2 Inputs"
    size="12"
/&gt;</code></pre>@declare(syntax=on)
                    </div>
                </form:wrapper>
            </ui:panel>
        </ui:col.12>
    </ui:row>
    <ui:row>
        <ui:col.12>

            <ui:panel header="Autocomplete">
                <form:wrapper action="/" method="PUT">
                    <form:autocomplete
                        name="date"
                        label="Autocomplete With Predefined Values"
                        value=""
                        size="6"
                    >
                        <script role="sf-options" type="application/javascript">
                            {

                            }
                        </script>
                    </form:autocomplete>

                    <div class="form-group col-sm-12 col-md-6">
                    <utils:syntaxhilight />
                    @declare(syntax=off)<pre class="language-markup"><code>&lt;form:autocomplete
    name="date"
    label="Native Date Picker"
    value=""
    size="12"
/&gt;</code></pre>@declare(syntax=on)</div>

                    <form:autocomplete
                        name="date"
                        label="Autocomplete From Server Url"
                        value=""
                        size="6"
                    >
                        <script role="sf-options" type="application/javascript">
                            {

                            }
                        </script>
                    </form:autocomplete>

                    <form:autocomplete
                        name="date"
                        label="Autocomplete With Custom Render and Server Fields"
                        value=""
                        size="6"
                    >
                        <script role="sf-options" type="application/javascript">
                            {

                            }
                        </script>
                    </form:autocomplete>

                    <form:autocomplete
                        name="date"
                        label="Multi-select Autocomplete"
                        value=""
                        size="6"
                    >
                        <script role="sf-options" type="application/javascript">
                            {

                            }
                        </script>
                    </form:autocomplete>

                </form:wrapper>
            </ui:panel>
        </ui:col.12>
    </ui:row>
</define:content>
