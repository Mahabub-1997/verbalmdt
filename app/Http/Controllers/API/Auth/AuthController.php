<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordOtp;
use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // ------------------------
    // REGISTER
    // ------------------------
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
        ], 201);
    }

    // ------------------------
    // LOGIN
    // ------------------------
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    try {
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    } catch (JWTException $e) {
        return response()->json(['message' => 'Could not create token'], 500);
    }

    $user = Auth::user(); // authenticated user
// dd($user);
    return response()->json([
        'user' => $user,
        'token' => $token, // this is the JWT token
        'token_type' => 'bearer',
    ]);
}

    // ------------------------
    // LOGOUT
    // ------------------------
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out',
        ]);
    }

    // ------------------------
    // REQUEST OTP (for logged-in user password change)
    // ------------------------
    public function requestOtp(Request $request)
    {
        $user = Auth::user();

        // Generate 6-digit OTP
        $otp = rand(100000, 999999);

        // Save OTP with 5 min expiry
        PasswordOtp::updateOrCreate(
            ['user_id' => $user->id],
            ['otp' => $otp, 'expires_at' => Carbon::now()->addMinutes(5)]
        );

        // TODO: Send OTP via email/SMS
        // For testing, return OTP in response
        return response()->json([
            'message' => 'OTP sent',
            'otp' => $otp,
        ]);
    }

    // ------------------------
    // VERIFY OTP & UPDATE PASSWORD (for logged-in user)
    // ------------------------
    public function verifyOtpAndUpdate(Request $request)
    {
        $request->validate([
            'otp' => 'required',
            'new_password' => 'required|string|confirmed',
        ]);

        $user = Auth::user();

        $passwordOtp = PasswordOtp::where('user_id', $user->id)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (!$passwordOtp) {
            return response()->json(['message' => 'Invalid or expired OTP'], 400);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        $passwordOtp->delete();

        return response()->json([
            'message' => 'Password updated successfully',
        ]);
    }

    // ------------------------
    // FORGOT PASSWORD: SEND OTP via Email
    // ------------------------
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        $otp = rand(100000, 999999);

        PasswordOtp::updateOrCreate(
            ['user_id' => $user->id],
            ['otp' => $otp, 'expires_at' => now()->addMinutes(5)]
        );

        // Send OTP via email
        Mail::raw("Your password reset OTP is: $otp", function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Password Reset OTP');
        });

        // Return OTP in response (for testing purposes)
        return response()->json([
            'message' => 'OTP sent to your email',
            'otp' => $otp,
        ]);
    }

    // ------------------------
    // FORGOT PASSWORD: VERIFY OTP
    // ------------------------
    public function verifyOtpForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:6',
        ]);

        $user = User::where('email', $request->email)->first();

        // Get OTP record from password_otps table
        $passwordOtp = PasswordOtp::where('user_id', $user->id)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (!$passwordOtp) {
            return response()->json(['message' => 'Invalid or expired OTP'], 400);
        }

        // OTP is valid, delete it
        $passwordOtp->delete();

        // Set a flag in user table to allow password reset
        $user->otp_verified_at = now();
        $user->save();

        return response()->json([
            'message' => 'OTP verified successfully',
        ]);
    }

    // ------------------------
    // RESET PASSWORD (after OTP verified)
    // ------------------------
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'new_password' => 'required|string|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        // Check if OTP was verified
        if (!$user->otp_verified_at) {
            return response()->json(['message' => 'OTP not verified'], 400);
        }

        // Update password
        $user->password = Hash::make($request->new_password);

        // Clear OTP verified flag after reset
        $user->otp_verified_at = null;
        $user->save();

        return response()->json([
            'message' => 'Password reset successfully',
        ]);
    }
}
