@if($model->projectsSection->projects != null && !empty($model->projectsSection->projects))
   
    @foreach($model->projectsSection->projects as $project)
        <div class="modal fade" id="modal-project_{{$project->id}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{$project->title}}</h5>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-7">
                                    <!-- Carousel Start-->
                                    <div id="myCarousel_{{$project->id}}" class="carousel slide" data-ride="carousel">
                                        <!-- Carousel items -->
                                        <div class="carousel-inner">
                                            @foreach($project->resources as $key=>$resource)
                                                <div class="{{$key == 0 ? "active" : "" }} carousel-item">
                                                    @if ($resource->type == 1)
                                                        <img src="{{$resource->url}}" class="d-block w-100">
                                                    @elseif ($resource->type == 2) 
                                                    <div class="embed-responsive embed-responsive-16by9">
                                                            <iframe class="embed-responsive-item" 
                                                                    src="{{$resource->url}}"
                                                                    frameborder="0" allowfullscreen>
                                                            </iframe>
                                                        </div>
                                                    @endif
                                                    
                                                </div>
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev" href="#myCarousel_{{$project->id}}" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                          </a>
                                          <a class="carousel-control-next" href="#myCarousel_{{$project->id}}" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                          </a>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    {!!$project->description!!}
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary"
                                data-dismiss="modal">cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endif


