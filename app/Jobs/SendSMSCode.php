<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;

class SendSMSCode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $phone;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($phone)
    {
        //
        $this->phone = $phone;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(EasySms $easySms)
    {
        //
        //生成4位随机数，左侧补0
        $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);
        $code = 1234;
        \Cache::put($this->phone.'_code', $code, 10);

//        try {
//            $result = $easySms->send($this->phone, ['content' => "【白孟冉】您的验证码是{$code}。如非本人操作，请忽略本短信"]);
//            \Cache::put('code', $code, 10);
//        } catch (NoGatewayAvailableException $exception) {
//            $message = $exception->getException('yunpian')->getMessage();
//            \Log::error($message);
//        }
    }
}
