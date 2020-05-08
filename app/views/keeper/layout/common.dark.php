<extends:keeper:layout.base lang="@{locale}" baseTitle="${title|Control Panel} - Keeper"/>
<use:bundle path="keeper:bundle"/>

<stack:push name="init">
  <use:element path="keeper:layout/sitemap" as="sitemap:init"/>
  <sitemap:init/>
</stack:push>

<block:styles>
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="/keeper/keeper.css"/>
</block:styles>

<define:body>
  <keeper:sidebar activeRoute="${activeRoute}">
    <block:header>
      <div class="sf-sidebar__logo" style="background-color: #364048">
        <img src="/logo.svg"/>
        <span>Spiral Framework</span>
      </div>
    </block:header>
  </keeper:sidebar>

  <main class="sf-main">
    <keeper:header/>

    <define:heading>
      <div class="sf-heading">
        <keeper:breadcrumps activeRoute="${activeRoute}"/>
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
</define:body>
