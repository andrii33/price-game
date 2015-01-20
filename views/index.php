<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Price Game</title>
    <link rel="stylesheet" type="text/css" href="../_css/main.css">
</head>
<body>
    <h1 class="game-title">Welcome "Price game"</h1>
    <form class="game js-result" id="game-form">
        <input type="email" style="display: none" class="game-input" placeholder="Email address">
        <input type="text" name="asin" class="game-input" placeholder="Enter ASIN">
        <input type="text" name="price" class="game-input" placeholder="Enter price">
        <input type="submit" value="Play" class="game-button js-game-button">
    </form>
    <div class="game-rules">
        The rules of the game are simple,
        you have an input field that will receive alpha-numeric charecters which will
        represent a search keyword in Amazon.com and another numeric field (real) that will represent a guess.
        The player needs to guess the price of the product he/she are looking for in Amazon.com --
        To make it simple we will be using ASIN’s which are special unique ID’s for Amazon.com products
        (examples will be given later) -- with a difference of 20% to each side.
        Meaning, if the product price is $10.00 any guess between $8.00 and $12.00 will make you a winner!
    </div>
    <script src="http://code.jquery.com/jquery-1.9.0.js"></script>
    <script src="/_js/main.js"></script>
</body>
</html>
