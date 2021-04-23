<?php

use App\Http\Controllers\Back\AnnonceController;
use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\ClubController;
use App\Http\Controllers\Back\EmploiDuTempsController;
use App\Http\Controllers\Back\EnseignantController;
use App\Http\Controllers\Back\EspaceNumeriqueController;
use App\Http\Controllers\Back\EtudiantController;
use App\Http\Controllers\Back\EvenementController;
use App\Http\Controllers\Back\FormationController;
use App\Http\Controllers\Back\MatiereController;
use App\Http\Controllers\Back\MessageController;
use App\Http\Controllers\Back\NewsletterController;
use App\Http\Controllers\Back\NiveauController;
use App\Http\Controllers\Back\ParcoursController;
use App\Http\Controllers\Back\AnneeUniversitaireLibelleController;
use App\Http\Controllers\Back\ConfigurationController;
use App\Http\Controllers\Back\UserController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\API\ConfigurationController as APIConfigurationController;
use App\Http\Controllers\API\FormationController as APIFormationController;
use App\Http\Controllers\API\EtudiantController as APIEtudiantController;
use App\Http\Controllers\API\EnseignantController as APIEnseignantController;
use App\Http\Controllers\API\EspaceMembreController as APIEspaceMembreController;
use App\Http\Controllers\API\TokenController as APITokenController;
use App\Http\Controllers\API\EmploiTempsController as APIEmploiTempsController;
use App\Http\Controllers\API\ClubController as APIClubController;
use App\Http\Controllers\API\ArticleController as APIArticleController;
use App\Http\Controllers\API\AnnonceController as APIAnnonceController;
use App\Http\Controllers\API\EvenementController as APIEvenementController;
use App\Http\Controllers\API\MessageController as APIMessageController;
use App\Http\Controllers\API\NewsletterController as APINewsletterController;
use App\Http\Controllers\API\EspaceNumeriqueController as APIEspaceNumeriqueController;
use App\Http\Controllers\API\ParcoursController as APIParcoursController;
use App\Http\Controllers\API\NiveauController as APINiveauController;
use App\Http\Controllers\API\AnneeUniversitaireController as APIAnneeUniversitaireController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

/**
 * Route Authentification
 */
require __DIR__.'/auth.php';


/**
 * Route Back-office
 */

# Tester l'intergaration
Route::get('/layout', function () {
    return view('back.parent.layout');
});

# Formation
Route::resource('formation', FormationController::class);

# Parcours
Route::resource('parcours', ParcoursController::class)->parameters(['parcours' => 'parcours']);

# Annee Universitaire
Route::resource('annee-universitaire', AnneeUniversitaireLibelleController::class)->parameters(['annee-universitaire' => 'annee']);

# Niveau
Route::resource('niveau', NiveauController::class);

# Etudiants
Route::resource('etudiant', EtudiantController::class);
Route::name('etudiant.indexactif')->get('/etudiant-actif', [EtudiantController::class, 'index']);
Route::name('etudiant.indexold')->get('/etudiant-ancien', [EtudiantController::class, 'index']);
ROute::name('etudiant.filter')->get('/etudiant/filter/avance', [EtudiantController::class, 'filter']);

# Enseignants
Route::resource('enseignant', EnseignantController::class);

# Clubs
Route::resource('club', ClubController::class);Route::view('/configuration/lien', 'back.configuration.lien')->name('configuration.lien');
Route::get('/club/{club}/staff', [ClubController::class, 'addStaffView'])->name('club.staff.view');
Route::post('/club/staff/add', [ClubController::class, 'addStaffStore'])->name('club.staff.add');

# Articles
Route::resource('article', ArticleController::class);

# Evenements
Route::resource('evenement', EvenementController::class);

# Annonces
Route::resource('annonce', AnnonceController::class);

# Message
Route::resource('message', MessageController::class);

# Newsletter
Route::resource('newsletter', NewsletterController::class);

# Configuration
Route::view('/configuration/contenu', 'back.configuration.contenu')->name('configuration.contenu');
Route::view('/configuration/contact', 'back.configuration.contact')->name('configuration.contact');
Route::view('/configuration/lien', 'back.configuration.lien')->name('configuration.lien');

Route::put('/configuration/update', [ConfigurationController::class, 'update'])->name('configuration.update');
Route::get('/configuration/update', [ConfigurationController::class, 'edit'])->name('configuration.edit');

# Espace Numerique
Route::resource('espace-numerique-travail', EspaceNumeriqueController::class)
    ->parameters(['espace-numerique-travail' => 'espaceNumerique']);
Route::get('/espace-numerique-travail/pieces-jointes/{espaceNumerique}', [EspaceNumeriqueController::class, 'piecesJointesView'])
    ->name('espace-numerique-travail.pieces.view');
