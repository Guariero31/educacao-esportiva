<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\PasswordInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $pluralLabel = 'Usuários';

    protected static ?string $label = 'Usuário';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Administração';

    protected static bool $isScopedToTenant = false;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Novo Usuário')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->label('Nome')
                            ->maxLength(255),
                        TextInput::make('email')
                            ->required()
                            ->label('E-mail')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('password')
                            ->required()
                            ->label('Senha')
                            ->password()
                            ->maxLength(255),
                        Select::make('escola')
                            ->relationship('escolas', 'nome')
                            ->preload()
                            ->multiple()
                    ]),
                    Section::make('Permissões')
                    ->schema([
                        Forms\Components\Grid::make(1)->schema([
                            Select::make('roles')
                                ->label('Permissões')
                                ->multiple()
                                ->relationship('roles', 'name', modifyQueryUsing: function ($query) {
                                    if (!empty(Auth::user()->escola_id)) {
                                        return $query->where('escola_id', Auth::user()->escola_id);
                                    }
                                    return $query;
                                })
                                ->preload()
                                ->columnSpan([
                                    'default' => 12,
                                    'md' => 12,
                                    'lg' => 12,
                                ]),
                        ])
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-mail')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->date(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
