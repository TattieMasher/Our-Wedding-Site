<nav class="navbar">
    <div class="navbar-inner">
        <a href="{{ route('home') }}" class="navbar-brand">A & C</a>

        <input type="checkbox" id="nav-toggle" class="nav-toggle">
        <label for="nav-toggle" class="nav-toggle-label">
            <span></span>
        </label>

        <ul class="navbar-links">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="#info">Info</a></li>
            <li><a href="#rsvp">RSVP</a></li>
        </ul>
    </div>
</nav>
