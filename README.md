# CRUD Generator
A simple crud generator for Laravel Framework

## Installation
You can install the package via composer:

```bash
composer require ion/crud-generator
```
## Usage
You can create :
- Migration with its columns.
- Model with fillable attributes.
- RequestForm with validation.
- Resource with a transformation layer.
- Api resource routes.
- Controller CRUD.

Via this command
```bash
php artisan make:crud example --f="titile:string, is_visible:boolean"
```
the `id` and `timestaps` will be generated in migraion file by default.

for other types of columns you can find them in 
[Laravel Docs](https://laravel.com/docs/8.x/migrations#creating-columns)

### The Generation Resualt
- Migration
```php
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examples', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('is_visible');
            $table->timestamps();
        });
    }
```
- Model
```php
    class Example extends Model
    {
        use HasFactory;

        /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
        protected $fillable = [
            'title', ' is_visible'
        ];
    } 
```
- Request
```php
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required',],
            'is_visible' => ['required',]
        ];
    }
```
- Resource
```php
    class ExampleResource extends JsonResource
    {
        /**
        * Transform the resource into an array.
        *
        * @param  \Illuminate\Http\Request  $request
        * @return array
        */
        public function toArray($request)
        {
            return [
                'title' => $this->title,
                'is_visible' => $this->is_visible
            ];
        }
    }
```
- Controller
```php
class ExampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\ExampleResource
     */
    public function index()
    {
        return ExampleResource::collection(Example::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ExampleRequest  $request
     * @return \App\Http\Resources\ExampleResource
     */
    public function store(ExampleRequest $request)
    {
        Example::create($request->all());
        return response()->json([
            'message' => 'row created'
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \App\Http\Resources\ExampleResource
     */
    public function show($id)
    {
        return new ExampleResource(Example::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ExampleRequest  $request
     * @param  int  $id
     * @return \App\Http\Resources\ExampleResource
     */
    public function update(ExampleRequest $request, $id)
    {
        $example = Example::findOrFail($id);
        $example->update($request->all());
        return new ExampleResource($example);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $example = Example::findOrFail($id);
        $example->delete();
         return response()->json([
            'message' => 'row deleted'
        ],201);
    }
}
```





## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
