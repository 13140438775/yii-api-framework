# Framework Instructions

## 框架介绍
糅合Swoole及YII2，借用Swoole的高性能及YII2的成熟组件，产出高性能真快API Framework，支持普通请求方式及restful api，默认restful。给各位小伙伴点赞!

**Framework**：Swoole+YII2 => HttpServer

**PHP Version**：PHP7.1.5

**HTTP Status Code**：
>
  Code  |  Description
------------- | -------------
200  | 请求成功
401  | token鉴权失败统一返回401
403  | 所有非业务异常统一返回403，包括参数异常、签名错误等
404  | uri not exist
500  | 服务器错误

>***Notice***：
>
>客户端接到401应静默调用/api_ver/user/token/refresh刷新token，成功则返回new token，否则返回业务异常【登录态失效】，客户端根据需要决定是否强制跳转登录页。

**Business Status Code**：
>
  Code  |  Description
------------- | -------------
0  | 请求成功
非0  | 业务异常，由具体业务定义。业务异常前端》直接取后台返回的异常msg展示

**Request Format**
>请求Body如果有值，后台只接收json方式传输参数，Content-Type:application/json。

**Response Format**：
>
后台统一返回json数据，请求统一返回格式：

>注意：非200请求返回与200请求返回区别仅在于没有data字段域，非200请求前端可使用后台返回msg进行展示，也可自定义。
>
```
{
    "code": 0,
    "msg": "success",
    "data":{
    	"hello":"world",
    	"users":[
    		{
    			"username":"上海",
    			"department":"研发部",
    			"staff":"程序员",
    			"attribute":"牛逼！"	
    		}
    	]
    }
```

## Features介绍

项目可做app及web api提供方，app主要用做给native application提供api接口，web为web application提供api。

### Native & Web Framework区别

#### 1、header必传参数区别 
>**Native App必传参数**
>>
Header Name  |  Description
------------- | -------------
app-id  | appid
app-version  | app版本
request-id  | 请求ID，客户端保证全局唯一
request-time  | 请求时间
signature  | 请求签名
platform  | 系统平台：ios、android
device-name  | 设备名称：Mi 5
os-version  | 系统版本：7.0.0
token  | 用户token，可为空
user-agent  | 自定义user agent

>**Web App必传参数**  
>>
Header Name  |  Description
------------- | -------------
app-id  | appid
app-version  | app版本
token  | 用户token，可为空

#### 2、请求校验区别
>Native App需要进行请求校验，包括请求超时、重放请求、签名验证，Web App不需要这些校验。

#### 3、Token机制区别
>Native App采用普通32位随机字符串token，存在用户token及refresh token，后者在其过期时间内可刷新前者，仅可使用一次。

>Web App采用单一JWT Token，token过期后，在缓冲期内可自我刷新一次。


### 签名机制
将request-id、request-time、signature key(由后台提供)与请求参数体的json串按升序排序后拼接成字符串，再进行SHA1加密。

>PHP Example
>
```
	$arr = [
            $versionSignKey,
            $timestamp,
            $requestId,
            json_encode($_POST),
   ];  
   sort($arr, SORT_STRING);
   $dictStr = implode($arr);
   $encryptStr = sha1($dictStr);
```

### 参数过滤
>默认开启参数过滤，清洗XSS及SQL等攻击注入。

### 配置管理
>params目录下存放runtime相关的配置。
>>
>email.php => 接口500及响应超时报警配置
>>
>log.php => log配置
>>
>params.php => 配置runtime常量
>>
>route.php => 配置资源路由
>>
>rule.php => 配置参数校验规则
>>
>filter.php => 配置路由在不同检验器下的行为
>
>***Notice***：
>
>如果新增了别的配置，需在params.php增加引用。


## Benchmark

内网压测数据如下，自行对比参考。

Swoole+YII2 benchmark 4C8G8worker
5000 concurrence 1000000 requests  

#### PHP 5.4 
>
>with log 7310.21qps zero fail load 11.0左右 mean_time 683.975ms
>
>without log 10494.17qps zero fail  load 9.0左右 mean_time 476.455ms

#### PHP 5.6
>
>with log 7271.29qps zero fail load 11.0左右 mean_time 687.636ms
>
>without log 10552.19qps zero fail  load 9.0左右 mean_time 473.835ms

#### PHP 7.2.3
>
>with log 10327.91qps zero fail load 9.2左右 mean_time 484.125ms
>
>without log 12957.31qps zero fail  load 5.5左右 mean_time 385.882ms

#### Nginx+PHP-FPM+YII2
>
>Requests per second:   150.64  


## 鸣谢
@Swoole @YII @彭彪 @方星 