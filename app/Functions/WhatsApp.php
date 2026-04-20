<?php

namespace App\Functions;

use Modules\Order\Entities\Model as Order;

class WhatsApp
{
    public static function SendOTP($phone, $code = null)
    {
        $otp = $code ?? rand(100000, 999999);
        // dd($otp);
        $body = '';
        $body .= '%0a *'.env('APP_NAME').'* %0a';
        $body .= '%0a *Your Verification Code Is* '.$otp.' %0a';
        $body .= '%0a Powered By *Emcan Solutions*';

        self::SendWhatsApp($phone, $body);

        return $otp;
    }

    public static function SendOrder($id)
    {
        $Order = Order::where('id', $id)->with(['Client', 'Address' => ['Region', 'Country'], 'Payment', 'Products.Items'])->firstorfail();
        $message = '%0a *An Order Has Been Placed By '.$Order->Client->name.' ('.env('APP_NAME').')* %0a';
        $message .= '%0a *Order Number :* '.$Order->id;

        $message .= '%0a *Client Name :* '.$Order->Client->name;
        $message .= '%0a *Client Number :* '.$Order->Client->phone;
        $message .= '%0a *Order Time :* '.$Order->created_at;

        if (isset($Order->Address) && isset($Order->Address->Region)) {

            $message .= '%0a *Country :* '.$Order->Address->Country->title_en;
            if ($Order->Address->Country->id == 1) {
                $message .= '%0a *Region :* '.$Order->Address->Region->title_en;
                $message .= '%0a *Block :* '.$Order->Address->block;
                $message .= '%0a *Road :* '.$Order->Address->road;
            } else {
                $message .= '%0a *City :* '.$Order->Address->Region->title_en;
                $message .= '%0a *District :* '.$Order->Address->block;
                $message .= '%0a *Street :* '.$Order->Address->road;
            }
            $message .= '%0a *Building Number :* '.$Order->Address->building_no;
            $message .= '%0a *Floor Number :* '.$Order->Address->floor_no;
            $message .= '%0a *Apartment :* '.$Order->Address->apartment;
            $message .= '%0a *Additional Directions :* '.$Order->Address->additional_directions.' %0a';
        }

        $message .= '%0a';
        $message .= '%0a *Products :* ';
        $message .= '%0a';
        foreach ($Order->Products as $Item) {
            $message .= '%0a *Item :* '.strip_tags(str_replace('&', ' ', $Item->Product->title_en));
            foreach ($Item->Items as $Option) {
                $message .= '%0a'.strip_tags(str_replace('&', ' ', $Option->title_en));
            }
            $message .= '%0a *Price :* '.number_format(Country()->currancy_value * $Item->price, Country()->decimals, '.', '').' '.Country()->currancy_code;
            $message .= '%0a *Quantity :* '.$Item->quantity;
            $message .= '%0a *Total :* '.number_format(Country()->currancy_value * $Item->total, Country()->decimals, '.', '').' '.Country()->currancy_code;
            $message .= '%0a';
            $message .= '%0a';
        }

        $message .= '%0a *SubTotal :* '.number_format(Country()->currancy_value * $Order->sub_total, Country()->decimals, '.', '').' '.Country()->currancy_code;
        if ($Order->discount > 0) {
            $message .= '%0a *Discount :* '.number_format(Country()->currancy_value * $Order->discount, Country()->decimals, '.', '').' '.Country()->currancy_code;
        }
        if ($Order->vat > 0) {
            $message .= '%0a *VAT :* '.number_format(Country()->currancy_value * $Order->vat, Country()->decimals, '.', '').' '.Country()->currancy_code;
        }
        if ($Order->coupon > 0) {
            $message .= '%0a *Coupon :* '.number_format(Country()->currancy_value * $Order->coupon, Country()->decimals, '.', '').' '.Country()->currancy_code;
        }
        if ($Order->charge_cost > 0) {
            $message .= '%0a *Delivery Cost :* '.number_format(Country()->currancy_value * $Order->charge_cost, Country()->decimals, '.', '').' '.Country()->currancy_code;
        }
        $message .= '%0a *NetTotal :* '.number_format(Country()->currancy_value * $Order->net_total, Country()->decimals, '.', '').' '.Country()->currancy_code;
        $message .= '%0a  %0a';

        $message .= '%0a *Powered By Emcan Solutions* %0a';

        self::SendWhatsApp($Order->Client->Country->phone_code.$Order->Client->phone, $message);
        self::SendWhatsApp(setting('whatsapp'), $message);
    }

    public static function SendWhatsApp($numbers, $message)
    {
        $EmcanWhats = self::GetToken();
        $instance = $EmcanWhats->instance;
        $token = $EmcanWhats->token;
        if ($EmcanWhats->active) {
            $numbers = is_array($numbers) ? $numbers : [$numbers];
            foreach ($numbers as $number) {
                $number = str_replace('++', '+', $number);
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => 'https://api.ultramsg.com/'.$instance.'/messages/chat',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => "token=$token&to=$number&body=$message&priority=1&referenceId=",
                    CURLOPT_HTTPHEADER => [
                        'content-type: application/x-www-form-urlencoded',
                    ],
                ]);
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                
                \Log::info('WhatsApp Response:', [
                            'number' => $number,
                            'response' => $response,
                            'error' => $err,
                        ]);

            }
        }
    }

    public static function GetToken()
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://emcan.bh/api/UltraCredentials',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POSTFIELDS => 'token=zuvzajw7goMh20q5YVu0&domain='.$_SERVER['SERVER_NAME'],
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => [
                'content-type: application/x-www-form-urlencoded',
            ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        return json_decode($response);
    }
}
