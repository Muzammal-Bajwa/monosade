<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProjectReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\WorkspaceController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\PaystackPaymentController;
use App\Http\Controllers\FlutterwavePaymentController;
use App\Http\Controllers\RazorpayPaymentController;
use App\Http\Controllers\MercadoPaymentController;
use App\Http\Controllers\CoingatePaymentController;
use App\Http\Controllers\ZoomMeetingController;
use App\Http\Controllers\PaymentWallPaymentController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TimeTrackerController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\ContractsTypeController;
use App\Http\Controllers\PlanRequestController;
use App\Http\Controllers\PaytmPaymentController;
use App\Http\Controllers\MolliePaymentController;
use App\Http\Controllers\SkrillPaymentController;






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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';


Route::get('/', [HomeController::class, 'landingPage'])->middleware(['XSS']);
Route::get('/{slug}/invoices/{id}/pay', [InvoiceController::class , 'payinvoice'])->name('pay.invoice');



Route::get('/check',[HomeController::class, 'check'])->middleware(['auth','XSS']);
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(['auth','XSS']);


Route::get('login/{lang?}', [AuthenticatedSessionController::class, 'showLoginForm'])->name('login')->middleware(['XSS']);
Route::get('register/{lang?}', [RegisteredUserController::class, 'showRegistrationForm'])->name('register')->middleware(['XSS']);
Route::get('password/resets/{lang?}', [AuthenticatedSessionController::class, 'showLinkRequestForm'])->name('password.request')->middleware(['XSS']);

