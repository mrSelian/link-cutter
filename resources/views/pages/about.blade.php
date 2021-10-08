<x-app-layout>
    <x-slot name="title">{{ __('page-title.about') }}</x-slot>

    <div class="container">
        <br>
        <h1>{{ __('page-title.about') }}</h1>
        <br>
        Сервис {{env('APP_NAME')}} помогает совершенно бесплатно сгенерировать короткий URL-адрес или QR-код с вашим
        содержанием.
        <hr>
        <h4>Как сократить ссылку ?</h4>
        Чтобы сгенерировать короткую ссылку, перейдите в пункт меню "Cut Link"; введите ссылку, которую необходимо
        сократить, затем нажмите кнопку "Сократить!".
        <br>
        <br>
        Можете также выбрать алиас, тогда ваша короткая ссылка будет иметь вид <u>{{env('APP_URL')}}/выбранный-алиас</u>
        вместо <u>{{env('APP_URL')}}/случайное-значение</u>
        <br>
        <br>
        Вы получите вашу короткую ссылку и QR-код, ведущий на вашу короткую ссылку.
        <hr>
        <h4>Как создать QR-код с вашим содержанием ?</h4>
        Чтобы сгенерировать QR-код с выбранным вами содержимым, перейдите в пункт меню "QR-Generator"; введите строку,
        которую необходимо зашифровать QR-кодом и нажмите кнопку "Создать!".
        <br>
        <hr>
        <h4>Функции, доступные зарегистрированным пользователям:</h4>
        <ul class="list-group">
            <li class="list-group-item">Возможность просмотра статистики переходов, по сгенерированным пользователем
                коротким ссылкам.
            </li>
            <li class="list-group-item">Возможность удаления сгенерированных пользователем коротких ссылок.</li>
            <li class="list-group-item">Возможность изменения алиасов сгенерированных пользователем коротких ссылок.</li>
        </ul>
        <br>
    </div>
</x-app-layout>
