<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermissionResource\Pages;
use App\Filament\Resources\PermissionResource\RelationManagers\RoleRelationManager;
use App\Filament\Resources\RoleRelationManagerResource\RelationManagers\RolesRelationManager;
use Filament\Actions\CreateAction;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class PermissionResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationLabel = 'Permissões';

    protected static ?string $navigationGroup = 'Administração';  

    protected static ?string $pluralLabel = 'Permissões';
    protected static ?string $label = 'Permissão';
    protected static bool $isScopedToTenant = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Grid::make(12)->schema(
                        self::fields()
                    )
                ]),
            ]);

    }

    public static function fields(): array
    {
        $fields = [];
        $fields[] = TextInput::make('name')
            ->rules(['max:255', 'string'])
            ->label('Nome')
            ->required()
            ->placeholder('Nome')
            ->columnSpan([
                'default' => 12,
                'md' => 12,
                'lg' => 12,
            ]);

        $regras = Permission::query()->select('order', 'title')->groupBy('order', 'title')->orderBy('order')->get();

        foreach ($regras as $grupo) {
            $fields[] = CheckboxList::make('regras')
                ->label(fn () => 'Regras -> ' . $grupo->title)
                ->columns(5)
                ->bulkToggleable()
                ->relationship('permissions', 'name', fn (Builder $query) => $query->where('order', $grupo->order)->orderBy('order', 'asc')->orderby('name', 'asc'))
                ->columnSpan([
                    'default' => 12,
                    'md' => 12,
                    'lg' => 12,
                ]);
        }
        return $fields;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nome'),

            ])
            ->filters([
                //
            ])
        
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])           
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPermissions::route('/'),
            'create' => Pages\CreatePermission::route('/create'),
            'edit' => Pages\EditPermission::route('/{record}/edit'),
        ];
    }
}
