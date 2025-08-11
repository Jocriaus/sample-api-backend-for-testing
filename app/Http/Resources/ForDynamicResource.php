<?php

// namespace App\Http\Resources;

// use Illuminate\Http\Request;
// use Illuminate\Http\Resources\Json\JsonResource;

// class UserResource extends JsonResource
// {
//     protected $format = 'default'; // A custom property to control format

//     public function __construct($resource, $format = 'default')
//     {
//         parent::__construct($resource);
//         $this->format = $format;
//     }

//     /**
//      * Transform the resource into an array.
//      *
//      * @return array<string, mixed>
//      */
//     public function toArray(Request $request): array
//     {
//         // Option A: Check the route name
//         if ($request->routeIs('users.index')) {
//             return $this->forUserIndex();
//         }

//         // Option B: Check the HTTP method (though routeIs is generally more specific)
//         if ($request->isMethod('get') && $request->routeIs('users.show')) {
//             return $this->forUserShow();
//         }

//         // Option C: Check a custom format passed via constructor
//         if ($this->format === 'short') {
//             return $this->forUserShort();
//         }

//         // Default or "full" format
//         return $this->forUserFull();
//     }

//     private function forUserIndex(): array
//     {
//         return [
//             'id' => $this->id,
//             'name' => $this->first_name . ' ' . $this->last_name,
//             'email' => $this->email,
//             // Only essential fields for a list view
//         ];
//     }

//     private function forUserShow(): array
//     {
//         return [
//             'id' => $this->id,
//             'first_name' => $this->first_name,
//             'middle_name' => $this->middle_name,
//             'last_name' => $this->last_name,
//             'email' => $this->email,
//             'department' => $this->whenLoaded('department', new DepartmentResource($this->department)),
//             'roles' => $this->whenLoaded('roles', RoleResource::collection($this->roles)),
//             'created_at' => $this->created_at->toDateTimeString(),
//             'updated_at' => $this->updated_at->toDateTimeString(),
//             // All detailed fields for a single view
//         ];
//     }

//     private function forUserShort(): array
//     {
//         return [
//             'id' => $this->id,
//             'full_name' => $this->first_name . ' ' . $this->last_name,
//             'email' => $this->email,
//         ];
//     }

//     private function forUserFull(): array
//     {
//         return [
//             'id' => $this->id,
//             'first_name' => $this->first_name,
//             'middle_name' => $this->middle_name,
//             'last_name' => $this->last_name,
//             'email' => $this->email,
//             'department_id' => $this->department_id,
//             'created_by' => $this->created_by,
//             'created_at' => $this->created_at->toDateTimeString(),
//             'updated_at' => $this->updated_at->toDateTimeString(),
//             'department' => new DepartmentResource($this->department), // Always load department for full
//             // ... all other fields including relationships
//         ];
//     }
// }


// How to use 

// use App\Http\Resources\UserResource;
// use App\Models\User;

// class UserController extends Controller
// {
//     public function index()
//     {
//         $users = User::paginate(10);
//         // UserResource will use forUserIndex() because of routeIs('users.index')
//         return UserResource::collection($users);
//     }

//     public function show(User $user)
//     {
//         // UserResource will use forUserShow() because of routeIs('users.show')
//         return new UserResource($user);
//     }

//     public function getShortUser(User $user)
//     {
//         // Example of passing a custom format flag
//         return new UserResource($user, 'short');
//     }
// }