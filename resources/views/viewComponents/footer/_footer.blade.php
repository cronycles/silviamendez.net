<footer>
    <div class="footer__main">
        @if (!empty($model->socials))
            <ul class="footer__main-box footer__social-box">
                @foreach($model->socials as $socialLink)
                    <li>
                        <a href="{{$socialLink->url}}"
                           title="{{$socialLink->text}}"
                           target="_blank">
                            <i class="{{$socialLink->iconClass}}" title="{{$socialLink->text}}"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    <div class="footer__sub">
        <section>
            <p>
                <a href="{{$model->sub->cookiePolicyUrl}}"
                   title="{{$model->sub->cookiePolicyText}}">
                    {{$model->sub->cookiePolicyText}}
                </a>
            </p>
            <p>
                <a href="{{$model->sub->privacyPolicyUrl}}"
                   title="{{$model->sub->privacyPolicyText}}">
                    {{$model->sub->privacyPolicyText}}
                </a>
            </p>
        </section>
        <section>
            <p>{{$model->sub->appVersion}}</p>
            <p>
                <a href="{{$model->sub->copyrightUrl}}"
                   title="{{$model->sub->copyrightText}}">
                    {{$model->sub->copyrightText}}
                </a>
            </p>
            <p>{{$model->sub->allRightReserved}}</p>
        </section>
    </div>
</footer>
