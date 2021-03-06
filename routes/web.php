<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IfadController;
use App\Http\Controllers\MetierController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\AssociationController;
use App\Http\Controllers\FichePositionnementController;
use App\Http\Controllers\PositionnementController;
use App\Http\Controllers\SuiviController;
use App\Http\Controllers\ObservationController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfilUserController;
use App\Http\Controllers\PreferenceController;
use App\Http\Controllers\FicheLongueController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\ApprenantController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login'); //view('welcome')
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');*/

Route::get('/dashboard', [MessageController::class, 'accueil'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

/*** routes generales pour profil ***/
Route::resource('/profils', ProfilController::class);

/*** routes generales pour utilisateur ***/
Route::resource('/users', UserController::class);

/*** routes generales pour message ***/
Route::get('/new-password', [MessageController::class, 'messagenewpassword'])->name('newpassword');
Route::get('/emailerreur', [MessageController::class, 'emailerreur'])->name('emailerreur');
Route::get('/erreur', [MessageController::class, 'pageerreur'])->name('pageerreur');
Route::get('/send-erreur-mail', [MessageController::class, 'send_erreur_mail'])->name('sendemail');

/*** route generer un mouveau mot de passe pour utilisateur ***/
Route::get('/generationnewpassword/{user}', [UserController::class, 'GenerationNewPassword'])->name('generationnewpassword');

/*** route generer compte utilisateur ***/
Route::post('/activecompte', [UserController::class, 'ActiveCompte'])->name('activecompte');
Route::post('/bloquercompte', [UserController::class, 'BloquerCompte'])->name('bloquercompte');

/*** routes generales pour Entreprise ***/
Route::resource('/entreprises', EntrepriseController::class);

/*** routes generales pour Activite ***/
Route::resource('/activites', ActiviteController::class);

/*** routes generales pour Tache ***/
Route::resource('/taches', TacheController::class);

/*** routes generales pour IFAD ***/
Route::resource('/ifads', IfadController::class);

/*** routes generales pour metier ***/
Route::resource('/metiers', MetierController::class);

/*** routes generales pour Association ***/
Route::resource('/associations', AssociationController::class);
Route::get('/get_ifad', [AssociationController::class, 'getIfad'])->name('get_ifad');

/*** routes generales pour Suivi ***/
Route::resource('/suivis', SuiviController::class);
Route::get('/suivi_fin/{suivi}', [SuiviController::class, 'update'])->name('suivi_fin');

/*** routes generales pour le profil de l'utilisateur ***/
Route::get('/profiluser', [ProfilUserController::class, 'show'])->name('profilusershow');
Route::post('/profiluser', [ProfilUserController::class, 'changeemail'])->name('profilemailchange');
Route::post('/profilpassword', [ProfilUserController::class, 'changepassword'])->name('profilpasswordchange');
Route::post('/profilphoto', [ProfilUserController::class, 'changephoto'])->name('profilphotochange');


/*** routes generales pour Fiche_positionnement ***/
Route::resource('/fiche_positionnements', FichePositionnementController::class);
Route::get('/fiche_positionnements/show/{fiche_positionnement}', [FichePositionnementController::class, 'show'])->name('fiche_show');
Route::get('/fiche_positionnements/edit/{fiche_positionnement}', [FichePositionnementController::class, 'edit'])->name('fiche_edit');
Route::get('/fiches_archive_show', [FichePositionnementController::class, 'fiches_archive_show'])->name('fiches_archive_show');
Route::get('/fiche_archive/{fiche_positionnement}', [FichePositionnementController::class, 'fiche_archive'])->name('fiche_archive');
Route::get('/fiche_desarchive/{fiche_positionnement}', [FichePositionnementController::class, 'fiche_desarchive'])->name('fiche_desarchive');


/*** routes generales pour Positionnement ***/
Route::resource('/positionnements', PositionnementController::class);
Route::get('/positionnement/create', [PositionnementController::class, 'index'])->name('positionnement_index');
Route::post('/positionnement/create', [PositionnementController::class, 'create'])->name('positionnement_create');
Route::get('/positionnement/recup_metier/{user}', [PositionnementController::class, 'recup_metier'])->name('positionnement_recup_metier');
//Route::get('/positionnement/recup', [PositionnementController::class, 'index'])->name('positionnement_recup_index');
//Route::post('/positionnement/recup', [PositionnementController::class, 'recup'])->name('positionnement_recup');
Route::get('/get_index', [PositionnementController::class, 'getUser'])->name('get_index');

/*** routes generales pour Observation ***/
Route::resource('/observations', ObservationController::class);
Route::get('/observations/create/{user}', [ObservationController::class, 'create'])->name('observation_create');

/*** routes statistiques ***/
Route::get('/statistique', [StatistiqueController::class, 'index'])->name('statistique_index');
Route::get('/statistique/{fiche_positionnement}', [StatistiqueController::class, 'show'])->name('statistique_show');
Route::get('/getfichepositionnement', [StatistiqueController::class, 'getfichepositionnement'])->name('getfichepositionnement');

/*** routes preferences ***/
Route::get('/preference_store', [PreferenceController::class, 'store'])->name('preference_store');
Route::post('/preference_top', [PreferenceController::class, 'top'])->name('preference_top');
Route::post('/preference_left', [PreferenceController::class, 'left'])->name('preference_left');
Route::post('/preference_center', [PreferenceController::class, 'center'])->name('preference_center');
Route::post('/preference_right', [PreferenceController::class, 'right'])->name('preference_right');

/*** routes generales pour Fiche_positionnement all regroupe l'apprenant le tuteur l'entreprise l'ifad et la metier (temporaire)***/
/*Route::get('/positionnement-apprenant', [FicheLongueController::class,'index'])->name('positionnement_apprenant_index');
Route::get('/fiche_positionnement-apprenant/create', [FicheLongueController::class, 'index'])->name('fiche_apprenant_get_create');
Route::post('/fiche_positionnement-apprenant/create', [FicheLongueController::class, 'create'])->name('fiche_apprenant_create');
Route::post('/positionnement-apprenant', [FicheLongueController::class, 'store'])->name('fiche_apprenant_store');
Route::get('/fiche_positionnements-apprenant', [FicheLongueController::class, 'fiche_index'])->name('fiche_apprenant_index');
Route::get('/fiche_positionnements-apprenant/{fiche_positionnement}', [FicheLongueController::class, 'show'])->name('fiche_apprenant_show');
Route::get('/fiche_positionnements-apprenant/{fiche_positionnement}/edit', [FicheLongueController::class, 'edit'])->name('fiche_apprenant_edit');
Route::patch('/fiche_positionnements-apprenant/{fiche_positionnement}', [FicheLongueController::class, 'update'])->name('fiche_apprenant_update');
Route::get('/statistique/{fiche_positionnement}', [StatistiqueController::class, 'fiche_longue_show'])->name('statistique_fiche_longue_show');*/

/** Historique **/
Route::get('/historiques', [HistoriqueController::class, 'index'])->name('historique_index');

/*** routes generales pour apprenant ***/
Route::resource('/apprenants', ApprenantController::class);


Route::get('/hoho', function () {
    return view('hoho');
});

Route::get('/pie', [ChartController::class, 'pie'])->name('chart.pie');

//Route::get('/first', [ChartController::class, 'first'])->name('first');
