<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    public function index(): JsonResource
    {
        return UserResource::collection(User::all());
    }

    public function store(UserStoreRequest $request): JsonResource
    {
        $request['password'] = Hash::make($request['password']);
        $user = User::create($request->validated());

        return new UserResource($user);
    }

    public function show(User $user): JsonResource
    {
        return new UserResource($user);
    }

    public function update(UserUpdateRequest $request, User $user): JsonResource
    {
        $data = $request->validated();

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return new UserResource($user);
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return response()->json(['message' => 'Usuario eliminado con exito']);
    }
}
