

<aside class="left-sidebar">
    <div class="scroll-sidebar">

        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">Onboarding flow</li>
                <li>
                    <a class="has-arrow" href="{{ url("/") }}" aria-expanded="false">
                        <i class="mdi mdi-view-dashboard"></i>
                        Dashboard
                    </a>
                </li>

                <li>
                    <a class="has-arrow" href="{{ route("showUploadForm") }}" aria-expanded="false">
                        <i class="fa fa-user-circle "></i>
                        Upload file
                    </a>
                </li>

                <li>
                    <a class="has-arrow" href="{{ route("showChart") }}" aria-expanded="false">
                        <i class="fa fa-vcard-o"></i>
                        Charts
                    </a>
                </li>

                <li>
                    <a class="has-arrow" href="{{ route("showAnalysis") }}" aria-expanded="false">
                        <i class="fa fa-vcard-o"></i>
                        Analysis
                    </a>
                </li>

            </ul>
        </nav>

    </div>

</aside>