<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Controller for the dice roller.
 */
class DiceController extends Controller
{
    public function showForm()
    {
        $data = [
            'author' => 'Peter Stackebrandt',
            'projectDesignDate' => 'Oktober 2023',
            'diceCount' => 1,
            'diceType' => 'd4',
            'lastRollResult' => session('lastRollResult', 0),
        ];
        return view('dice-roller', $data);
    }

    public function rollDice(Request $request)
    {
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
        $sides = (int) substr($diceType, 1);

        $total = 0;
        for ($i = 0; $i < $diceCount; $i++) {
            $total += rand(1, $sides);
        }

        return redirect('/select-dice')
            ->with('lastRollResult', $total);
    }
}
