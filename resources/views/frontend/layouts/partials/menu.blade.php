
<!-- Menu -->
<div id="site-menu">
    <nav class="nav-menu">
        <ul>
            <li class="menu-item {{ Request::is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>
            <li class="menu-item {{ Request::is('resume') ? 'active' : '' }}"><a href="{{ url('resume') }}">Resume</a></li>
            <li class="menu-item {{ Request::is('portfolio') ? 'active' : '' }}"><a href="{{ url('portfolio') }}">Portfolio</a></li>
            <li class="menu-item {{ Request::is('blog') ? 'active' : '' }}"><a href="{{ url('blog') }}">Blog</a></li>
            <li class="menu-item {{ Request::is('contact') ? 'active' : '' }}"><a href="{{ url('contact') }}">Contact</a></li>
        </ul>
    </nav>
</div>
<div class="menu-overlay"></div>
<div class="site-menu-toggle">
    <a href="about.html#site-menu" class="ti"> <span class="screen-reader-text">Toggle navigation</span> </a>
</div>
