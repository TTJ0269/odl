<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IfadController;
use App\Http\Controllers\MetierController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\AssociationController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\RattacherController;
use App\Http\Controllers\AllUserController;
use App\Http\Controllers\FichePositionnementController;
use App\Http\Controllers\PositionnementController;
use App\Http\Controllers\SuiviController;
use App\Http\Controllers\FormateurController;
use App\Http\Controllers\ObservationController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfilUserController;
use App\Http\Controllers\PreferenceController;
use App\Http\Controllers\FicheLongueController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\GroupeActiviteController;
use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\ApprenantController;
use App\Http\Controllers\AppartenanceController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ReferentielController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index'])->name('index'); //view('welcome') auth.login

Route::get('/aed/{logo}/{name}/login', [MessageController::class, 'send_logo'])->name('send_logo');
Route::get('/login', [HomeController::class, 'index'])->name('login');

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

/*** routes generales pour GroupeActivite ***/
Route::resource('/groupe_activites', GroupeActiviteController::class);

/*** routes generales pour Tache ***/
Route::resource('/taches', TacheController::class);

/*** routes generales pour IFAD ***/
Route::resource('/ifads', IfadController::class);

/*** routes generales pour metier ***/
Route::resource('/metiers', MetierController::class);

/*** routes generales pour appartenance  pour les tuteurs***/
Route::resource('/appartenances', AppartenanceController::class);

/*** routes generales pour Association ***/
Route::resource('/associations', AssociationController::class);
Route::get('/get_ifad', [AssociationController::class, 'getIfad'])->name('get_ifad');

/*** routes generales pour Classe ***/
Route::resource('/classes', ClasseController::class);

/*** routes generales pour formateurs ***/
Route::resource('/formateurs', FormateurController::class);

/*** routes generales pour Rattacher ***/
Route::resource('/rattachers', RattacherController::class);

/*** routes autres users ***/
Route::get('/utilisateur', [AllUserController::class, 'index'])->name('autre_user');

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
Route::get('/positionnement/create/{user}', [PositionnementController::class, 'create'])->name('positionnement_create');
Route::get('/positionnement/recup_apprenant/{user}', [PositionnementController::class, 'recup_apprenant'])->name('positionnement_recup_apprenant');
Route::get('/positionnement/classe_apprenant', [PositionnementController::class, 'index'])->name('positionnement_classe_apprenant');
Route::post('/positionnement/classe_apprenant', [PositionnementController::class, 'classe_apprenant'])->name('positionnement_classe_apprenant');
Route::get('/get_index', [PositionnementController::class, 'getUser'])->name('get_index');
Route::get('/get_classe', [PositionnementController::class, 'getClasse'])->name('get_classe');
Route::get('/get_apprenant', [PositionnementController::class, 'getApprenant'])->name('get_apprenant');

/*** routes generales pour Observation ***/
Route::resource('/observations', ObservationController::class);
Route::get('/observations/create/{user}', [ObservationController::class, 'create'])->name('observation_create');

/*** routes statistiques ***/
Route::get('/statistique', [StatistiqueController::class, 'index'])->name('statistique_index');
Route::get('/statistique/{fiche_positionnement}', [StatistiqueController::class, 'show'])->name('statistique_show');
Route::post('/statistique', [StatistiqueController::class, 'show_info'])->name('statistique_show_info');
Route::get('/fiche_generale/{user}', [StatistiqueController::class, 'fiche_generale'])->name('fiche_generale');
Route::get('/statistique_generale/{user}', [StatistiqueController::class, 'statistique_generale'])->name('statistique_generale');
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

/** Exportation **/
Route::get('/export_user', [ExportController::class, 'export_user'])->name('export_user');
Route::get('/export_user_cvs', [ExportController::class, 'export_user_csv'])->name('export_user_cvs');


/** Importation **/
Route::get('/import_user', [ImportController::class, 'import_user_index'])->name('import_user_index');
Route::post('/import_user', [ImportController::class, 'import_user_store'])->name('import_user_store');

/** Importation user , activite , tache **/
Route::get('/import_index', [ImportController::class, 'import_index'])->name('import_index');
Route::get('/import_activite_tache', [ImportController::class, 'import_index'])->name('import_activite_tache_index');
Route::get('/import_user_ifad', [ImportController::class, 'import_index'])->name('import_user_ifad_index');
Route::post('/import_activite_tache', [ImportController::class, 'import_activite_tache_store'])->name('import_activite_tache_store');
Route::post('/import_user_ifad', [ImportController::class, 'import_user_ifad_store'])->name('import_user_ifad_store');

/** Importation fichier user , activite , tache **/
Route::get('/fichier_user', [ImportController::class, 'referentiel_user'])->name('referentiel_user');
Route::get('/fichier_activite_tache', [ImportController::class, 'referentiel_metier'])->name('referentiel_metier');


/*** routes generales pour apprenant ***/
Route::resource('/apprenants', ApprenantController::class);

/** Referentiel **/
Route::get('/referentiel', [ReferentielController::class, 'index'])->name('referentiel');
Route::get('/referentiel_show/{ifad}', [ReferentielController::class, 'show'])->name('referentiel_show');


Route::get('/hoho', function () {
    return view('hoho');
});

Route::get('/pie', [ChartController::class, 'pie'])->name('chart.pie');

//Route::get('/first', [ChartController::class, 'first'])->name('first');
