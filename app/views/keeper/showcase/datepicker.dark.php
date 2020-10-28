<extends:keeper:layout.page title="Showcase: Datepicker"/>
<use:bundle path="keeper:bundle"/>
<use:element path="utils/syntaxhilight" as="utils:syntaxhilight"/>

<define:content>
    <ui:panel header="Date Pickers">
                <form:wrapper action="/" method="PUT">
                    <div class="with-form-control col-sm-12 col-md-6">
                    <form:date
                        name="date"
                        label="Native Date Picker"
                        value=""
                        size="6"
                    />
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <utils:syntaxhilight />
                        @declare(syntax=off)<pre class="language-markup"><code>&lt;form:date
    name="date"
    label="Native Date Picker"
    value=""
    size="12"
/&gt;</code></pre>@declare(syntax=on)</div>

                    <div class="col-sm-12">
                        <hr/>
                    </div>
                    <div class="with-form-control col-sm-12 col-md-6">
                    <form:date-js
                        name="date1"
                        label="Date"
                        value=""
                        size="6"
                    />
                    </div>

                    <div class="form-group col-sm-12 col-md-6">
                        <utils:syntaxhilight />
                        @declare(syntax=off)<pre class="language-markup"><code>&lt;form:date-js
    name="date1"
    label="Date"
    value=""
    size="6"
/&gt;</code></pre>@declare(syntax=on)</div>

                    <div class="col-sm-12">
                        <hr/>
                    </div>
                    <div class="with-form-control col-sm-12 col-md-6">
                    <form:date-js
                        display-format="yyyy-MM-dd"
                        name="date2"
                        label="Date Output Format"
                        value=""
                        size="6"
                    />
                        <p>Use <code>display-format</code> to change how date <em>looks like</em>. It is not affecting how it's sent to server. Default is <code>yyyy LLL dd</code></p>
                        <p><a href="https://moment.github.io/luxon/docs/manual/formatting.html#table-of-tokens">For format tokens see here</a></p>
                    </div>

                    <div class="form-group col-sm-12 col-md-6">
                        <utils:syntaxhilight />
                        @declare(syntax=off)<pre class="language-markup"><code>&lt;form:date-js
    display-format="yyyy-MM-dd"
    name="date2"
    label="Date Output Format"
    value=""
    size="6"
/&gt;</code></pre>@declare(syntax=on)</div>

                    <div class="col-sm-12">
                        <hr/>
                    </div>
                    <div class="with-form-control col-sm-12 col-md-6">
                    <form:date-js
                        format="yyyy-MM-dd"
                        name="date3"
                        label="Date Server Format"
                        value=""
                        size="6"
                    />
                        <p>Use <code>format</code> to change how date is sent to server and processed in value property. It is not affecting how it's displayed. Default is <code>yyyy-MM-dd'T'HH:mm:ssZZZ</code></p>
                        <p><a href="https://moment.github.io/luxon/docs/manual/formatting.html#table-of-tokens">For format tokens see here</a></p>
                    </div>

                    <div class="form-group col-sm-12 col-md-6">
                        <utils:syntaxhilight />
                        @declare(syntax=off)<pre class="language-markup"><code>&lt;form:date-js
    format="yyyy-MM-dd"
    name="date3"
    label="Date Server Format"
    value=""
    size="6"
/&gt;</code></pre>@declare(syntax=on)</div>

                    <div class="col-sm-12">
                        <hr/>
                    </div>
                    <div class="with-form-control col-sm-12 col-md-6">
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
                        <p>Use <code>enable-time</code> to enable time picker. Ensure to change display format to see time picked as default format won't show it</p>
                        <p>Use <code>force-confirm-button</code> force showing Apply button. It's recommended for calendars with time pickers</p>
                    </div>

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

                    <div class="col-sm-12">
                        <hr/>
                    </div>
                    <div class="with-form-control col-sm-12 col-md-6">
                    <form:date-js
                        display-format="HH:mm"
                        format="HH:mm ZZZ"
                        force-confirm-button="true"
                        name="date3"
                        enable-time="true"
                        no-calendar="true"
                        label="Time"
                        value=""
                        size="6"
                    />

                        <p>Use <code>enable-time</code> to enable time picker. Ensure to change display format to see time picked as default format won't show it</p>
                        <p>Use <code>no-calendar</code> to remove calendar and use only time picker. You may want to change <code>format</code> options to send time only as default sends full date</p>
                        <p>Use <code>force-confirm-button</code> force showing Apply button. It's recommended for calendars with time pickers</p>
                    </div>

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

                    <div class="col-sm-12">
                        <hr/>
                    </div>
                    <div class="with-form-control col-sm-12 col-md-6">
                    <form:date-range
                        name="date4"
                        label="Date Range as Single Input"
                        value=""
                        size="6"
                    />
                        <p>Note you will need to split value manually on backend</p>
                    </div>

                    <div class="form-group col-sm-12 col-md-6">
                        <utils:syntaxhilight />
                        @declare(syntax=off)<pre class="language-markup"><code>&lt;form:date-range
    name="date4"
    label="Date Range as Single Input"
    value=""
    size="6"
/&gt;</code></pre>@declare(syntax=on)
                    </div>

                    <div class="col-sm-12">
                        <hr/>
                    </div>
                    <div class="with-form-control col-sm-12 col-md-6">
                    <form:date-range-double
                        startName="date5"
                        endName="date5"
                        startValue=""
                        endValue=""
                        label="Date Range as 2 Inputs"
                        size="6"
                    />
                        <p>Use <code>startName</code> and <code>endName</code> for names for inputs for start and end of date range</p>
                        <p>Use <code>startValue</code> and <code>endValue</code> for values for start and end of date range</p>
                    </div>

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
</define:content>
