<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link <?php $p = $_GET['pages']; if($p=='summary' || $p=='profile' || $p=='institution'){echo "collapsed";} ?>"
                href="?pages=dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        <li class="nav-heading">Pages</li>

        <?php
            if ($type == "Authors"){
        ?>
        <li class="nav-item">
            <a class="nav-link <?php $p = $_GET['pages']; if($p=='dashboard' || $p=='profile'){echo "collapsed";} ?>"
                href="?pages=summary">
                <i class="bi bi-file-earmark-bar-graph"></i>
                <span>Summary</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php $p = $_GET['pages']; if($p=='dashboard' || $p=='summary'){echo "collapsed";} ?>"
                href="?pages=profile">
                <i class="bi bi-person-badge"></i>
                <span>Profile</span>
            </a>
        </li>
        <?php } ?>

        <?php
            if ($type == "Admin"){
        ?>
        <li class="nav-item">
            <a class="nav-link <?php $p = $_GET['pages']; if($p=='dashboard'){echo "collapsed";} ?>"
                href="?pages=institution">
                <i class="bi bi-building"></i>
                <span>Institution</span>
            </a>
        </li>
        <?php } ?>

    </ul>
</aside>
<!-- End Sidebar-->