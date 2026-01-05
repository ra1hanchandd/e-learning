<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Routes Configuration
 * E-Learning Bootcamp System
 */

// Default controller
$route['default_controller'] = 'auth';

// 404 override
$route['404_override'] = '';

// Translate URI dashes
$route['translate_uri_dashes'] = FALSE;

// =====================================================
// AUTH ROUTES
// =====================================================
$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';
$route['register'] = 'auth/register';

// =====================================================
// ADMIN ROUTES
// =====================================================
$route['admin'] = 'admin/dashboard';
$route['admin/dashboard'] = 'admin/dashboard';

// Mentor Routes
$route['admin/mentor'] = 'admin/mentor';
$route['admin/mentor/create'] = 'admin/mentor_create';
$route['admin/mentor/store'] = 'admin/mentor_store';
$route['admin/mentor/edit/(:num)'] = 'admin/mentor_edit/$1';
$route['admin/mentor/update/(:num)'] = 'admin/mentor_update/$1';
$route['admin/mentor/delete/(:num)'] = 'admin/mentor_delete/$1';

// Bootcamp Routes
$route['admin/bootcamp'] = 'admin/bootcamp';
$route['admin/bootcamp/create'] = 'admin/bootcamp_create';
$route['admin/bootcamp/store'] = 'admin/bootcamp_store';
$route['admin/bootcamp/edit/(:num)'] = 'admin/bootcamp_edit/$1';
$route['admin/bootcamp/update/(:num)'] = 'admin/bootcamp_update/$1';
$route['admin/bootcamp/delete/(:num)'] = 'admin/bootcamp_delete/$1';

// Batch Routes
$route['admin/batch'] = 'admin/batch';
$route['admin/batch/create'] = 'admin/batch_create';
$route['admin/batch/store'] = 'admin/batch_store';
$route['admin/batch/edit/(:num)'] = 'admin/batch_edit/$1';
$route['admin/batch/update/(:num)'] = 'admin/batch_update/$1';
$route['admin/batch/delete/(:num)'] = 'admin/batch_delete/$1';

// Peserta Routes
$route['admin/peserta'] = 'admin/peserta';
$route['admin/peserta/detail/(:num)'] = 'admin/peserta_detail/$1';

// Pendaftaran Routes
$route['admin/pendaftaran'] = 'admin/pendaftaran';

// Absensi Routes
$route['admin/absensi'] = 'admin/absensi';
$route['admin/absensi/batch/(:num)'] = 'admin/absensi_batch/$1';
$route['admin/absensi/store'] = 'admin/absensi_store';
$route['admin/absensi/history/(:num)'] = 'admin/absensi_history/$1';
$route['admin/absensi/edit/(:num)'] = 'admin/absensi_edit/$1';
$route['admin/absensi/update/(:num)'] = 'admin/absensi_update/$1';
$route['admin/absensi/delete/(:num)'] = 'admin/absensi_delete/$1';
$route['admin/absensi/auto-alpha/(:num)'] = 'admin/absensi_auto_alpha/$1';

// Tugas Routes
$route['admin/tugas'] = 'admin/tugas';
$route['admin/tugas/create'] = 'admin/tugas_create';
$route['admin/tugas/store'] = 'admin/tugas_store';
$route['admin/tugas/edit/(:num)'] = 'admin/tugas_edit/$1';
$route['admin/tugas/update/(:num)'] = 'admin/tugas_update/$1';
$route['admin/tugas/delete/(:num)'] = 'admin/tugas_delete/$1';
$route['admin/tugas/submissions/(:num)'] = 'admin/tugas_submissions/$1';

// Penilaian Routes
$route['admin/penilaian'] = 'admin/penilaian';
$route['admin/penilaian/nilai/(:num)'] = 'admin/penilaian_nilai/$1';
$route['admin/penilaian/store'] = 'admin/penilaian_store';

// Report Routes
$route['admin/report'] = 'admin/report';
$route['admin/report/pendaftaran'] = 'admin/report_pendaftaran';
$route['admin/report/absensi'] = 'admin/report_absensi';
$route['admin/report/nilai'] = 'admin/report_nilai';
$route['admin/report/export/(:any)'] = 'admin/report_export/$1';
$route['admin/report/export_pdf/(:any)'] = 'admin/report_export_pdf/$1';

// =====================================================
// USER ROUTES
// =====================================================
$route['user'] = 'user/dashboard';
$route['user/dashboard'] = 'user/dashboard';
$route['user/bootcamp'] = 'user/bootcamp';
$route['user/bootcamp/detail/(:num)'] = 'user/bootcamp_detail/$1';
$route['user/daftar/(:num)'] = 'user/daftar/$1';
$route['user/pendaftaran'] = 'user/pendaftaran';
$route['user/bootcamp_saya'] = 'user/pendaftaran';
$route['user/daftar_bootcamp'] = 'user/bootcamp';
$route['user/tugas'] = 'user/tugas';
$route['user/tugas/detail/(:num)'] = 'user/tugas_detail/$1';
$route['user/tugas/upload/(:num)'] = 'user/tugas_upload/$1';
$route['user/tugas/submit'] = 'user/tugas_submit';
$route['user/absensi'] = 'user/absensi';
$route['user/nilai'] = 'user/nilai';
$route['user/profil'] = 'user/profil';
$route['user/profil/update'] = 'user/profil_update';
