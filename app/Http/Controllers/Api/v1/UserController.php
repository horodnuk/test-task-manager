<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{

    public function index(): JsonResponse
    {
        $users = new UserCollection(User::paginate());

        return new JsonResponse($users);
    }
}
