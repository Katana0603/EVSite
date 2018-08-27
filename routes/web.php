<?php

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

Auth::routes();

Route::get('todo', function(){
	return view('backend/todo');
});


Route::get('/cookiePolicy', function(){
	return view('frontend/general/cookiePolicy');
})->name('cookiePolicy');

Route::get('/privacyPolicy', function(){
	return view('frontend/general/privacyPolicy');
})->name('privacyPolicy');

Route::get('/termsOfService', function(){
	return view('frontend/general/termsOfService');
})->name('termsOfService');

/*Send a Mail*/
Route::post('/send', 'Admin\Email\EmailController@send')->name('email.send');

/*Download a File*/
Route::get('/download/{folderPath}', 'Admin\MediaController@getFile')->name('getFolderFiles');


/*Calendar*/
Route::post('/calendar/newItem', 'Admin\CalendarController@newItem')->name('calendar.newItem');

Route::get('/', 'Frontend\NewsController@index')->name('news.index');

Route::prefix('admin')->group(function () 
{
// News
	Route::get('', 'Admin\AdminController@index')->name('admin.index');

	Route::post('toDoList', 'Admin\AdminController@toDoListSaveEntry')->name('admin.toDoList.saveEntry');
	Route::delete('toDoList/{id}', 'Admin\AdminController@toDoListDeleteEntry')->name('toDo.delete');


	Route::get('news', 'Admin\NewsController@index')->name('admin.news.index');
	Route::get('news/create', 'Admin\NewsController@create')->name('news.create');
	Route::post('news/like/{id}', 'Admin\NewsController@like')->name('news.like');
	Route::post('news/dislike/{id}', 'Admin\NewsController@dislike')->name('news.dislike');
	Route::post('news', 'Admin\NewsController@store')->name('news.store');
	Route::get('/news/{id}/edit', 'Admin\NewsController@edit')->name('news.edit');
	Route::post('/news/update/{id}', 'Admin\NewsController@update')->name('news.update');
	Route::delete('news/{id}', 'Admin\NewsController@delete')->name('news.delete');

// Articel
	Route::get('articel', 'Admin\ArticelController@index')->name('admin.articel.index');
	Route::get('articel/create', 'Admin\ArticelController@create')->name('articel.create');
	Route::post('articel', 'Admin\ArticelController@store')->name('articel.store');
	Route::get('/articel/{id}/edit', 'Admin\ArticelController@edit')->name('articel.edit');
	Route::post('/articel/update/{id}', 'Admin\ArticelController@update')->name('articel.update');
	Route::delete('articel/{id}', 'Admin\ArticelController@delete')->name('articel.delete');
	Route::post('articel/like/{id}', 'Frontend\ArticelController@like')->name('articel.like');
	Route::post('articel/dislike/{id}', 'Frontend\ArticelController@dislike')->name('articel.dislike');

	Route::resource('users', 'User\UserController');
	Route::get('users/getdata', 'User\UserController@anyData')->name('users.getdata');
	Route::get('users.locked.{id}', 'User\UserController@locked')->name('users.locked');
	Route::resource('roles', 'User\RoleController');

	Route::post('clan/store', 'Frontend\UserController@storeClan')->name('store.clan');

	Route::resource('permissions', 'User\PermissionController');

// Forum
	Route::get('forum', 'Admin\ForumController@index')->name('admin.forum.index');

	Route::post('cat', 'Admin\ForumController@storeCat')->name('forum.cat.store');
	Route::post('sub', 'Admin\ForumController@storeSub')->name('forum.sub.store');
	Route::post('thread', 'Admin\ForumController@storeThread')->name('forum.thread.store');

	Route::delete('cat/{id}', 'Admin\ForumController@deleteCat')->name('forum.cat.delete');
	Route::delete('sub/{id}', 'Admin\ForumController@deleteSub')->name('forum.sub.delete');
	Route::delete('thread/{id}', 'Admin\ForumController@deleteThread')->name('forum.thread.delete');


	Route::resource('issueList', 'Admin\IssueListController');
	Route::resource('settings', 'Admin\SettingsController');
	Route::resource('sponsoren', 'Admin\SponsorenController');
	Route::resource('partner', 'Admin\PartnerController');
	Route::resource('media', 'Admin\MediaController');

	Route::resource('team', 'Admin\TeamController',['as' => 'admin']);
	Route::post('admin/storeTeamCat', 'Admin\TeamController@storeTeamCat')->name('admin.team.storeTeamCat');
	Route::delete('admin/destroyTeamCat/{id}', 'Admin\TeamController@destroyTeamCat')->name('admin.team.destroyTeamCat');

	Route::resource('teamspeak', 'Admin\TeamspeakController',['as' => 'admin']);
// TICKETS
	Route::resource('eventTickets', 'Admin\TicketController',['as' => 'admin']);

// EVENT
	Route::get('event', 'Admin\EventController@index')->name('admin.event.index');
	Route::get('event/create', 'Admin\EventController@create')->name('admin.event.create');
	Route::post('event', 'Admin\EventController@store')->name('admin.event.store');
	Route::get('event/edit/{id}', 'Admin\EventController@edit')->name('admin.event.edit');
	Route::get('event/accountCheck/{id}', 'Admin\EventController@accountCheck')->name('admin.event.accountCheck');
	Route::post('event/{id}', 'Admin\EventController@update')->name('admin.event.update');
	Route::delete('event/{id}', 'Admin\EventController@delete')->name('event.delete');

	Route::resource('eventlocation', 'Admin\Event\LocationController');
	Route::resource('eventsponsoren', 'Admin\Event\SponsorController');
	Route::resource('eventuser', 'Admin\Event\UserController');

	Route::resource('eventTournament', 'Admin\Event\TournamentController');
	Route::resource('eventGames', 'Admin\Games\GamesController');
	Route::get('eventTournament/createGamePlan/{id}', 'Admin\Event\TournamentController@createGamePlan')->name('admin.tournament.createGamePlan');
	
	Route::get('eventSeatplan/fillSeatplan/{id}', 'Admin\Event\SeatplanController@setSeatsOnPlan')->name('eventSeatplan.plan');
	Route::post('eventSeatplan/storeSeat', 'Admin\Event\SeatplanController@storeNewSeat')->name('eventSeatplan.storeSeat');
	Route::post('eventSeatplan/editSeat', 'Admin\Event\SeatplanController@editNewSeat')->name('eventSeatplan.editSeat');
	Route::delete('eventSeatplan/destroySeat', 'Admin\Event\SeatplanController@deleteNewSeat')->name('eventSeatplan.deleteSeat');
	Route::resource('eventSeatplan', 'Admin\Event\SeatplanController');
//EVENT END

	/*
 	* Active Events
 	*/
 	Route::get('activeEvents/{eventId}/users', 'Admin\Event\ActiveEventController@users')->name('activeEvents.users');
 	Route::post('activeEvents/{eventId}/addUser', 'Admin\Event\ActiveEventController@addUser')->name('activeEvents.addUser');	
 	Route::post('activeEvents/{eventId}/editUser', 'Admin\Event\ActiveEventController@editUser')->name('activeEvents.editUser');
 	Route::delete('activeEvents/{eventId}/deleteUser/{userId}', 'Admin\Event\ActiveEventController@deleteUser')->name('activeEvents.deleteUser');
 	Route::get('activeEvents/{eventId}/userPaidCash/{userId}', 'Admin\Event\ActiveEventController@userPaidCash')->name('activeEvents.userPaidCash');
 	Route::get('activeEvents/{eventId}/userPaidPaypal/{userId}', 'Admin\Event\ActiveEventController@userPaidPaypal')->name('activeEvents.userPaidPaypal');
 	Route::get('activeEvents/{eventId}/userArrived/{userId}', 'Admin\Event\ActiveEventController@userArrived')->name('activeEvents.userArrived');

 	Route::get('activeEvents/{eventId}/seatplan', 'Admin\Event\ActiveEventController@seatplan')->name('activeEvents.seatplan');
 	Route::post('activeEvents/{eventId}/saveSeat', 'Admin\Event\ActiveEventController@saveSeat')->name('activeEvents.saveSeat');
 	Route::get('activeEvents/{eventId}/freeSeat/{seatId}', 'Admin\Event\ActiveEventController@freeSeat')->name('activeEvents.freeSeat');
 	Route::get('activeEvents/{eventId}/tournaments', 'Admin\Event\ActiveEventController@tournaments')->name('activeEvents.tournament');
 	Route::get('activeEvents/{eventId}/tournaments/{tournamentId}/startFirstRound', 'Admin\Event\ActiveEventController@startFirstRound')->name('activeEvents.tournament.stratFirstRound');
 	Route::post('activeEvents/tournaments/enterScores','Admin\Event\ActiveEventController@enterScores')->name('activeEvents.tournament.enterScores');
 	Route::post('activeEvents/{eventId}/tournaments/{tournamentId}/addTeam', 'Admin\Event\ActiveEventController@addTeams')->name('activeEvents.tournament.addTeam');
 	Route::post('activeEvents/{eventId}/tournaments/{tournamentId}/{teamId}/addPlayer', 'Admin\Event\ActiveEventController@addPlayer')->name('activeEvents.tournament.addPlayer');

 	Route::get('activeEvents/{eventId}/arrival', 'Admin\Event\ActiveEventController@arrival')->name('activeEvents.arrival.index');

	//Layout
 	Route::get('layout/widgets', 'Admin\LayoutController@widgets')->name('admin.widgets');
 	Route::get('layout/chartsjs', 'Admin\LayoutController@chartsjs')->name('admin.chartsjs');
 	Route::get('layout/chartsMorris', 'Admin\LayoutController@chartsMorris')->name('admin.chartsMorris');
 	Route::get('layout/chartsFlot', 'Admin\LayoutController@chartsFlot')->name('admin.chartsFlot');
 	Route::get('layout/chartsInline', 'Admin\LayoutController@chartsInline')->name('admin.chartsInline');

 	Route::get('layout/elementsGeneral', 'Admin\LayoutController@elementsGeneral')->name('admin.elementsGeneral');
 	Route::get('layout/elementsIcons', 'Admin\LayoutController@elementsIcons')->name('admin.elementsIcons');
 	Route::get('layout/elementsButtons', 'Admin\LayoutController@elementsButtons')->name('admin.elementsButtons');
 	Route::get('layout/elementsSliders', 'Admin\LayoutController@elementsSliders')->name('admin.elementsSliders');
 	Route::get('layout/elementsTimeline', 'Admin\LayoutController@elementsTimeline')->name('admin.elementsTimeline');
 	Route::get('layout/elementsModals', 'Admin\LayoutController@elementsModals')->name('admin.elementsModals');


 	Route::get('layout/formsGeneral', 'Admin\LayoutController@formsGeneral')->name('admin.formsGeneral');
 	Route::get('layout/formsAdvanced', 'Admin\LayoutController@formsAdvanced')->name('admin.formsAdvanced');
 	Route::get('layout/formsEditors', 'Admin\LayoutController@formsEditors')->name('admin.formsEditors');
 	Route::get('layout/tablesSimple', 'Admin\LayoutController@tablesSimple')->name('admin.tablesSimple');
 	Route::get('layout/tablesData', 'Admin\LayoutController@tablesData')->name('admin.tablesData');


 	Route::get('pages/calendar', 'Admin\CalendarController@index')->name('admin.calendar');
 	Route::get('pages/mailbox', 'Admin\AdminController@mailbox')->name('admin.mailbox');


 	Route::get('pages/profile', 'Admin\AdminController@pagesProfile')->name('admin.pagesProfile');
 	Route::get('pages/login', 'Admin\AdminController@pagesLogin')->name('admin.pagesLogin');
 	Route::get('pages/register', 'Admin\AdminController@pagesRegister')->name('admin.pagesRegister');
 	Route::get('pages/lockscreen', 'Admin\AdminController@pageslockscreen')->name('admin.pageslockscreen');
 	Route::get('pages/404Error', 'Admin\AdminController@pages404Error')->name('admin.pages404Error');
 	Route::get('pages/500Error', 'Admin\AdminController@pages500Error')->name('admin.pages500Error');
 	Route::get('pages/blank', 'Admin\AdminController@pagesblank')->name('admin.pagesblank');

 	Route::get('pages/city', 'Admin\PagesController@city')->name('admin.pages.city');
 	
 	Route::post('pages/city', 'Admin\PagesController@citySave')->name('admin.pages.citysave');


 	Route::get('startUpNews', 'Admin\StartUpNewsController@index')->name('admin.startUpNews.index');
 	Route::post('startUpNews', 'Admin\StartUpNewsController@store')->name('admin.startUpNews.store');

 });
