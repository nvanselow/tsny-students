<?php

namespace Tsny\Http\Middleware;

use Closure;
use Tsny\Models\RegistrationCodes;

class CheckRegistrationCode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->has('registration_code')){
            return redirect()->back()->withErrors(['Please enter a valid registration code.'])->withInput();
        }

        $registration_code = RegistrationCodes::where('code', strtolower($request->input('registration_code')))->first();

        if(!$registration_code){
            return redirect()->back()->withInput()->withErrors(['That registration code does not exist. Please check the registration code and try again.']);
        }

        return $next($request);
    }
}
