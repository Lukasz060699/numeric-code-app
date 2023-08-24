<?php

namespace App\Http\Controllers;

use App\Models\Codes;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    public function index()
    {
        $codes = Codes::all();
        return view('codes.index');
    }

    public function create()
    {
        return view('codes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|integer|min:1|max:10'
        ]);

        $generatedCodes = [];
        for($i = 0; $i< $request->input('amount'); $i++)
        {
            do {
                $randomCode = str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
            } while (in_array($randomCode, $generatedCodes) || Codes::where('code', $randomCode)->exists);

            $generatedCodes[] = $randomCode;
            Codes::create(['code' => $randomCode]);
        }

        return redirect('/codes')->with('success', 'Kody zostały pomyślnie wygenerowane');
    }

    public function delete()
    {
        return view('codes.delete');
    }

    public function destroy(Request $request)
    {
        $codesToDelete = array_filter(array_map('trim', explode(',', $request->input('codes'))));

        $notFoundCodes = [];
        foreach ($codesToDelete as $code)
        {
            if(!Codes::where('code', $code)->exists())
            {
                $notFoundCodes [] = $code;
            }
        }

        if(!empty($notFoundCodes))
        {
            return back()->with('warning', 'Nie znaleziono następujących kodów w baziee danych: ' . implode(', ', $notFoundCodes));
        }

        Codes::whereIn('code', $codesToDelete)->delete();
        return redirect('/codes')->with('success', 'Kody zostały pomyślnie usunięte')
    }


}
