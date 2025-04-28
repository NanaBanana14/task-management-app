<?php

namespace App\Filament\Resources\MyTaskResource\Pages;

use App\Filament\Resources\MyTaskResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMyTask extends EditRecord
{
    protected static string $resource = MyTaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
