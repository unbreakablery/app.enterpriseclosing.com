<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-black sidebar collapse">
    <div class="sidebar-sticky pt-3 bg-black">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link @if (isset($nl_tasks_class)) {{ $nl_tasks_class }} @endif" href="{{ route('tasks') }}">
                    <span data-feather="home"></span>
                    Tasks <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (isset($nl_outbound_class)) {{ $nl_outbound_class }} @endif" href="{{ route('outbound') }}">
                    <span data-feather=""></span>
                    Outbound
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (isset($nl_opportunities_class)) {{ $nl_opportunities_class }} @endif" href="{{ route('opportunities') }}">
                    <span data-feather=""></span>
                    Opportunities
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (isset($nl_scripts_class)) {{ $nl_scripts_class }} @endif" href="{{ route('scripts') }}">
                    <span data-feather=""></span>
                    Scripts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (isset($nl_emails_class)) {{ $nl_emails_class }} @endif" href="{{ route('emails') }}">
                    <span data-feather=""></span>
                    Emails
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (isset($nl_contacts_class)) {{ $nl_contacts_class }} @endif" href="{{ route('contacts') }}">
                    <span data-feather=""></span>
                    Contacts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (isset($nl_resources_class)) {{ $nl_resources_class }} @endif" href="{{ route('resources') }}">
                    <span data-feather=""></span>
                    Resources
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (isset($nl_skills_class)) {{ $nl_skills_class }} @endif" href="{{ route('skills') }}">
                    <span data-feather=""></span>
                    Skills
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (isset($nl_analytics_class)) {{ $nl_analytics_class }} @endif" href="{{ route('analytics') }}">
                    <span data-feather=""></span>
                    Analytics
                </a>
            </li>
        </ul>
    </div>
</nav>