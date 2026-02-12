<?php

namespace App\Http\Controllers\Doctors\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
   use SendsPasswordResetEmails;

    public function getForgotPassword(){
        return view('doctors.auth.forgot');
    }
    //
     public function reset(Request $request)
    {
       $this->validateEmail($request);
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($request, $response)
                    : $this->sendResetLinkFailedResponse($request, $response);
    }
      protected function validationErrorMessages()
   {
     return [
          'email.required' => 'Email không để trống',
          'email.email' => 'Email không đúng định dạng',

     ];
   }

   public function broker()
    {
        return Password::broker('doctors');
    }
}
