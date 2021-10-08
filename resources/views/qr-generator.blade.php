<x-app-layout>
    <x-slot name="title">{{ __('page-title.qr_gen') }}</x-slot>

    <div class="container">
        <form action="{{route('qr_generate')}}" method="POST" class="mt-4" enctype="multipart/form-data">
            <label for="link" class="control-label"><h1>{{ __('qr-gen.generate_qr') }}</h1></label>
            @csrf
            <div class="d-flex flex-column">
                <label for="origin" class="font-bold mt-4 mb-2">{{ __('qr-gen.content') }}</label>
                <input class="form-control" name="origin" id="origin" value="{{old('origin')}}"
                       type="text" placeholder="{{ __('qr-gen.content') }}">
            </div>

            <div class="submit mb-2">
                <button type="submit" class="btn btn-primary mt-4 btn-lg font-semibold">
                    {{ __('qr-gen.gen_button') }}
                </button>
            </div>
        </form>
        @if(\Illuminate\Support\Facades\App::currentLocale() == 'ru')
        <b>*</b> - используя сервис, вы подтверждаете своё согласие с <a href="{{route('rules_page')}}">правилами</a>
        @endif
    </div>
</x-app-layout>
