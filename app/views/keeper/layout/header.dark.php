<use:bundle path="keeper:bundle"/>

<header class="sf-header">
  <button class="sf-sidebar__toggle" data-sf="sidebar-toggle" aria-expanded="true" aria-controls="sidebar">
    <i class="fa fa-bars"></i>
  </button>
    <?php
    $_auth_ = $this->container->get(\Spiral\Auth\AuthContextInterface::class);

    /** @var \App\Database\User $_actor_ */
    $_actor_ = $_auth_->getActor();
    ?>
  <div class="sf-header-user" data-sf="dropdown">
    <button class="sf-header-user__info" data-sf="dropdown-toggle" id="sf-header-user-menu" aria-haspopup="true"
            aria-expanded="false">
      <div class="sf-user-short-info">
        <span
          class="sf-user-short-info__avatar">{{ substr($_actor_->firstName, 0, 1) . substr($_actor_->lastName, 0, 1) }}</span>
        <span class="sf-user-short-info__name">{{ $_actor_->firstName . ' ' . $_actor_->lastName }}</span>
      </div>
    </button>
    <div class="sf-header-user__menu dropdown-menu" data-sf="dropdown-menu" aria-labelledby="sf-header-user-menu">
      <a class="dropdown-item" href="@action('profile.me')">Profile</a>
      <a class="dropdown-item" href="@route('auth:logout', ['token' => $_auth_->getToken()->getID()])">Log Out</a>
    </div>
  </div>
  <notifications:toggle>
    <script role="sf-options" type="application/json">
        {
            "api": {
                "getList": "/notifications",
                "setAsRead": "/keeper/markasread"
            },
            "ws": "SpiralSocketConnection"
        }
    </script>
  </notifications:toggle>
</header>
