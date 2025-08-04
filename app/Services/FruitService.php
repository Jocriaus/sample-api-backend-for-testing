<?php

namespace App\Services;
use App\Models\Fruit;
use App\Http\Resources\FruitCollection;

class FruitService
{
    /**
     * Create a new FruitService instance.
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
    public function storeFruit(array $data)
    {
        Fruit::create([
            'name' => $data['name'],
            'scientific_name' => $data['scientific_name'],
            'color' => $data['color'],
            'taste_profile' => $data['taste_profile'], 
            'season' => $data['season'], 
            'is_seasonal' => $data['is_seasonal'], 
            'price_per_kg' => $data['price_per_kg'], 
            'origin_country' => $data['origin_country'], 
            'description' => $data['description'], 
        ]);

        $response = [
            'is_success' => true,
            'message '=> 'Fruit added successfully.',
        ];
            
        return $response; // Placeholder return
    }

    public function viewFruits(string $limit = null, string $search_query = null)
    {
        $query = Fruit::query();

        if ($limit){
            $query->limit($limit);
        }

        if ($search_query){
            $search = strtolower($search_query);
            $query->where(function($q) use ($search) {
                $q->where("name",'LIKE', "%{$search}%")
                ->orWhere("scientific_name", 'LIKE', "%{$search}%")
                ->orWhere("taste_profile", 'LIKE', "%{$search}%")
                ->orWhere("season", 'LIKE', "%{$search}%")
                ->orWhere("is_seasonal", 'LIKE', "%{$search}%")
                ->orWhere("price_per_kg", 'LIKE', "%{$search}%")
                ->orWhere("origin_country", 'LIKE', "%{$search}%")
                ->orWhere("description", 'LIKE', "%{$search}%")
                ->orWhere("color", 'LIKE', "%{$search}%");
            });
        }

        $fruits = $query->get();


        
        return $fruits;
    }

    public function viewFruit()
    {

        $fruit = Fruit::all()->random();
        
        return $fruit;
    }

    public function updateFruit($id, array $data)
    {
        $fruit = Fruit::find($id);

        if (!$fruit) {
            $response = [
                'is_success' => false,
                'message '=> 'Fruit not found.',
            ];

            return $response;
        }

        $fruit->name = $data['name'];
        $fruit->scientific_name = $data['scientific_name'];
        $fruit->color = $data['color'];
        $fruit->taste_profile = $data['taste_profile'];
        $fruit->season = $data['season'];
        $fruit->is_seasonal = $data['is_seasonal'];
        $fruit->price_per_kg = $data['price_per_kg'];
        $fruit->origin_country = $data['origin_country'];
        $fruit->description = $data['description'];

        $fruit->save();

        $response = [
            'is_success' => true,
            'message '=> 'Fruit updated successfully.',
        ];
            
        return $response;
    }

    public function deleteFruit($id)
    {
        $fruit = Fruit::find($id);

        if (!$fruit) {
            $response = [
                'is_success' => false,
                'message '=> 'Fruit not found.',
            ];

            return $response;
        }
        
        $fruit->delete();

        $response = [
            'is_success' => true,
            'message '=> 'Fruit updated successfully.',
        ];
            
        return $response;
    }
}
