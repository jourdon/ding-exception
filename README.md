# 通过钉钉推送机器人消息推送Laravel异常


## 安装

`composer require jourdon/ding-exception`


## 发布配置文件:

`php artisan vendor:publish --provider="Jourdon\DingException\DingExceptionServiceProvider"`

#### 钉钉启用开关 默认为开启
```
DING_ENABLED=true
```
#### 钉钉的推送token
(必选)发送钉钉机器人的token，
钉钉推送链接:https://oapi.dingtalk.com/robot/send?access_token=your-token
```
DING_TOKEN=your-token
```
## 使用方法

```
use Jourdon\DingException\DingException;

class Handler extends ExceptionHandler
{
//...
    public function report(Exception $exception)
    {
        DingException::notify($exception);
        parent::report($exception);
    }
//...
}


```