Route::prefix('client')->as('client.')->group(function() {

    Route::post('login', [AuthenticatedSessionController::class,'clientLogin'])->name('login')->middleware(['XSS']);
    Route::get('login/{lang?}', [AuthenticatedSessionController::class ,'showClientLoginForm'])->name('login')->middleware(['XSS']);
    Route::post('logout', [ClientController::class, 'clientLogout'])->name('logout')->middleware(['auth:client','XSS']);


    Route::get('/my-account',[UserController::class, 'account'])->name('users.my.account')->middleware(['auth:client','XSS']);
    Route::post('/{slug}/my-account/{id}/update',[ClientController::class, 'update'])->name('update.account')->middleware(['auth:client','XSS']);
    Route::post('/my-account/password',[UserController::class ,'updatePassword'])->name('update.password')->middleware(['auth:client','XSS']);
    Route::post('/my-account/billing',[ClientController::class, 'updateBilling'])->name('update.billing')->middleware(['auth:client','XSS']);
    Route::delete('/my-account',[UserController::class, 'deleteAvatar'])->name('delete.avatar')->middleware(['auth:client','XSS']);

    // project
    Route::get('/{slug}/projects',[ProjectController::class, 'index'])->name('projects.index')->middleware(['auth:client','XSS']);
    Route::get('/{slug}/projects/{id}',[ProjectController::class, 'show'])->name('projects.show')->middleware(['auth:client','XSS']);
    Route::get('/{slug}/projects/milestone/{id}',[ProjectController::class, 'milestone'])->name('projects.milestone')->middleware(['auth:client','XSS']);
    Route::post('/{slug}/projects/milestone/{id}/store',[ProjectController::class, 'milestoneStore'])->name('projects.milestone.store')->middleware(['auth:client','XSS']);
    Route::get('/{slug}/projects/milestone/{id}/show',[ProjectController::class, 'milestoneShow'])->name('projects.milestone.show')->middleware(['auth:client','XSS']);
    Route::get('/{slug}/projects/milestone/{id}/edit',[ProjectController::class, 'milestoneEdit'])->name('projects.milestone.edit')->middleware(['auth:client','XSS']);
    Route::post('/{slug}/projects/milestone/{id}/update',[ProjectController::class, 'milestoneUpdate'])->name('projects.milestone.update')->middleware(['auth:client','XSS']);
    Route::delete('/{slug}/projects/milestone/{id}',[ProjectController::class, 'milestoneDestroy'])->name('projects.milestone.destroy')->middleware(['auth:client','XSS']);
    Route::get('/{slug}/projects/{id}/file/{fid}',[ProjectController::class ,'fileDownload'])->name('projects.file.download')->middleware(['auth:client','XSS']);
    Route::delete('/{slug}/projects/{id}/file/delete/{fid}',[ProjectController::class, 'fileDelete'])->name('projects.file.delete')->middleware(['auth:client','XSS']);
    
    // Task Board
    Route::get('/{slug}/projects/{id}/task-board',[ProjectController::class ,'taskBoard'])->name('projects.task.board')->middleware(['auth:client','XSS']);
    Route::get('/{slug}/projects/{id}/task-board/create',[ProjectController::class ,'taskCreate'])->name('tasks.create')->middleware(['auth:client','XSS']);
    Route::post('/{slug}/projects/{id}/task-board',[ProjectController::class ,'taskStore'])->name('tasks.store')->middleware(['auth:client','XSS']);
    Route::post('/{slug}/projects/{id}/task-board/order-update',[ProjectController::class ,'taskOrderUpdate'])->name('tasks.update.order')->middleware(['auth:client','XSS']);
    Route::get('/{slug}/projects/{id}/task-board/edit/{tid}',[ProjectController::class, 'taskEdit'])->name('tasks.edit')->middleware(['auth:client','XSS']);
    Route::post('/{slug}/projects/{id}/task-board/{tid}/update',[ProjectController::class, 'taskUpdate'])->name('tasks.update')->middleware(['auth:client','XSS']);
    Route::delete('/{slug}/projects/{id}/task-board/{tid}',[ProjectController::class, 'taskDestroy'])->name('tasks.destroy')->middleware(['auth:client','XSS']);
    Route::get('/{slug}/projects/{id}/task-board/{tid}/{cid?}',[ProjectController::class, 'taskShow'])->name('tasks.show')->middleware(['auth:client','XSS']);;

    Route::get('/{slug}/timesheet',[ProjectController::class, 'timesheet'])->name('timesheet.index')->middleware(['auth:client','XSS']);
    Route::get('/{slug}/timesheet-table-view', [ ProjectController::class ,'filterTimesheetTableView'])->name('filter.timesheet.table.view')->middleware(['auth:client', 'XSS']);
    Route::get('/{slug}/timesheet/{id}',[ProjectController::class, 'projectsTimesheet'])->name('projects.timesheet.index')->middleware(['auth:client','XSS']);

    // Gantt Chart
    Route::get('/{slug}/projects/{id}/gantt/{duration?}',[ProjectController::class, 'gantt'])->name('projects.gantt')->middleware(['auth:client','XSS']);
    Route::post('/{slug}/projects/{id}/gantt',[ProjectController::class, 'ganttPost'])->name('projects.gantt.post')->middleware(['auth:client','XSS']);


    // bug report
    Route::get('/{slug}/projects/{id}/bug_report',[ProjectController::class, 'bugReport'])->name('projects.bug.report')->middleware(['auth:client','XSS']);
    Route::get('/{slug}/projects/{id}/bug_report/create',[ProjectController::class, 'bugReportCreate'])->name('projects.bug.report.create')->middleware(['auth:client','XSS']);
    Route::post('/{slug}/projects/{id}/bug_report',[ProjectController::class, 'bugReportStore'])->name('projects.bug.report.store')->middleware(['auth:client','XSS']);
    Route::post('/{slug}/projects/{id}/bug_report/order-update',[ProjectController::class, 'bugReportOrderUpdate'])->name('projects.bug.report.update.order')->middleware(['auth:client','XSS']);
    Route::get('/{slug}/projects/{id}/bug_report/{bid}/show',[ProjectController::class, 'bugReportShow'])->name('projects.bug.report.show')->middleware(['auth:client','XSS']);
    Route::get('/{slug}/projects/{id}/bug_report/{bid}/edit',[ProjectController::class, 'bugReportEdit'])->name('projects.bug.report.edit')->middleware(['auth:client','XSS']);
    Route::post('/{slug}/projects/{id}/bug_report/{bid}/update',[ProjectController::class, 'bugReportUpdate'])->name('projects.bug.report.update')->middleware(['auth:client','XSS']);
    Route::delete('/{slug}/projects/{id}/bug_report/{bid}',[ProjectController::class, 'bugReportDestroy'])->name('projects.bug.report.destroy')->middleware(['auth:client','XSS']);

    Route::get('/{slug}/searchJson/{search?}',[ProjectController::class, 'getSearchJson'])->name('search.json')->middleware(['auth:client','XSS']);
    Route::get('/userProjectJson/{id}',[UserController::class, 'getProjectUserJson'])->name('user.project.json')->middleware(['auth:client','XSS']);
    Route::get('/projectMilestoneJson/{id}',[UserController::class, 'getProjectMilestoneJson'])->name('project.milestone.json')->middleware(['auth:client','XSS']);

    Route::get('/{slug}/invoices',[InvoiceController::class, 'index'])->name('invoices.index')->middleware(['auth:client', 'XSS']);
    Route::get('/{slug}/invoices/{id}',[InvoiceController::class, 'show'])->name('invoices.show')->middleware(['auth:client', 'XSS']);
    Route::get('/{slug}/invoices/{id}/print',[InvoiceController::class, 'printInvoice'])->name('invoice.print')->middleware( 'XSS');
    Route::post('/{slug}/invoices/{id}/payment',[InvoiceController::class, 'addPayment'])->name('invoice.payment')->middleware(['auth:client', 'XSS']);
    Route::get('/workspace/{id}',[WorkspaceController::class, 'changeCurrentWorkspace'])->name('change-workspace')->middleware(['auth:client','XSS']);

    Route::get('/{slug}/calendar/{id?}',[CalenderController::class, 'index'])->name('calender.index')->middleware(['auth:client','XSS']);

    Route::post('/{slug}/{id}/pay-with-paypal',[PaypalController::class, 'clientPayWithPaypal'])->name('pay.with.paypal')->middleware(['auth:client','XSS']);
    Route::get('/{slug}/{id}/get-payment-status',[PaypalController::class, 'clientGetPaymentStatus'])->name('get.payment.status')->middleware(['auth:client','XSS']);

    Route::get('/{slug?}', [HomeController::class, 'index'])->name('home')->middleware(['auth:client','XSS']);


    ////**===================================== Project Reports =======================================================////

    Route::resource('/{slug}/project_report',ProjectReportController::class)->middleware(['auth:client','XSS']);
    Route::post('/{slug}/project_report_data',[ProjectReportController::class, 'ajax_data'])->name('projects.ajax')->middleware(['auth:client','XSS']);
    Route::post('/{slug}/project_report/{id}',[ProjectReportController::class, 'show'])->name('project_report.show')->middleware(['auth:client','XSS']);

    Route::post('/{slug}/project_report/tasks/{id}',[ProjectReportController::class, 'ajax_tasks_report'])->name('tasks.report.ajaxdata')->middleware(['auth:client','XSS']);



////**===================================== Client Contract Module =======================================================////
    Route::resource('/{slug}/contracts', ContractController::class)->middleware(['auth:client','XSS']);
    Route::get('/{slug}/signature/{id}', [ContractController::class, 'signature'])->name('signature')->middleware(['auth:client','XSS']);
    Route::post('/{slug}/signaturestore', [ContractController::class, 'signatureStore'])->name('signaturestore')->middleware(['auth:client','XSS']);

    Route::post('/{slug}/contract/{id}/file', [ContractController::class , 'fileUpload',])->name('contracts.file.upload')->middleware(['auth:client','XSS']);

    Route::get('/{slug}/contract/{id}/file/{fid}', [ContractController::class, 'fileDownload',])->name('contracts.file.download')->middleware(['auth:client','XSS']);

   Route::delete('/{slug}/contract/{id}/file/delete', [ContractController::class, 'fileDelete',])->name('contracts.file.delete')->middleware(['auth:client','XSS']);

   Route::post('/{slug}/contract/{id}/comment', [ContractController::class, 'commentStore',])->name('comment_store.store')->middleware(['auth:client','XSS']);

   Route::get('/{slug}/contract/{id}/comment', [ContractController::class, 'commentDestroy',])->name('comment_store.destroy')->middleware(['auth:client','XSS']);

   Route::post('/{slug}/contract/{id}/notes', [ContractController::class, 'noteStore',])->name('note_store.store')->middleware(['auth:client','XSS']);
   Route::get('/{slug}/contract/{id}/notes', [ContractController::class, 'noteDestroy',])->name('note_store.destroy')->middleware(['auth:client','XSS']);

   Route::post('/{slug}/contract/{id}/contract_description', [ContractController::class,'contract_descriptionStore'])->name('contract.contract_description.store')->middleware(['auth:client']);

    //================================= Invoice Payment Gateways  ====================================//

    Route::post('/{slug}/invoice-pay-with-paystack/{invoice_id}',[PaystackPaymentController::class, 'invoicePayWithPaystack'])->name('invoice.pay.with.paystack')->middleware(['auth:client','XSS']);
    Route::get('/{slug}/invoice/paystack/{pay_id}/{invoice_id}', [PaystackPaymentController::class, 'getInvoicePaymentStatus'])->name('invoice.paystack')->middleware(['auth:client']);

    Route::post('/{slug}/invoice-pay-with-flaterwave/{invoice_id}',[FlutterwavePaymentController::class, 'invoicePayWithFlutterwave'])->name('invoice.pay.with.flaterwave')->middleware(['auth:client','XSS']);
    Route::get('/{slug}/invoice/flaterwave/{txref}/{invoice_id}', [FlutterwavePaymentController::class, 'getInvoicePaymentStatus'])->name('invoice.flaterwave')->middleware(['auth:client']);

    Route::post('/{slug}/invoice-pay-with-razorpay/{invoice_id}',[RazorpayPaymentController::class, 'invoicePayWithRazorpay'])->name('invoice.pay.with.razorpay')->middleware(['auth:client','XSS']);
    Route::get('/{slug}/invoice/razorpay/{txref}/{invoice_id}', [RazorpayPaymentController::class, 'getInvoicePaymentStatus'])->name('invoice.razorpay')->middleware(['auth:client']);

    Route::post('/{slug}/invoice-pay-with-paytm/{invoice_id}',[PaytmPaymentController::class, 'invoicePayWithPaytm'])->name('invoice.pay.with.paytm')->middleware(['auth:client','XSS']);
    // Route::post('/{slug}/invoice/paytm/{invoice}', [PaytmPaymentController::class, 'getInvoicePaymentStatus'])->name('invoice.paytm')->middleware(['auth:client']);

    Route::post('invoice/paytm', [PaytmPaymentController::class, 'getInvoicePaymentStatus'])->name('invoice.paytm')->middleware(['auth:client']);

    Route::post('/{slug}/invoice-pay-with-mercado/{invoice_id}',[MercadoPaymentController::class, 'invoicePayWithMercado'])->name('invoice.pay.with.mercado')->middleware(['auth:client','XSS']);
    Route::get('/{slug}/invoice/mercado/{invoice}', [MercadoPaymentController::class, 'getInvoicePaymentStatus'])->name('invoice.mercado')->middleware(['auth:client']);

    Route::post('/{slug}/invoice-pay-with-mollie/{invoice_id}',[MolliePaymentController::class, 'invoicePayWithMollie'])->name('invoice.pay.with.mollie')->middleware(['auth:client','XSS']);
    Route::get('/{slug}/invoice/mollie/{invoice}', [MolliePaymentController::class, 'getInvoicePaymentStatus'])->name('invoice.mollie')->middleware(['auth:client']);

    Route::post('/{slug}/invoice-pay-with-skrill/{invoice_id}',[SkrillPaymentController::class, 'invoicePayWithSkrill'])->name('invoice.pay.with.skrill')->middleware(['auth:client','XSS']);
    Route::get('/{slug}/invoice/skrill/{invoice}', [SkrillPaymentController::class, 'getInvoicePaymentStatus'])->name('invoice.skrill')->middleware(['auth:client']);

    Route::post('/{slug}/invoice-pay-with-coingate/{invoice_id}',[CoingatePaymentController::class, 'invoicePayWithCoingate'])->name('invoice.pay.with.coingate')->middleware(['auth:client','XSS']);
    Route::get('/{slug}/invoice/coingate/{invoice}', [CoingatePaymentController::class, 'getInvoicePaymentStatus'])->name('invoice.coingate')->middleware(['auth:client']);

    //================================= End Invoice Payment Gateways  ====================================//
    
    Route::get('/{slug}/zoom-meeting',[ZoomMeetingController::class, 'index'])->name('zoom-meeting.index')->middleware(['auth:client']);

});

