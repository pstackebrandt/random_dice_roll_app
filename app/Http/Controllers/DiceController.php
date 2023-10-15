<?php
// Path: app/Http/Controllers/DiceController.php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Controller for the dice roller.
 */
class DiceController extends Controller
{
    /**
     * Call the dice roller view and initialize the view.
     *
     * @return View
     */
    public function showDiceRollerFormInitially(): View
    {
        $lastRollResult = session('lastRollResult', [
            'diceCount' => 0,
            'diceType' => '',
            'rolledTotalScore' => 0,
            'rolledScores' => []
        ]);

        $data = [
            'author' => 'Peter Stackebrandt',
            'projectDesignDate' => 'Oktober 2023',
            'diceCount' => 3,
            'diceType' => 'd4',
            'lastRollResult'  => $lastRollResult,
        ];
        return view('dice-roller', $data);
    }

    /**
     * Roll the dice and return the roll result  to the dice roller view.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function rollDice(Request $request): RedirectResponse
    {
        // Validate the roll input
        $validator = Validator::make($request->all(), [
            'diceType' => 'required|in:d4,d6,d8,d10,d12,d20',
            'diceCount' => 'required|integer|min:1|max:10'
        ]);

        if ($validator->fails()) {
            return redirect('/select-dice')
                ->withErrors($validator)
                ->withInput();
        }

        $diceType = $request->input('diceType');
        $diceCount = $request->input('diceCount');
        $sides = (int)substr($diceType, 1);

        $rolledTotalScore = 0;
        $rolledScores = [];
        for ($i = 0; $i < $diceCount; $i++) {
            $rolledScore = rand(1, $sides);
            $rolledScores[] = $rolledScore;
            $rolledTotalScore += $rolledScore;
        }

//        dd($diceType, $diceCount, $sides, $rolledTotalScore, $rolledScores);

        return redirect('/select-dice')
        ->with(key: 'lastRollResult', value: ['diceCount' => $diceCount,
        'diceType' => $diceType,
        'rolledTotalScore' => $rolledTotalScore,
        'rolledScores' => $rolledScores]);
    }
}
