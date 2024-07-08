<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $per_page = $request->input('per_page', 10);
        $page = $request->input('page', 1);
        $products = Product::paginate($per_page,['*'],'page',$page);
        return response()->json($products);
    }

    public function store(Request $request)
    {
        try {
            $this->validator($request->all())->validate();
        }catch (ValidationException $e){
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }


    public function show(Product $product)
    {
        return $product;
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric',
        ]);

        $product->update($validated);
        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }


    protected function validator(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:products'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:1'],
        ]);
    }
}
