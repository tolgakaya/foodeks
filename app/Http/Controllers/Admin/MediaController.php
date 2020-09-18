<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Media;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($chcbox = null)
    {
        // $medias = Media::paginate(5);
        $medias = Media::take(1)->get();
        return view('backend.media.library', compact('medias', 'chcbox'));
    }
    // Fetch More Data
    function more(Request $request)
    {
        if ($request->ajax()) {
            $skip = $request->skip;
            $take = 2;
            $medias = Media::skip($skip)->take($take)->get();
            return response()->json($medias);
        } else {
            return response()->json('Direct Access Not Allowed!!');
        }
    }
    function search(Request $request)
    {
        // return response()->json($request->term);
        if ($request->ajax()) {
            $medias = Media::query()
                ->where('filename', 'LIKE', "%{$request->term}%")
                ->get();
            return response()->json($medias);
        } else {
            return response()->json('Direct Access Not Allowed!!');
        }
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
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);

        $media = new Media();
        $media->filename = $imageName;
        $media->save();
        $resim = [$media->id => $imageName];
        return $resim;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($filename)
    {
        $media = Media::where('filename', $filename)->get();
        return view('backend.media.show', compact('media'));
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
    public function destroy(Request $request)
    {
        $filename =  $request->get('filename');
        Media::where('filename', $filename)->delete();
        $path = public_path() . '/images/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }
    public function destroymass(Request $request)
    {
        // $data = request()->validate([
        //     'selecteds' => 'required',
        // ]);
        return response()->json(($request->all()));
        // dd($data);
        // Media::destroy($data['selecteds']);
        // return redirect()->back();
        // // $filename =  $request->get('filename');
        // // Media::where('filename', $filename)->delete();
        // $path = public_path() . '/images/' . $filename;
        // if (file_exists($path)) {
        //     unlink($path);
        // }
        // return $filename;
    }
}