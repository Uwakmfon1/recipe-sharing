<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Recipe;
use Illuminate\Http\Request;
// use PHPOpenSourceSaver\JWTAuth\Contracts\Providers\Auth;
use Illuminate\Support\Facades\Auth;
class RecipeController extends Controller
{
     /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function index(Request $request)
    {
        $data = Recipe::select('title','ingredients','servings','instructions')->get();
        return response()->json(data: $data);
    }


    public function store(Request $request) {
        $validator = Validator::make(request()->all(), [
            'title' => 'required',
            'ingredients' => 'required|array',
            'servings' => 'required',
            'instructions'=>'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }


        $array = request()->ingredients;
        $fArray = implode('  |  ', $array);
        // dd($request);
        $recipe = new Recipe;
        $recipe->user_id = auth()->user()->id;

        $recipe->title = request()->title;
        $recipe->ingredients = $fArray;
        $recipe->servings = request()->servings;
        $recipe->instructions= request()->instructions;
        $recipe->save();


        return response()->json([
            'data'=>$recipe,
        ],201);
    }


    public function search(Request $request)
    {
        $req = $request->input('query');
        // dd($req);
        $val = Recipe::where('title', 'LIKE', '%'.$req.'%')
                        ->orWhere('ingredients', 'LIKE', '%'.$req.'%')
                        ->OrWhere('instructions', 'LIKE', '%'.$req.'%')
                        ->get('title');
        return response()->json($val);
    }

    public function searchId(Request $request)
    {
        $req = $request->input('id');

        // $id = Recip
    }
}



