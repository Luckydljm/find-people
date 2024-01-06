<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link <?php $p = $_GET['pages']; if($p=='report' || $p=='make-report'){echo "collapsed";} ?>"
                href="?pages=dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link <?php $p = $_GET['pages']; if($p=='dashboard' || $p=='make-report'){echo "collapsed";} ?>"
                href="?pages=report">
                <i class="bi bi-file-earmark-bar-graph"></i>
                <span>Summary</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php $p = $_GET['pages']; if($p=='dashboard' || $p=='report'){echo "collapsed";} ?>"
                href="?pages=make-report">
                <i class="bi bi-person-badge"></i>
                <span>Profile</span>
            </a>
        </li>

    </ul>
</aside>
<!-- End Sidebar-->