Route::any('/plan/error/{flag}', [PaymentWallPaymentController::class, 'paymenterror'])->name('callback.error')->middleware(['auth','XSS']);
Route::post('paymentwall', [PaymentWallPaymentController::class, 'index'])->name('paymentwall')->middleware(['auth','XSS']);
Route::post('plan-pay-with-paymentwall/{plan}', [PaymentWallPaymentController::class, 'planPayWithPaymentwall'])->name('plan.pay.with.paymentwall')->middleware(['auth','XSS']);


// Calender
Route::get('/{slug}/calendar/{id?}',[CalenderController::class, 'index'])->name('calender.index')->middleware(['auth','CheckPlan','XSS']);

// Chats

Route::get('/{slug}/notification/seen',[UserController::class, 'notificationSeen'])->name('notification.seen');
// End Chats

Route::get('/settings',[SettingsController::class, 'index'])->name('settings.index')->middleware(['auth','XSS']);
Route::post('/settings',[SettingsController::class, 'store'])->name('settings.store')->middleware(['XSS']);
Route::post('/email-settings',[SettingsController::class, 'emailSettingStore'])->name('email.settings.store')->middleware(['auth','XSS']);
Route::post('/payment-settings',[SettingsController::class, 'paymentSettingStore'])->name('payment.settings.store')->middleware(['auth','XSS']);
Route::post('/pusher-settings',[SettingsController::class, 'pusherSettingStore'])->name('pusher.settings.store')->middleware(['auth','XSS']);
Route::get('/test',[SettingsController::class, 'testEmail'])->name('test.email')->middleware(['auth','XSS']);
Route::post('/test/send',[SettingsController::class, 'testEmailSend'])->name('test.email.send')->middleware(['auth','XSS']);

Route::get('/{slug}/clients',[ClientController::class, 'index'])->name('clients.index')->middleware(['auth','CheckPlan','XSS']);
Route::post('/{slug}/clients',[ClientController::class, 'store'])->name('clients.store')->middleware(['auth','XSS']);
Route::get('/{slug}/clients/create',[ClientController::class, 'create'])->name('clients.create')->middleware(['auth','XSS']);
Route::get('/{slug}/clients/{id}/edit',[ClientController::class, 'edit'])->name('clients.edit')->middleware(['auth','XSS']);
Route::post('/{slug}/clients/{id}/update',[ClientController::class, 'update'])->name('clients.update')->middleware(['auth','XSS']);
Route::delete('/{slug}/clients/{id}',[ClientController::class, 'destroy'])->name('clients.destroy')->middleware(['auth','XSS']);
// User
Route::get('/usersJson/{id}',[UserController::class, 'getUserJson'])->name('user.email.json')->middleware(['auth','XSS']);
Route::get('/{slug}/searchJson/{search?}',[ProjectController::class, 'getSearchJson'])->name('search.json')->middleware(['auth','XSS']);
Route::get('/userProjectJson/{id}',[UserController::class, 'getProjectUserJson'])->name('user.project.json')->middleware(['auth','XSS']);
Route::get('/projectMilestoneJson/{id}',[UserController::class, 'getProjectMilestoneJson'])->name('project.milestone.json')->middleware(['auth','XSS']);
Route::get('/users',[UserController::class, 'index'])->name('users.index')->middleware(['auth','CheckPlan','XSS']);
Route::get('/users/create',[UserController::class, 'create'])->name('users.create')->middleware(['auth','XSS']);
Route::post('/users/store',[UserController::class, 'store'])->name('users.store')->middleware(['auth','XSS']);
Route::delete('/users/{id}',[UserController::class, 'destroy'])->name('users.delete')->middleware(['auth','XSS']);
Route::get('/users/{id}',[UserController::class, 'changePlan'])->name('users.change.plan')->middleware(['auth','XSS']);
Route::get('/resetpassword/{id}',[UserController::class, 'resetPassword'])->name('users.reset.password')->middleware(['auth','XSS']);
Route::post('/changepassword/{id}',[UserController::class, 'changePassword'])->name('users.change.password')->middleware(['auth','XSS']);



Route::get('/{slug}/users',[UserController::class, 'index'])->name('users.index')->middleware(['auth','CheckPlan','XSS']);
Route::get('/{slug}/users/invite',[UserController::class, 'invite'])->name('users.invite')->middleware(['auth','XSS']);
Route::post('/{slug}/users/invite',[UserController::class, 'inviteUser'])->name('users.invite.update')->middleware(['auth','XSS']);
Route::get('/{slug}/users/edit/{id}',[UserController::class, 'edit'])->name('users.edit')->middleware(['auth','XSS']);
Route::post('/{slug}/users/update/{id}',[UserController::class, 'update'])->name('users.update')->middleware(['auth','XSS']);
Route::delete('/{slug}/users/{id}',[UserController::class, 'removeUser'])->name('users.remove')->middleware(['auth','XSS']);



