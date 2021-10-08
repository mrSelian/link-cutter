<x-app-layout>
    <x-slot name="title">{{ __('page-title.donate') }}</x-slot>
    <br>
    <div class="container">
        <h1>{{ __('page-title.donate') }}</h1>
        {{ __('donate.thanks1') }}
        <br>
        <br>
        {{ __('donate.thanks2') }}
        <br>
        <br>
        <iframe
            src="https://yoomoney.ru/quickpay/shop-widget?writer=seller&targets=Thanks%20Link-Cutter&targets-hint=&default-sum=100&button-text=12&payment-type-choice=on&mobile-payment-type-choice=on&hint=&successURL=&quickpay=shop&account=410016334419054"
            width="100%" height="222" frameborder="0" allowtransparency="true" scrolling="no"></iframe>
    </div>
</x-app-layout>
