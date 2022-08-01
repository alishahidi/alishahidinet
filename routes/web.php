<?php

use System\Router\Web\Route;

Route::get('/captcha/get', 'Captcha\CaptchaController@get', 'captcha.get');

// editor Routes
Route::post('/file/image/upload', "File\ImageController@upload", 'file.image.upload');

// Home Controller
Route::get('/', "Home\HomeController@index", 'home.index');
Route::get('/home', "Home\HomeController@index", 'home.home');
Route::get('/url/{token}', "Home\HomeController@url", 'home.url');
Route::get('/feed', "Home\HomeController@feed", 'home.feed');
Route::get('/rss', "Home\HomeController@feed", 'home.rss');
Route::get('/contact', "Home\ContactController@index", 'home.contact.index');
Route::post('/contact', "Home\ContactController@store", 'home.contact.store');
Route::post('/contact/send/show', "Home\ContactController@sendShow", 'home.contact.send.show');
Route::get('/contact/show/{support_key}', "Home\ContactController@show", 'home.contact.show');
Route::get('/about', "Home\HomeController@about", 'home.about.index');
Route::get('/articles', "Home\HomeController@allArticle", 'home.article.all');
Route::get('/article/{id}/{slug}', "Home\HomeController@article", 'home.article.show');
Route::post('/article/{id}/comment', "Home\HomeController@comment", 'home.article.comment');
Route::get('/topic/{id}/{slug}', "Home\HomeController@topic", 'home.topic.show');
Route::get('/tag/{id}/{slug}', "Home\HomeController@tag", 'home.tag.index');

// Auth Routes
Route::get('/auth/login', "Auth\LoginController@view", 'auth.login.view');
Route::post('/auth/login', "Auth\LoginController@login", 'auth.login');
Route::get('/auth/register', "Auth\RegisterController@view", 'auth.register.view');
Route::post('/auth/register', "Auth\RegisterController@register", 'auth.register');
Route::get('/auth/logout', "Auth\LogoutController@logout", 'auth.logout');

Route::get('/admin', 'Admin\AdminController@index', 'admin.index');

// Article Routes
Route::get('/admin/article', "Admin\ArticleController@index", 'admin.article.index');
Route::get('/admin/article/create', "Admin\ArticleController@create", 'admin.article.create');
Route::post('/admin/article/store', "Admin\ArticleController@store", 'admin.article.store');
Route::get('/admin/article/edit/{id}', "Admin\ArticleController@edit", 'admin.article.edit');
Route::put('/admin/article/update/{id}', "Admin\ArticleController@update", 'admin.article.update');
Route::delete('/admin/article/delete/{id}', "Admin\ArticleController@destroy", 'admin.article.delete');

// User Routes
Route::get('/admin/user', "Admin\UserController@index", 'admin.user.index');
Route::get('/admin/user/edit/{id}', "Admin\UserController@edit", 'admin.user.edit');
Route::put('/admin/user/update/{id}', "Admin\UserController@update", 'admin.user.update');

// Topic Routes
Route::get('/admin/topic', "Admin\TopicController@index", 'admin.topic.index');
Route::get('/admin/topic/create', "Admin\TopicController@create", 'admin.topic.create');
Route::post('/admin/topic/store', "Admin\TopicController@store", 'admin.topic.store');
Route::get('/admin/topic/edit/{id}', "Admin\TopicController@edit", 'admin.topic.edit');
Route::put('/admin/topic/update/{id}', "Admin\TopicController@update", 'admin.topic.update');
Route::delete('/admin/topic/delete/{id}', "Admin\TopicController@destroy", 'admin.topic.delete');

// Contact Routes
Route::get('/admin/contact', "Admin\ContactController@index", 'admin.contact.index');
Route::get('/admin/contact/view/{id}', "Admin\ContactController@view", 'admin.contact.view');
Route::post('/admin/contact/answer/{id}', "Admin\ContactController@answer", 'admin.contact.answer');
Route::delete('/admin/contact/delete/{id}', "Admin\ContactController@answerDestroy", 'admin.contact.answer.destroy');

