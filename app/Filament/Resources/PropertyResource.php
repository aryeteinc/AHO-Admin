<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages;
use App\Filament\Resources\PropertyResource\RelationManagers;
use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';
    protected static ?string $navigationLabel = 'Inmuebles';
    protected static ?string $pluralLabel = 'Listado de Inmuebles';

    public static function form(Form $form): Form
    {



        return $form
            ->schema([
                Forms\Components\Section::make('Información del Inmueble')
                    ->schema([
                        Forms\Components\Section::make('Crear Inmueble')
                            ->description('Es el codigo interno de la Inmobiliaria')
                            ->collapsible()
                            ->schema([
                            Forms\Components\TextInput::make('inner_id')
                                ->label('Id Constructora')
                                ->unique(ignoreRecord: true)
                                ->extraAttributes(['oninput' => 'this.value = this.value.replace(/[^0-9]/g, "")'])
                                ->required()
                                ->live(debounce: 500)
                                ->afterStateUpdated(function (Get $get, Set $set, ?string $operation, ?string $old, ?string $state, ?Model $record) {
                                    $set('name', 'Inmueble ' . $state);
                                    $set('slug', 'inmueble-' . $state);

                                    //Obtener el valor del campo inner_id y y usarlo para el nombre del directorio de las imagenes
                                    //al momento de subir las imagenes
                                    //$set('images.directory', 'properties/' . $state);
                                }),
                            Forms\Components\TextInput::make('name')
                                ->label('Nombre')
                                ->required()
                                ->readOnly(),
                            Forms\Components\TextInput::make('slug')
                                ->label('Slug')
                                ->unique(ignoreRecord: true)
                                ->required()
                                ->readOnly()
                                ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                                    $set('images.directory', 'properties/' . $state);
                                }),

                            Forms\Components\RichEditor::make('description')
                                ->label('Descripción')
                                ->required()
                                ->columnSpanFull(),
                        ])->columns(3),

                        Forms\Components\Section::make('Dirección del Inmueble')
                            ->description('Datos de la Dirección')
                            ->schema([

                            Forms\Components\TextInput::make('address')
                                ->label('Dirección')
                                ->required(),

                            Forms\Components\TextInput::make('neighborhood')
                                ->label('Barrio')
                                ->required(),

                            Forms\Components\Select::make('city_id')
                                ->label('Ciudad')
                                ->relationship('city', 'name')
                                ->searchable()
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                                    $set('department_id', \App\Models\City::find($state)?->department_id);
                                }),

                           //al seleccionar la ciudad se debe cargar el departamento en el select de abajo
                            Forms\Components\Select::make('department_id')
                                ->label('Departamento')
                                ->options(function (Get $get) {
                                    $cityId = $get('city_id');
                                    return \App\Models\Department::whereHas('cities', function ($query) use ($cityId) {
                                        $query->where('id', $cityId);
                                    })->pluck('name', 'id');
                                })
                                ->required(),
                        ])->columns(3),

                        //$table->unsignedTinyInteger('parking');
                        //$table->unsignedTinyInteger('air_conditioning');
                        //$table->unsignedTinyInteger('bedroom_with_bathroom');
                        //$table->unsignedTinyInteger('bedroom_without_bathroom');
                        //$table->unsignedTinyInteger('bedroom_total');
                        //$table->unsignedTinyInteger('bathroom_total');
                        //$table->unsignedTinyInteger('half_bathroom'); //Rango: 0 a 255
                        //$table->unsignedSmallInteger('year_built'); //0 a 65,535
                        //$table->unsignedTinyInteger('stratum'); //0 a 255
                        //$table->unsignedTinyInteger('backyard');

                        Forms\Components\Section::make('Detalles del Inmueble')
                        ->description('Datos del Inmueble')
                        ->schema([
                            Forms\Components\TextInput::make('price')
                                ->label('Precio')
                                ->prefix('$')
                                ->mask(RawJs::make('$money($input)'))
                                ->stripCharacters(',')
                                ->numeric()
                                //hacer requerido si el campo deal_id es igual a 1,4 o 5
                                ->required(fn (Get $get) => in_array($get('deal_id'), [1, 4, 5]))
                                ->extraAttributes(['oninput' => 'this.value = this.value.replace(/[^0-9]/g, "")']),

                            Forms\Components\TextInput::make('cannon_price')
                                ->label('Canon')
                                ->prefix('$')
                                ->mask(RawJs::make('$money($input)'))
                                ->stripCharacters(',')
                                ->numeric()
                                ->required(fn (Get $get) => in_array($get('deal_id'), [2, 4, 6]))
                                ->extraAttributes(['oninput' => 'this.value = this.value.replace(/[^0-9]/g, "")']),

                            Forms\Components\TextInput::make('admin_price')
                                ->label('Administración')
                                ->prefix('$')
                                ->mask(RawJs::make('$money($input)'))
                                ->stripCharacters(',')
                                ->numeric()
                                ->extraAttributes(['oninput' => 'this.value = this.value.replace(/[^0-9]/g, "")']),

                            Forms\Components\TextInput::make('area_building')
                                ->label('Área Construida')
                                ->numeric()
                                ->suffix('m2')
                                ->extraAttributes(['oninput' => 'this.value = this.value.replace(/[^0-9]/g, "")']),

                            Forms\Components\TextInput::make('area_land')
                                ->label('Área no Construido')
                                ->numeric()
                                ->suffix('m2')
                                ->extraAttributes(['oninput' => 'this.value = this.value.replace(/[^0-9]/g, "")']),

                            Forms\Components\TextInput::make('area_total')
                                ->label('Área Total')
                                ->numeric()
                                ->suffix('m2')
                                ->required()
                                ->extraAttributes(['oninput' => 'this.value = this.value.replace(/[^0-9]/g, "")']),

                            Forms\Components\Select::make('parking')
                                ->label('Parqueadero')
                                ->options(array_combine(range(1, 4), range(1, 4))),

                            Forms\Components\Select::make('air_conditioning')
                                ->label('Aire Acondicionado')
                                ->options(array_combine(range(1, 5), range(1, 5))),

                            Forms\Components\Select::make('bedroom_with_bathroom')
                                ->label('Habitaciones con Baño')
                                ->options(array_combine(range(1, 5), range(1, 5))),

                            Forms\Components\Select::make('bedroom_without_bathroom')
                                ->label('Habitaciones sin Baño')
                                ->options(array_combine(range(1, 5), range(1, 5))),

                            Forms\Components\Select::make('bedroom_total')
                                ->label('Total Habitaciones')
                                ->options(array_combine(range(1, 5), range(1, 5))),

                            Forms\Components\Select::make('bathroom_total')
                                ->label('Total Baños')
                                ->options(array_combine(range(1, 5), range(1, 5))),

                            Forms\Components\Select::make('half_bathroom')
                                ->label('Medio Baño')
                                ->options(array_combine(range(0, 10), range(0, 10))),

                            Forms\Components\Select::make('year_built')
                                ->label('Año de Construcción')
                                ->options(array_merge(array_combine(range(1, 10), range(1, 10)), [20 => 'mas de 20', 30 => 'mas de 30', 40 => 'mas de 40'])),

                            Forms\Components\Select::make('stratum')
                                ->label('Estrato')
                                ->options(array_combine(range(1, 8), range(1, 8))),

                            Forms\Components\Select::make('backyard')
                                ->label('Patio')
                                ->options(array_combine(range(1, 3), range(1, 3))),
                        ])->columns(4),
                    ])->columnSpan(8),

                Forms\Components\Section::make('Clasificaciones')
                    ->schema([
                        Forms\Components\Section::make()
                        ->schema([
                            Forms\Components\Select::make('clasification_id')
                                ->label('Clasificación')
                                ->relationship('clasification', 'name')
                                ->required(),

                                Forms\Components\Select::make('type_id')
                                    ->label('Tipo')
                                    ->relationship('type', 'name')
                                    ->required(),

                                Forms\Components\Select::make('deal_id')
                                    ->label('Negocio')
                                    ->relationship('deal', 'name')
                                    ->required(),

                                Forms\Components\Select::make('status_id')
                                    ->label('Estado')
                                    ->relationship('status', 'name')
                                    ->required(),

                                Forms\Components\Select::make('asesor_id')
                                    ->label('Asesor')
                                    ->relationship('asesor', 'name')
                                    ->searchable()
                                    ->required()
                                    ->createOptionForm([
                                        //Crear un layout personalizado para el formulario de creación de asesores
                                        Forms\Components\Section::make()
                                            ->schema([
                                                Forms\Components\TextInput::make('name')
                                                    ->required()
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make('last_name')
                                                    ->live(debounce: 800)
                                                    ->reactive()
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->afterStateUpdated(function (Get $get, Set $set, ?string $operation, ?string $old, ?string $state, ?Model $record) {
                                                        $name = $get('name');
                                                        $last_name = $get('last_name');
                                                        $set('slug', Str::slug($name.' '.$last_name));
                                                    }),
                                                Forms\Components\TextInput::make('slug')
                                                    ->disabled()
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                                                        $set('avatar.directory', 'asesors/' . $state);
                                                    }),
                                                Forms\Components\TextInput::make('email')
                                                    ->email()
                                                    ->required()
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make('phone')
                                                    ->tel()
                                                    ->maxLength(255),
                                                Forms\Components\FileUpload::make('avatar')
                                                    ->avatar()
                                                    ->directory(fn (Get $get) => 'asesors/' . $get('slug')),
                                                Forms\Components\Toggle::make('is_active')
                                                    ->required(),
                                            ])->columns(3),
                                    ]),
                        ]),

                        Forms\Components\Section::make()
                            ->schema([
                            Forms\Components\Select::make('tags')
                                ->label('Etiquetas')
                                ->relationship('tags', 'name')
                                ->searchable()
                                ->multiple(),
                        ]),

                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\FileUpload::make('docs')
                                    ->label('Adjuntar Documentos')
                                    ->multiple()
                                    ->directory('documents')
                                    ->acceptedFileTypes(['application/pdf','application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                                    ->previewable()
                                    ->maxFiles(5),
                            ]),

                ])->columnSpan(4),

                Forms\Components\Section::make('Características')
                    ->schema([
                    Forms\Components\CheckboxList::make('details')
                        ->label('Detalles')
                        ->relationship('details', 'name')
                        ->searchable()
                        ->columns(4),

                    ])->columnSpanFull(),

                Forms\Components\Section::make('Imágenes y Videos')
                    ->schema([
                        Forms\Components\FileUpload::make('images')
                            //usar el valor del campo inner_id para el nombre del directorio
                            ->label('Imágenes')
                            ->image()
                            ->panelLayout('grid')
                            ->multiple()
                            ->reorderable()
                            ->appendFiles()
                            ->maxFiles(30)
    //                        ->uploadButtonPosition('left')
    //                        ->uploadProgressIndicatorPosition('left')
                            ->directory(fn (Get $get) => 'properties/' . $get('slug')),

//                        SpatieMediaLibraryFileUpload::make('images')
//                            ->collection('all_images')
//                            ->responsiveImages()
//                            ->label('Imágenes')
//                            ->image()
//                            ->panelLayout('grid')
//                            ->multiple()
//                            ->reorderable()
//                            ->appendFiles()
//                            ->maxFiles(30)
//                            //                        ->uploadButtonPosition('left')
//                            //                        ->uploadProgressIndicatorPosition('left')
//                            ->directory(fn (Get $get) => 'properties/' . $get('slug')),

                    ])->columnSpanFull(),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('clasification.name'),
                TextColumn::make('type.name'),
                TextColumn::make('deal.name'),

                TextColumn::make('price')
                    ->money()
                    ->label('Precio'),
                    //->visible(fn ($record) => $record->deal_id === 1), // Assuming 1 is the ID for 'Venta'
                TextColumn::make('cannon_price')
                    ->money()
                    ->label('canon'),
                    //->visible(fn ($record) => $record->deal_id === 2),
                ImageColumn::make('images')
                    ->circular()
                    ->stacked()
                    ->limit(3)
                    ->limitedRemainingText(),
                ImageColumn::make('asesor.avatar')
                    ->circular()
                    //Obtener el nombre completo del asesor en el tooltip
                    ->tooltip(fn ($record) => $record->asesor->full_name),

//                TextColumn::make('details.name')
//                    ->listWithLineBreaks()
//                    ->bulleted()
//                    ->limitList(1)
//                    ->expandableLimitedList()
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
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }
}
