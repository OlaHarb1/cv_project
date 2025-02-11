<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
class JsonResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $result = $next($request);
        if ($result->exception == null) {
            $data = $result->getOriginalContent();
            $message = 'Success';
            if(gettype( $result->getOriginalContent())=='array'){
                if(array_key_exists('message',$data) ){
                    $message=$data['message'];
                    $data=collect($result->getOriginalContent())->except(['message']);
                }
            }elseif (gettype( $result->getOriginalContent())=='string' ) {
                $message = $result->getOriginalContent();
                $data = null;
            }
            $result = response()->json([
                "success" => true,
                "data" =>$data,
                "message" =>$message
            ]);
        }
        return $result;
    }
}
