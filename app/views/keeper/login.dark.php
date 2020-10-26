<extends:keeper:layout.base baseTitle="[[Authentication Required]]"/>
<use:bundle path="keeper:bundle"/>

<block:styles>
    @if(!env('FRONT_END_PUBLIC_URL'))
        <link rel="stylesheet" href="/generated/css/keeper.css"/>
    @endif
    @if(env('FRONT_END_PUBLIC_URL'))
        <link rel="stylesheet" href="{{ env('FRONT_END_PUBLIC_URL') }}/generated/css/keeper.css"/>
    @endif
</block:styles>

<block:scripts>
    <script type="text/javascript" src="/generated/ie11.js"></script>
    @if(env('FRONT_END_PUBLIC_URL'))
        <script type="text/javascript" src="{{ env('FRONT_END_PUBLIC_URL') }}/generated/keeper.js"></script>
    @endif
    @if(!env('FRONT_END_PUBLIC_URL'))
        <script type="text/javascript" src="/generated/keeper.js"></script>
    @endif
</block:scripts>

<define:body>
    <div class="signin">
        <ui:panel>
            <div class="row no-gutters align-items-center">
                <div class="col-12 col-lg-6 text-center">
                    <block:image>
                        <img class="signin__logo" src="/logo.svg" alt="Spiral Framework" width="0">
                    </block:image>
                </div>
                <div class="col-12 col-lg-6">
                    <h2 class="text-center">Sign In to Your Account</h2>
                    <block:form>
                        <form:wrapper action="@route('auth:login')" class="js-sf-form">
                            <form:input name="username" label="E-mail"/>
                            <form:input name="password" type="password" label="Password"/>
                            <form:checkbox label="Remember me" name="remember" value="yes"/>
                            <form:button label="Sign In"/>
                        </form:wrapper>
                    </block:form>
                </div>
            </div>
        </ui:panel>
    </div>
</define:body>
