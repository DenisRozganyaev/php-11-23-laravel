<?php

namespace App\Http\Controllers\Callbacks;

use App\Http\Controllers\Controller;
use Azate\LaravelTelegramLoginAuth\TelegramLoginAuth;
use Illuminate\Http\Request;

class JoinTelegramCallback extends Controller
{
    public function __invoke(TelegramLoginAuth $validator, Request $request)
    {
        $data = $validator->validate($request);

        auth()->user()->update([
            'telegram_id' => $data->getId()
        ]);

        notify()->success('You were added to our telegram bot', position: 'topRight');
        return redirect()->route('admin.dashboard');
    }
}
