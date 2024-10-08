<?php

namespace App\Filament\Resources\AsesorResource\Pages;

use App\Filament\Resources\AsesorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAsesor extends EditRecord
{
    protected static string $resource = AsesorResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
