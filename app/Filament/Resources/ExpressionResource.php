<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpressionResource\Pages;
use App\Models\Expression;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ExpressionResource extends Resource
{
    protected static ?string $model = Expression::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('key')->required()->unique(ignoreRecord: true),
            TextInput::make('locale')->required()->default('pt'),
            Textarea::make('value')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('key')->searchable(),
            TextColumn::make('locale'),
            TextColumn::make('value')->limit(50),
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
            'index' => Pages\ListExpressions::route('/'),
            'create' => Pages\CreateExpression::route('/create'),
            'edit' => Pages\EditExpression::route('/{record}/edit'),
        ];
    }
}
