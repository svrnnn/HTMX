<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="htmx.js"></script>
</head>
<body>
    <main>
        <h1>Shopping List</h1>
        <section>
            <form id="item-form">
                <div>
                    <label for="item">Item</label>
                    <input type="text" id="item" name="item" />
                </div>
                <button type="submit">Add item</button>
            </form>
        </section>
        <section>
            <ul id="items">
                <li>
                    <!-- Lisää sivulle SESSION muuttuja, josta generoidaan nämä li-elementit -->
                    <span>Juusto</span>
                    <button>Remove</button>
                </li>
                <li>
                    <span>Maito</span>
                    <button>Remove</button>
                </li>
            </ul>
        </section>
    </main>
</body>
</html>