Route::get('/my-account',[UserController::class, 'account'])->name('users.my.account')->middleware(['auth','XSS']);
Route::post('/{slug}/my-account/{id}/update',[UserController::class, 'update'])->name('update.account')->middleware(['auth','XSS']);
Route::post('/my-account/password',[UserController::class, 'updatePassword'])->name('update.password')->middleware(['auth','XSS']);
Route::delete('/my-account',[UserController::class, 'deleteAvatar'])->name('delete.avatar')->middleware(['auth','XSS']);
Route::delete('/delete-my-account',[UserController::class, 'deleteMyAccount'])->name('delete.my.account')->middleware(['auth','XSS']);

Route::get('/plans',[PlanController::class, 'index'])->name('plans.index')->middleware(['auth','XSS']);
Route::get('/plans/create',[PlanController::class, 'create'])->name('plans.create')->middleware(['auth','XSS']);
Route::post('/plans',[PlanController::class, 'store'])->name('plans.store')->middleware(['auth','XSS']);
Route::get('/plans/{id}/edit',[PlanController::class, 'edit'])->name('plans.edit')->middleware(['auth','XSS']);
Route::post('/plans/{id}/update',[PlanController::class, 'update'])->name('plans.update')->middleware(['auth','XSS']);
Route::post('/user-plans/',[PlanController::class, 'userPlan'])->name('update.user.plan')->middleware(['auth','XSS']);
Route::get('/payment/{frequency}/{code}', [PlanController::class, 'payment'])->name('payment')->middleware(['auth','XSS']);

Route::get('/orders',[StripePaymentController::class, 'index'])->name('order.index')->middleware(['auth','XSS']);
Route::post('/stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post')->middleware(['auth','XSS']);

Route::get('/apply-coupon', [CouponController::class, 'applyCoupon'])->name('apply.coupon')->middleware(['auth','XSS']);
Route::resource('coupons', CouponController::class)->middleware(['auth','XSS',]);

// Lang
Route::get('/admin/change_lang/{lang}',[WorkspaceController::class, 'changeLangAdmin'])->name('change_lang_admin')->middleware(['auth','XSS']);
Route::get('/workspace/{slug}/change_lang/{lang}',[WorkspaceController::class, 'changeLangWorkspace'])->name('change_lang_workspace')->middleware(['auth','XSS']);
Route::get('/workspace/{slug}/change_lang1/{lang}',[WorkspaceController::class, 'changeLangWorkspace1'])->name('change_lang_workspace1')->middleware(['auth:client','XSS']);

Route::get('/workspace/lang/create',[WorkspaceController::class, 'createLangWorkspace'])->name('create_lang_workspace')->middleware(['auth','XSS']);
Route::get('/workspace/lang/{lang?}',[WorkspaceController::class, 'langWorkspace'])->name('lang_workspace')->middleware(['auth','XSS']);
Route::post('/workspace/lang/{lang}',[WorkspaceController::class, 'storeLangDataWorkspace'])->name('store_lang_data_workspace')->middleware(['auth','XSS']);
Route::post('/workspace/lang',[WorkspaceController::class, 'storeLangWorkspace'])->name('store_lang_workspace')->middleware(['auth','XSS']);

// Workspace
Route::get('/workspace/{slug}/settings',[WorkspaceController::class, 'settings'])->name('workspace.settings')->middleware(['auth','XSS']);
Route::post('/workspace/{slug}/settings',[WorkspaceController::class, 'settingsStore'])->name('workspace.settings.store')->middleware(['auth','XSS']);

Route::post('/workspace',[WorkspaceController::class, 'store'])->name('add-workspace')->middleware(['auth','XSS']);
Route::delete('/workspace/{id}',[WorkspaceController::class, 'destroy'])->name('delete-workspace')->middleware(['auth','XSS']);
Route::delete('/workspace/leave/{id}',[WorkspaceController::class, 'leave'])->name('leave-workspace')->middleware(['auth','XSS']);
Route::get('/workspace/{id}',[WorkspaceController::class, 'changeCurrentWorkspace'])->name('change-workspace')->middleware(['auth','XSS']);



// project
Route::get('/{slug}/projects',[ProjectController::class, 'index'])->name('projects.index')->middleware(['auth','CheckPlan','XSS']);
Route::get('/{slug}/projects/create',[ProjectController::class, 'create'])->name('projects.create')->middleware(['auth','XSS']);
Route::get('/{slug}/projects/{id}',[ProjectController::class, 'show'])->name('projects.show')->middleware(['auth','CheckPlan','XSS']);
Route::post('/{slug}/projects',[ProjectController::class, 'store'])->name('projects.store')->middleware(['auth','XSS']);
Route::get('/{slug}/projects/{id}/edit',[ProjectController::class, 'edit'])->name('projects.edit')->middleware(['auth','XSS']);
Route::post('/{slug}/projects/{id}/update',[ProjectController::class, 'update'])->name('projects.update')->middleware(['auth','XSS']);
Route::delete('/{slug}/projects/{id}',[ProjectController::class, 'destroy'])->name('projects.destroy')->middleware(['auth','XSS']);
Route::delete('/{slug}/projects/leave/{id}',[ProjectController::class, 'leave'])->name('projects.leave')->middleware(['auth','XSS']);
Route::get('/{slug}/projects/invite/{id}',[ProjectController::class, 'popup'])->name('projects.invite.popup')->middleware(['auth','XSS']);
Route::get('/{slug}/projects/{id}/user/{uid}/permission',[ProjectController::class, 'userPermission'])->name('projects.user.permission')->middleware(['auth','XSS']);
Route::post('/{slug}/projects/{id}/user/{uid}/permission',[ProjectController::class, 'userPermissionStore'])->name('projects.user.permission.store')->middleware(['auth','XSS']);
Route::delete('/{slug}/projects/{id}/user/{uid}',[ProjectController::class, 'userDelete'])->name('projects.user.delete')->middleware(['auth','XSS']);
Route::get('/{slug}/projects/share/{id}',[ProjectController::class, 'sharePopup'])->name('projects.share.popup')->middleware(['auth','XSS']);
Route::get('/{slug}/projects/{id}/client/{uid}/permission',[ProjectController::class, 'clientPermission'])->name('projects.client.permission')->middleware(['auth','XSS']);
Route::post('/{slug}/projects/{id}/client/{uid}/permission',[ProjectController::class, 'clientPermissionStore'])->name('projects.client.permission.store')->middleware(['auth','XSS']);
Route::delete('/{slug}/projects/{id}/client/{uid}',[ProjectController::class, 'clientDelete'])->name('projects.client.delete')->middleware(['auth','XSS']);
Route::post('/{slug}/projects/share/{id}',[ProjectController::class, 'share'])->name('projects.share')->middleware(['auth','XSS']);
Route::post('/{slug}/projects/invite/{id}/update',[ProjectController::class, 'invite'])->name('projects.invite.update')->middleware(['auth','XSS']);
Route::get('/{slug}/projects/milestone/{id}',[ProjectController::class, 'milestone'])->name('projects.milestone')->middleware(['auth','XSS']);
Route::post('/{slug}/projects/milestone/{id}/store',[ProjectController::class, 'milestoneStore'])->name('projects.milestone.store')->middleware(['auth','XSS']);
Route::get('/{slug}/projects/milestone/{id}/show',[ProjectController::class, 'milestoneShow'])->name('projects.milestone.show')->middleware(['auth','XSS']);
Route::get('/{slug}/projects/milestone/{id}/edit',[ProjectController::class, 'milestoneEdit'])->name('projects.milestone.edit')->middleware(['auth','XSS']);
Route::post('/{slug}/projects/milestone/{id}/update',[ProjectController::class, 'milestoneUpdate'])->name('projects.milestone.update')->middleware(['auth','XSS']);
Route::delete('/{slug}/projects/milestone/{id}',[ProjectController::class, 'milestoneDestroy'])->name('projects.milestone.destroy')->middleware(['auth','XSS']);
Route::post('/{slug}/projects/{id}/file',[ProjectController::class, 'fileUpload'])->name('projects.file.upload')->middleware(['auth','XSS']);
Route::get('/{slug}/projects/{id}/file/{fid}',[ProjectController::class, 'fileDownload'])->name('projects.file.download')->middleware(['auth','XSS']);
Route::delete('/{slug}/projects/{id}/file/delete/{fid}',[ProjectController::class, 'fileDelete'])->name('projects.file.delete')->middleware(['auth','XSS']);

