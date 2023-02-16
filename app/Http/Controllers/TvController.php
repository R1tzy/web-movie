<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\Api;
use App\ViewModels\TvsViewModel;
use App\ViewModels\TvViewModel;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularTv = Api::get('/tv/popular?language=pt-BR&region=BR')
        ->json()['results'];

        $ratedTv = Api::get('/tv/top_rated?language=pt-BR')
        ->json()['results'];

        $genres = Api::get('/genre/tv/list?language=pt-BR')
        ->json()['genres'];

        $viewModel = new TvsViewModel(
            $popularTv,
            $genres,
            $ratedTv
        );

        return view('tvShows.index', $viewModel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $details = Api::get("/tv/$id?append_to_response=credits,videos,images&include_image_language=pt,null&language=pt-BR&region=BR")
        ->json();


        $viewModel = new TvViewModel($details);
        
        return view('tvShows.show', $viewModel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
