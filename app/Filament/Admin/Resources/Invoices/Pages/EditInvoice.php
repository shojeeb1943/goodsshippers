<?php

namespace App\Filament\Admin\Resources\Invoices\Pages;

use App\Actions\GenerateInvoice;
use App\Filament\Admin\Resources\Invoices\InvoiceResource;
use App\Models\Invoice;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditInvoice extends EditRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('generate_from_shipment')
                ->label('Generate from Shipment')
                ->visible(fn (Invoice $record): bool => $record->shipment_id && $record->status === 'draft'
                )
                ->action(function (Invoice $record) {
                    $invoice = app(GenerateInvoice::class)->forShipment($record->shipment);

                    return redirect()->to(EditInvoice::getUrl(['record' => $invoice]));
                }),
            Action::make('generate_from_order')
                ->label('Generate from Order')
                ->visible(fn (Invoice $record): bool => $record->order_id && $record->status === 'draft'
                )
                ->action(function (Invoice $record) {
                    $invoice = app(GenerateInvoice::class)->forOrder($record->order);

                    return redirect()->to(EditInvoice::getUrl(['record' => $invoice]));
                }),
            Action::make('send_to_customer')
                ->label('Send to Customer')
                ->visible(fn (Invoice $record): bool => $record->status === 'draft'
                )
                ->requiresConfirmation()
                ->action(function (Invoice $record) {
                    $record->update(['status' => 'sent']);
                    $this->success();
                }),
            Action::make('mark_as_paid')
                ->label('Mark as Paid')
                ->visible(fn (Invoice $record): bool => $record->status === 'sent'
                )
                ->requiresConfirmation()
                ->action(function (Invoice $record) {
                    $record->update([
                        'status' => 'paid',
                        'paid_at' => now(),
                    ]);
                    $this->success();
                }),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
