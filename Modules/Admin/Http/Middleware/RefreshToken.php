<?php

namespace Modules\Admin\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class RefreshToken extends BaseMiddleware
{

    public function handle($request, Closure $next)
    {
        //BaseMiddleware内方法
        $this->checkForToken($request);

        try{
            if ($userInfo = $this->auth->parseToken()->authenticate()) {
                return $next($request);
            }
            throw new UnauthorizedHttpException('jwt-auth', '未登录');
        } catch (TokenExpiredException $exception){
            //是否可以刷新,刷新后加入到响应头
            try{
                $token = $this->auth->refresh();
                // 使用一次性登录以保证此次请求的成功
                Auth::guard('api')->onceUsingId($this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray()['sub']);
                $request->headers->set('Authorization','Bearer '.$token);
            }catch(JWTException $exception){
                throw new UnauthorizedHttpException('jwt-auth', $exception->getMessage());
            }
        }
        return $this->setAuthenticationHeader($next($request), $token);
    }
}
