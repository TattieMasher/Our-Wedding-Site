<html>
    <head>
        <title>PHP Test</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible:ital,wght@0,400;0,700;1,400;1,700&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Playfair+Display:ital,wght@0,500;1,500&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/@tsparticles/confetti@3.0.3/tsparticles.confetti.bundle.min.js"></script> <!-- Confetti -->
    </head>
    <body>
        <script>
            const duration = 3 * 1000,
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
      y: Math.random() * skew - 0.2,
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
        <?php include('nav.php'); ?>
        <main>
            <h1 class="header-hearts">
                ❤❤
            </h1>
            <h1 class="main-preheader">Celebrate our wedding</h1>
            <div class="top-bottom-border">
                <h1 class="main-header">
                    Alex M<sup>c</sup>Caughran
                    <br> — and — <br> 
                    Candace Scoular
                </h1>
            </div>
            <div class="index-details-block">
                FRIDAY 1ˢᵗ AUGUST 2025<br>
                SANTINO KILMARNOCK<br>
                Arrival by 1:30pm<br>
            </div>
            <div class="index-RSVP-invitation">
            We request the pleasure of your company as we celebrate our love and joy through marriage.<br><br>
            <a class="RSVP-invite-link" href="">Please let us know if you can attend (RSVP)</a>
            </div>
        </main>
    </body>
</html>