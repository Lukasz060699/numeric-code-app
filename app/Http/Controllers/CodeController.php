<?php

namespace App\Http\Controllers;

use App\Models\Codes;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Backtrace\Backtrace;

class CodeController extends Controller
{

    /**
     * Display a list of all codes
     *
     */
    public function index()
    {
        $codes = Codes::cursorPaginate(5);
        return view('codes.index', compact('codes')); // passing codes to the view
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
        if(!Auth::check()) {
            throw new \Exception('Nie jesteś zalogowany.');
        }

        try{
            $userId = Auth::id(); //get user id

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
                Codes::create(['code' => $randomCode, 'user_id' => $userId]);
            }

            return redirect('/')->with('success', 'Kody zostały pomyślnie wygenerowane');
        } catch (\Exception $e) {
            Log::error("Error in store method: " . $e->getMessage());
            return back()->with('error', 'Wystąpił błąd podczas generowania kodów');
        }
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
        if(!Auth::check()) {
            throw new \Exception('Nie jesteś zalogowany.');
        }
        try{
            $codesToDelete = preg_split('/[,\r\n]+/', $request->input('codes'));
            $codesToDelete = array_map('trim', $codesToDelete);
            $codesToDelete = array_filter($codesToDelete);

            // get existing codes from database
            $existingCodes = Codes::whereIn('code', $codesToDelete)->pluck('code')->toArray();

            // check, which codes exist
            $notFoundCodes = array_diff($codesToDelete, $existingCodes);
            if(!empty($notFoundCodes))
            {
                return back()->with('warning', 'Nie znaleziono następujących kodów w bazie danych: ' . implode(', ', $notFoundCodes));
            }

            //delete codes from the database
            Codes::whereIn('code', $codesToDelete)->delete();
            return redirect('/')->with('success', 'Kody zostały pomyślnie usunięte');
        } catch (\Exception $e) {
            Log::error("Error in destroy method: " . $e->getMessage());
            return back()->with('error', 'Wystąpił błąd podczas usuwania kodów');
        }
    }

    // function generated unique code
    private function generateUniqueCode(array &$existingCodes): string
    {
        try{
            $maxAttempts = 10; // max attempts to generate a unique code

            for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
                $randomCode = str_pad(rand(0, 99999999), 10, '0', STR_PAD_LEFT);

                if (!in_array($randomCode, $existingCodes) && !Codes::where('code', $randomCode)->exists()) {
                    return $randomCode;
                }
            }

            // if the loop reached the max attempts, throw an exception
            throw new \RuntimeException('Nie udało się wygenerować unikalnego kodu po ' . $maxAttempts . ' próbach.');
        } catch (\RuntimeException $e) {
            Log::error("Error in generated UniqueCode method: " . $e->getMessage());
            throw $e;
        }
    }

}
