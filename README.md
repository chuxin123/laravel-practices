## 一、项目简介
Laravel9 实践

## 二、目录结构
    -- Console/Commands  任务调度目录，如Nacos配置拉取，监听等
    -  Constants  常量目录，存放内容如Redis key等等
    -  Enums  枚举集合目录
    -  Exceptions 异常错误捕获，渲染类异常错误重定向
    -  Factories  工厂集合目录
    -  Helpers  通用方法类，存放内容如Redis 锁、布隆过滤器，以及一些通用方法
    -- Http/Controllers  控制器目录，负责处理请求参数验证，并与服务进行交互，输出响应
    -- Http/Middleware  中间件目录，如鉴权，全局上下文request_id，请求响应记录，限流等
    -- Http/Requests  请求参数验证规则
    -- Http/Response  响应结果格式化
    -- Http/Services  业务处理服务，接受与处理控制器请求
    -- Logging  自定义日志驱动
    -- Models  数据模型类
    -- Providers  服务提供者
    -- Repositories 数据仓库
    -- Traits  Traits集合目录

## 三、部署方式
### 3.1 安装依赖
```bash
#执行composer依赖包安装
composer install
```
### 3.2 拉取配置
```bash
# 从Nacos拉取配置到本地
php artisan nacos:refresh
```
### 3.3 启动
```bash
# sail 模式启动
./vendor/bin/sail up
or
# docker 模式启动
docker-compose up -d --no-recreate
```
