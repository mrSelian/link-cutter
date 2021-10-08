<?php

namespace App\Http\Controllers;

use App\Domain\AliasGeneratorInterface;
use App\Domain\Link;
use App\Domain\LinkRepositoryInterface;
use App\Services\QrSavingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ApiController extends Controller
{
    private LinkRepositoryInterface $linkRepository;
    private AliasGeneratorInterface $aliasGenerator;

    public function __construct(LinkRepositoryInterface $linkRepository, AliasGeneratorInterface $aliasGenerator)
    {
        $this->linkRepository = $linkRepository;
        $this->aliasGenerator = $aliasGenerator;
    }

    public function getQr(Request $request): BinaryFileResponse
    {
        if ($request->link != null) {
            $this->validate($request, [
                'link' => 'url'
            ]);

            $origin = $request->link;

        } else if ($request->value != null) {
            $this->validate($request, [
                'value' => 'string'
            ]);

            $origin = $request->value;
        }
        else
        {
            $origin = url('/');
        }

        $path = QrSavingService::saveQrFrom($origin)['path'];

        return Response::download($path);
    }

    public function getAlias(Request $request): string
    {
        $this->validate($request, [
            'link' => 'required|url'
        ]);

        $link = Link::create($request->link, Auth::id())->updateAlias(null, $this->aliasGenerator);

        $this->linkRepository->save($link);

        return $link->getAliasPath();
    }

    public function getQrByLinkId($id)
    {
        $link = $this->linkRepository->getById($id);

        if ($link != null) {

            $path = QrSavingService::saveQrFrom($link->getAliasPath())['path'];

            return Response::download($path);
        }
        abort(404);
    }

}
