<?php
    $author = "Peter Stackebrandt";
    $projectDesignDate = "Oktober 2023";

    $diceCount = 1;
    $diceType = "d4";
    $lastRollResult = 0;
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Roll your dice</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>

<body>
    <header>
        <div name="author">Author: {{ $author }}</div>
        <div name="project-date">Project design date: {{ $projectDesignDate }}</div>
    </header>
    <main>
        <h1>Dice Roller</h1>
        <div>Let's roll the dice</div>

        <p>Structure of this page</p>

        <form action="/roll-dice" method="POST">
            @csrf
            <input type="hidden" name="diceSelection" value="d4">

            <label for="diceType">Choose a dice type:</label>
            <label id="diceTypeError"></label>
            <p> A d4 dice has 4 sides with the numbers 1, 2, 3 and 4 on them. </p>
            <select id="diceType" name="diceType">
                <option value="d4">d4</option>
                <option value="d6">d6</option>
                <option value="d8">d8</option>
                <option value="d10">d10</option>
                <option value="d12">d12</option>
                <option value="d20">d20</option>
            </select>

            <label for="diceCount">How many dice do you want to roll in 1 throw?</label>
            <label id="diceCountError"></label>
            <input type="number" id="diceCount" name="diceCount" min="1" max="10" value="{{$diceCount}}">
            <input type="submit" value="Roll">
        </form>

        <br><hr><br>

        <label for="lastRollResult">Last roll result</label>
        <div id="lastRollResult"></div>

    </main>
    </div>
</body>

</html>