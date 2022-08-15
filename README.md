Laravel 开发API开发的基础模块

## 统一 Response 响应

1、返回成功信息
```php
return $this->success($data);
```
2、返回失败信息
```php
return $this->fail($codeResponse);
```
3、抛出异常
```php
$this->throwBusinessException([Code::DELETED_ERROR, Code::getDescription(Code::DELETED_ERROR)]);
```
4、分页
```php
return $this->successPaginate($data);
```
## 统一表单参数输入校验

### 使用
1、验证参数是否为ID
```php
$this->verifyId('key');
```
2、验证参数是否为整数
```php
$this->verifyInteger('key');
```
3、验证参数是否为字符串
```php
$this->verifyString('key');
```
4、验证参数是否为布尔值
```php
$this->verifyBoolean('key');
```
....
