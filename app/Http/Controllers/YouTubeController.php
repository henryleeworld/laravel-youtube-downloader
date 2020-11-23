<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use YouTube\YouTubeDownloader;
use YouTube\YouTubeStreamer;

class YouTubeController extends Controller
{

    private $youTubeDownloader;

    public function __construct(YouTubeDownloader $youTubeDownloader, YouTubeStreamer $youTubeStreamer)
    {
        $this->youTubeDownloader = $youTubeDownloader;
        $this->youTubeStreamer   = $youTubeStreamer;
    }

    public function index() 
    {
        return view('youtube.index');
    }

    public function download(Request $request) 
    {
        $links = $this->youTubeDownloader->getDownloadLinks($request->url);
        return response()->json([
            'error' => '',
            'links' => $links,
        ]);
    }

    public function stream(Request $request) 
    {
        return $this->youTubeStreamer->stream($request->url);
    }
}
