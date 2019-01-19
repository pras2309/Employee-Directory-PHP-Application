<div data-sticky-container>
    <div data-sticky data-options="marginTop: 0;" class="navigation">
        <div class="title-bar">
            <div class="row">
                <div class="title-bar-left">
                    <ul class="menu">
                        <li><a href="index" title="Home">Employee Directory Application</a></li>
                    </ul>
                </div>
                <div class="title-bar-right">
                    <ul class="menu">
                        <li><a href="index" title="Return to Dashboard">Dashboard</a></li>
                        <li><a href="employee-profile" title="See My Info">My Info</a></li>
                        <li><a href="employee-list" title="See Employees">Employees</a></li>
                    </ul>
                    <ul class="dropdown menu" data-dropdown-menu>
                        <li>
                            <a href="#"><?php echo $_SESSION['display_name']; ?></a>
                            <ul class="menu" style="text-align: left;">
                                <li><a href="user-profile">Settings</a></li>
                                <li><a href="help">Help</a></li>
                                <li><a href="logout">Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="navigation--sub">
            <div class="row">
                <ul class="col-large-12 columns">
                    <?php if( is_admin() ) : ?>
                    <li><a href="sentiment_collection" title="Sentiment Collection">Sentiment Collection</a></li>
                    <li><a href="reports" title="See Reports">Reports</a></li>
                    <li><a href="user-list" title="See Users">Users</a></li>
                    <li><a href="department-list">Departments</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>