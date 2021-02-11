@if($model->projectsSection->projects != null && !empty($model->projectsSection->projects))
    @if(isset($model->categories) && !empty($model->categories))
        <ul class="page__section__box product__categories">
            @foreach($model->categories as $category)
                <li class="jcl product__category {{$category->isActive ? 'active' : ''}}"
                    data-c="{{$category->id}}">{{$category->name}}</li>
            @endforeach
        </ul>
    @endif
    <div class="page__section__box">
        <div class="cro__auto-adjust__gallery overlay-zoom">
            @foreach($model->projectsSection->projects as $project)
                <article class="gallery__box jcb" data-c="{{$project->category->id}}">
                    <div class="image__track" data-toggle="modal" data-target="#modal-project_{{$project->id}}" title="{{$project->title}}">
                        <img src="{{config('custom.images.static.defaultLazyPlaceholder')}}"
                             data-src="{{$project->cover ? $project->cover->url : ""}}"
                             alt="{{$project->title}}"
                             title="{{$project->title}}"
                             class="jlimg">
                    </div>
                    <div data-toggle="modal" data-target="#modal-project_{{$project->id}}" class="overlay__track">
                        <div class="overlay__text">{{$project->title}}</div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
@endif


@include('pages._projects-modals')