#-----------------------------------------------------------------------------------
#FRONTEND START
#-----------------------------------------------------------------------------------

Route::get('/news', 'Frontend\NewsController@index')->name('news.index');
Route::post('/news/{id}/storeComment', 'Frontend\NewsController@storeComment')->name('news.storeComment');
Route::delete('/news/{id}/deleteComment','Frontend\NewsController@deleteComment')->name('news.deleteComment');
Route::get('/news/editComment/{id}', 'Frontend\NewsController@editComment')->name('news.editComment');
Route::post('/news/editComment/{id}','Frontend\NewsController@updateComment')->name('news.updateComment');
Route::get('/news/{id}', 'Frontend\NewsController@show')->name('news.show');

Route::get('/articel','Frontend\ArticelController@index')->name('articel.index');
Route::get('/articel/{id}', 'Frontend\ArticelController@show')->name('articel.show');
Route::post('/articel/{id}/storeComment', 'Frontend\ArticelController@storeComment')->name('articel.storeComment');

Route::delete('/articel/{id}/deleteComment','Frontend\ArticelController@deleteComment')->name('articel.deleteComment');

Route::get('/articel/{id}/editComment/{commentId}', 'Frontend\ArticelController@editComment')->name('articel.editComment');
Route::post('/articel/{id}/editComment/{commentId}', 'Frontend\ArticelController@updateComment')->name('articel.updateComment');

