<x-app-layout>
    <x-slot name="title">{{ __('page-title.stats') }}</x-slot>
    <div class="container">
        <div class="stats_row row">
            <div class="stats_link mt-3 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <h5>{{ __('link.link') }}:</h5>
                <a href="{{$link->getTargetLink()}}">{{$link->getTargetLink()}}</a>
                <hr>
                <h5>{{ __('link.alias') }}:</h5>
                <a href="{{$link->getAliasPath()}}">{{$link->getAliasPath()}}</a>
            </div>

            <div class="stats_clicks mt-3 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <h5>{{ __('stats.clicks') }}:</h5>
                {{$link->getClicks()}}

            </div>

            <div class="stats_share col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <hr>
                <h5>{{ __('stats.share') }}:</h5>
                <div class="ya-share2" data-curtain data-size="l" data-url="{{$link->getAliasPath()}}"
                     data-services="vkontakte,facebook,odnoklassniki,telegram,twitter"
                     data-title="Переходи по ссылке!"></div>
            </div>

            <div class="stats_actions col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <hr>
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('stats.actions') }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <li><a class="dropdown-item" href="{{route('api_get_qr_for_id',$link->getId())}}">
                                {{ __('stats.get_qr') }}</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li><a class="dropdown-item" href="{{route('edit_link',$link->getId())}}">
                                {{ __('stats.edit') }}</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('destroy_link', $link->getId())}}"
                                  method="post">
                                @csrf
                                @method('DELETE')
                                <button class="dropdown-item" type="submit">{{ __('stats.delete') }}</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="stats_donate mt-3 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <a class="btn btn-warning" href="{{route('donate_page')}}">{{ __('page-title.donate') }}</a>
            </div>
        </div>
    </div>
    <br>
</x-app-layout>
