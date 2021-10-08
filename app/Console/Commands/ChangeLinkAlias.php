<?php

namespace App\Console\Commands;

use App\Domain\AliasGeneratorInterface;
use App\Domain\LinkRepositoryInterface;
use Illuminate\Console\Command;

class ChangeLinkAlias extends Command
{
    protected LinkRepositoryInterface $linkRepository;
    protected AliasGeneratorInterface $aliasGenerator;


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'link:changeAlias {linkId} {alias}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Изменяет алиас ссылки с указанным id на выбранный.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(LinkRepositoryInterface $linkRepository, AliasGeneratorInterface $aliasGenerator)
    {
        parent::__construct();
        $this->linkRepository = $linkRepository;
        $this->aliasGenerator = $aliasGenerator;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $linkId = $this->argument('linkId');
        $alias = $this->argument('alias');

        $link = $this->linkRepository->getById($linkId);

        if ($link == null) return dump('Ссылка с указанным ID не найдена!');

        $link->updateAlias($alias, $this->aliasGenerator);
        $newAlias = $link->getAlias();

        if ($this->linkRepository->getByAlias($newAlias) != null) return dump('Выбранный алиас уже занят.');

        $this->linkRepository->save($link);

        return dump("Алиас ссылки изменен на $newAlias");
    }
}
