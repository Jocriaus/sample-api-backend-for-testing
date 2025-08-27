<?php

namespace App\Services;
use App\Models\Manufacturer;
class ManufacturerService
{
    /**
     * Create a new ManufacturerService instance.
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
    public function storeManufacturer(array $data)
    {
        Manufacturer::create([
            'name' => $data['name'],
            'country_of_origin' => $data['country_of_origin'],
            'website' => $data['website'],
            'contact_email' => $data['contact_email'],
            'founded_year' => $data['founded_year'],
        ]);

        $response = [
            'is_success' => true,
            'message '=> 'Manufacturer added successfully.',
        ];
            
        return $response; // Placeholder return
    }

    public function viewManufacturers(?string $limit = null, ?string $search_query = null, ?string $pagination = null)
    {
        $query = Manufacturer::query();

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
                    'name','country_of_origin','website','contact_email','founded_year',
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

    public function viewManufacturer()
    {

        $manufacturer = Manufacturer::all()->random();
        
        return $manufacturer;
    }


    public function updateManufacturer($id, array $data)
    {
        $manufacturer = Manufacturer::find($id);

        if (!$manufacturer) {
            $response = [
                'is_success' => false,
                'message '=> 'A manufacturer not found.',
            ];

            return $response;
        }

        $manufacturer->first_name = $data['first_name'];
        $manufacturer->last_name = $data['last_name'];
        $manufacturer->email = $data['email'];
        $manufacturer->phone_number = $data['phone_number'];
        $manufacturer->gender = $data['gender'];
        $manufacturer->address = $data['address'];
        $manufacturer->city = $data['city'];
        $manufacturer->state = $data['state'];
        $manufacturer->zip_code = $data['zip_code'];
        $manufacturer->country = $data['country'];

        $manufacturer->save();

        $response = [
            'is_success' => true,
            'message '=> 'A manufacturer record was updated successfully.',
        ];
            
        return $response;
    }

    public function deleteManufacturer($id)
    {
        $manufacturer = Manufacturer::find($id);

        if (!$manufacturer) {
            $response = [
                'is_success' => false,
                'message '=> 'This can\'t be deleted, manufacturer not found.',
            ];

            return $response;
        }
        
        $manufacturer->delete();

        $response = [
            'is_success' => true,
            'message '=> 'A manufacturer record updated successfully.',
        ];
            
        return $response;
    }
}