// FORUM
Route::get('/forum','Frontend\ForumController@index')->name('forum.index');
Route::get('/forum/{id}','Frontend\ForumController@sub')->name('forum.sub');


Route::get('forum/{id}/createThread', 'Frontend\ForumController@createThread')->name('forum.createThread');
Route::post('forum/{id}/storeThread', 'Frontend\ForumController@storeThread')->name('forum.storeThread');
Route::get('/forum/{id}/{threadId}/editThread', 'Frontend\ForumController@editThread')->name('forum.editThread');
Route::post('/forum/{id}/{threadId}/updateThread', 'Frontend\ForumController@updateThread')->name('forum.updateThread');
Route::delete('/forum/{id}/{threadId}/deleteThread','Frontend\ForumController@deleteThread')->name('forum.deleteThread');
Route::get('/forum/{id}/{threadId}','Frontend\ForumController@thread')->name('forum.thread');

Route::post('/forum/{id}/{threadId}/storePost', 'Frontend\ForumController@storePost')->name('forum.storePost');
Route::delete('/forum/{id}/{threadId}/{postId}/deletePost','Frontend\ForumController@deletePost')->name('forum.deletePost');
Route::get('/forum/{id}/{threadId}/{postId}/editPost', 'Frontend\ForumController@editPost')->name('forum.editPost');


