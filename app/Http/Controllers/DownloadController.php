<?php

namespace App\Http\Controllers;

use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DownloadController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  string $token
     * @return Response
     */
    public function get(string $token)
    {
        $download = Download::find($token);
        return redirect($download->route);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Download $download
     * @return Response
     */
    public function destroy(Download $download)
    {
        //
    }
}
