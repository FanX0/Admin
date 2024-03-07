<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SalaryResource\Pages;
use App\Models\Salary;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Resources\EmployeeResource\RelationManagers\SalariesRelationManager;
use App\Traits\DefaultCounterNavigationBadge;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\Summarizers\Sum;

class SalaryResource extends Resource
{
    use DefaultCounterNavigationBadge;
    protected static ?string $model = Salary::class;
    protected static ?string $navigationGroup = 'Employee Management';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::getFormFields());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(self::getTableColumns())
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
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
            'index' => Pages\ListSalaries::route('/'),
            // 'create' => Pages\CreateSalary::route('/create'),
            // 'edit' => Pages\EditSalary::route('/{record}/edit'),
        ];
    }

    public static function getFormFields(): array
    {
        return [
            Forms\Components\Select::make('employee_id')
                ->relationship('employee', 'name')
                ->searchable()
                ->preload()
                ->required(),
            Forms\Components\TextInput::make('amount')
                ->required()
                ->prefix('Rp.')
                ->mask(\Filament\Support\RawJs::make('$money($input')),
            Forms\Components\DatePicker::make('effective_date')
                ->native(false)
                ->default(now()->addMonth(6)->startOfMonth())
                ->required(),
        ];
    }

    public static function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('employee.name')
                ->numeric()
                ->sortable()
                ->hiddenOn(SalariesRelationManager::class),
            Tables\Columns\TextColumn::make('amount')
                ->numeric()
                ->prefix('Rp. ')
                ->sortable()
                ->summarize(
                    Sum::make('amount')
                        ->money('IDR'),
                ),
            Tables\Columns\TextColumn::make('effective_date')
                ->date()
                ->sortable(),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }
}