// Task Board
Route::get('/{slug}/projects/client/task-board/{code}',[ProjectController::class, 'taskBoard'])->name('projects.client.task.board');
Route::get('/{slug}/projects/{id}/task-board',[ProjectController::class, 'taskBoard'])->name('projects.task.board')->middleware(['auth','CheckPlan','XSS']);
Route::get('/{slug}/projects/{id}/task-board/create',[ProjectController::class, 'taskCreate'])->name('tasks.create')->middleware(['auth','XSS']);
Route::post('/{slug}/projects/{id}/task-board',[ProjectController::class, 'taskStore'])->name('tasks.store')->middleware(['auth','XSS']);
Route::post('/{slug}/projects/{id}/task-board/order-update',[ProjectController::class, 'taskOrderUpdate'])->name('tasks.update.order');
Route::get('/{slug}/projects/{id}/task-board/edit/{tid}',[ProjectController::class, 'taskEdit'])->name('tasks.edit')->middleware(['auth','XSS']);
Route::post('/{slug}/projects/{id}/task-board/{tid}/update',[ProjectController::class, 'taskUpdate'])->name('tasks.update')->middleware(['auth','XSS']);
Route::delete('/{slug}/projects/{id}/task-board/{tid}',[ProjectController::class, 'taskDestroy'])->name('tasks.destroy')->middleware(['auth','XSS']);
Route::get('/{slug}/projects/{id}/task-board/{tid}/{cid?}',[ProjectController::class, 'taskShow'])->name('tasks.show');
Route::post('/{slug}/projects/{id}/task-board/{tid}/drag',[ProjectController::class, 'taskDrag'])->name('tasks.drag.event');

// Gantt Chart
Route::get('/{slug}/projects/{id}/gantt/{duration?}',[ProjectController::class, 'gantt'])->name('projects.gantt')->middleware(['auth','CheckPlan','XSS']);
Route::post('/{slug}/projects/{id}/gantt',[ProjectController::class, 'ganttPost'])->name('projects.gantt.post')->middleware(['auth','XSS']);

Route::get('/{slug}/tasks',[ProjectController::class, 'allTasks'])->name('tasks.index')->middleware(['auth','CheckPlan','XSS']);
Route::post('/{slug}/tasks',[ProjectController::class, 'ajax_tasks'])->name('tasks.ajax')->middleware(['auth','XSS']);

// Timesheet
Route::get('/{slug}/tasks/{id?}',[ProjectController::class, 'getTask'])->name('tasks.ajax')->middleware(['auth','XSS']);
Route::get('/{slug}/timesheet',[ProjectController::class, 'timesheet'])->name('timesheet.index')->middleware(['auth','CheckPlan','XSS']);
Route::get('/{slug}/timesheet/create',[ProjectController::class, 'timesheetCreate'])->name('timesheet.create')->middleware(['auth','XSS']);
Route::post('/{slug}/timesheet/store',[ProjectController::class, 'timesheetStore'])->name('timesheet.store')->middleware(['auth','XSS']);
Route::get('/{slug}/timesheet/{id}/edit',[ProjectController::class, 'timesheetEdit'])->name('timesheet.edit')->middleware(['auth','XSS']);
Route::post('/{slug}/timesheet/{id}/update',[ProjectController::class, 'timesheetUpdate'])->name('timesheet.update')->middleware(['auth','XSS']);
Route::delete('/{slug}/timesheet/{id}',[ProjectController::class, 'timesheetDestroy'])->name('timesheet.destroy')->middleware(['auth','XSS']);

Route::post('/{slug}/projects/{id}/comment/{tid}/file/{cid?}',[ProjectController::class, 'commentStoreFile'])->name('comment.store.file');
Route::delete('/{slug}/projects/{id}/comment/{tid}/file/{fid}',[ProjectController::class, 'commentDestroyFile'])->name('comment.destroy.file');
Route::post('/{slug}/projects/{id}/comment/{tid}/{cid?}',[ProjectController::class, 'commentStore'])->name('comment.store');
Route::delete('/{slug}/projects/{id}/comment/{tid}/{cid}',[ProjectController::class, 'commentDestroy'])->name('comment.destroy');
Route::post('/{slug}/projects/{id}/sub-task/update/{stid}',[ProjectController::class, 'subTaskUpdate'])->name('subtask.update');
Route::post('/{slug}/projects/{id}/sub-task/{tid}/{cid?}',[ProjectController::class, 'subTaskStore'])->name('subtask.store');
Route::delete('/{slug}/projects/{id}/sub-task/{stid}',[ProjectController::class, 'subTaskDestroy'])->name('subtask.destroy');

// todo
//Route::get('/{slug}/todo',['as' => 'todos.index','uses' =>'TodoController@index'])->middleware(['auth','XSS']);
//Route::post('/{slug}/todo',['as' => 'todos.store','uses' =>'TodoController@store'])->middleware(['auth','XSS']);
//Route::post('/{slug}/todo',['as' => 'todos.update','uses' =>'TodoController@update'])->middleware(['auth','XSS']);
//Route::delete('/{slug}/todo',['as' => 'todos.destroy','uses' =>'TodoController@destroy'])->middleware(['auth','XSS']);