// FORUM END

Route::post('/issueStore', 'Frontend\IssueListController@storeIssue')->name('issueList.storeIssue');

Route::get('/user/create', 'Frontend\UserController@create')->name('user.create');
Route::post('/user/store', 'Frontend\UserController@store')->name('user.store');
Route::get('/user/{id}', 'Frontend\UserController@index')->name('user.index');
Route::get('/user/{id}/edit', 'Frontend\UserController@edit')->name('user.edit');
Route::put('/user/{id}/update', 'Frontend\UserController@update')->name('user.update');
Route::post('/user/{id}/lockUser', 'Frontend\UserController@lockUser')->name('user.lockUser');
Route::get('/user/confirmUser/{code}', 'Frontend\UserController@userConfirmed')->name('user.confirmed');

Route::get('/team', 'Frontend\TeamController@index')->name('team.index');

Route::get('/downloads', 'Frontend\DownloadController@index')->name('download.index');
Route::get('/tickets', 'Frontend\TicketsController@index')->name('tickets.index');


Route::get('/teamspeak', 'Frontend\TeamspeakController@index')->name('teamspeak.index');


Route::get('/media', 'Frontend\MediaController@index')->name('media.index');


Route::get('/city', 'Frontend\CityController@index')->name('city.index');

Route::get('/partner', 'Frontend\PartnerController@index')->name('partner.general');

