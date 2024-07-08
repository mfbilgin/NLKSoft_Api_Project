<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    protected $product_service;
    public function __construct(ProductService $product_service)
    {
        $this->product_service = $product_service;
    }

    public function index(Request $request)
    {
        $per_page = $request->input('per_page', 10);
        $page = $request->input('page', 1);
        $api_response = $this->product_service->getAllProducts($per_page, $page);
        return view('product.index', compact('api_response'));
    }

    public function show($id)
    {
        $product = $this->product_service->getProductById($id);
        return view('product.show', compact('product'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        try {
            $this->validator($request->all())->validate();
        }catch (ValidationException $e) {
            Log::error($e->errors());
            return redirect()->back()->withErrors($e->errors());
        }
        $data = $request->all();
        $this->product_service->create_product($data);
        return redirect()->route('product.index');
    }

    public function destroy($id)
    {
        $this->product_service->delete_product($id);
        return redirect()->route('product.index');
    }

    public function edit($id)
    {
        $product = $this->product_service->getProductById($id);
        return view('product.edit', compact('product'));
    }

    public function update(Request $request,$id)
    {
        try {
            $this->validator($request->all())->validate();
        }catch (ValidationException $e) {
            Log::error($e->errors());
            return redirect()->back()->withErrors($e->errors());
        }
        $data = $request->all();
        $this->product_service->update_product($request,$id, $data);
        return redirect()->route('product.index');
    }

    private function validator($data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);
    }
}
