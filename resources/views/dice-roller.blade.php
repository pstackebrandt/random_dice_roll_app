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
        <div name="author">Author: {{ $author ?? 'Unknown' }}</div>
        <div name="project-date">Project design date: {{ $projectDesignDate ?? 'Unknown' }}</div>
    </header>
    <main>
        <h1>Dice Roller</h1>
        <div>Let's roll the dice</div>

        @if ($errors->any())
        <div>
            <strong>Fehler:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="/roll-dice" method="POST">
            @csrf
            {{-- Choose dice type --}}
            <div>
                <label for="diceType">Choose a dice type:</label>
                <select id="diceType" name="diceType">
                    <option value="d4" {{ $diceType=='d4' ? 'selected' : '' }}>d4</option>
                    <option value="d6" {{ $diceType=='d6' ? 'selected' : '' }}>d6</option>
                    <option value="d8" {{ $diceType=='d8' ? 'selected' : '' }}>d8</option>
                    <option value="d10" {{ $diceType=='d10' ? 'selected' : '' }}>d10</option>
                    <option value="d12" {{ $diceType=='d12' ? 'selected' : '' }}>d12</option>
                    <option value="d20" {{ $diceType=='d20' ? 'selected' : '' }}>d20</option>
                </select>
            </div>

            <br>
            <div>
                {{-- Choose dice count --}}
                <label for="diceCount">How many dice do you want to roll in 1 throw?</label>
                <input type="number" id="diceCount" name="diceCount" min="1" max="10" value="{{ $diceCount ?? 1 }}">
            </div>
            <input type="submit" value="Roll">
        </form>

        <br>
        <hr><br>

        <div>
            {{-- Show roll result --}}
            <label for="lastRollResult">Last roll result</label>
            <div id="lastRollResult">{{ $lastRollResult ?? 'No rolls yet.' }}</div>
        </div>
    </main>
</body>

</html>