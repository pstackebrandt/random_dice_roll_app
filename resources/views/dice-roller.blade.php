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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<header class="flex-container">
    <div id="author" class="flex-item">Author: {{ $author ?? 'Unknown' }}</div>
    <div id="project-date" class="flex-item">Project design date: {{ $projectDesignDate ?? 'Unknown' }}</div>
</header>
<main class="flex-container">
    <div id="page-title-area" class="page-title-area">
        <h1>Dice Roller</h1>
        <p class="slogan">Let's roll the dice</p>
    </div>

    <div id="select-dice-area">

        {{-- Select die/dice for next roll and start the roll. --}}
        <form action="/roll-dice" method="POST">
            @csrf
            <input type="hidden" name="selectDiceForm">
            <h2>Prepare your roll</h2>
            @if ($errors->any())
                <div class="error-viewer-area">
                    <p class="error-viewer-heading">Error</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="error-viewer">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Choose dice type --}}
            <div>
                <label for="diceType">Choose a dice type:</label>
                <select id="diceType" name="diceType">
                    <option value="d4" {{ old('diceType', $diceType) == 'd4' ? 'selected' : '' }}>d4</option>
                    <option value="d6" {{ old('diceType', $diceType) == 'd6' ? 'selected' : '' }}>d6</option>
                    <option value="d8" {{ old('diceType', $diceType) == 'd8' ? 'selected' : '' }}>d8</option>
                    <option value="d10" {{ old('diceType', $diceType) == 'd10' ? 'selected' : '' }}>d10</option>
                    <option value="d12" {{ old('diceType', $diceType) == 'd12' ? 'selected' : '' }}>d12</option>
                    <option value="d20" {{ old('diceType', $diceType) == 'd20' ? 'selected' : '' }}>d20</option>
                    {{--                Value is required to check validation behaviour --}}
                    <option
                        value="Not existing die" {{ old('diceType', $diceType) == 'Not existing die' ? 'selected' : '' }}>
                        Not existing die
                    </option>
                </select>

                <sub>A d4 die has 4 sides with score 1 to 4.</sub><br>
                <sub>(Choose 'Not existing die' to watch error handling.)</sub>
            </div>

            <div>
                {{-- Choose dice count --}}
                <label for="diceCount">How many dice do you want to roll in 1 throw?</label>
                <input type="number" id="diceCount" name="diceCount" min="1" max="11"
                       value="{{ old('diceCount', $diceCount) }}">
                {{--                Value 11 is required to check validation behaviour --}}
                <br>
                <sub>(Choose '11' to watch error handling.)</sub>
            </div>
            <input type="submit" value="Roll">
        </form>
    </div>

    <div>
        <h2>Roll results</h2>
        @if (isset($lastRollResult) && $lastRollResult['diceCount'] > 0 )
            <h2>Result of last roll</h2>
            <div>
                {{-- Show roll result --}}
                <label for="lastRollResult">Total score:</label>
                <span id="lastRollResult">{{ $lastRollResult['rolledTotalScore'] ?? 'No rolls yet.' }}</span>
                <br>
            </div>

            <br>
            <div>
                {{--            Show Type and count of rolled dices--}}
                <label for="rolledDiceCountAndType">Count and type of dices: </label>
                <span id="rolledDiceCountAndType">{{ $lastRollResult['diceCount'] ?? 'diceCount is null'}} dices of
                    type {{$lastRollResult['diceType'] ?? 'diceType is null'}}</span>
                <br>
            </div>

            <br>
            <div>
                {{--            Show score of each roll in a table --}}
                <label for="rolledDiceScores">Score of each dice:</label>
                <br>
                <table id="rolledDiceScores">
                    <tr>
                        <th>Dice count</th>
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

        <br>
        <hr>
        <br>

        <div id="debugging-area">
            <h2>Debugging</h2>
            <p>$lastRollResult: {!! print_r($lastRollResult, return: true) !!}
            <p>$diceCount: {!! print_r($diceCount, return: true) !!}</p>
            <p>$diceCount: {!! print_r($diceType, return: true) !!}</p>
        </div>
    </div>

</main>
</body>

</html>
