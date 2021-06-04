<nav class="main-menu">
    <ul>
        <li>
            <a class="nav-link @if (isset($nl_tasks_class)) {{ $nl_tasks_class }} @endif" href="{{ route('tasks') }}">
                <i class="bi bi-list-task bi-2x"></i>
                <span class="nav-text">
                    Tasks
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if (isset($nl_outbound_class)) {{ $nl_outbound_class }} @endif" href="{{ route('outbound') }}">
                <i class="bi bi-telephone-outbound-fill bi-2x"></i>    
                <span class="nav-text">
                    Outbound
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if (isset($nl_opportunities_class)) {{ $nl_opportunities_class }} @endif" href="{{ route('opportunities') }}">
                <i class="bi bi-signpost-2-fill bi-2x"></i>
                <span class="nav-text">
                    Opportunities
                </span>
            </a>
        </li>
        <li class="has-subnav">
            <a class="nav-link @if (isset($nl_scripts_class)) {{ $nl_scripts_class }} @endif" href="{{ route('scripts') }}">
                <i class="bi bi-terminal-fill bi-2x"></i>
                <span class="nav-text">
                    Scripts
                </span>
            </a>
        </li>
        <li class="has-subnav">
            <a class="nav-link @if (isset($nl_emails_class)) {{ $nl_emails_class }} @endif" href="{{ route('emails') }}">
                <i class="bi bi-envelope-fill bi-2x"></i>
                <span class="nav-text">
                    Emails
                </span>
            </a>
        </li>
        <li>
            <a class="nav-link @if (isset($nl_contacts_class)) {{ $nl_contacts_class }} @endif" href="{{ route('contacts') }}">
                <i class="bi bi-person-lines-fill bi-2x"></i>
                <span class="nav-text">
                    Contacts
                </span>
            </a>
        </li>
        <li>
            <a class="nav-link @if (isset($nl_resources_class)) {{ $nl_resources_class }} @endif" href="{{ route('resources') }}">
                <i class="bi bi-server bi-2x"></i>
                <span class="nav-text">
                    Resources
                </span>
            </a>
        </li>
        <li>
           <a class="nav-link @if (isset($nl_skills_class)) {{ $nl_skills_class }} @endif" href="{{ route('skills') }}">
                <i class="bi bi-table bi-2x"></i>
                <span class="nav-text">
                    Skills
                </span>
            </a>
        </li>
        <li>
           <a class="nav-link @if (isset($nl_analytics_class)) {{ $nl_analytics_class }} @endif" href="{{ route('analytics') }}">
                <i class="bi bi-graph-up bi-2x"></i>
                <span class="nav-text">
                    Analytics
                </span>
            </a>
        </li>
    </ul>
</nav>