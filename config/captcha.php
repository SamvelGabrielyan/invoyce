<?php
/*
 * Secret key and Site key get on https://www.google.com/recaptcha
 * */
return [
    'secret' => env('CAPTCHA_SECRET', '6LdSX0gUAAAAAFUZ5CsE5QbshPJbjYoDdv0YaYNO'),
    'sitekey' => env('CAPTCHA_SITEKEY', '6LdSX0gUAAAAAHmPZtIWGXfsIeGhp-Ns53gWfLqJ')
];