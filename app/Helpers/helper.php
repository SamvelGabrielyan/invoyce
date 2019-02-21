<?php
function debug($array = [], $exit = 0)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
    if ($exit) {
        exit();
    }
}

function getIP()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function array_to_csv_download($array, $filename = "export.csv", $delimiter = ",")
{
    // open raw memory as file so no temp files needed, you might run out of memory though
    $f = fopen('php://memory', 'w');
    // loop over the input array
    foreach ($array as $line) {
        // generate csv lines from the inner arrays
        fputcsv($f, $line, $delimiter);
    }
    // reset the file pointer to the start of the file
    fseek($f, 0);
    // tell the browser it's going to be a csv file
    header('Content-Type: application/csv');
    // tell the browser we want to save it instead of displaying it
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    // make php send the generated csv lines to the browser
    fpassthru($f);
}

function csv_to_array($filename = '', $delimiter = ',')
{
    if (!file_exists($filename) || !is_readable($filename))
        return FALSE;

    $header = NULL;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE) {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
            if (!$header)
                $header = $row;
            else
                //$data[] = array_combine($header, $row);
                $data[] = $row;
        }
        fclose($handle);
    }
    return $data;
}

function hasAccess()
{
    if (Auth::check()) {
        if (Auth::user()->role == 'admin') {
            return true;
        }
    }
    return false;
}

function isAdmin()
{
    if (Auth::check()) {
        if (Auth::user()->role == 'admin') {
            return true;
        }
    }
    return false;
}

function _mail($data)
{
    //$dataEmail = ['to'=>'','subject'=>'',$cc=>'','body'=>'','files'=>[],'sender'=>email_sender,'replyTo'=>email_reply_to];
    try {
        Mail::send([], [], function ($message) use ($data) {
            $message->to($data['to'])
                ->subject($data['subject'])
                ->replyTo('noreply@invoyce.me')
                ->from('noreply@invoyce.me', 'Invoyce')
                ->sender('noreply@invoyce.me');
            if (isset($data['cc']) && trim(!empty($data['cc']))) {
                $message->cc($data['cc']);
            }
            if (isset($data['files']) && !empty($data['files']) && sizeof($data['files']) > 0) {
                for ($i = 0; $i < count($data['files']); $i++) {
                    $message->attach($data['files'][$i]); // change i to $i
                }
            }
            $message = $message->setBody($data['body'], 'text/html');
        });
    } catch (Exception $e) {
        return false;
    }
    return ['Operation' => 'True', 'Message' => 'Email Sent Successfully.'];
}

function drawErrors()
{
    $returnStr = '';

    if (\Session::has('errors')) {
        $errorsStr = '';
        $errors = \Session::get('errors')->toArray();
        foreach ($errors as $error) {
            $errorsStr .= $error[0] . '<br>';
        }
        $returnStr = '<div class="alert alert-danger errordiv errordivMain" id="errordiv"><span  onclick="hideErrorDiv()" class="pull-right"  style="color:#933432; font-size: 20px;line-height: 15px; cursor: pointer;" >×</span>' . $errorsStr . '</div>';
    }
    if (\Session::has('success') && !empty(\Session::get('success'))) {
        $returnStr = '  <div class="alert alert-success errordivMain"><span  onclick="hideErrorDiv()" class="pull-right" style="color:#2b542c; font-size: 20px;line-height: 15px;cursor: pointer;" >×</span>' . \Session::get('success') . '</div>';
    }
    return $returnStr;
}

function _encode($str)
{
    $str = base64_encode($str);
    $str = str_replace('=', 'gcc_ab', $str);
    $str = str_replace('Z', 'jazznju', $str);
    $str = gzcompress($str, 9);
    $str = strtr(base64_encode($str), '+/=', '._-');
    return urlencode($str);
}

function _decode($str)
{
    $str = base64_decode(strtr(urldecode($str), '._-', '+/='));
    $str = gzuncompress($str);
    $str = str_replace('gcc_ab', '=', $str);
    $str = str_replace('jazznju', 'Z', $str);

    $str = base64_decode($str);

    return $str;
}

function calculate_time_span($date)
{

    $hour1 = 0;
    $hour2 = 0;
    $date1 = $date;
    $date2 = date('Y-m-d H:i:s');
    $datetimeObj1 = new DateTime($date1);
    $datetimeObj2 = new DateTime($date2);
    $interval = $datetimeObj1->diff($datetimeObj2);

    if ($interval->format('%a') > 0) {
        $hour1 = $interval->format('%a') * 24;
    }
    if ($interval->format('%h') > 0) {
        $hour2 = $interval->format('%h');
    }
    return ($hour1 + $hour2);
}

function stripeOathValidate($code)
{
    $token_request_body = array(
        'grant_type' => 'authorization_code',
        'code' => $code,
        'client_secret' => \Config::get('constants.STRIPE_SECRET_KEY')
    );
    $TOKEN_URI = "https://connect.stripe.com/oauth/token";
    $req = curl_init($TOKEN_URI);
    curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($req, CURLOPT_POST, true);
    curl_setopt($req, CURLOPT_POSTFIELDS, http_build_query($token_request_body));
    curl_setopt($req, CURLOPT_SSL_VERIFYPEER, false); // Bypass the verification
    $respCode = curl_getinfo($req, CURLINFO_HTTP_CODE);
    $resp = json_decode(curl_exec($req), true); // Now has response well.
    curl_close($req);
    return $resp;
}

function invoiceFilter($query, $filter_type)
{

    $sort_by = '';
    if (!empty($filter_type)) {
        if ($filter_type == "save") {
            $query->where('save_status', '=', '1');
            $sort_by = "save";
        }
        if ($filter_type == "cancel") {
            $query->where('save_status', '=', '4');
            $sort_by = "cancel";
        }
        if ($filter_type == "paid") {
            $query->where('save_status', '=', '3');
            $sort_by = "paid";
        }
        if ($filter_type == "unpaid") {
            $query->where('save_status', '<', '3');
            $sort_by = "unpaid";
        }
        if ($filter_type == "viewed") {
            $query->where('view_status', '=', '1');
            $sort_by = "viewed";

        }
        if ($filter_type == "not_viewed") {
            $query->where('view_status', '=', '0');
            $sort_by = "not_viewed";
        }
    }
    // print_r($query);exit();
    return $sort_by;
}

function dateConversion($start_date, $end_date)
{
    list($m, $d, $y) = preg_split('/\//', $start_date);
    $data['start'] = $y . '-' . $m . '-' . $d;
    list($m, $d, $y) = preg_split('/\//', $end_date);
    $data['end'] = $y . '-' . $m . '-' . $d;
    return $data;
}