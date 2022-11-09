<?php

namespace App\Filament\Resources;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Filament\Resources\TopicResource\Pages;
use App\Models\Category;
use App\Models\Topic;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Arr;

class TopicResource extends Resource
{
    protected static ?string $model = Topic::class;

    protected static ?string $label = '话题';

    protected static ?string $breadcrumb = '话题';

    protected static ?string $navigationIcon = 'phosphor-article-ny-times-fill';

    protected static ?string $navigationLabel = '话题管理';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->label('标题')->required()->maxLength(255),
                Forms\Components\TextInput::make('subtitle')->label('副标题')->required()->maxLength(255),
                Forms\Components\FileUpload::make('image')->image()->label('图片'),
                Forms\Components\Textarea::make('body')->required()->maxLength(65535),
                Forms\Components\Select::make('user_id')->label('发布用户')->options(User::pluck('name', 'id'))->searchable()->required(),
                Forms\Components\Select::make('category_id')
                    ->label('所属类别')
                    ->options(Category::whereNotNull('parent_id')->where('is_directory', false)->where('level', '<>', 0)->get()->keyBy('id')->map(function ($item) {
                        return optional(Arr::get($item, 'parent'))->name.' - '.Arr::get($item, 'name');
                    })->all())
                    ->searchable()
                    ->required(),
                Forms\Components\Toggle::make('is_released')->label('是否发布')->required(),
                Forms\Components\Toggle::make('need_released')->label('是否需要自动发布')->required(),
                Forms\Components\DateTimePicker::make('released_at')->label('发布时间'),
                Forms\Components\TextInput::make('vote_count')->label('点赞数量')->disabled(),
                Forms\Components\TextInput::make('collect_count')->label('收藏数量')->disabled(),
                Forms\Components\TextInput::make('reply_count')->label('评论数量')->disabled(),
                Forms\Components\TextInput::make('view_count')->label('查看总数')->disabled(),
                Forms\Components\TextInput::make('last_reply_user.name')->label('最后评论的用户')->disabled(),
                Forms\Components\TextInput::make('excerpt')->label('文章摘要')->disabled(),
                Forms\Components\TextInput::make('slug')->label('SEO 友好的 URL')->disabled(),
                Forms\Components\TextInput::make('order')->label('排序')->default(0)->required(),
                Forms\Components\DateTimePicker::make('created_at')->label('创建时间')->disabled(),
                Forms\Components\DateTimePicker::make('updated_at')->label('编辑时间')->disabled(),
                Forms\Components\DateTimePicker::make('deleted_at')->label('删除时间')->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('title')->label('标题'),
                Tables\Columns\TextColumn::make('subtitle')->label('副标题'),
                Tables\Columns\ImageColumn::make('image')->label('图片')->rounded(),
                Tables\Columns\TextColumn::make('user.name')->label('用户'),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('所属类别'),
                Tables\Columns\BooleanColumn::make('is_released')->label('是否公开'),
                Tables\Columns\BooleanColumn::make('need_released')->label('需要自动公开'),
                Tables\Columns\TextColumn::make('released_at')
                    ->dateTime()
                    ->label('公开时间'),
                Tables\Columns\TextColumn::make('vote_count')->label('点赞数量'),
                Tables\Columns\TextColumn::make('collect_count')->label('收藏数量'),
                Tables\Columns\TextColumn::make('reply_count')->label('回复数量'),
                Tables\Columns\TextColumn::make('view_count')->label('查看总数'),
                Tables\Columns\TextColumn::make('lastReplyUser.name')->label('最后回复的用户'),
                Tables\Columns\TextColumn::make('excerpt')->label('摘要'),
                Tables\Columns\TextColumn::make('slug')->label('SEO 友好的 URL'),
                Tables\Columns\TextColumn::make('order')->label('排序'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('创建时间'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('最后更新时间'),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->label(''),
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
                FilamentExportBulkAction::make('export')
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
            'index' => Pages\ListTopics::route('/'),
            'create' => Pages\CreateTopic::route('/create'),
            'view' => Pages\ViewTopic::route('/{record}'),
            'edit' => Pages\EditTopic::route('/{record}/edit'),
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
