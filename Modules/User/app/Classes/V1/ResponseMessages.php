<?php

namespace Modules\User\Classes\V1;

class ResponseMessages{
    const REGISTER_SUCCESS = 'ثبت نام با موفقیت انجام شد ';
    const ERROR_REGISTER= 'ارور در ثبت نام کاربر !';
    const OTP_SEND_SUCCESS = 'رمز یکبار مصرف با موفقیت ارسال شد'; 
    const OTP_SEND_FAILURE ='ارور در ارسال رمز یکبار مصرف';
    const OTP_IS_FALSE = 'کد یکبار مصرف نامعتبر است';
    const LOGIN_SUCCESS = 'ورود با موفقیت انجام شد';
}