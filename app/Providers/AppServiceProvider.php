<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
     // Model::preventLazyLoading(app()->environment('local'));
      Model::preventLazyLoading();

     Builder::macro('whereLike', function ($attributes, string $searchTerm) {
        $this->where(function (Builder $query) use ($attributes, $searchTerm) {
            foreach (Arr::wrap($attributes) as $attribute) {
                $query->when(
                    str_contains($attribute, '.'),
                    function (Builder $query) use ($attribute, $searchTerm) {
                        $buffer = explode('.', $attribute);
                        $attributeField = array_pop($buffer);
                        $relationPath = implode('.', $buffer);
                        $query->orWhereHas($relationPath, function (Builder $query) use ($attributeField, $searchTerm) {
                            $query->where($attributeField, 'LIKE', "%{$searchTerm}%");
                        });
                    },
                    function (Builder $query) use ($attribute, $searchTerm) {
                        $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                    }
                );
            }
        });
        return $this;
    });
    
    Builder::macro('search',function($field,$string){
        return $string ? $this->where($field,'like','%'.$string.'%') : $this;
    });
    Builder::macro('orSearch',function($field,$string){
        return $string ? $this->orWhere($field,'like','%'.$string.'%') : $this;
    });

    }
}
