<div class="page-header-inner">
    <div class="page-header-inner">
        <div class="navbar-header">
            <a href="{{ url('/') }}"
               class="navbar-brand">
                @lang('quickadmin.quickadmin_title')
            </a>
        </div>
        <a href="javascript:;"
           class="menu-toggler responsive-toggler"
           data-toggle="collapse"
           data-target=".navbar-collapse">
        </a>

        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <i class="fa fa-bell-o"></i>
                        @php($notificationCount = \Auth::user()->internalNotifications()->where('read_at', null)->count())
                            @if($notificationCount > 0)
                            <span class="label label-warning">
                            {{ $notificationCount }}
                        </span>
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="slimScrollDiv"
                                 style="position: relative;">
                                <ul class="menu notification-menu">
                                    @if (count($notifications = \Auth::user()->internalNotifications()->get()) > 0)
                                        @foreach($notifications as $notification)
                                            <li class="notification-link {{ $notification->pivot->read_at === null ? "unread" : false }}">
                                                <a href="{{ $notification->link ? $notification->link : "#" }}" class="{{ $notification->link ? 'is-link' : false }}">
                                                    {{ $notification->text }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="notification-link" style="text-align:center;">
                                            No notifications
                                        </li>
                                    @endif
                                </ul>
                                <div class="slimScrollBar"
                                     style="background: rgb(0, 0, 0); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 195.122px;"></div>
                                <div class="slimScrollRail"
                                     style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>

<style>
    .slimScrollDiv {
        width: auto !important;
        height:auto !important;
    }

    .notification-menu {
        width: auto !important;
        list-style-type: none;
        padding: 5px;
        max-width: 300px;
        height:auto !important;
    }

    .notification-link {
        width: auto;
    }

    .notification-link a {
        white-space: normal !important;
    }

    .unread a {
        font-weight: bold !important;
    }

    .is-link {
        color: #5b9bd1 !important;
    }
</style>