<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Login Header
    |--------------------------------------------------------------------------
    |
    | Used at the top of Login Page
    |
    */
    'login_text' => env('FOUNDATION_LOGIN_TEXT', 'LOGIN'),

    /*
    |--------------------------------------------------------------------------
    | Login Description
    |--------------------------------------------------------------------------
    |
    | Used after login header text
    |
    */
    'login_description' => env('FOUNDATION_LOGIN_DESCRIPTION', 'Sign In to your account'),

    /*
    |--------------------------------------------------------------------------
    | Company Name
    |--------------------------------------------------------------------------
    |
    | Used at the top of the content
    |
    */
    'company' => env('FOUNDATION_COMPANY', 'Laravel Foundation'),

    /*
    |--------------------------------------------------------------------------
    | Full Name of App
    |--------------------------------------------------------------------------
    |
    | Used at the top of the sidebar
    |
    */
    'menu_name' => env('FOUNDATION_MENU_NAME', 'Administrator'),

    /*
    |--------------------------------------------------------------------------
    | Short Name of App
    |--------------------------------------------------------------------------
    |
    | Used at the top of the sidebar when Sidebar Minimized
    |
    */
    'menu_name_short' => env('FOUNDATION_MENU_NAME_SHORT', 'AD'),

    /*
    |--------------------------------------------------------------------------
    | Namespace
    |--------------------------------------------------------------------------
    |
    | Namespace for
    |
    */
    'namespace' => env('FOUNDATION_NAMESPACE', 'Backend'),

    /*
    |--------------------------------------------------------------------------
    | Short Name of App
    |--------------------------------------------------------------------------
    |
    | The name of the administrator role
    | Should be Administrator by design and unable to change from the backend
    | It is not recommended to change
    |
    */
    'role_admin' => 'Administrator',

    /*
    |--------------------------------------------------------------------------
    | Date Format
    |--------------------------------------------------------------------------
    |
    | Setting date format for use
    |
    */
    'date_format' => 'd/m/Y',
    'date_format_javascript' => 'DD/MM/YYYY',
];
