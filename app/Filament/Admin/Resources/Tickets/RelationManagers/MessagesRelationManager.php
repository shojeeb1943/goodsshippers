<?php

namespace App\Filament\Admin\Resources\Tickets\RelationManagers;

use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class MessagesRelationManager extends RelationManager
{
    protected static string $relationship = 'messages';

    protected static ?string $recordTitleAttribute = 'id';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\Textarea::make('message')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('attachment_path')
                    ->directory('tickets/attachments')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'application/pdf'])
                    ->maxSize(10240)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('sender.name')
                    ->label('Sender'),
                Tables\Columns\TextColumn::make('message')
                    ->wrap(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Reply')
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['sender_id'] = auth()->id();
                        return $data;
                    })
                    ->after(function (\Illuminate\Database\Eloquent\Model $record) {
                        $ticket = $this->getOwnerRecord();
                        
                        if (in_array($ticket->status, ['resolved', 'closed'])) {
                            $ticket->update(['status' => 'open']);
                        }
                        
                        // Notify User about the staff reply
                        if ($ticket->user) {
                            $ticket->user->notify(new \App\Notifications\TicketReplyNotification($ticket));
                        }
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