// note
Route::get('/{slug}/notes',[NoteController::class, 'index'])->name('notes.index')->middleware(['auth','CheckPlan','XSS']);
Route::get('/{slug}/notes/create',[NoteController::class, 'create'])->name('note.create')->middleware(['auth','XSS']);
Route::post('/{slug}/notes',[NoteController::class, 'store'])->name('notes.store')->middleware(['auth','XSS']);
Route::get('/{slug}/notes/{id}/edit',[NoteController::class, 'edit'])->name('notes.edit')->middleware(['auth','XSS']);
Route::post('/{slug}/notes/{id}/update',[NoteController::class, 'update'])->name('notes.update')->middleware(['auth','XSS']);
Route::delete('/{slug}/notes/{id}',[NoteController::class, 'destroy'])->name('notes.destroy')->middleware(['auth','XSS']);
// bug report
Route::get('/{slug}/projects/{id}/bug_report',[ProjectController::class, 'bugReport'])->name('projects.bug.report')->middleware(['auth','CheckPlan','XSS']);
Route::get('/{slug}/projects/{id}/bug_report/create',[ProjectController::class, 'bugReportCreate'])->name('projects.bug.report.create')->middleware(['auth','XSS']);
Route::post('/{slug}/projects/{id}/bug_report',[ProjectController::class, 'bugReportStore'])->name('projects.bug.report.store')->middleware(['auth','XSS']);
Route::post('/{slug}/projects/{id}/bug_report/order-update',[ProjectController::class, 'bugReportOrderUpdate'])->name('projects.bug.report.update.order')->middleware(['auth','XSS']);
Route::get('/{slug}/projects/{id}/bug_report/{bid}/show',[ProjectController::class, 'bugReportShow'])->name('projects.bug.report.show')->middleware(['auth','XSS']);
Route::get('/{slug}/projects/{id}/bug_report/{bid}/edit',[ProjectController::class, 'bugReportEdit'])->name('projects.bug.report.edit')->middleware(['auth','XSS']);
Route::post('/{slug}/projects/{id}/bug_report/{bid}/update',[ProjectController::class, 'bugReportUpdate'])->name('projects.bug.report.update')->middleware(['auth','XSS']);
Route::delete('/{slug}/projects/{id}/bug_report/{bid}',[ProjectController::class, 'bugReportDestroy'])->name('projects.bug.report.destroy')->middleware(['auth','XSS']);

Route::post('/{slug}/projects/{id}/bug_comment/{tid}/file/{cid?}',[ProjectController::class, 'bugStoreFile'])->name('bug.comment.store.file');
Route::delete('/{slug}/projects/{id}/bug_comment/{tid}/file/{fid}',[ProjectController::class, 'bugDestroyFile'])->name('bug.comment.destroy.file');
Route::post('/{slug}/projects/{id}/bug_comment/{tid}/{cid?}',[ProjectController::class, 'bugCommentStore'])->name('bug.comment.store');
Route::delete('/{slug}/projects/{id}/bug_comment/{tid}/{cid}',[ProjectController::class, 'bugCommentDestroy'])->name('bug.comment.destroy');

Route::get('/{slug}/invoices/preview/{template}/{color}',[InvoiceController::class,'previewInvoice'])->name('invoice.preview');
Route::resource('/{slug}/invoices',InvoiceController::class)->middleware(['CheckPlan']);
Route::get('/{slug}/invoices/{id}/item',[InvoiceController::class, 'create_item'])->name('invoice.item.create');
Route::post('/{slug}/invoices/{id}/item',[InvoiceController::class, 'store_item'])->name('invoice.item.store');
Route::delete('/{slug}/invoices/{id}/item/{iid}',[InvoiceController::class, 'destroy_item'])->name('invoice.item.destroy');
Route::get('/{slug}/invoices/{id}/print',[InvoiceController::class, 'printInvoice'])->name('invoice.print');

Route::get('/{slug}/taxes',[WorkspaceController::class, 'create_tax'])->name('tax.create')->middleware(['auth','XSS']);
Route::post('/{slug}/taxes',[WorkspaceController::class, 'store_tax'])->name('tax.store')->middleware(['auth','XSS']);
Route::get('/{slug}/taxes/{id}/edit',[WorkspaceController::class, 'edit_tax'])->name('tax.edit')->middleware(['auth','XSS']);
Route::post('/{slug}/taxes/{id}/update',[WorkspaceController::class, 'update_tax'])->name('tax.update')->middleware(['auth','XSS']);
Route::delete('/{slug}/taxes/{id}',[WorkspaceController::class, 'destroy_tax'])->name('tax.destroy')->middleware(['auth','XSS']);

Route::post('/{slug}/stages',[WorkspaceController::class, 'store_stages'])->name('stages.store')->middleware(['auth','XSS']);
Route::post('/{slug}/bug/stages',[WorkspaceController::class, 'store_bug_stages'])->name('bug.stages.store')->middleware(['auth','XSS']);


Route::post('/{slug}/manual-invoice-payment/{invoice_id}',[InvoiceController::class, 'addManualPayment'])->name('manual.invoice.payment')->middleware(['auth','XSS']);

Route::post('/plan-pay-with-paypal',[PaypalController::class, 'planPayWithPaypal'])->name('plan.pay.with.paypal')->middleware(['auth','XSS']);
Route::get('/{id}/plan-get-payment-status',[PaypalController::class, 'planGetPaymentStatus'])->name('plan.get.payment.status')->middleware(['auth','XSS']);



Route::get('plan_request', [PlanRequestController::class , 'index'])->name('plan_request.index')->middleware(['auth','XSS',]);
Route::get('request_frequency/{id}', [PlanRequestController::class, 'requestView'])->name('request.view')->middleware(['auth','XSS',]);
Route::get('request_send/{id}', [PlanRequestController::class, 'userRequest'])->name('send.request')->middleware(['auth','XSS',]);
Route::get('request_response/{id}/{response}', [PlanRequestController::class, 'acceptRequest'])->name('response.request')->middleware(['auth','XSS',]);
Route::get('request_cancel/{id}', [PlanRequestController::class, 'cancelRequest'])->name('request.cancel')->middleware(['auth','XSS',]);





Route::get('/{slug}/timesheet/{id}',[ProjectController::class, 'projectsTimesheet'])->name('projects.timesheet.index')->middleware(['auth','CheckPlan','XSS']);

Route::get('/{slug}/timesheet-table-view', [ProjectController::class, 'filterTimesheetTableView'])->name('filter.timesheet.table.view')->middleware(['auth', 'XSS']);

Route::get('/{slug}/append-timesheet-task-html', [ProjectController::class, 'appendTimesheetTaskHTML'])->name('append.timesheet.task.html')->middleware(['auth', 'XSS']);

Route::get('/{slug}/timesheet/create/{project_id}',[ProjectController::class, 'projectTimesheetCreate'])->name('project.timesheet.create')->middleware(['auth','XSS']);

Route::post('/{slug}/timesheet/store/{project_id}',[ProjectController::class, 'projectTimesheetStore'])->name('project.timesheet.store')->middleware(['auth','XSS']);

Route::get('/{slug}/timesheet/{timesheet_id}/edit/{project_id}',[ProjectController::class, 'projectTimesheetEdit'])->name('project.timesheet.edit')->middleware(['auth','XSS']);

