<?php

namespace App\Http\Controllers;

use App\Domain\AliasGeneratorInterface;
use App\Domain\Link;
use App\Domain\LinkRepositoryInterface;
use App\Http\Requests\CreateLinkRequest;
use App\Services\QrSavingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    private LinkRepositoryInterface $linkRepository;
    private AliasGeneratorInterface $aliasGenerator;


    public function __construct(LinkRepositoryInterface $linkRepository, AliasGeneratorInterface $aliasGenerator)
    {
        $this->linkRepository = $linkRepository;
        $this->aliasGenerator = $aliasGenerator;
    }

    public function redirectToLink(string $alias)
    {
        $link = $this->linkRepository->getByAlias($alias);

        if ($link == null) return redirect()->back()->with('success', 'Данная ссылка отсутствует!');

        $link->click();

        $this->linkRepository->save($link);

        return redirect($link->getTargetLink());
    }

    public function create()
    {
        return view('link.create');
    }

    public function store(CreateLinkRequest $request): RedirectResponse
    {
        if ($this->linkRepository->getByAlias($request->alias) != null) throw new \Exception('Выбранный алиас уже занят.');

        $link = Link::create($request->targetLink, Auth::id())
            ->updateAlias($request->alias, $this->aliasGenerator);

        $this->linkRepository->save($link);

        $path = QrSavingService::saveQrFrom($link->getAliasPath())['download_path'];

        return redirect()
            ->route('create_link')
            ->with('success',
                '<h6>Ссылка теперь доступна по адресу:</h6> ' . '<a href="' . $link->getAliasPath() . '">' . $link->getAliasPath() . '</a>' .
                '<br><br>' .
                '<h6>QR-code:</h6> ' . '<img src="' . $path . '">' .
                '<a href="' . $path . '" download="">Скачать</a><hr><h6>Поделиться</h6>' .
                '<div class="ya-share2" data-curtain data-size="m" data-url="' .
                $link->getAliasPath() .
                '" data-services="vkontakte,facebook,odnoklassniki,telegram,twitter"></div>' .
                '<br><a class="btn btn-warning" href="'.route('donate_page').'">Помочь проекту</a>');
    }

    public function edit(int $id)
    {
        $link = $this->linkRepository->getById($id);

        $this->authorize('edit', $link);

        return view('link.edit', compact('link'));
    }

    public function update(CreateLinkRequest $request, int $id)
    {
        $link = $this->linkRepository->getById($id);

        $this->authorize('update', $link);

        if ($request->alias != $link->getAlias()) {
            $link->updateAlias($request->alias, $this->aliasGenerator);
        }

        $link->updateTargetLink($request->targetLink);

        $linkId = $this->linkRepository->save($link);

        $path = QrSavingService::saveQrFrom($link->getAliasPath())['download_path'];

        return redirect()
            ->route('dashboard')
            ->with('success',
                '<h6>Ссылка успешно изменена и доступна по адресу:</h6> ' .
                '<a href="' . $link->getAliasPath() . '">' . $link->getAliasPath() . '</a>' .
                '<br><br>' .
                '<h6>QR-code:</h6> ' . '<img src="' . $path . '">' .
                '<a href="' . $path . '" download="">Скачать</a><hr><h6>Поделиться</h6>' .
                '<div class="ya-share2" data-curtain data-size="m" data-url="' .
                $link->getAliasPath() .
                '" data-services="vkontakte,facebook,odnoklassniki,telegram,twitter"></div>' .
                '<br><a class="btn btn-warning" href="'.route('donate_page').'">Помочь проекту</a>');
    }

    public function destroy(int $id)
    {
        $link = $this->linkRepository->getById($id);

        $this->authorize('destroy', $link);

        $link->delete();

        $this->linkRepository->delete($link);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Ссылка была успешно удалена.');
    }
}
