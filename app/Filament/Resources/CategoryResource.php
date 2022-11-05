<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $label = '话题类目';

    protected static ?string $breadcrumb = '话题类目';

    protected static ?string $navigationIcon = 'iconsax-bro-category-2';

    protected static ?string $navigationLabel = '类目管理';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->label('类目名称')->required()->maxLength(255),
                Forms\Components\Toggle::make('is_directory')->label('是否目录')->required(),
                Forms\Components\Select::make('parent_id')
                    ->label('父类目')
                    ->options(Category::where('is_directory', true)->pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\Toggle::make('show')->label('是否显示')->required(),
                Forms\Components\TextInput::make('order')->label('排序')->required(),
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
                Tables\Columns\TextColumn::make('parent.name')->label('父类目'),
                Tables\Columns\TextColumn::make('name')->label('类目名称')->searchable(),
                Tables\Columns\TextColumn::make('level')->label('层级'),
                Tables\Columns\BooleanColumn::make('is_directory')->label('是否目录'),
                Tables\Columns\TextColumn::make('path')->label('类目路径'),
                Tables\Columns\BooleanColumn::make('show')->label('是否显示'),
                Tables\Columns\TextColumn::make('order')->label('排序')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('创建时间')->sortable()->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->label('编辑时间')->sortable()->dateTime(),
                Tables\Columns\TextColumn::make('deleted_at')->label('删除时间')->sortable()->dateTime(),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'view' => Pages\ViewCategory::route('/{record}'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
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
