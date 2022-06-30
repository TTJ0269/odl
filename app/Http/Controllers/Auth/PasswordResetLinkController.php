<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\NotificationMail;
use App\Models\User;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        try
        {
            $email = request('email');

            if(User::select('id')->where('email',$email)->exists())
            {
                $user_email = User::select('*')->where('email',$email)->first();

                $message = "Votre nouveau mot de passe est : ";
                $password = strtotime(now());

                $useremail = ['email' => $user_email->email , 'nomuser' => $user_email->nomuser , 'prenomuser' => $user_email->prenomuser, 'password' => $password, 'message' => $message];

                Mail::to($useremail['email'])->send(new NotificationMail($useremail));

                return redirect('new-password')->with('message', 'Nouveau mot de passe bien envoyé à votre boite mail.');
            }
            else
            {
                return redirect('forgot-password')->with('messagealert', "Désolé !! Vous n'avez pas de compte");
            }
        }
        catch(\Exception $exception)
        {
            return redirect('emailerreur');
        }


        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        /*
            $request->validate([
               'email' => ['required', 'email'],
             ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);*/
    }
}
