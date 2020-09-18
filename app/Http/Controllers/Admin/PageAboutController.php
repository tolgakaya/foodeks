<?php

namespace App\Http\Controllers\Admin;

use App\PageAbout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PageAboutGallery;

class PageAboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = PageAbout::first();
        $medias = PageAboutGallery::take(10)->get();
        return view('backend.pages.about.about', compact('medias', 'page'));
    }
    // Fetch More Data
    function more(Request $request)
    {
        if ($request->ajax()) {
            $skip = $request->skip;
            $take = 10;
            $medias = PageAboutGallery::skip($skip)->take($take)->get();
            return response()->json($medias);
        } else {
            return response()->json('Direct Access Not Allowed!!');
        }
    }
    function search(Request $request)
    {
        // return response()->json($request->term);
        if ($request->ajax()) {
            $medias = PageAboutGallery::query()
                ->where('filename', 'LIKE', "%{$request->term}%")
                ->get();
            return response()->json($medias);
        } else {
            return response()->json('Direct Access Not Allowed!!');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function mediastore(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);

        $media = new PageAboutGallery();
        $media->filename = $imageName;
        $media->save();
        $resim = [$media->id => $imageName];
        return $resim;
    }

    public function store(Request $request)
    {
        $validated = request()->validate([
            'title' => 'required',
            'text' => 'required'
        ]);
        $validated['show_opening'] = false;
        if (isset($request->show_opening)) {
            $validated['show_opening'] = true;
        }
        $page = PageAbout::first();
        if ($page == null) {
            PageAbout::create($validated);
        } else {
            $page->update($validated);
        }
        return redirect()->route('admin.pages.about.index');
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
        PageAboutGallery::where('filename', $filename)->delete();
        $path = public_path() . '/images/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }
    public function destroymass(Request $request)
    {
        $bisey =  $request->all();
        $data = request()->validate([
            'selecteds' => 'required',
        ]);
        // return response()->json(($request->all()));
        // dd($data);
        $images = PageAboutGallery::whereIn('id', $data['selecteds'])->pluck('filename');
        foreach ($images as  $filename) {
            $path = public_path() . '/images/' . $filename;
            if (file_exists($path)) {
                unlink($path);
            }
        }
        PageAboutGallery::destroy($data['selecteds']);
        return ['success' => 200];
    }
}