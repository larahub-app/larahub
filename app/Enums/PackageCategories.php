<?php

namespace App\Enums;

enum PackageCategories: string
{
    case Frontend = 'frontend';
    case Backend = 'backend';
    case Database = 'database';
    case DevTools = 'dev-tools';
    case Security = 'security';
    case Testing = 'testing';
    case Architecture = 'architecture';
    case Authentication = 'authentication';
    case Authorization = 'authorization';
    case Payments = 'payments';
    case Email = 'email';
    case Notifications = 'notifications';
    case Other = 'other';
}
