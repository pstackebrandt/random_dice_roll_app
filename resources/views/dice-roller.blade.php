{{-- file name: dice-roller.blade.php --}}

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Roll your dice</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
</head>

<body>
<header>
    <div id="author">Author: {{ $author ?? 'Unknown' }}</div>
    <div id="project-date">Project design date: {{ $projectDesignDate ?? 'Unknown' }}</div>
</header>
<main>
    <h1>Dice Roller</h1>
    <div>Let's roll the dice</div>
    <br>

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

    {{-- Select die/dice for next roll and start the roll. --}}
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
{{--                This seems not to lead to error show --}}
                <option value="Not existing die" {{ $diceType=='not existing die' ? 'selected' : '' }}>Not existing die</option>
            </select>
            <br>
            <sub>(Choose 'Not existing die' to watch error handling.) --}}</sub>
        </div>

        <br>
        <div>
            {{-- Choose dice count --}}
            <label for="diceCount">How many dice do you want to roll in 1 throw?</label>
            <input type="number" id="diceCount" name="diceCount" min="1" max="10" value="{{ $diceCount ?? 1 }}">
            <br>
        </div>
        <input type="submit" value="Roll">
    </form>


    <div>
        <h1>Debugging</h1>
        {!! print_r($lastRollResult, return: true) !!}
    </div>

    <br>
    <hr>
    <br>

    <div>
        <h1>Roll results</h1>
        @if (isset($lastRollResult) && $lastRollResult['diceCount'] > 0 )
            <h2>Result of last roll</h2>
            <div>
                {{-- Show roll result --}}
                <label for="lastRollResult">Total score</label>
                <div id="lastRollResult">{{ $lastRollResult['rolledTotalScore'] ?? 'No rolls yet.' }}</div>
                <br>
            </div>

            <div>
                {{--            Show Type and count of rolled dices--}}
                <label for="rolledDiceCountAndType">Count and type of dices</label>
                <div id="rolledDiceCountAndType">{{ $lastRollResult['diceCount'] ?? 'diceCount is null'}} dices of
                    type {{$lastRollResult['diceType'] ?? 'diceType is null'}}</div>
                <br>
            </div>

            <div>
                {{--            Show score of each roll in a table --}}
                <label for="rolledDiceScores">Score of each dice</label>
                <table id="rolledDiceScores">
                    <tr>
                        <th>Dice Number</th>
                        <th>Score</th>
                    </tr>
                    @foreach ($lastRollResult['rolledScores'] as $key => $value)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $value }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

        @else
            {{--        Show that no roll done yet --}}
            <div>
                <p><strong>No rolls yet</strong></p>
            </div>
        @endif
    </div>

</main>
</body>

</html>
