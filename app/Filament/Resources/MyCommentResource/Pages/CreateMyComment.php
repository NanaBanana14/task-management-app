<?php

namespace App\Filament\Resources\MyCommentResource\Pages;

use App\Filament\Resources\MyCommentResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateMyComment extends CreateRecord
{
    protected static string $resource = MyCommentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
        return $data;
    }
}
