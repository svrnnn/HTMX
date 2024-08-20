<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eka HTMX</title>
    <link rel="stylesheet" href="style.css">
    <!-- <script src="https://unpkg.com/htmx.org@2.0.1" integrity="sha384-QWGpdj554B4ETpJJC9z+ZHJcA/i59TyjxEPXiiUgN2WmTyV5OEZWCD6gQhgkdpB/" crossorigin="anonymous"></script> -->
    <script src="htmx.js" defer></script>
</head>
<body>
    <header id="main-header">
        <img src="htmx-logo.png" alt="HTMX logo">
        <h1>high power tools for HTML</h1>
    </header>
    <main>
        <p>You can build modern user interfaces with the simplicity and power of hypertext</p>
        <button
            hx-get="info.php"
            hx-trigger="mouseenter[ctrlKey] once, click once"
            hx-target="main"
            hx-swap="beforeend">
            Learn More</button>
    </main>
</body>
</html>

