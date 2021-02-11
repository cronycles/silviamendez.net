@extends('layouts.app')

@section('content')
    <section id="cover">
        <div class="gallery__box cro-fs-images-carousel jslider">
            @if(isset($model->slidesSection->slides) && !empty($model->slidesSection->slides))
                @foreach($model->slidesSection->slides as $slide)
                    <figure class="none">
                        <img src="{{config('custom.images.static.defaultLazyPlaceholder')}}"
                            class="tns-lazy-img"
                            data-src="{{$slide->imageUrl}}"
                            @if($slide->isMobileSlide)
                            data-m="1"
                            @endif
                            alt="{{$slide->imageAltText}}">
                    </figure>
                @endforeach
            @endif
        </div>
        
        <div class="central_box">
            <h1 class="central_box__logo"><img src="{{$model->coverSection->logo->url}}" alt="{{$model->coverSection->logo->altText}}"></h1>
            <h2>{{$model->coverSection->subtitle}}</h2>
            <div class="central_box__link"><a href="{{$model->coverSection->button->url}}"
                class="cro__button cro__button--basic center">{{$model->coverSection->button->text}}</a>
            </div>
        </div>
        
    </section>
    <section id="home__below__container">
        <div class="page__section presentation-section">
            <div class="section__title">
                <h3>{{$model->presentationSection->title}}</h3>
                <hr>
            </div>
            <div class="page__section__box presentation-photo">
                <img src="{{$model->presentationSection->photo->url}}" alt="{{$model->presentationSection->photo->altText}}">
            </div>
            <div class="page__section__box presentation-text">{!! $model->presentationSection->text !!}</div>
            <div style="text-align: center" class="page__section__box">
                <a href="{{$model->presentationSection->downloadCvFileUrl}}" target="_blank"
                    class="cro__button cro__button--basic center">{{$model->presentationSection->downloadCvText}}</a>
            </div>
          
        </div>
        <article id="skills" class="page__section colored">
            <div class="section__title">
                <h3>Skills</h3>
                <hr>
            </div>
            @include('pages._skills')
        </article>

       

        
        @if(isset($model->projectsSection->projects) && !empty($model->projectsSection->projects))
        <article id="projects" class="page__section">
            <div class="section__title">
                <h3>{{$model->projectsSection->title}}</h3>
                <hr>
            </div>
            @include('pages._projects-gallery')
        </article>
        @endif
        
        <article id="contact" class="page__section section__contact colored">
            <div class="section__title">
                <h3>{{$model->contactSection->title}}</h3>
                <hr>
            </div>
            <div class="page__section__box contact__types">
                <div>
                    <i class="las la-map-marker"></i>
                    <p>{{$model->contactSection->address}}</p>
                </div>
                <div>
                    <a style="color: #121d1f" href="mailto:{{$model->contactSection->email}}">
                        <i class="las la-envelope"></i>
                        <p>{{$model->contactSection->email}}</p>
                    </a>
                </div>
                <div>
                    <a style="color: #121d1f" href="tel:+34{{$model->contactSection->phone}}">
                        <i class="las la-phone"></i>
                        <p>{{$model->contactSection->phone}}</p>
                    </a>
                </div>
            </div>
            <div class="page__section__box">
                <p class="form__title">{{$model->contactSection->formTitleText}}</p>
                @include('custom.form._form', ['model' => $model->contactSection->formData])
                </div>
            </div>
        </article>
    </section>
@endsection


