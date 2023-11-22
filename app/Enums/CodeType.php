<?php

namespace App\Enums;

enum CodeType: string
{
    case Register = "register";
    case ForgetPassword = "forget_password";
}
