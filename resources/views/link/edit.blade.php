<x-app-layout>
    <x-slot name="title">{{ __('page-title.edit_link') }}</x-slot>

    <div class="container">
        <form action="{{route('update_link',$link->getId())}}" method="POST" class="mt-4" enctype="multipart/form-data">
            <label for="link" class="control-label"><h1>{{ __('page-title.edit_link') }}</h1></label>
            @method('PATCH')
            @csrf
            <div class="d-flex flex-column">
                <label for="targetLink" class="font-bold mt-4 mb-2">{{ __('link.link') }}*</label>
                <input name="targetLink" id="targetLink" value="{{$link->getTargetLink()}}"
                       type="text" placeholder="{{ __('link.link') }}">

                <label for="alias" class="font-bold mt-4 mb-2">{{ __('link.alias') }}</label>
                <input name="alias" id="alias" value="{{$link->getAlias()}}"
                       type="text" placeholder="{{ __('link.alias') }}">
            </div>

            <div class="submit mb-2">
                <button type="submit" class="btn btn-primary btn-lg mt-4 font-semibold">
                    {{ __('link.edit_button') }}
                </button>
            </div>
            <br>
            <b>*</b> - {{ __('link.link_note') }}
        </form>
        @if(\Illuminate\Support\Facades\App::currentLocale() == 'ru')
        <b>**</b> - используя сервис, вы подтверждаете своё согласие с <a href="{{route('rules_page')}}">правилами</a>
        @endif
    </div>
    <br>
</x-app-layout>
