<?php

namespace SantosSabanari\LaravelFoundation\Http\Controllers;

use SantosSabanari\LaravelFoundation\Http\Requests\ClearUserSessionRequest;
use App\Models\User;
use App\Http\Controllers\Controller;

/**
 * Class UserSessionController.
 */
class UserSessionController extends Controller
{
    /**
     * @param  ClearUserSessionRequest  $request
     * @param  User  $user
     *
     * @return mixed
     */
    public function update(ClearUserSessionRequest $request, User $user)
    {
        $user->update(['to_be_logged_out' => true]);

        return redirect()->back()->withFlashSuccess(__('The user\'s session was successfully cleared.'));
    }
}
