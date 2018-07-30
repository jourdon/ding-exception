# 通过钉钉推送机器人消息推送Laravel异常

[![Latest Stable Version](https://poser.pugx.org/jourdon/ding-exception/version)](https://github.com/jourdon/ding-exception)
[![Total Downloads](https://poser.pugx.org/jourdon/ding-exception/downloads)](https://packagist.org/packages/jourdon/ding-exception)
[![License](https://poser.pugx.org/jourdon/ding-exception/license)](https://packagist.org/packages/jourdon/ding-exception)

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
#### 是否显示Trace 默认为关闭
```
DING_TRACE=false
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
## 示例
![file](https://lccdn.phphub.org/uploads/images/201807/30/10512/yO9UoTEPfw.png?imageView2/2/w/1240/h/0)