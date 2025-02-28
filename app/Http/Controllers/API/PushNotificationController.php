<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\DeviceToken;
use App\Traits\Notification;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Models\SocialProvider;
use App\Http\Controllers\Controller;

/**
* @group User Management
*
* APIs for User Management
*/
class PushNotificationController extends Controller
{

     /**
     * Set Device token
     * @bodyParam device_token string required device token for push notification
     *
     * @response{
     *  "status": "success",
     *   "message": "Successfully set fcm token"
     * }
     */
    public function setFcmToken(Request $request)
    {
        $request->validate([
            'device_token' => 'required'
        ]);
        try {
            DeviceToken::create(['user_id'=>$request->user()->id,'device_token'=>$request->device_token]);
            $response = [
                'status' => trans('app.Success'),
                'message' => trans('app.Successfully set fcm token'),
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'status' => 'failed',
                'message' => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }
}
