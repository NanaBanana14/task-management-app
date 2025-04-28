<?php

namespace App\Filament\Resources\MyTaskResource\Pages;

use App\Filament\Resources\MyTaskResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMyTask extends CreateRecord
{
    protected static string $resource = MyTaskResource::class;
}
