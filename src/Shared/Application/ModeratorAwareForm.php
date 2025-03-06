<?php

declare(strict_types=1);

namespace App\Shared\Application;

use App\Ddd\Application\Form;
use App\Moderators\Domain\ModeratorId;

abstract class ModeratorAwareForm extends Form
{
    private string $moderatorId;

    public function setModeratorId(string $moderatorId) : void
    {
        $this->moderatorId = $moderatorId;
    }

    protected function moderatorId() : ModeratorId
    {
        return ModeratorId::make($this->moderatorId);
    }
}