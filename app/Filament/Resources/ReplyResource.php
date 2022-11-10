<?php

namespace App\Filament\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Filament\Resources\ReplyResource\Pages;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReplyResource extends Resource
{
    protected static ?string $model = Reply::class;

    protected static ?string $label = '评论';

    protected static ?string $breadcrumb = '评论';

    protected static ?string $navigationIcon = 'far-comment-dots';

    protected static ?string $navigationLabel = '评论管理';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('topic_id')->label(trans('field.topic'))->options(Topic::pluck('title', 'id'))->searchable()->required(),
                Forms\Components\Select::make('user_id')->label(trans('field.user'))->options(User::pluck('name', 'id'))->searchable()->required(),
                Forms\Components\Select::make('parent_id')->label(trans('field.parent_reply'))->options(Reply::pluck('content', 'id'))->searchable(),
                Forms\Components\Textarea::make('content')->label(trans('field.content'))->required()->maxLength(65535),
                Forms\Components\Toggle::make('show')->label(trans('field.show'))->required(),
                Forms\Components\TextInput::make('order')->label(trans('field.order'))->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('topic.title')->label(trans('field.topic')),
                Tables\Columns\TextColumn::make('user.name')->label(trans('field.user')),
                Tables\Columns\TextColumn::make('parent.content')->label(trans('field.parent_reply')),
                Tables\Columns\TextColumn::make('content')->label(trans('field.content')),
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
            'index' => Pages\ListReplies::route('/'),
            'create' => Pages\CreateReply::route('/create'),
            'view' => Pages\ViewReply::route('/{record}'),
            'edit' => Pages\EditReply::route('/{record}/edit'),
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
