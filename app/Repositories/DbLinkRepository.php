<?php

namespace App\Repositories;

use App\Domain\AliasGeneratorInterface;
use App\Domain\Link;
use App\Domain\LinkRepositoryInterface;
use App\Models\Clicks as ClicksModel;
use App\Models\Link as LinkModel;

class DbLinkRepository implements LinkRepositoryInterface
{
    protected AliasGeneratorInterface $aliasGenerator;

    public function __construct(AliasGeneratorInterface $aliasGenerator)
    {
        $this->aliasGenerator=$aliasGenerator;
    }
    public function getByAlias(?string $alias): ?Link
    {
        return LinkModel::query()
            ->where('alias', '=', $alias)
            ->where('deleted', '=', false)
            ->get()
            ->map($this->mapToLink())
            ->first();
    }

    public function getById(int $id): ?Link
    {
        return LinkModel::where('id', $id)
            ->get()
            ->map($this->mapToLink())
            ->first();
    }

    public function getAllAvailableByOwner(?int $ownerId)
    {
        return LinkModel::query()
            ->where('user_id', '=', $ownerId)
            ->where('deleted', '=', false)
            ->get()
            ->map($this->mapToLink());
    }

    public function save(Link $link)
    {
        $record = LinkModel::where('id', $link->getId())->firstOrNew();

        $record->alias = $link->getAlias();
        $record->link = $link->getTargetLink();
        $record->user_id = $link->getOwnerId();
        $record->deleted = $link->isDeleted();
        $record->save();

        $clicks = ClicksModel::where('link_id', $record->id)->firstOrNew();
        $clicks->link_id = $record->id;
        $clicks->counter = $link->getClicks();
        $clicks->save();

        return $record->id;
    }

    public function delete(Link $link)
    {
        $record = LinkModel::where('id', $link->getId())->firstOrFail();

        $record->deleted = $link->isDeleted();
        $record->save();
    }

    public function mapToLink(): \Closure
    {
        return fn(LinkModel $record) => Link::from(
            $record->alias,
            $record->link,
            $record->user_id,
            (bool)$record->deleted,
            ClicksModel::where('link_id', $record->id)->first()->counter,
            $record->id,
        );
    }
}
