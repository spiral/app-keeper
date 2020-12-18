<extends:keeper:layout.base lang="@{locale}" baseTitle="${title|Control Panel} - Keeper"/>
<use:bundle path="keeper:bundle"/>

<stack:push name="init">
  <use:element path="keeper:layout/sitemap" as="sitemap:init"/>
  <sitemap:init/>
</stack:push>

<block:styles name="styles">
    @if(!env('FRONT_END_PUBLIC_URL'))
        <link rel="stylesheet" href="/generated/css/keeper.css"/>
    @endif
    @if(env('FRONT_END_PUBLIC_URL'))
        <link rel="stylesheet" href="{{ env('FRONT_END_PUBLIC_URL') }}/generated/css/keeper.css"/>
    @endif
</block:styles>

<stack:push name="scripts">
    <script type="text/javascript" src="/generated/ie11.js"></script>
    @if(env('FRONT_END_PUBLIC_URL'))
        <script type="text/javascript" src="{{ env('FRONT_END_PUBLIC_URL') }}/generated/keeper.js"></script>
    @endif
    @if(!env('FRONT_END_PUBLIC_URL'))
        <script type="text/javascript" src="/generated/keeper.js"></script>
    @endif
</stack:push>

<define:body>
  <keeper:sidebar activeRoute="${activeRoute}">
    <block:header>
      <div class="sf-sidebar__logo">
        <img src="/logo.svg"/>
        <span>Spiral Framework</span>
      </div>
    </block:header>
  </keeper:sidebar>

  <main class="sf-main">
    <keeper:header/>

    <define:heading>
      <div class="sf-heading">
        <keeper:breadcrumbs activeRoute="${activeRoute}"/>
        <h1>
          <block:title>{{$_ln_->getOption('title')}}</block:title>
        </h1>
        <div>
          <block:actions/>
          <stack:collect name="actions" level="20"/>
        </div>
      </div>
    </define:heading>

    <block:main/>
  </main>

    <notifications:drawer></notifications:drawer>
</define:body>
