<?php

namespace Moves\ConventionalCommits\CaptainHook;

use CaptainHook\App\Config;
use CaptainHook\App\Config\Action as ActionConfig;
use CaptainHook\App\Console\IO;
use SebastianFeldmann\Git\Repository;

class ValidateConventionalCommit extends \Ramsey\CaptainHook\ValidateConventionalCommit
{
    private const MERGE_PATTERN = '/^Merge branch /';

    public function execute(
        Config $config,
        IO $io,
        Repository
        $repository,
        ActionConfig $action
    ): void {
        $message = $repository->getCommitMsg()->getContent();

        if (preg_match(self::MERGE_PATTERN, $message)) {
            return;
        }

        parent::execute($config, $io, $repository, $action);
    }
}