// Comment Routes
Route::get('/admin/comment', "Admin\CommentController@index", 'admin.comment.index');
Route::get('/admin/comment/view/{id}', "Admin\CommentController@view", 'admin.comment.view');
Route::put('/admin/comment/approved/{id}', "Admin\CommentController@approved", 'admin.comment.approved');

// Service Routes
Route::get('/admin/service', "Admin\ServiceController@index", 'admin.service.index');
Route::get('/admin/service/create', "Admin\ServiceController@create", 'admin.service.create');
Route::post('/admin/service/store', "Admin\ServiceController@store", 'admin.service.store');
Route::get('/admin/service/edit/{id}', "Admin\ServiceController@edit", 'admin.service.edit');
Route::put('/admin/service/update/{id}', "Admin\ServiceController@update", 'admin.service.update');
Route::delete('/admin/service/delete/{id}', "Admin\ServiceController@destroy", 'admin.service.delete');

// User Routes
Route::get('/admin/user', "Admin\UserController@index", 'admin.user.index');
Route::get('/admin/user/edit/{id}', "Admin\UserController@edit", 'admin.user.edit');
Route::put('/admin/user/update/{id}', "Admin\UserController@update", 'admin.user.update');
Route::delete('/admin/user/delete/{id}', "Admin\UserController@destroy", 'admin.user.delete');

// Skill Routes
Route::get('/admin/skill', "Admin\SkillController@index", 'admin.skill.index');
Route::get('/admin/skill/create', "Admin\SkillController@create", 'admin.skill.create');
Route::post('/admin/skill/store', "Admin\SkillController@store", 'admin.skill.store');
Route::get('/admin/skill/edit/{id}', "Admin\SkillController@edit", 'admin.skill.edit');
Route::put('/admin/skill/update/{id}', "Admin\SkillController@update", 'admin.skill.update');
Route::delete('/admin/skill/delete/{id}', "Admin\SkillController@destroy", 'admin.skill.delete');

// Project Routes
Route::get('/admin/project', "Admin\ProjectController@index", 'admin.project.index');
Route::get('/admin/project/create', "Admin\ProjectController@create", 'admin.project.create');
Route::post('/admin/project/store', "Admin\ProjectController@store", 'admin.project.store');
Route::get('/admin/project/edit/{id}', "Admin\ProjectController@edit", 'admin.project.edit');
Route::put('/admin/project/update/{id}', "Admin\ProjectController@update", 'admin.project.update');
Route::delete('/admin/project/delete/{id}', "Admin\ProjectController@destroy", 'admin.project.delete');

Route::get('/panel', 'Panel\PanelController@index', 'panel.index');

// Comment Routes
Route::get('/panel/comment', "Panel\CommentController@index", 'panel.comment.index');
Route::get('/panel/comment/edit/{id}', "Panel\CommentController@edit", 'panel.comment.edit');
Route::put('/panel/comment/update/{id}', "Panel\CommentController@update", 'panel.comment.update');
Route::delete('/panel/comment/delete/{id}', "Panel\CommentController@destroy", 'panel.comment.delete');

// Detail Routes
Route::get('/panel/detail', "Panel\DetailController@index", 'panel.detail.index');
Route::get('/panel/detail/edit', "Panel\DetailController@edit", 'panel.detail.edit');
Route::put('/panel/detail/update', "Panel\DetailController@update", 'panel.detail.update');

// Password Routes
Route::get('/panel/password', "Panel\PasswordController@index", 'panel.password.index');
Route::get('/panel/password/edit', "Panel\PasswordController@edit", 'panel.password.edit');
Route::put('/panel/password/update', "Panel\PasswordController@update", 'panel.password.update');
