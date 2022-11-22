<?php

namespace UserAuth\App\Enums;

enum RuleEnum: string
{
    case STRING = 'string';
    case PASSWORD = 'password';
    case REQUIRED = 'required';
}
