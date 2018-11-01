<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Com\System\User;
use App\Com\System\UserGroup;
use App\Com\System\Extension;
use App\Com\System\System;



class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
            Model::unguard();

            UserGroup::create(
            [
                "group_name" => "Administrator",
            ]);

            User::create(
            [
                "fullname"          => "Administrator",
                "username"          => "admin",
                "password"          => Hash::make('admin@123'),
                "user_group_id"     => 1,
                "active"            => 1
            ]);

            System::insert(
            [
                [
                    "code"      => "system",
                    "attribs"   => json_encode(
                    [
                        "dateformat_vi" => "d/m/Y",
                        "dateformat_en" => "d/m/Y",
                        "offline"       => 0,
                        "keywords"      => "",
                        "description"   => "",
                        "frontend_template"   => "default",
                        "backend_template"    => "default",
                        "version"       => "2.0.0",
                        "creation_date" => "Dec 2015",
                    ])
                ],
            ]);

            Extension::insert(
            [
                [
                    'name'          => 'System',
                    'type'          => 'System',
                    'location'      => 'admin',
                    'author'        => 'System',
                    'creation_date' => 'Dec 2015',
                    'copyright'     => '',
                    'license'       => '',
                    'author_email'  => '',
                    'author_url'    => '',
                    'version'       => '2.0.0',
                    'description'   => '',
                    'attribs'       => '',
                    'protected'     => 1
                ],
            ]);

            \App\Com\System\Route::insert(
            [
                [
                    'name'          => 'dashboard',
                    'alias'         => 'dashboard',
                    'ctrl'          => 'DashboardController',
                    'location'      => 'admin',
                    'extension_id'  => 1,
                    'perm'          => json_encode(
                                    [
                                        'CAN_ACCESS' => [1],
                                        'CAN_INSERT' => [1],
                                        'CAN_UPDATE' => [1],
                                        'CAN_DELETE' => [1],
                                        'IS_ADMIN'   => [1],
                                    ]),
                    'attribs'       => '',
                    'protected'     => 1,
                    'show_menu'     => 1
                ],
				[
                    'name'          => 'config',
                    'alias'         => 'configs',
                    'ctrl'          => 'ConfigController',
                    'location'      => 'admin',
                    'extension_id'  => 1,
                    'perm'          => json_encode(
                                    [
                                        'CAN_ACCESS' => [1],
                                        'CAN_INSERT' => [1],
                                        'CAN_UPDATE' => [1],
                                        'CAN_DELETE' => [1],
                                        'IS_ADMIN'   => [1],
                                    ]),
                    'attribs'       => '',
                    'protected'     => 1,
                    'show_menu'     => 1
                ],
				[
                    'name'          => 'user',
                    'alias'         => 'users',
                    'ctrl'          => 'UserController',
                    'location'      => 'admin',
                    'extension_id'  => 1,
                    'perm'          => json_encode(
                                    [
                                        'CAN_ACCESS' => [1],
                                        'CAN_INSERT' => [1],
                                        'CAN_UPDATE' => [1],
                                        'CAN_DELETE' => [1],
                                        'IS_ADMIN'   => [1],
                                    ]),
                    'attribs'       => '',
                    'protected'     => 1,
                    'show_menu'     => 1
                ],
                [
                    'name'          => 'usergroup',
                    'alias'         => 'user-groups',
                    'ctrl'          => 'UserGroupController',
                    'location'      => 'admin',
                    'extension_id'  => 1,
                    'perm'          => json_encode(
                                    [
                                        'CAN_ACCESS' => [1],
                                        'CAN_INSERT' => [1],
                                        'CAN_UPDATE' => [1],
                                        'CAN_DELETE' => [1],
                                        'IS_ADMIN'   => [1],
                                    ]),
                    'attribs'       => '',
                    'protected'     => 1,
                    'show_menu'     => 1
                ],
				[
                    'name'          => 'block',
                    'alias'         => 'blocks',
                    'ctrl'          => 'BlockController',
                    'location'      => 'admin',
                    'extension_id'  => 1,
                    'perm'          => json_encode(
                                    [
                                        'CAN_ACCESS' => [1],
                                        'CAN_INSERT' => [1],
                                        'CAN_UPDATE' => [1],
                                        'CAN_DELETE' => [1],
                                        'IS_ADMIN'   => [1],
                                    ]),
                    'attribs'       => '',
                    'protected'     => 1,
                    'show_menu'     => 1
                ],
				[
                    'name'          => 'extension',
                    'alias'         => 'extensions',
                    'ctrl'          => 'ExtensionController',
                    'location'      => 'admin',
                    'extension_id'  => 1,
                    'perm'          => json_encode(
                                    [
                                        'CAN_ACCESS' => [1],
                                        'CAN_INSERT' => [1],
                                        'CAN_UPDATE' => [1],
                                        'CAN_DELETE' => [1],
                                        'IS_ADMIN'   => [1],
                                    ]),
                    'attribs'       => '',
                    'protected'     => 1,
                    'show_menu'     => 1
                ],
				[
                    'name'          => 'template',
                    'alias'         => 'templates',
                    'ctrl'          => 'TemplateController',
                    'location'      => 'admin',
                    'extension_id'  => 1,
                    'perm'          => json_encode(
                                    [
                                        'CAN_ACCESS' => [1],
                                        'CAN_INSERT' => [1],
                                        'CAN_UPDATE' => [1],
                                        'CAN_DELETE' => [1],
                                        'IS_ADMIN'   => [1],
                                    ]),
                    'attribs'       => '',
                    'protected'     => 1,
                    'show_menu'     => 1
                ],
				[
                    'name'          => 'language',
                    'alias'         => 'languages',
                    'ctrl'          => 'LanguageController',
                    'location'      => 'admin',
                    'extension_id'  => 1,
                    'perm'          => json_encode(
                                    [
                                        'CAN_ACCESS' => [1],
                                        'CAN_INSERT' => [1],
                                        'CAN_UPDATE' => [1],
                                        'CAN_DELETE' => [1],
                                        'IS_ADMIN'   => [1],
                                    ]),
                    'attribs'       => '',
                    'protected'     => 1,
                    'show_menu'     => 1
                ],
            ]);
	}

}
