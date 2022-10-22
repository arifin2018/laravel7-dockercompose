<?php

namespace App\Http\Controllers;

use DateTime;
use App\Product;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Product\Create;
use Facade\FlareClient\Http\Response;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ImageController;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class ProductController extends Controller
{
    public function index()
    {
        Gate::authorize('view', ['product']);
        $product = Product::paginate();

        return response(ProductResource::collection($product), HttpFoundationResponse::HTTP_ACCEPTED);
    }

    public function show($id)
    {
        Gate::authorize('view', ['product']);
        $product = Product::find($id);
        return response(new ProductResource($product), HttpFoundationResponse::HTTP_ACCEPTED);
    }

    public function store(Create $request)
    {
        Gate::authorize('edit', ['product']);
        $image = ImageController::upload($request->image);
        $product = Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' =>  $image['image'],
            'price' => $request->price
        ]);

        return response($product, HttpResponse::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        Gate::authorize('edit', ['product']);
        $product = Product::find($id);
        Product::update($request->all());
        return response($product, HttpResponse::HTTP_ACCEPTED);
    }

    public function destroy($id)
    {
        Gate::authorize('edit', ['product']);
        Product::destroy($id);

        return response(null, HttpFoundationResponse::HTTP_NO_CONTENT);
    }
}
