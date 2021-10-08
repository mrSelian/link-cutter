<?php

namespace App\Http\Controllers;

use App\Domain\LinkRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    private LinkRepositoryInterface $linkRepository;

    public function __construct(LinkRepositoryInterface $linkRepository)
    {
        $this->linkRepository = $linkRepository;
    }

    public function userLinksPage()
    {
        $links = $this->linkRepository->getAllAvailableByOwner(Auth::id())->paginate(10);

        return view('dashboard', compact('links'));
    }

    public function qrGeneratorPage()
    {
        return view('qr-generator');
    }

    public function rulesPage()
    {
        return view('pages.rules');
    }

    public function aboutServicePage()
    {
        return view('pages.about');
    }

    public function linkStatsPage($id)
    {
        if (Auth::id() == null) {
            abort(404);
        }

        $link = $this->linkRepository->getById($id);
        if ($link->getOwnerId() != Auth::id()) {
            abort(404);
        }

        return view('link.stats', compact('link'));
    }

    public function donatePage()
    {
        return view('pages.donate');
    }

    public function changeLocale($locale): RedirectResponse
    {
        $availableLocals = ['ru', 'en'];

        if (!in_array($locale, $availableLocals)) {
            $locale = 'en';
        }

        session(['locale' => $locale]);
        App::setLocale($locale);

        return redirect()->back();
    }
}
