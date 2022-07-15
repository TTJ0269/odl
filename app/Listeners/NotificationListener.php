<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\Profil;
use App\Mail\NotificationMail;

class NotificationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        try
        {
            $message = "Votre mot de passe est : ";
            $password = $event->user->password;

            /** Chiffrement du mot de passe **/
            $users = DB::table('users')->where('users.id','=',$event->user->id)->update(['users.password' => Hash::make($password)]);

            $useremail = ['email' => $event->user->email , 'nomuser' => $event->user->nomuser , 'prenomuser' => $event->user->prenomuser, 'password' => $password, 'message' => $message];

            Mail::to($useremail['email'])->send(new NotificationMail($useremail));
        }
        catch(\Exception $exception)
        {
            return redirect('send-erreur-mail')->with('messageerreur',$exception->getMessage());
        }
    }
}
