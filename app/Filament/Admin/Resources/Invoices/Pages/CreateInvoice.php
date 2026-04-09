<?php

namespace App\Filament\Admin\Resources\Invoices\Pages;

use App\Actions\GenerateInvoice;
use App\Filament\Admin\Resources\Invoices\InvoiceResource;
use App\Models\Order;
use App\Models\Shipment;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\CreateRecord;

class CreateInvoice extends CreateRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getDefaultFormSchema(): array
    {
        return [
            Select::make('source_type')
                ->label('Invoice For')
                ->options([
                    'order' => 'Shop For Me Order',
                    'shipment' => 'Existing Shipment',
                ])
                ->live()
                ->required(),
            Select::make('order_id')
                ->label('Select Order')
                ->visible(fn (callable $get) => $get('source_type') === 'order')
                ->options(fn () => Order::where('status', 'quote_approved')
                    ->with('user')
                    ->get()
                    ->pluck('user.name', 'id'))
                ->searchable(),
            Select::make('shipment_id')
                ->label('Select Shipment')
                ->visible(fn (callable $get) => $get('source_type') === 'shipment')
                ->options(fn () => Shipment::where('status', 'created')
                    ->with('user')
                    ->get()
                    ->pluck('user.name', 'id'))
                ->searchable(),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $sourceType = $data['source_type'] ?? null;

        if ($sourceType === 'order' && ! empty($data['order_id'])) {
            $order = Order::with('items')->find($data['order_id']);
            $invoice = app(GenerateInvoice::class)->forOrder($order);
            $this->redirect(EditInvoice::getUrl(['record' => $invoice]));
        } elseif ($sourceType === 'shipment' && ! empty($data['shipment_id'])) {
            $shipment = Shipment::find($data['shipment_id']);
            $invoice = app(GenerateInvoice::class)->forShipment($shipment);
            $this->redirect(EditInvoice::getUrl(['record' => $invoice]));
        }

        return [];
    }
}
