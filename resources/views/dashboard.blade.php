<x-app-layout>
    <x-slot name="title">{{ __('page-title.my_links') }}</x-slot>
    <br>
    <div class="container">
        @if($links->isEmpty())
            <br>
            {{ __('dashboard.no_links') }}
        @else
            <ul class="list-group">
                @foreach($links as $link)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="link_alias mt-3 mb-1.5 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                <h5>{{ __('link.alias') }}
                                    :</h5><a style="color: black; word-wrap: break-word"
                                             href="{{$link->getAliasPath()}}"
                                             target="_blank">{{$link->getAliasPath()}}</a>
                            </div>
                            <div class="link_url mt-3 mb-1.5 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                <h5>{{ __('link.link') }}:</h5><a
                                    href="{{$link->getTargetLink()}}"
                                    target="_blank" style="word-wrap: break-word">{{$link->getTargetLink()}}</a>
                            </div>
                            <div class="link_actions mt-3 mb-1.5 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" id="navbarDropdown" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ __('dashboard.actions') }}
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                                        <li><a class="dropdown-item"
                                               href="{{route('api_get_qr_for_id',$link->getId())}}">
                                                {{ __('dashboard.get_qr') }}</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="{{route('link_stats',$link->getId())}}">
                                                {{ __('dashboard.stats') }}</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="{{route('edit_link',$link->getId())}}">
                                                {{ __('dashboard.edit') }}</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <form action="{{ route('destroy_link', $link->getId())}}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item"
                                                        type="submit"> {{ __('dashboard.delete') }}</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="link_share mt-3 mb-1.5 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="ya-share2" data-curtain data-size="m"
                                     data-url="{{$link->getAliasPath()}}"
                                     data-services="vkontakte,facebook,odnoklassniki,telegram,twitter"
                                     data-title="Переходи по ссылке!"></div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <br>
            <div
                class="pagination_links d-flex justify-content-center">{{ $links->links('pagination::bootstrap-4') }}</div>
        @endif
    </div>

</x-app-layout>
