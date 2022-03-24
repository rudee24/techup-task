<?php
namespace App\Enums;

enum PostStatus:string{
    case New='New';
    case Incomplete="Incomplete";
    case Complete="Complete";
} 