Route::get('/pm', 'Frontend\PrivateMessagesController@getMessages')->name('pm.get.messages');
Route::get('/pm/createMessage', 'Frontend\PrivateMessagesController@createMessage')->name('pm.create.message');
Route::get('/pm/createMessageToUser/{userId}', 'Frontend\PrivateMessagesController@createMessageToUser')->name('pm.create.MessageToUser');


Route::post('/pm/storeMessage', 'Frontend\PrivateMessagesController@sendMessage')->name('pm.store.message');
Route::get('/pm/{id}', 'Frontend\PrivateMessagesController@openMessage')->name('pm.open.message');
Route::post('/pm/answerMessage/{id}', 'Frontend\PrivateMessagesController@answerMessage')->name('pm.answer.message');

Route::delete('pm/deletepm/{id}','Frontend\PrivateMessagesController@deleteMessage')->name('pm.delete.message');

// FRONTEND EVENT
Route::group(['prefix' => 'event'], function () {
	Route::get('/', 'Frontend\EventController@index')->name('event.index');
	Route::get('/general', 'Frontend\EventController@index')->name('event.general');
	Route::get('/tickets', 'Frontend\EventController@tickets')->name('event.tickets');
	Route::get('/tournaments', 'Frontend\EventController@tournaments')->name('event.tournaments');
	Route::get('/seatplan', 'Frontend\EventController@seatplan')->name('event.seatplan');
	// Route::get('/seatplan/reserveSeat/{id}', 'Frontend\EventController')->name('event.seatplanreserve');
	// Route::get('/seatplan/reserveSeat/{id}', 'Frontend\EventController')->name('event.seatplanreserve');
	// Route::get('/seatplan/reserveSeat/{id}', 'Frontend\EventController')->name('event.seatplanreserve');
	Route::get('/user', 'Frontend\EventController@user')->name('event.user');
	Route::get('/arrival', 'Frontend\EventController@arrival')->name('event.arrival');

	Route::get('/sponsors', 'Frontend\EventController@sponsors')->name('event.sponsors');

	Route::get('/downloads', 'Frontend\EventController@downloads')->name('event.downloads');

	Route::get('/team', 'Frontend\EventController@team')->name('event.team');

	Route::get('/halloffame', 'Frontend\EventController@halloffame')->name('event.halloffame');

	Route::get('/faq', 'Frontend\EventController@faq')->name('event.faq');

	Route::get('/registerNow/{id}', 'Frontend\EventController@registerNow')->name('event.register.now');
});
// FRONTEND EVENT END

// Calendar Events

Route::get('calendar', 'Frontend\Calendar\CalendarController@index')->name('calendar.events.index');
Route::post('calendar', 'Frontend\Calendar\CalendarController@addEvent')->name('calendar.events.add');