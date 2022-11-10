<?php

namespace App\Filament\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Filament\Resources\LinkResource\Pages;
use App\Models\Link;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LinkResource extends Resource
{
    protected static ?string $model = Link::class;

    protected static ?string $label = '资源推荐';

    protected static ?string $breadcrumb = '资源推荐';

    protected static ?string $navigationIcon = 'heroicon-o-link';

    protected static ?string $navigationLabel = '资源推荐管理';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->label(trans('field.name'))->required()->maxLength(255),
                Forms\Components\Textarea::make('description')->label(trans('field.description'))->maxLength(255),
                Forms\Components\TextInput::make('link')->label(trans('field.link'))->required()->maxLength(255),
                Forms\Components\Toggle::make('show')->label(trans('field.show'))->required(),
                Forms\Components\TextInput::make('order')->label(trans('field.order'))->required()->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label(trans('field.name')),
                Tables\Columns\TextColumn::make('description')->label(trans('field.description')),
                Tables\Columns\TextColumn::make('link')->label(trans('field.link')),
                Tables\Columns\BooleanColumn::make('show')->label(trans('field.show')),
                Tables\Columns\TextColumn::make('order')->label(trans('field.order')),
                Tables\Columns\TextColumn::make('created_at')->label(trans('field.created_at'))->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->label(trans('field.updated_at'))->dateTime(),
                Tables\Columns\TextColumn::make('deleted_at')->label(trans('field.deleted_at'))->dateTime(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                FilamentExportBulkAction::make('export'),
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
            'index' => Pages\ListLinks::route('/'),
            'create' => Pages\CreateLink::route('/create'),
            'view' => Pages\ViewLink::route('/{record}'),
            'edit' => Pages\EditLink::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
