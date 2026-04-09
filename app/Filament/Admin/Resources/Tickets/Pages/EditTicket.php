<?php

namespace App\Filament\Admin\Resources\Tickets\Pages;

use App\Filament\Admin\Resources\Tickets\TicketResource;
use App\Models\Ticket;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTicket extends EditRecord
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('mark_in_progress')
                ->label('Mark In Progress')
                ->visible(fn (Ticket $record): bool => $record->status === 'open'
                )
                ->action(function (Ticket $record) {
                    $record->update(['status' => 'in_progress']);
                    $this->success();
                }),
            Action::make('resolve')
                ->label('Resolve')
                ->visible(fn (Ticket $record): bool => in_array($record->status, ['open', 'in_progress'])
                )
                ->requiresConfirmation()
                ->action(function (Ticket $record) {
                    $record->update(['status' => 'resolved']);
                    $this->success();
                }),
            Action::make('close')
                ->label('Close Ticket')
                ->visible(fn (Ticket $record): bool => $record->status === 'resolved'
                )
                ->requiresConfirmation()
                ->action(function (Ticket $record) {
                    $record->update(['status' => 'closed']);
                    $this->success();
                }),
            Action::make('reopen')
                ->label('Reopen Ticket')
                ->visible(fn (Ticket $record): bool => in_array($record->status, ['resolved', 'closed'])
                )
                ->requiresConfirmation()
                ->action(function (Ticket $record) {
                    $record->update(['status' => 'open']);
                    $this->success();
                }),
            DeleteAction::make(),
        ];
    }
}
