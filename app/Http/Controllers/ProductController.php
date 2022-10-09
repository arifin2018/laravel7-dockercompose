<?php

namespace App\Http\Controllers;

use DateTime;
use App\Product;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Facade\FlareClient\Http\Response;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::paginate();

        return response(ProductResource::collection($product), HttpFoundationResponse::HTTP_ACCEPTED);
    }

    public function show($id)
    {
        $product = Product::find($id);
        return response(new ProductResource($product), HttpFoundationResponse::HTTP_ACCEPTED);
    }

    public function store(Request $request)
    {
        $time = time(); // current Unix timestamp
        // $dt = new DateTime("@$time");
        // return $dt->format('Y-m-d H:i:s');
        $file = $request->image;
        $AddedName =  $time . '-' . $file->getClientOriginalName();
        $image = Storage::putFileAs('images', $file, $AddedName);
        $product = Product::create([
            'title' => $request->title,
            'description'   => $request->description,
            'image' =>  env('APP_URL') . '/' . $image,
            'price' => $request->price
        ]);

        return response($product, HttpResponse::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        # code...
    }

    public function destroy($id)
    {
        Product::destroy($id);

        return response(null, HttpFoundationResponse::HTTP_NO_CONTENT);
    }
}
