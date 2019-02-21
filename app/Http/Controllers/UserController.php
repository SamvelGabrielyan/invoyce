<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Model\User;
use App\Model\Industries;
use App\Model\UserBillings;
use App\Model\PasswordReset;
use App\Http\Controllers\Controller;

use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ForgotPasswordResetRequest;

use View, Validator, Input, Redirect, Auth, URL, Uuid, Hash;

class UserController extends Controller {
	public function __construct() {
		parent::__construct();
	}

    /**
     * Showing registration page.
     *
     * @since 1.0.1
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function showRegister(Request $request)
    {
		$firstName  = ($request->first_name) ? $request->first_name : '';
        $email      = ($request->email_address) ? $request->email_address : '';
        $title      = "Create an Account";
		$industries = Industries::where('status','=','1')
            ->lists('name','id')
            ->toArray();

		$data = [
            'Industries'    => $industries,
            'title'         => $title,
            'first_name'    => $firstName,
            'email_address' => $email
        ];

		return view('users.register', $data);
	}

    /**
     * Register User.
     *
     * @since 1.0.1
     *
     * @param RegistrationRequest $request
     * @return mixed
     */
	public function registerPost(RegistrationRequest $request)
    {
		$userObj = new User();
		$userObj->uuid       = Uuid::generate();
		$userObj->first_name = $request->first_name;
		$userObj->last_name  = $request->last_name;
		$userObj->company    = $request->company_name;
		$userObj->user_type  = 'Client';
		$userObj->status     = 'Pending-Payment';
		$userObj->industry   = $request->industry;
		$userObj->email      = $request->email;
		$userObj->password   = Hash::make($request->password);
		$userObj->save();
		
		Auth::attempt(['email' => $request->email, 'password' => $request->password], 1);
		
		$body = view('emails.welcome', [
		    'user_info' => $request->all()
        ])->render();

		$dataEmail = ['to'=>$request->email ,'subject'=>'Welcome to Invoyce','body'=>$body];
		_mail($dataEmail);

		//return Redirect::to(route('dashboard/apps'));
		return Redirect::to(route('paymentGateway'));
	}

    /**
     * Show login page.
     *
     * @return mixed
     */
	public function login()
    {
		$title = "login";

		return view('users.login', compact('title'));
	}

    /**
     * Login user and redirect to dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginPost(Request $request)
    {
		$data = $request->except('_token');

		if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']], isset($post['remember_me']) ? 1 : 0)) {
           return Redirect::back()
               ->withInput()
               ->withErrors(['Sorry! You have entered invalid email or password, Please try again.'] );
        }
        
		return redirect()->to(route('dashboard'));
    }

    /**
     * Forgot password page.
     *
     * @return mixed
     */
	public function forgotPassword()
    {
		$title = "Reset Password";

		return view('users.forgot-password', compact('title'));
	}

    /**
     * Forgot password.
     * Send password reset link.
     *
     * @param ForgotPasswordRequest $request
     * @return mixed
     */
	public function forgotPasswordPost(ForgotPasswordRequest $request)
    {
		$email = $request->email;
		$user  = User::where('email', $email)->first();

		if($user && !empty($user)) {
			if($user->status == 'In-active') {
				return Redirect::back()
                    ->withInput()
                    ->withErrors([
                        'Sorry! Your account has been In-Active, Please contact with site administrator. Thanks'
                    ]);
			}

			$token = Hash::make(Uuid::generate());
			
			PasswordReset::where('email', $email)->delete();
			PasswordReset::insert([
			    'email'      => $email,
                'token'      => $token,
                'created_at' => date('Y-m-d H:i:s')
            ]);
			
			$body = View::make('emails.forgot_password', [
			    'user_info' => $user,
                'token'     => $token
            ])->render();

			$dataEmail = [
			    'to'      => $email,
                'subject' => 'Forgot Password Link Email Received.',
                'body'    => $body
            ];
			_mail($dataEmail);

			return Redirect::back()
                ->with('success','Your reset password link has been sent to your email.');
		}else{
			return Redirect::back()
                ->withInput()
                ->withErrors(['Sorry! Our system cannot find this email, Please try with valid email address.']);
		}
    }

    /**
     * Forgot password reset link.
     *
     * @since 1.0.1
     *
     * @uses UserController::getEmailAndToken()
     * @uses UserController::checkPasswordToken()
     *
     * @param $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function forgotPasswordResetLink($token)
    {
		$data   = $this->getEmailAndToken($token);
		$record = PasswordReset::where('token', $data['dbToken'])
            ->where('email', $data['email'])
            ->first();

		$error = ($this->checkPasswordToken($record)) ? $this->checkPasswordToken($record) : '';

		return view('users.reset_password', [
		    'error' => $error,
            'token' => $token
        ]);
	}

    /**
     * Forgot Password Reset link.
     *
     * @since 1.0.1
     *
     * @uses UserController::getEmailAndToken()
     * @uses UserController::checkPasswordToken()
     *
     * @param ForgotPasswordResetRequest $request
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forgotPasswordResetLinkPost(ForgotPasswordResetRequest $request, $token)
    {
	    $post = Input::all();
		$data = $this->getEmailAndToken($token);

		$record = PasswordReset::where('token', $data['dbToken'])
            ->where('email', $data['email'])
            ->first();

		$error = $this->checkPasswordToken($record);

		if (!$error) {
			$dataToUpdate = [
			    'password' => Hash::make($post['password'])
            ];

			User::where('email','=', $data['email'])->update($dataToUpdate);
			PasswordReset::where('email', $data['email'])->delete();
			
			$body = View::make('emails.forgot_password_thanks', [
			    'email' => $data['email']
            ])->render();

			$dataEmail = ['to'=> $data['email'], 'subject'=>'Password Updated Successfully.', 'body'=>$body];
			_mail($dataEmail);
			
			return redirect()->to(route('login'))
                ->with('success','Your password has been reset successfully, Please login with your new password. Thanks');
		}else{
			return Redirect::back();	
		}
	}

    /**
     * User logout.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
	public function logout() {
        Auth::logout();
        //return Redirect::back();
		return redirect()->to(route('index'));
    }

    /**
     * Getting token and email from token.
     *
     * @since 1.0.1
     *
     * @internal
     * @used-by UserController::forgotPasswordResetLink()
     * @used-by UserController::forgotPasswordResetLinkPost()
     *
     * @param $token
     * @return array
     */
    private function getEmailAndToken($token)
    {
        $getToken = _decode($token);
        $getToken = explode('####', $getToken);
        $email 	  = urldecode($getToken[0]);
        $dbToken  = urldecode($getToken[1]);

        return [
            'email'   => $email,
            'dbToken' => $dbToken,
        ];
    }

    /**
     * Checking password token based on record.
     *
     * @since 1.0.1
     *
     * @internal
     * @used-by UserController::forgotPasswordResetLink()
     * @used-by UserController::forgotPasswordResetLinkPost()
     *
     * @param $record
     * @return bool|string
     */
    private function checkPasswordToken($record)
    {
        $error = false;

        if (empty($record)) {
            $error = 'Sorry! Your password token is invalid.';

            return $error;
        } else {
            $toTime    = $record->created_at;
            $hoursPast = calculate_time_span($toTime);

            if ($hoursPast > 2) {
                $error = 'Sorry! Your password token has been expired.';
            }
        }

        return $error;
    }
}
