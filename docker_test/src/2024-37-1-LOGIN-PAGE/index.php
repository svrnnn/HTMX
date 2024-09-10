<?php
    session_start();
    session_destroy();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login HTMX</title>
    <script src="htmx.js" defer></script>
    <script src="htmx-response-targets.js" defer></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <form 
            hx-ext="response-targets"
            hx-post="login.php"
            hx-headers='{"x-csrf-token": "5jg85ghl485gu5j85g58h3f8h3f38h45"}'
            hx-target-4*="#extra-information"
            hx-target-5*=".control"
            hx-sync="this: replace"
        >
        <!-- paina enter -->
            <img src="images/lock.jpg" alt="icon of a pixel art padlock">
            <div class="control">
                <label for="email">Email</label>
                <input id="email" type="email" name="email"
                    hx-post="validate.php"
                    hx-target="next p"
                    hx-params="email"
                    hx-headers='{"x-csrf-token": "5jg85ghl485gu5j85g58h3f8h3f38h45"}'
                >
                <!-- simuloidaan CSRF token, oikeassa tilanteessa generoidaan satunnaisesti -->
                <p class="error"></p>
            </div>
            <div class="control">
                <label for="password">Password</label>
                <input id="password" type="password" name="password"
                    hx-post="validate.php"
                    hx-target="next p"
                    hx-params="password"
                    hx-headers='{"x-csrf-token": "5jg85ghl485gu5j85g58h3f8h3f38h45"}'
                >
                <p class="error"></p>
            </div>
            <div id="extra-information"></div>
            <button type="submit">
                Login
            </button>
        </form>
    </main>
</body>
</html>