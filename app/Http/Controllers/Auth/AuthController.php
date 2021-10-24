<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\Actions\CreateNewUser;
use App\Http\Controllers\Auth\Actions\LoginUser;
use App\Http\Controllers\Auth\Actions\LogoutUser;
use App\Http\Controllers\Auth\Actions\ResetUserPassword;
use App\Http\Controllers\Auth\Actions\UpdateUserPassword;
use App\Http\Controllers\Auth\Actions\UpdateUserProfileInformation;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\NewAccessToken;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $action = new CreateNewUser();
        if (($result = $action->create($request->all())) instanceof User)
            return response()->json([
                'success' => true,
                'user' => $result
            ]);
        return $this->_errors($result);
    }
    public function login(Request $request)
    {
        $action = new LoginUser();
        if (($result = $action->check($request->all())) instanceof NewAccessToken)
            return response()->json([
                'success' => true,
                'token' => $result->plainTextToken
            ]);
        return $this->_errors($result);
    }
    public function logout(Request $request)
    {
        $action = new LogoutUser();
        $action->logout($request->user());
        return response()->json([
            'success' => true
        ]);
    }
    public function reset(Request $request)
    {
        return $this->_update(new ResetUserPassword, $request);
    }
    public function updatePassword(Request $request)
    {
        return $this->_update(new UpdateUserPassword, $request);
    }
    public function updateUser(Request $request)
    {
        return $this->_update(new UpdateUserProfileInformation, $request);
    }

    private function _update($action, $request)
    {
        if (($result = $action->update($request->user(), $request->all())) === true)
            return response()->json([
                'success' => true
            ]);
        return $this->_errors($result);
    }
    private function _errors(array $errors)
    {
        return
            response()->json([
                'success' => false,
                'errors' => $errors
            ]);
    }
}
