<?php

namespace SantosSabanari\LaravelFoundation\Http\Controllers;

use SantosSabanari\LaravelFoundation\Http\Requests\EditUserPasswordRequest;
use SantosSabanari\LaravelFoundation\Http\Requests\UpdateUserPasswordRequest;
use App\Models\User;
use SantosSabanari\LaravelFoundation\Services\UserService;
use App\Http\Controllers\Controller;

/**
 * Class UserPasswordController.
 */
class UserPasswordController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * UserPasswordController constructor.
     *
     * @param  UserService  $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param  EditUserPasswordRequest  $request
     * @param  User  $user
     *
     * @return mixed
     */
    public function edit(EditUserPasswordRequest $request, User $user)
    {
        return view('laravel-foundation::system.user.change-password')
            ->withUser($user);
    }

    /**
     * @param  UpdateUserPasswordRequest  $request
     * @param  User  $user
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateUserPasswordRequest $request, User $user)
    {
        $this->userService->updatePassword($user, $request->validated());

        return redirect()->route('backend.system.user.index')->withFlashSuccess(__('The user\'s password was successfully updated.'));
    }
}
