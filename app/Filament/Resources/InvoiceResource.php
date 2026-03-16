<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Finance';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->searchable()
                ->required(),
            Forms\Components\Select::make('shipment_id')
                ->relationship('shipment', 'shipment_number')
                ->nullable(),
            Forms\Components\Select::make('order_id')
                ->relationship('order', 'id')
                ->nullable(),
            Forms\Components\TextInput::make('invoice_number')->disabled(),
            Forms\Components\Select::make('status')
                ->options(Invoice::STATUSES)
                ->required(),
            Forms\Components\TextInput::make('total_amount')->numeric()->prefix('BDT'),
            Forms\Components\DatePicker::make('due_date'),
            Forms\Components\DateTimePicker::make('paid_at'),
            Forms\Components\Textarea::make('notes')->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')->searchable(),
                Tables\Columns\TextColumn::make('user.name')->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'gray'    => 'draft',
                        'warning' => 'sent',
                        'success' => 'paid',
                        'danger'  => 'cancelled',
                    ]),
                Tables\Columns\TextColumn::make('total_amount')->prefix('BDT '),
                Tables\Columns\TextColumn::make('due_date')->date(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options(Invoice::STATUSES),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit'   => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
