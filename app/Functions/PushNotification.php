<?php

namespace App\Functions;

use Illuminate\Support\Facades\Log;
use Modules\Notification\Entities\Model as Notification;

class PushNotification
{
    public static function send($message, $data, $receiver_id = null, $receiver_type = 'client')
    {
        Log::info('📤 Push send called', compact('receiver_id', 'receiver_type', 'message', 'data'));

        // ✅ split Arabic / English
        $title_ar = is_array($message) ? ($message['ar'] ?? '') : $message;
        $title_en = is_array($message) ? ($message['en'] ?? $title_ar) : $message;

        switch ($receiver_type) {
            case 'client':
                $tokens = \Modules\Client\Entities\DeviceToken::where('client_id', $receiver_id)
                    ->whereNotNull('device_token')
                    ->pluck('device_token');

                $notifiableType = 'Modules\\Client\\Entities\\Model';
                break;

            default:
                $tokens = collect([]);
                $notifiableType = null;
        }

        Log::info('📱 Tokens fetched', [
            'count' => $tokens->count(),
            'tokens' => $tokens->toArray()
        ]);

        if ($tokens->isEmpty()) {
            Log::warning('❌ No tokens found', ['receiver_id' => $receiver_id]);
        }

        // ✅ store notification in DB (AR + EN)
        if ($receiver_id && $notifiableType) {
            self::storeNotification(
                $receiver_id,
                $notifiableType,
                $title_ar,
                $title_en,
                $data
            );
        }

        // send push
        foreach ($tokens as $token) {

            if (!$token) {
                Log::warning('⚠️ Empty token skipped');
                continue;
            }

            Log::info('🚀 Sending to token', ['token' => $token]);

            self::send_notification($title_ar, $data, $token);
        }
    }

    public static function send_notification($message, $data, $token)
    {
        $notification = [
            'message' => [
                'token' => $token,
                'notification' => [
                    'title' => env('APP_NAME'),
                    'body' => $message,
                ],
                'data' => array_map('strval', $data),
            ],
        ];

        $encodedData = json_encode($notification);

        $headers = [
            'Authorization: Bearer ' . self::getToken(),
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/v1/projects/tayet-app/messages:send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);

        $result = curl_exec($ch);

        if ($result === false) {
            Log::error('❌ Curl failed', ['error' => curl_error($ch)]);
            curl_close($ch);
            return null;
        }

        $responseData = json_decode($result, true);

        Log::info('✅ FCM response', ['response' => $result]);

        curl_close($ch);

        return $responseData;
    }

    public static function storeNotification($receiver_id, $receiver_type, $title_ar, $title_en, $data = [])
    {
        Notification::create([
            'title_ar' => $title_ar,
            'title_en' => $title_en,
            'body_ar'  => $title_ar,
            'body_en'  => $title_en,
            'type'     => $data['type'] ?? null,
            'notifiable_id' => $receiver_id,
            'notifiable_type' => $receiver_type,
            'data' => $data,
        ]);
    }

    public static function getToken()
    {
        Log::info('getting FCM access token');

        $keyFilePath = public_path('firebase.json');
        $keyData = json_decode(file_get_contents($keyFilePath), true);

        $header = ['alg' => 'RS256', 'typ' => 'JWT'];

        $now = time();

        $claims = [
            'iss' => $keyData['client_email'],
            'scope' => 'https://www.googleapis.com/auth/cloud-platform',
            'aud' => 'https://oauth2.googleapis.com/token',
            'exp' => $now + 3600,
            'iat' => $now,
        ];

        $base64UrlHeader = self::base64UrlEncode(json_encode($header));
        $base64UrlClaims = self::base64UrlEncode(json_encode($claims));

        $signatureInput = $base64UrlHeader . '.' . $base64UrlClaims;

        openssl_sign($signatureInput, $signature, $keyData['private_key'], 'sha256WithRSAEncryption');

        $base64UrlSignature = self::base64UrlEncode($signature);

        $jwt = $signatureInput . '.' . $base64UrlSignature;

        $postFields = http_build_query([
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $jwt,
        ]);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://oauth2.googleapis.com/token');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);

        $response = curl_exec($ch);

        if ($response === false) {
            Log::error('Curl failed to get token', ['error' => curl_error($ch)]);
            curl_close($ch);
            return null;
        }

        $responseData = json_decode($response, true);

        curl_close($ch);

        return $responseData['access_token'] ?? null;
    }

    private static function base64UrlEncode($data)
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
    }
}
