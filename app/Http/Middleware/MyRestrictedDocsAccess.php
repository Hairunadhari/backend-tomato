<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;  // Pastikan Gate di-import

class MyRestrictedDocsAccess
{
    public function handle($request, Closure $next)
    {
        // Cek apakah aplikasi sedang berjalan di environment lokal
        if (app()->environment('local')) {
            return $next($request);  // Lanjutkan jika di environment lokal
        }
    
        // Cek apakah pengguna memiliki izin untuk melihat dokumentasi API
        if (Gate::allows('viewApiDocs')) {
            return $next($request);  // Lanjutkan jika akses diizinkan
        }
    
        abort(403);  // Tolak akses jika tidak memenuhi syarat
    }
}
