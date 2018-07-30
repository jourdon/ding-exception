<?php
namespace Jourdon\DingException;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DingExceptionJob /*implements ShouldQueue*/
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $hookUrl = 'https://oapi.dingtalk.com/robot/send?access_token=';

    private $exception;

    private $config;

    public function __construct($exception,$config)
    {
        $this->exception = $exception;
        $this->config = $config;
    }
    public function handle()
    {
        $message = [
            'Time                 :   ' . Carbon::now()->toDateTimeString(),
            'Environment   :   ' . config('app.env'),
            'Project Name  :   ' . config('app.name'),
            'IP                     :   '.request()->getClientIp(),
            'Url                   :   ' . $this->getUrl(),
            'Request          :   '.json_encode(request()->all()),
            'Method           :   '.request()->getMethod(),
            'Exception       :   ' . $this->getException(),
            $this->config['trace']??'Trace            :    '.$this->getTrace(),
        ];
        try {
            $data = [
                'msgtype' => 'text',
                'text' => [
                    'content' => implode(PHP_EOL, $message)
                ]
            ];

            $http = new Client();
            $http->post($this->getWebhook(),[
                'body' => json_encode($data),
                'headers' => [
                    'Content-Type' => 'application/json',
                ]
            ]);
        } catch (\Exception $exception) {
            logger($exception->getMessage());
        }
    }

    public function getWebhook(){
        return $this->hookUrl .$this->config['token'];
    }

    public function getUrl()
    {
        return \request()->fullUrl();
    }
    public function getFile()
    {
        return $this->exception->getFile();
    }
    public function getLine()
    {
        return $this->exception->getLine();
    }

    public function getCode()
    {
        return $this->exception->getCode();
    }
    public function getTrace()
    {
        return $this->exception->getTraceAsString();
    }
    public function getErrorMsg()
    {
        return get_class($this->exception);
    }

    public function getMessage()
    {
        return $this->exception->getMessage();
    }
    public function getException()
    {
        return $this->getErrorMsg()."(code:".$this->getCode()."): [".$this->getMessage(). "]  at ".$this->getFile().":第".$this->getLine().'行';
    }
}