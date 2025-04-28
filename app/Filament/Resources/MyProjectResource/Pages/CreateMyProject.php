<?php

namespace App\Filament\Resources\MyProjectResource\Pages;

use App\Filament\Resources\MyProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMyProject extends CreateRecord
{
    protected static string $resource = MyProjectResource::class;
}
