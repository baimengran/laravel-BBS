<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/2
 * Time: 21:22
 */

namespace App\Exceptions;


use Illuminate\Http\Request;
use Throwable;

class DataBaseException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function report()
    {

    }

    public function render(Request $request)
    {
        //如果用户通过APi请求，则返回JSON格式的错误
        if ($request->expectsJson()) {
            return response()->json(['msg' => $this->message], $this->code);
        }
        //否则返回上一页，并带上错误信息
        return redirect()->back()->withErrors(['coupon_code' => $this->message]);
    }
}