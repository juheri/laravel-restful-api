<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Products;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController extends Controller
{

    public function createProduct(CreateProductRequest $request) :  ProductResource
    {
        $data = $request->validated();
        $product = new Products($data);
        $product->save();

        return new ProductResource($product);
    }

    public function getProduct($id)
    {
        $product = Products::where("id", "=",$id)->first();
        if(!$product){
            throw new HttpResponseException(response()-> json([
                "errors" => [
                    "message" => ["not found"]
                    ]
                    ])->setStatusCode(404));
                }
        return new ProductResource($product);
    }

    public function getProducts()
    {
        $result = Products::latest()->paginate(10, ["id", "product_name", "category", "price","discount"]);
        return $result;
    }

    public function updateProduct(int $id, UpdateProductRequest $request): ProductResource
    {
        $products = Products::where("id", $id)->first();
        if(!$products){
            throw new HttpResponseException(response()-> json([
                "errors" => [
                    "message" => ["not found"]
                    ]
                    ])->setStatusCode(404));
                }

        $data = $request->validated();
        $products->fill($data);
        $products->save();
        return new ProductResource($products);
    }

    public function deleteProduct($id) : JsonResponse
    {
        $product = Products::where("id", $id)->first();
        if(!$product){
            throw new HttpResponseException(response()-> json([
                "errors" => [
                    "message" => ["product not found"]
                    ]
                    ])->setStatusCode(404));
                }
        $product->delete();
        return response()->json([
            "data"=> true,
        ])->setStatusCode(200);
    }
}
