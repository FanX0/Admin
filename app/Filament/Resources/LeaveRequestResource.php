<?php

namespace App\Filament\Resources;

use App\Enums\LeaveRequestStatus;
use App\Filament\Resources\EmployeeResource\RelationManagers\LeaveRequestsRelationManager;
use App\Filament\Resources\LeaveRequestResource\Pages;
use App\Models\LeaveRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class LeaveRequestResource extends Resource
{
    protected static ?string $model = LeaveRequest::class;
    protected static ?string $navigationGroup = 'Employee Management';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';

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
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('approve')
                    ->requiresConfirmation()
                    ->visible (fn (LeaveRequest $record) => $record->status == LeaveRequestStatus::PENDING)
                    ->icon('heroicon-m-check-circle')
                    ->action(function (LeaveRequest $record){
                        $record->approve();
                    })->after(function(){
                        Notification::make()
                        ->success()
                        ->title('Approved!')
                        ->body('The Leave Request has been Approved')
                        ->send();
                    }),
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
            'index' => Pages\ListLeaveRequests::route('/'),
            'create' => Pages\CreateLeaveRequest::route('/create'),
            'edit' => Pages\EditLeaveRequest::route('/{record}/edit'),
        ];
    }

    public static function getFormFields(): array
    {
        return [
            Forms\Components\Select::make('employee_id')
                ->relationship('employee', 'name')
                ->prefixIcon('heroicon-o-user')
                ->hiddenOn(LeaveRequestsRelationManager::class)
                ->searchable()
                ->preload()
                ->required(),
            Forms\Components\Section::make('Start Ending')
                ->columns(2)
                ->schema([
                    Forms\Components\DatePicker::make('start_date')
                        ->native(false)
                        ->required(),
                    Forms\Components\DatePicker::make('end_date')
                        ->native(false)
                        ->required(),
                ]),
            Forms\Components\Select::make('type')
                ->enum(\App\Enums\LeaveRequestType::class)
                ->options(\App\Enums\LeaveRequestType::class)
                ->required(),
            Forms\Components\Select::make('status')
                ->enum(\App\Enums\LeaveRequestStatus::class)
                ->options(\App\Enums\LeaveRequestStatus::class)
                ->required(),
            Forms\Components\MarkdownEditor::make('reason')
                ->maxLength(65535)
                ->columnSpanFull(),
        ];
    }

    public static function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('employee.name')
                ->hiddenOn(LeaveRequestsRelationManager::class)
                ->sortable(),
            Tables\Columns\TextColumn::make('start_date')
                ->date()
                ->sortable(),
            Tables\Columns\TextColumn::make('end_date')
                ->date()
                ->sortable(),
            Tables\Columns\TextColumn::make('type')
                ->searchable(),
            Tables\Columns\TextColumn::make('status')
                ->badge(),
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
