<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\Cors;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;
use App\Filters\Admin;
use App\Filters\Auth;
use App\Filters\Karyawan;

class Filters extends BaseFilters
{
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => Cors::class,
        'forcehttps'    => ForceHTTPS::class,
        'pagecache'     => PageCache::class,
        'performance'   => PerformanceMetrics::class,
        'admin'         => Admin::class,
        'auth'          => Auth::class,
        'karyawan'      => Karyawan::class,
    ];

    public array $globals = [
        'before' => [
            'honeypot',
        ],
        'after' => [
            'toolbar',
        ],
    ];

    public array $methods = [];

    public array $filters = [
        'admin' => [
            'before' => ['departemen/*', 'jabatan/*', 'karyawan', 'karyawan/create', 'karyawan/detail/*', 'karyawan/edit/*', 'penggajian', 'penggajian/create', 'penggajian/detail/*', 'penggajian/edit/*', 'penggajian/delete/*', 'laporan/*'],
        ],
    ];
}
