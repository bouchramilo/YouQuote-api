<?php
namespace App\Http\Controllers;

use App\Models\Citation;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CitationController extends Controller
{
    /** ***************************************************************************************************************************
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Citation::all());
    }

    /** ***************************************************************************************************************************
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "contenu"    => "required|string",
            "auteur"     => "required|string",
            "popularite" => "required|integer",
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()->first(),
            ], 0);
        }

        $citation = Citation::create([
            'contenu'    => $request->contenu,
            'auteur'     => $request->auteur,
            'popularite' => $request->popularite,
            'nbr_mots'   => str_word_count($request->contenu),
        ]);

        return response()->json([
            "success"  => true,
            "citation" => $citation,
        ], 200);
    }

    /** ***************************************************************************************************************************
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $citation             = Citation::findOrFail($id);
            $citation->popularite = $citation->popularite + 1;
            $citation->save();
            return response()->json($citation, 200);

        } catch (Exception $e) {
            return response()->json(['message' => 'Erreur interne du serveur'], 500);
        }
    }

    /** ***************************************************************************************************************************
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $citation = Citation::findOrFail($id);

            $validated = $request->validate([
                'contenu'    => 'sometimes|string',
                'auteur'     => 'sometimes|string',
                "popularite" => "required|integer",
            ]);

            $updated = $citation->update($validated);

            if (! $updated) {
                return response()->json(['message' => 'Échec de la mise à jour'], 500);
            }

            return response()->json($citation, 200);

        } catch (ValidationException $e) {
            return response()->json(['message' => 'Données invalides', 'errors' => $e->errors()], 422);

        } catch (Exception $e) {
            return response()->json(['message' => 'Erreur interne du serveur'], 500);
        }
    }

    /** ***************************************************************************************************************************
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $citation = Citation::findOrFail($id);
            $delete   = $citation->delete();

            if (! $delete) {
                return response()->json(['message' => 'La suppression n\'est pas effectue'], 500);
            }
            return response()->json(['message' => 'La suppression a été bien effectue', 'citation' => $citation], 200);

        } catch (Exception $e) {
            return response()->json(['message' => 'Erreur interne du serveur'], 500);
        }
    }

    // ***************************************************************************************************************************
    public function random(Request $request)
    {
        $count = $request->route('count', 1);

        if ($count < 1) {
            return response()->json(['error' => 'Le paramètre count doit être supérieur ou égal à 1'], 400);
        }

        $citations = Citation::inRandomOrder()->take($count)->get();

        if ($citations->isEmpty()) {
            return response()->json(['error' => 'Aucune citation trouvée'], 404);
        }

        return response()->json($citations, 200);
    }

    // ***************************************************************************************************************************

    public function filterByLength(Request $request)
    {
        try {
            $min = $request->input('min') ? $request->input('min') : 0;
            $max = $request->input('max') ? $request->input('max') : 1000;

            $citations = Citation::where('nbr_mots', ">=", $min)->where('nbr_mots', "<=", $max)->get();

            if ($citations->isEmpty()) {
                return response()->json(['message' => 'Aucune citation trouvée'], 404);
            }

            return response()->json($citations, 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erreur interne du serveur',
            ], 500);
        }
    }

    // ***************************************************************************************************************************

    public function popularite()
    {
        try {
            $citations = Citation::orderBy('popularite', 'desc')->take(5)->get();
            return response()->json($citations);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erreur interne du serveur',
            ], 500);
        }
    }

    // ***************************************************************************************************************************

}
