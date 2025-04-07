<nav class="navbar">
    <div class="navbar-inner">
        <a href="{{ route('home') }}" class="navbar-brand">A & C</a>

        <input type="checkbox" id="nav-toggle" class="nav-toggle">
        <label for="nav-toggle" class="nav-toggle-label">
            <svg viewBox="0 0 100 100">
                <path class="line top" d="M 20,30 H 80" />
                <path class="line middle" d="M 20,50 H 80" />
                <path class="line bottom" d="M 20,70 H 80" />
            </svg>
        </label>

        <ul class="navbar-links">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('info') }}">Info</a></li>
            <li><a href="#rsvp">RSVP</a></li>
        </ul>
    </div>
</nav>
