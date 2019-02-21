<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\User;
use App\Model\UserBillings;
use App\Model\Invoice;
use App\Model\State;
use App\Model\PaymentSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Helpers\ImageHelper;
use View,
    HTML,
    Validator,
    Session,
    Input,
    Redirect,
    Auth,
    URL,
    Hash,
    Uuid,
    Mail;
class AccountController extends Controller {
    /**
     * Update profile information.
     *
     * @since 1.0.1
     *
     * @param Request $request
     * @return mixed
     */
    public function updateProfile(Request $request) {		
		
        $email = $request->input('email');
        $user = User::where('email', $email)
                ->where('id', '!=', Auth::user()->id)
                ->get();
        if (count($user) == 0) {
            
            //print_r($request->all());
            $phone_number= $request['phone'];
            $new_phone= preg_replace("/[^0-9]/", "", $phone_number);
            
            $validator = Validator::make($request->all(), [
                        'first_name' => 'regex:/^[a-zA-Z]+$/u',
                        'last_name' => 'regex:/^[a-zA-Z]+$/u',
                        $new_phone => 'numeric',
                        'zip_code' => 'numeric'
            ]);
            if ($validator->fails()) {
                Session::flash('special-chars-error', $validator->errors()->all());
                return Redirect::to(route('account'));
            }
            User::where('id', Auth::user()->id)->update([
                'email' => $email,
                'first_name' => $request->fname,
                'last_name' => $request->lname,
                'company' => $request->company ?? '',
                'tax_id' => $request->tax_id ?? '',
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code
            ]);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                //if (ImageHelper::validateImageRatio($file)) {
                    //Session::flash('image-size-error', 'Image size must not exceed 250px * 90px');
                    //return Redirect::to(route('account'));
                //}
                $filename = ImageHelper::uploadImage($file);
                $userData = User::where('id', Auth::user()->id)->first();
                if ($userData->image) {
                    File::delete(public_path() . '/profile/' . $userData->image);
                }
                User::where('id', Auth::user()->id)->update([
                    'image' => $filename
                ]);
            }
            Session::flash('success', 'block');
            return Redirect::to(route('account'));
        } else {
            Session::flash('error', 'block');
            return Redirect::to(route('account'));
        }
    }
    /**
     * Update password.
     *
     * @since 1.0.1
     *
     * @param Request $request
     * @return mixed
     */
    public function updatePassword(Request $request) {
        $oldPassword = $request->old_password;
        $newPassword = $request->new_password;
        $user = User::where('id', Auth::user()->id)->first();
        $checkPassword = Hash::check($oldPassword, $user->password);
        // print_r($check_password);exit();
        if ($checkPassword > 0) {
            User::where('id', Auth::user()->id)
                    ->update([
                        'password' => Hash::make($newPassword)
            ]);
            Session::flash('success', 'block');
            return Redirect::to(route('password'));
        } else {
            Session::flash('error', 'block');
            return Redirect::to(route('password'));
        }
    }
    /**
     * Show Account page.
     *
     * @since 1.0.1
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function account() {
        $data['state'] = State::get();
        $data['user_data'] = User::where('id', Auth::user()->id)->first();
        return view('dashboard.account.account', compact('data'));
    }
    /**
     * Show password page.
     *
     * @since 1.0.1
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function password() {
        return view('dashboard.account.password');
    }
    public function updatePayment(Request $request) {
        $apiLoginId = $request->input('api_login_id');
        $transKey = $request->input('trans_key');
        $user_data3 = PaymentSetting::where('user_id', '=', Auth::user()->id)->get();
        if (count($user_data3) > 0) {
            $lastId = PaymentSetting::where('user_id', Auth::user()->id)->update(
                    ['api_login_id' => $apiLoginId, 'trans_key' => $transKey]
            );
        } else {
            $lastId = PaymentSetting::insertGetId([
                        'api_login_id' => $apiLoginId,
                        'trans_key' => $transKey,
                        'user_id' => Auth::user()->id
            ]);
        }
        Session::flash('success', 'Your credit card has been updated.');
        return Redirect::to(route('paymentSetting'));
    }
}
