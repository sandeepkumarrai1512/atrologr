<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ChatManagement extends Controller
{
public function index()
{
    
    return view('admin.chatManagement.chat-management');
}




}