Route::post('/{slug}/timesheet/{timesheet_id}/update/{project_id}',[ProjectController::class, 'projectTimesheetUpdate'])->name('project.timesheet.update')->middleware(['auth','XSS']);

Route::get('/{slug}/checkuserexists', [UserController::class, 'checkUserExists'])->name('user.exists')->middleware(['auth', 'XSS']);

Route::delete('/lang/{lang}',[WorkspaceController::class, 'destroyLang'])->name('lang.destroy')->middleware(['auth','XSS']);

Route::get('/stripe-payment-status/{plan_id}',[StripePaymentController::class, 'planGetStripePaymentStatus'])->name('stripe.payment.status');
Route::post('/webhook-stripe',[StripePaymentController::class, 'webhookStripe'])->name('webhook.stripe');

Route::get('/take-a-plan-trial/{plan_id}', [PlanController::class, 'takeAPlanTrial'])->name('take.a.plan.trial')->middleware(['auth','XSS']);
Route::get('/change-user-plan/{plan_id}', [PlanController::class, 'changeUserPlan'])->name('change.user.plan')->middleware(['auth','XSS']);

Route::get('user/{id}/plan/{pid}/{duration}', [UserController::class, 'manuallyActivatePlan'])->name('manually.activate.plan')->middleware(['auth','XSS',]);



//================================= Plan Payment Gateways Route ====================================//

Route::post('/plan-pay-with-paystack',[PaystackPaymentController::class, 'planPayWithPaystack'])->name('plan.pay.with.paystack')->middleware(['auth','XSS']);
Route::get('/plan/paystack/{pay_id}/{plan_id}', [PaystackPaymentController::class, 'getPaymentStatus'])->name('plan.paystack');

Route::post('/plan-pay-with-flaterwave',[FlutterwavePaymentController::class, 'planPayWithFlutterwave'])->name('plan.pay.with.flaterwave')->middleware(['auth','XSS']);
Route::get('/plan/flaterwave/{txref}/{plan_id}', [FlutterwavePaymentController::class, 'getPaymentStatus'])->name('plan.flaterwave');

Route::post('/plan-pay-with-razorpay',[RazorpayPaymentController::class, 'planPayWithRazorpay'])->name('plan.pay.with.razorpay')->middleware(['auth','XSS']);
Route::get('/plan/razorpay/{txref}/{plan_id}', [RazorpayPaymentController::class, 'getPaymentStatus'])->name('plan.razorpay');

Route::post('/plan-pay-with-paytm',[PaytmPaymentController::class, 'planPayWithPaytm'])->name('plan.pay.with.paytm')->middleware(['auth','XSS']);
Route::post('/plan/paytm/{plan}', [PaytmPaymentController::class, 'getPaymentStatus'])->name('plan.paytm');

Route::post('/plan-pay-with-mercado',[MercadoPaymentController::class, 'planPayWithMercado'])->name('plan.pay.with.mercado')->middleware(['auth','XSS']);
Route::get('/plan/mercado/{plan}', [MercadoPaymentController::class, 'getPaymentStatus'])->name('plan.mercado');

Route::post('/plan-pay-with-mollie',[MolliePaymentController::class, 'planPayWithMollie'])->name('plan.pay.with.mollie')->middleware(['auth','XSS']);
Route::get('/plan/mollie/{plan}', [MolliePaymentController::class,'getPaymentStatus'])->name('plan.mollie');

Route::post('/plan-pay-with-skrill',[SkrillPaymentController::class, 'planPayWithSkrill'])->name('plan.pay.with.skrill')->middleware(['auth','XSS']);
Route::get('/plan/skrill/{plan}', [SkrillPaymentController::class, 'getPaymentStatus'])->name('plan.skrill');

Route::post('/plan-pay-with-coingate',[CoingatePaymentController::class, 'planPayWithCoingate'])->name('plan.pay.with.coingate')->middleware(['auth']);
Route::get('/plan/coingate/{planID}', [CoingatePaymentController::class,  'getPaymentStatus'])->name('plan.coingate');

//================================= End Plan Payment Gateways Route ====================================//


//================================= Custom Landing Page ====================================//

//--------------------------------------------------------Import/Export Data Route-----------------------------------------------------------------


Route::get('import/user/file', [UserController::class, 'importFile'])->name('user.file.import');
Route::post('/import/user', [UserController::class, 'import'])->name('user.import');
Route::get('export/user', [UserController::class, 'export'])->name('user.export');



Route::get('/{slug}/import/client/file', [ClientController::class , 'importFile'])->name('client.file.import');
Route::post('import/client', [ClientController::class, 'import'])->name('client.import');
Route::get('export/client', [ClientController::class, 'export'])->name('client.export');

Route::get('/{slug}/import/project/file', [ProjectController::class, 'importFile'])->name('project.file.import');
Route::post('import/project', [ ProjectController::class, 'import'])->name('project.import');
Route::get('export/project', [ProjectController::class, 'export'])->name('project.export');

Route::get('export/invoice', [InvoiceController::class, 'export'])->name('invoice.export');


////------------------------tracker-----------------------------------------////

Route::get('/{slug}/projects/time-tracker/{id}',[ProjectController::class, 'tracker'])->name('projecttime.tracker')->middleware(['auth','XSS']);
Route::get('/{slug}/projectsss/time-tracker/{id}',[ProjectController::class, 'tracker'])->name('client.projecttime.tracker')->middleware(['auth:client','XSS']);
Route::delete('tracker/{tid}/destroy', [TimeTrackerController::class, 'Destroy'])->name('tracker.destroy');
Route::get('/{slug}/time-tracker',[TimeTrackerController::class, 'index'])->name('time.tracker')->middleware(['auth','XSS']);
Route::post('/{slug}/tracker/image-view', [TimeTrackerController::class, 'getTrackerImages'])->name('tracker.image.view');
Route::any('tracker/image-remove', [TimeTrackerController::class, 'removeTrackerImages'])->name('tracker.image.remove');


// ================================= Zoom Meeting ======================================//


Route::get('/{slug}/zoom-meeting',[ZoomMeetingController::class, 'index'])->name('zoom-meeting.index')->middleware(['auth','XSS']);
Route::get('/{slug}/zoom-meeting/create',[ZoomMeetingController::class, 'create'])->name('zoom-meeting.create')->middleware(['auth','XSS']);
Route::get('/{slug}/zoom-meeting/calendar',[ZoomMeetingController::class, 'calender'])->name('zoommeeting.Calender')->middleware(['auth','XSS']);
Route::get('/{slug}/Zoom-Meeting/calendar',[ZoomMeetingController::class, 'calender'])->name('zoommeetings.Calender')->middleware(['auth:client','XSS']);

Route::post('/{slug}/zoom-meeting/store',[ZoomMeetingController::class, 'store'])->name('zoom-meeting.store')->middleware(['auth','XSS']);
Route::get('/{slug}/zoom-meeting/{id}/show',[ZoomMeetingController::class, 'show'])->name('zoom_meeting.show')->middleware(['auth','XSS']);

