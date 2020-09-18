{{-- modal start --}}
<div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modal-title-default">Select or Upload Media
                </h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">

                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" id="home-tab2" data-toggle="tab" href="#home2" role="tab"
                                aria-selected="true">Upload Media</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#profile2" role="tab"
                                aria-selected="false">Media
                                Library</a>
                        </li>

                    </ul>
                    <div class="tab-content tab-bordered" id="myTab2Content">
                        <div class="tab-pane fade active show text-sm" id="home2" role="tabpanel"
                            aria-labelledby="home-tab2">
                            <form method="post" action="{{route('admin.about.media.store')}}"
                                enctype="multipart/form-data" class="dropzone" id="dropzone">
                                @csrf
                            </form>
                        </div>
                        <div class="tab-pane fade text-sm" id="profile2" role="tabpanel" aria-labelledby="profile-tab2">
                            <form>
                                <div class="form-group" id="custom-search-input">
                                    <div class="input-group">
                                        @csrf
                                        <input type="text" class="form-control" placeholder="Media arayın..." id="term"
                                            name="term">
                                        <span class="input-group-append">
                                            <button class="btn btn-primary" type="submit" id="btn-search">Ara</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            <form action="{{route('admin.about.media.delete.mass')}}" method="post" id="modalForm">
                                @csrf
                                <div class="gallery row">
                                </div>
                                <input type="submit" class="btn btn-primary" form="modalForm" value="Save" />
                            </form>
                            <p class="text-center mt-4 mb-5"><button class="load-more btn btn-dark"
                                    data-totalResult="{{ App\Media::count() }}">Load
                                    More</button></p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnForm" class="btn btn-primary">Seçilenleri Sil</button>
                <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Kapat</button>
                {{-- <input type="submit" class="btn btn-primary" form="modalForm" value="Save" /> --}}
            </div>
        </div>
    </div>
</div>
{{-- modal finished --}}{{-- modal start --}}
<div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modal-title-default">Select or Upload Media
                </h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">

                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" id="home-tab2" data-toggle="tab" href="#home2" role="tab"
                                aria-selected="true">Upload Media</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#profile2" role="tab"
                                aria-selected="false">Media
                                Library</a>
                        </li>

                    </ul>
                    <div class="tab-content tab-bordered" id="myTab2Content">
                        <div class="tab-pane fade active show text-sm" id="home2" role="tabpanel"
                            aria-labelledby="home-tab2">
                            <form method="post" action="{{route('admin.about.media.store')}}"
                                enctype="multipart/form-data" class="dropzone" id="dropzone">
                                @csrf
                            </form>
                        </div>
                        <div class="tab-pane fade text-sm" id="profile2" role="tabpanel" aria-labelledby="profile-tab2">
                            <form>
                                <div class="form-group" id="custom-search-input">
                                    <div class="input-group">
                                        @csrf
                                        <input type="text" class="form-control" placeholder="Media arayın..." id="term"
                                            name="term">
                                        <span class="input-group-append">
                                            <button class="btn btn-primary" type="submit" id="btn-search">Ara</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            <form action="{{route('admin.about.media.delete.mass')}}" method="post" id="modalForm">
                                @csrf
                                <div class="gallery row">
                                </div>
                                <input type="submit" class="btn btn-primary" form="modalForm" value="Save" />
                            </form>
                            <p class="text-center mt-4 mb-5"><button class="load-more btn btn-dark"
                                    data-totalResult="{{ App\Media::count() }}">Load
                                    More</button></p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnForm" class="btn btn-primary">Save
                    changes</button>
                <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
                {{-- <input type="submit" class="btn btn-primary" form="modalForm" value="Save" /> --}}
            </div>
        </div>
    </div>
</div>
{{-- modal finished --}}