<?php

namespace App\Services;
use App\Models\Product;
class ProductService
{
    /**
     * Create a new ProductService instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Constructor logic if needed
    }

    /**
     * Example method for the service.
     * Replace this with your actual business logic.
     *
     * @param array $data
     * @return mixed
     */
    public function storeProduct(array $data)
    {
        Product::create([
            'name' => $data['name'],
            'category' => $data['category'],
            'description' => $data['description'],
            'price' => $data['price'],
            'stock_quantity' => $data['stock_quantity'],
            'sku' => $data['sku'],
            'is_available' => $data['is_available'],
            'weight_kg' => $data['weight_kg'],
            'dimensions_cm' => $data['dimensions_cm'],
            'manufacturer_id' => $data['manufacturer_id'],
            'release_date' => $data['release_date'],
        ]);

        $response = [
            'is_success' => true,
            'message '=> 'Product added successfully.',
        ];
            
        return $response; // Placeholder return
    }

    public function viewProducts(?string $limit = null, ?string $search_query = null, ?string $pagination = null)
    {
        $query = Product::query();

        if ($limit){
            $query->limit($limit);
        }else {
            $query->limit(10);
        }

        // Search the books by the given search query
        if ($search_query) {
            $search = strtolower($search_query);
            $query->where(function ($q) use ($search) {
                // Search by the following fields
                $fields = [
                    'name','category','description','price','stock_quantity',
                    'sku','is_available','weight_kg','dimensions_cm',
                    'manufacturer_id','release_date',
                ];

                // Iterate over the fields and search by the given search query
                foreach ($fields as $field) {
                    $q->orWhereRaw("LOWER($field) LIKE ?", ["%{$search}%"]);
                }
            });
        }

        // --- Pagination Handling ---
        if ($pagination) {
            $paginationArray = explode(',', $pagination);
            $page = is_numeric($paginationArray[0]) ? (int)$paginationArray[0] : 10;
            $perPage = (isset($paginationArray[1]) && is_numeric($paginationArray[1])) ? (int)$paginationArray[1] : 1;

            // If limit is set, it overrides per-page size
            if ($limit && is_numeric($limit)) {
                $perPage = (int)$limit;
            }

            return $query->paginate($perPage, ['*'], 'page', $page);
        }

        // --- No Pagination ---
        if ($limit && is_numeric($limit)) {
            $query->limit((int)$limit);
        } else {
            $query->limit(10);
        }

        return $query->get();
    }

    public function viewProduct()
    {

        $product = Product::all()->random();
        
        return $product;
    }


    public function updateProduct($id, array $data)
    {
        $product = Product::find($id);

        if (!$product) {
            $response = [
                'is_success' => false,
                'message '=> 'A product not found.',
            ];

            return $response;
        }

        $product->first_name = $data['first_name'];
        $product->last_name = $data['last_name'];
        $product->email = $data['email'];
        $product->phone_number = $data['phone_number'];
        $product->gender = $data['gender'];
        $product->address = $data['address'];
        $product->city = $data['city'];
        $product->state = $data['state'];
        $product->zip_code = $data['zip_code'];
        $product->country = $data['country'];

        $product->save();

        $response = [
            'is_success' => true,
            'message '=> 'A product was updated successfully.',
        ];
            
        return $response;
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);

        if (!$product) {
            $response = [
                'is_success' => false,
                'message '=> 'This can\'t be deleted, product not found.',
            ];

            return $response;
        }
        
        $product->delete();

        $response = [
            'is_success' => true,
            'message '=> 'A product record updated successfully.',
        ];
            
        return $response;
    }
}
