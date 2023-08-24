<?php

namespace App\Http\Controllers;

use App\Models\Codes;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    /**
     * Display a list of all codes
     *
     */
    public function index()
    {
        $codes = Codes::all();
        return view('codes.index'); // passing codes to the view
    }

    /**
     * Display a form to create new codes
     *
     */
    public function create()
    {
        return view('codes.create');
    }

    /**
     * Save new codes to the database
     *
     */
    public function store(Request $request)
    {
        // form validation
        $request->validate([
            'amount' => 'required|integer|min:1|max:10'
        ]);

        //generate unique codes and saving to the database
        $generatedCodes = [];
        for($i = 0; $i< $request->input('amount'); $i++)
        {
            $randomCode = $this->generateUniqueCode($generatedCodes);
            $generatedCodes[] = $randomCode;
            Codes::create(['code' => $randomCode]);
        }

        return redirect('/codes')->with('success', 'Kody zostały pomyślnie wygenerowane');
    }

    /**
     * Display a form to delete new codes
     *
     */
    public function delete()
    {
        return view('codes.delete');
    }

     /**
     * Removing selected codes from the database
     *
     */
    public function destroy(Request $request)
    {
        $codesToDelete = array_filter(array_map('trim', explode(',', $request->input('codes'))));

        // get existing codes from database
        $existingCodes = Codes::whereIn('code', $codesToDelete)->pluck('code')->toArray();

        // check, which codes exist
        $notFoundCodes = array_diff($codesToDelete, $existingCodes);

        if(!empty($notFoundCodes))
        {
            return back()->with('warning', 'Nie znaleziono następujących kodów w baziee danych: ' . implode(', ', $notFoundCodes));
        }

        //delete codes from the database
        Codes::whereIn('code', $codesToDelete)->delete();
        return redirect('/codes')->with('success', 'Kody zostały pomyślnie usunięte');
    }

    // function generated unique code
    private function generateUniqueCode(array &$existingCodes): string
    {
        do {
            $randomCode = str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
        } while (in_array($randomCode, $existingCodes) || Codes::where('code', $randomCode)->exists());

        return $randomCode;
    }

}
