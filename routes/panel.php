<?php

use App\Http\Controllers\Dashboard;
// use App\Http\Controllers\PolicyController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WebsiteInformationController;
use App\Http\Controllers\ContactInformationController;
use App\Http\Controllers\EventDetailsController;
use App\Http\Controllers\VisionController;

Route::prefix('panel')->middleware('auth')->group(function () {
    Route::get('dashboard', [Dashboard::class, 'index'])->name('dashboard');



    // users & customers
    Route::prefix('users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('users.index');
        Route::post('store', [UsersController::class, 'store'])->name('users.store');
        Route::delete('delete', [UsersController::class, 'destroy'])->name('users.delete');
        Route::get('edit/{email}', [UsersController::class, 'edit'])->name('users.edit');
        Route::patch('update', [UsersController::class, 'update'])->name('users.update');
    });

    // Frontend Pages Content
    Route::prefix('pages')->group(function () {

        // Policies
        // Route::get('policies', [PolicyController::class, 'index'])->name('policies.index');
        // Route::patch('privacy', [PolicyController::class, 'privacy'])->name('policies.privacy');
        // Route::patch('refund', [PolicyController::class, 'refund'])->name('policies.refund');

        // Terms
        // Route::get('tos', [PolicyController::class, 'tos'])->name('tos.index');
        // Route::patch('tos/update', [PolicyController::class, 'tosUpdate'])->name('tos.update');

        // Website Information
        Route::get('website-information', [WebsiteInformationController::class, 'index'])->name('info.index');
        Route::get('vision-information', [VisionController::class, 'index'])->name('vision.index');

        Route::put('website-information/update', [WebsiteInformationController::class, 'update'])->name('info.update');
        Route::put('vision-information/update', [VisionController::class, 'update'])->name('vision.update');

        // Contact Information
        Route::get('contact-information', [ContactInformationController::class, 'index'])->name('contact.index');
        Route::put('contact-information/update', [ContactInformationController::class, 'update'])->name('contact.update');

        // Event Details
        Route::get('event-details', [EventDetailsController::class, 'index'])->name('event.index');
        Route::put('event-details/update', [EventDetailsController::class, 'update'])->name('event.update');
    });


    // group post
    Route::get('groups', [RolesController::class, 'groupsIndex'])->name('groups.index');
    Route::post('group/store', [RolesController::class, 'groupStore'])->name('group.store');
    Route::patch('group/update/{id}', [RolesController::class, 'groupUpdate'])->name('group.update');
    Route::delete('group/delete', [RolesController::class, 'groupDelete'])->name('group.delete');

    // permission post
    Route::get('permissions', [RolesController::class, 'permissionsIndex'])->name('permissions.index');
    Route::post('permission/store', [RolesController::class, 'permissionStore'])->name('permission.store');
    Route::patch('permission/update', [RolesController::class, 'permissionUpdate'])->name('permission.update');
    Route::delete('permission/delete', [RolesController::class, 'permissionDelete'])->name('permission.delete');

    // role post
    Route::get('roles', [RolesController::class, 'rolesIndex'])->name('roles.index');
    Route::get('role/create', [RolesController::class, 'roleCreate'])->name('role.create');
    Route::post('role/store', [RolesController::class, 'roleStore'])->name('role.store');
    Route::get('role/edit/{name}', [RolesController::class, 'roleEdit'])->name('role.edit');
    Route::patch('role/update', [RolesController::class, 'roleUpdate'])->name('role.update');
    Route::delete('role/delete', [RolesController::class, 'roleDelete'])->name('role.delete');
});
