<?php

namespace App\Services;
use App\Models\Person;
use App\Http\Resources\PersonCollection;
class PersonService
{
    /**
     * Create a new PersonSevice instance.
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
    public function storePerson(array $data)
    {
        Person::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'gender' => $data['gender'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'zip_code' => $data['zip_code'],
            'country' => $data['country'],
        ]);

        $response = [
            'is_success' => true,
            'message '=> 'Person added successfully.',
        ];
            
        return $response; // Placeholder return
    }

    public function viewPersons(?string $limit = null, ?string $search_query = null, ?string $pagination = null)
    {
        $query = Person::query();

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
                    'first_name','last_name','email','phone_number',
                    'address', 'city', 'state', 'zip_code', 'country',
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

    public function viewPerson()
    {

        $person = Person::all()->random();
        
        return $person;
    }


    public function updatePerson($id, array $data)
    {
        $person = Person::find($id);

        if (!$person) {
            $response = [
                'is_success' => false,
                'message '=> 'A person not found.',
            ];

            return $response;
        }

        $person->first_name = $data['first_name'];
        $person->last_name = $data['last_name'];
        $person->email = $data['email'];
        $person->phone_number = $data['phone_number'];
        $person->gender = $data['gender'];
        $person->address = $data['address'];
        $person->city = $data['city'];
        $person->state = $data['state'];
        $person->zip_code = $data['zip_code'];
        $person->country = $data['country'];

        $person->save();

        $response = [
            'is_success' => true,
            'message '=> 'A person record was updated successfully.',
        ];
            
        return $response;
    }

    public function deletePerson($id)
    {
        $person = Person::find($id);

        if (!$person) {
            $response = [
                'is_success' => false,
                'message '=> 'This can\'t be deleted, person not found.',
            ];

            return $response;
        }
        
        $person->delete();

        $response = [
            'is_success' => true,
            'message '=> 'A person record updated successfully.',
        ];
            
        return $response;
    }
}
