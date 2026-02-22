<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduledMessageResource\Pages;
use App\Filament\Resources\ScheduledMessageResource\RelationManagers;
use App\Models\ScheduledMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ScheduledMessageResource extends Resource
{
    protected static ?string $model = ScheduledMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('Message Details')
                ->schema([
                    Forms\Components\TextInput::make('chat_id')
                        ->required()
                        ->placeholder('-100123456789'),
                    Forms\Components\Textarea::make('body')
                        ->required()
                        ->rows(5),
                    Forms\Components\DateTimePicker::make('scheduled_at')
                        ->required()
                        ->native(false),
                    Forms\Components\Hidden::make('user_id')
                        ->default(auth()->id()),
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListScheduledMessages::route('/'),
            'create' => Pages\CreateScheduledMessage::route('/create'),
            'edit' => Pages\EditScheduledMessage::route('/{record}/edit'),
        ];
    }
}
