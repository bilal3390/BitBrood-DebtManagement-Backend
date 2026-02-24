<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminWebUserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::query()
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function show(string $user_phone_e164): Response
    {
        abort(403, 'Viewing user details is not allowed.');
    }
}