Route::post('/espace-numerique-travail/pieces-jointes/upload/{espaceNumerique}', [EspaceNumeriqueController::class, 'piecesJointes'])
    ->name('espace-numerique-travail.pieces.upload');
Route::post('/espace-numerique-travail/pieces-jointes/delete/{espaceNumerique}', [EspaceNumeriqueController::class, 'deletePiecesJointes'])
    ->name('espace-numerique-travail.pieces.delete');


# Emploi du Temps
Route::resource('emploi-du-temps', EmploiDuTempsController::class)
    ->parameters(['emploi-du-temps' => 'emploiDuTemps']);
Route::get('/emploi-du-temps/calendar/{id}/{niveau}/{parcours}/{start?}/{end?}', [EmploiDuTempsController::class, 'showCalendar'])
    ->name('emploi-du-temps.calendar.show');
Route::post('/emploi-du-temps/calendar', [EmploiDuTempsController::class, 'calendar'])
    ->name('emploi-du-temps.calendar');
Route::get('/emploi-du-temps/calendar/seed', [EmploiDuTempsController::class, 'seed'])
    ->name('emploi-du-temps.calendar.seed');

# Matiere
Route::resource('matiere', MatiereController::class);

# User
Route::resource('user', UserController::class);

# File Manager
Route::group(['prefix' => 'laravel-filemanager-webcup', 'middleware' => ['web', 'auth']], function (){
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


####### API Route

# Token
Route::get('/api/token', [APITokenController::class, 'getToken']);

# Configuration
Route::get('/api/configurations', [APIConfigurationController::class, 'get']);


# Formation
Route::get('/api/formations', [APIFormationController::class, 'all']);
Route::get('/api/formations/{formation}', [APIFormationController::class, 'get']);

# Etudiant
Route::get('/api/etudiants/{etudiant}', [APIEtudiantController::class, 'info']);
Route::get('/api/etudiants/filter/vue', [APIEtudiantController::class, 'filter']);
Route::get('/api/etudiants/filter/status', [APIEtudiantController::class, 'status']);

# Enseignant
Route::get('/api/enseignants/{enseignant}', [APIEnseignantController::class, 'info']);

### Espace Membre
Route::post('/api/login', [APIEspaceMembreController::class, 'login']);


### Emploi du Temps
Route::get('/api/emploi-du-temps', [APIEmploiTempsController::class, 'all']);
Route::get('/api/emploi-du-temps/{id}', [APIEmploiTempsController::class, 'get']);

# Club
Route::get('/api/clubs', [APIClubController::class, 'all']);
Route::get('/api/clubs/{club}', [APIClubController::class, 'get']);

# Article
Route::get('/api/articles', [APIArticleController::class, 'all']);
Route::get('/api/articles/top', [APIArticleController::class, 'top']);
Route::get('/api/articles/{article}', [APIArticleController::class, 'get']);

# Annonces
Route::get('/api/annonces', [APIAnnonceController::class, 'all']);
Route::get('/api/annonces/top', [APIAnnonceController::class, 'top']);
Route::get('/api/annonces/{annonce}', [APIAnnonceController::class, 'get']);

# Evenements
Route::get('/api/evenements', [APIEvenementController::class, 'all']);
Route::get('/api/evenements/top/nouvelle', [APIEvenementController::class, 'topNouvelle']);
Route::get('/api/evenements/top/actualite', [APIEvenementController::class, 'topActualite']);
Route::get('/api/evenements/{evenement}', [APIEvenementController::class, 'get']);

# Messages
Route::post('/api/messages', [APIMessageController::class, 'post']);

# NewsLetter
Route::post('/api/newsletter', [APINewsletterController::class, 'post']);

# Espace Numeriques
Route::post('/api/espace-numerique', [APIEspaceNumeriqueController::class, 'post']);
Route::post('/api/espace-numerique/{espaceNumerique}', [APIEspaceNumeriqueController::class, 'postPiecesJointes']);
Route::get('/api/espace-numerique', [APIEspaceNumeriqueController::class, 'all']);
Route::get('/api/espace-numerique/{espaceNumerique}', [APIEspaceNumeriqueController::class, 'get']);

# Parcours
Route::get('/api/parcours/etudiants', [APIParcoursController::class, 'filter']);

# Niveaux
Route::get('/api/niveaux/etudiants', [APINiveauController::class, 'filter']);

# Annee Universitaire
Route::get('/api/annee-universitaire/etudiants', [APIAnneeUniversitaireController::class, 'filter']);

# Formation
Route::get('/api/formations/etudiants/filter', [APIFormationController::class, 'filter']);
