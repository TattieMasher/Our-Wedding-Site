@extends('layouts.app')

@section('title', 'Thanks for RSVPing!')

@section('content')
    <script>
        const duration = 0.2 * 1000,
        animationEnd = Date.now() + duration;

        let skew = 1;

        function randomInRange(min, max) {
        return Math.random() * (max - min) + min;
        }

        (function frame() {
        const timeLeft = animationEnd - Date.now(),
            ticks = Math.max(200, 500 * (timeLeft / duration));

        skew = Math.max(0.8, skew - 0.001);

        confetti({
            particleCount: 1,
            startVelocity: 0,
            ticks: ticks,
            origin: {
            x: Math.random(),
            // since particles fall down, skew start toward the top
            y: Math.random() * skew + 0.1,
            },
            colors: ["FFC0CB", "FF69B4", "FF1493", "C71585"],
            shapes: ["heart"],
            gravity: randomInRange(0.4, 0.6),
            scalar: randomInRange(2, 4),
            drift: randomInRange(-0.4, 0.4),
        });

        if (timeLeft > 0) {
            requestAnimationFrame(frame);
        }
        })();
    </script>

    <section class="thanks-page">
        <div class="thanks-card">
            <h1>🎉 Thank You!</h1>
            <p>Your RSVP has been submitted and we can't wait to see you there!</p>
            <p>If you need to make changes later, just return to the RSVP page using your original invite link.</p>
            <a href="{{ route('rsvp.form') }}" class="back-link">Return to RSVP Form</a>
        </div>

        <div class="thanks-card">
            <h2>🎁 Considering a Gift?</h2>
            <p>Please know your presence at our wedding is the <u>only gift</u> we truly need.</p>
            <p>But if you'd <u>like</u> to chip in towards our honeymoon, future home, or just because, we've put together a small list of ideas here, handled by PayPal.</p>
            <a href="{{ route('registry.index') }}" class="gift-link">View Our Wedding Gift Page</a>
        </div>
    </section>
@endsection