Route::get('/{slug}/zoom-meetings/{id}/show',[ZoomMeetingController::class, 'show'])->name('zoom_meetings.show')->middleware(['auth:client','XSS']);

Route::get('/{slug}/zoom-meeting/{id}/edit',[ZoomMeetingController::class, 'edit'])->name('zoom-meeting.edit')->middleware(['auth','XSS']);
Route::post('/{slug}/zoom-meeting/{id}/update',[ZoomMeetingController::class, 'update'])->name('zoom-meeting.update')->middleware(['auth','XSS']);
Route::delete('/{slug}/zoom-meeting/{id}',[ZoomMeetingController::class, 'destroy'])->name('zoom-meeting.destroy')->middleware(['auth','XSS']);
Route::get('/{slug}/projects/{id}/members',[ProjectController::class, 'members'])->name('projects.members')->middleware(['auth','XSS']);


//=================================== slack=============================================================//

Route::post('/workspace/{slug}/settingsss',[WorkspaceController::class, 'settingsSlack'])->name('workspace.settings.Slack')->middleware(['auth','XSS']);


// ====================================telegram===============================================================//

Route::post('/workspace/{slug}/telegram',[WorkspaceController::class, 'settingstelegram'])->name('workspace.settings.telegram')->middleware(['auth','XSS']);

/*==================================Recaptcha====================================================*/

Route::post('/recaptcha-settings',[SettingsController::class, 'recaptchaSettingStore'])->name('recaptcha.settings.store')->middleware(['auth','XSS']);

/*==============================================Invoice Paymentwall===========================================================*/
Route::any('{slug}/paymentwall/invoice/{invoice_id}', [PaymentWallPaymentController::class, 'invoiceindex'])->name('paymentwall.index');
Route::post('{slug}/invoice-pay-with-paymentwall/{invoice_id}', [PaymentWallPaymentController::class, 'invoicePayWithPaymentwall'])->name('invoice.pay.with.paymentwall');
Route::any('{slug}/invoice/error/{flag}/{invoice_id}', [PaymentWallPaymentController::class, 'orderpaymenterror'])->name('invoice.callback.error');

/*================================================client password reset======================================================*/
Route::get('{slug}/client/resetpassword/{id}',[ClientController::class, 'resetPassword'])->name('client.reset.password')->middleware(['auth','XSS']);
Route::post('{slug}/client/changepassword/{id}',[ClientController::class, 'changePassword'])->name('client.change.password')->middleware(['auth','XSS']);

/*================================================Email Templates======================================================*/

Route::get('email_template_lang/{id}/{lang?}', [EmailTemplateController::class, 'manageEmailLang'])->name('manage.email.language')->middleware(['auth']);
Route::post('email_template_store/{pid}', [EmailTemplateController::class, 'storeEmailLang'])->name('store.email.language')->middleware(['auth']);
Route::any('{slug}/email_template_status/{id}', [EmailTemplateController::class, 'updateStatus'])->name('status.email.language')->middleware(['auth']);

Route::resource('email_template', EmailTemplateController::class)->middleware(['auth']);
Route::resource('email_template_lang', EmailTemplateLangController::class)->middleware(['auth','XSS']);
// End Email Templates



////**===================================== Project Reports =======================================================////

Route::resource('/{slug}/project_report',ProjectReportController::class)->middleware(['auth','XSS']);
Route::post('/{slug}/project_report_data',[ProjectReportController::class, 'ajax_data'])->name('projects.ajax')->middleware(['auth','XSS']);
Route::post('/{slug}/project_report/{id}',[ProjectReportController::class, 'show'])->name('project_report.show')->middleware(['auth','XSS']);

Route::post('/{slug}/project_report/tasks/{id}',[ProjectReportController::class, 'ajax_tasks_report'])->name('tasks.report.ajaxdata')->middleware(['auth','XSS']);

Route::get('export/task_report/{id}', [ProjectReportController::class, 'export'])->name('project_report.export');


// End Project Reports




//////****================================== Contract Module ===========================================******///////
Route::resource('/{slug}/contract_type', ContractsTypeController::class)->middleware(['auth','XSS']);

Route::resource('/{slug}/contracts', ContractController::class)->middleware(['auth','XSS']);

Route::get('get-projects/{client_id}', [ContractController::class, 'clientByProject'])->name('project.by.user.id')->middleware(['auth','XSS']);


Route::get('/{slug}/contract/{id}',[ContractController::class, 'copycontract'])->name('contracts.copy')->middleware(['auth','XSS']);
Route::post('/{slug}/contract/copy/store/{id}',[ContractController::class, 'copycontractstore'])->name('contracts.copy.store')->middleware(['auth','XSS']);


Route::post('/{slug}/contract/{id}/contract_description', [ContractController::class, 'contract_descriptionStore'])->name('contract.contract_description.store')->middleware(['auth']);
Route::post('/{slug}/contract/{id}/file', [ContractController::class, 'fileUpload',])->name('contracts.file.upload')->middleware(['auth','XSS']);

Route::get('/{slug}/contract/{id}/file/{fid}', [ContractController::class, 'fileDownload',])->name('contracts.file.download')->middleware(['auth','XSS']);
Route::delete('/{slug}/contract/{id}/file/delete', [ContractController::class, 'fileDelete',])->name('contracts.file.delete')->middleware(['auth','XSS']);

Route::post('/{slug}/contract/{id}/comment', [ContractController::class, 'commentStore',])->name('comment_store.store')->middleware(['auth']);
Route::get('/{slug}/contract/{id}/comment', [ContractController::class, 'commentDestroy',])->name('comment_store.destroy');
Route::post('/{slug}/contract/{id}/notes', [ContractController::class, 'noteStore',])->name('note_store.store')->middleware(['auth']);
Route::get('/{slug}/contract/{id}/notes', [ContractController::class, 'noteDestroy',])->name('note_store.destroy')->middleware(['auth']);

Route::get('/{slug}/contract/{id}/mail', [ContractController::class,  'sendmailContract',])->name('send.mail.contract');
Route::get('/{slug}/contract/pdf/{id}', [ContractController::class, 'pdffromcontract'])->name('contract.download.pdf');
Route::get('/{slug}/contract/{id}/get_contract', [ContractController::class, 'printContract'])->name('get.contract');


Route::get('/{slug}/signature/{id}', [ContractController::class, 'signature'])->name('signature')->middleware(['auth','XSS']);
Route::post('/{slug}/signaturestore', [ContractController::class, 'signatureStore'])->name('signaturestore')->middleware(['auth','XSS']);

Route::post('/{slug}/contract_status_edit/{id}', [ContractController::class, 'contract_status_edit'])->name('contract.status')->middleware(['auth','XSS']);


///////*************End Contract Module ==================================================================================////


///////////////////////////////-------------------Storage-Setting--------------------------------------------------\\\\\\\\\
  Route::post('storage-settings',[SettingsController::class, 'storageSettingStore'])->name('storage.setting.store')->middleware(['auth','XSS']);


  Route::post(
    '/{slug}/Notification/Delete', [UserController::class, 'delete_all_notification',])->name('delete_all.notifications');
