<?php

namespace App\Http\Controllers\Auth;

use App\DTO\RegisterCustomerDto;
use App\Services\RegisterCustomerService;
use App\Http\Requests\RegisterCustomerRequest;

use Exception;
use Inertia\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;

class RegisteredCustomerController extends Controller
{
    public function __construct(protected RegisterCustomerService $service) {
        parent::__construct("Pages/Auth");
    }

    public function create(): Response
    {
        return $this->view("Register");
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterCustomerRequest $req): JsonResponse
    {
        try {
            $dto = RegisterCustomerDto::fromRequest($req);
            $user = $this->service->register($dto);

            event(new Registered($user));

            Auth::login($user);

            return $this->apiJsonResponse(201, "Data berhasil diproses", $user);
        } catch (Exception $err) {
            return $this->apiJsonResponse(400, "Data gagal diproses", $err->getMessage());
        }
    }
}
